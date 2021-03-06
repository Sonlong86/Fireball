<?php
namespace cms\system\content\type;

use cms\data\content\Content;
use wcf\system\WCF;

/**
 * @author	Jens Krumsieck
 * @copyright	2013 - 2015 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class FourColumnsContentType extends AbstractStructureContentType {
	/**
	 * @see	\cms\system\content\type\AbstractStructureContentType::getCSSClasses()
	 */
	public function getCSSClasses() {
		return 'gridContainer';
	}

	/**
	 * @see	\cms\system\content\type\AbstractStructureContentType::getChildCSSClasses()
	 */
	public function getChildCSSClasses(Content $content) {
		$parent = $content->getParentContent();
		$data = $parent->handleContentData();
		if (isset($data['width'])) $width = array(
			substr($data['width'], 0, 2),
			substr($data['width'], 2, 2),
			substr($data['width'], 4, 2),
			substr($data['width'], 6, 2)
		);
		else $width = array(
			25,
			25,
			25,
			25
		);
		
		switch ($content->showOrder % 3) {
			case 0:
				$gridWidth = $width[3];
				break;
			case 1:
				$gridWidth = $width[0];
				break;
			case 2:
				$gridWidth = $width[1];
				break;
			case 3:
				$gridWidth = $width[3];
				break;
		}
		return 'grid grid' . $gridWidth;
	}
}
