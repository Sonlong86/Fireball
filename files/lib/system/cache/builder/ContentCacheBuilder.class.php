<?php
namespace cms\system\cache\builder;

use cms\data\content\ContentList;
use wcf\system\cache\builder\AbstractCacheBuilder;

/**
 * @author	Jens Krumsieck
 * @copyright	2013 - 2015 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class ContentCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @see	\wcf\system\cache\builder\AbstractCacheBuilder::rebuild()
	 */
	public function rebuild(array $parameters) {
		$data = array(
			'contens' => array(),
			'tree' => array()
		);

		$list = new ContentList();
		$list->sqlOrderBy = 'parentID ASC, showOrder ASC';
		$list->readObjects();
		$data['contents'] = $list->getObjects();

		foreach ($data['contents'] as $content) {
			$data['tree'][$content->parentID][] = $content->contentID;
		}

		return $data;
	}
}
