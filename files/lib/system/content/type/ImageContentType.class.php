<?php
namespace cms\system\content\type;

use cms\data\content\Content;
use cms\data\file\File;
use wcf\system\WCF;

/**
 * @author	Jens Krumsieck
 * @copyright	2014 codeQuake
 * @license	GNU Lesser General Public License <http://www.gnu.org/licenses/lgpl-3.0.txt>
 * @package	de.codequake.cms
 */
class ImageContentType extends AbstractContentType {
	/**
	 * @see	\cms\system\content\type\AbstractContentType::$icon
	 */
	protected $icon = 'icon-picture';

	public $multilingualFields = array(
		'text'
	);

	public function getFormTemplate() {
		WCF::getTPL()->assign('file', new File(0));
		return 'imageContentType';
	}

	public function getOutput(Content $content) {
		$data = $content->handleContentData();
		$image = new File($data['imageID']);
		WCF::getTPL()->assign(array(
			'data' => $data,
			'image' => $image
		));
		
		return WCF::getTPL()->fetch('imageContentType', 'cms');
	}
}
