<?php
namespace cms\system\event\listener;

use wcf\data\package\PackageCache;
use wcf\system\event\IEventListener;

/**
 * @author	Jens Krumsieck
 * @copyright	2013 - 2015 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class PageMenuListener implements IEventListener {
	/**
	 * @see	\wcf\system\event\IEventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		if ($eventObj->menuItemController == 'cms\page\PagePage') {
			$eventObj->additionalFields['className'] = 'cms\system\menu\page\CMSPageMenuItemProvider';
			$eventObj->additionalFields['packageID'] = PackageCache::getInstance()->getPackageID('de.codequake.cms');
		}
	}
}
