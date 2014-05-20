<?php
namespace cms\data\content;

use cms\data\content\section\ContentContentSectionList;
use cms\data\page\PageCache;
use cms\data\CMSDatabaseObject;
use wcf\data\object\type\ObjectTypeCache;
use wcf\system\request\IRouteController;
use wcf\system\WCF;

/**
 * Represents a content item.
 *
 * @author	Jens Krumsieck
 * @copyright	2014 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class Content extends CMSDatabaseObject implements IRouteController {
	protected static $databaseTableName = 'content';
	protected static $databaseTableIndexName = 'contentID';

	public function __construct($id, $row = null, $object = null) {
		if ($id !== null) {
			$sql = "SELECT *
                    FROM " . static::getDatabaseTableName() . "
                    WHERE (" . static::getDatabaseTableIndexName() . " = ?)";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array(
				$id
			));
			$row = $statement->fetchArray();

			if ($row === false) $row = array();
		}

		parent::__construct(null, $row, $object);
	}

	public function getPage() {
		return PageCache::getInstance()->getPage($this->pageID);
	}

	public function getTitle() {
		return $this->title;
	}

	public function getIcon() {
		$this->objectType = $this->getObjectType();
		return $this->objectType->getProcessor()->getIcon();
	}

	public function getOutput() {
		$this->objectType = $this->getObjectType();
		return $this->objectType->getProcessor()->getOutput($this);
	}

	public function getCategory() {
		$this->objectType = $this->getObjectType();
		return $this->objectType->category;
	}

	public function getParentContent() {
		if ($this->parentID !== null) return ContentCache::getInstance()->getContent($this->parentID);
		return null;
	}

	//build css structure
	public function getCSSClasses() {
		if ($this->getCategory() == 'structure') {
			if ($this->parentID != null && $this->getParentContent()->getCategory() == 'structure') {
				$childCSS = $this->getParentContent()->getObjectType()->getProcessor()->getChildCSSClasses($this);
				if ($childCSS != '') return $this->getObjectType()->getProcessor()->getCSSClasses().' '.$childCSS.' '.$this->cssClasses;
			}
			return $this->getObjectType()->getProcessor()->getCSSClasses().' '.$this->cssClasses;
		}
		if ($this->parentID != null && $this->getParentContent()->getCategory() == 'structure') {
			$childCSS = $this->getParentContent()->getObjectType()->getProcessor()->getChildCSSClasses($this);
			if ($childCSS != '') return $childCSS.' '.$this->cssClasses;
			return $this->cssClasses;
		}
		return $this->cssClasses;
	}

	public function handleContentData() {
		return @unserialize($this->contentData);
	}

	public function getObjectType() {
		return ObjectTypeCache::getInstance()->getObjectType($this->contentTypeID);
	}

	public function getTypeName() {
		$this->objectType = $this->getObjectType();
		return $this->objectType->objectType;
	}
}
