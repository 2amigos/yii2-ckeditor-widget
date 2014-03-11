<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\ckeditor;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * CKEditorInline renders a CKEditor js plugin for inline editing.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\ckeditor
 */
class CKEditorInline extends Widget
{
	use CKEditorTrait;

	/**
	 * @var array the HTML attributes for the input tag.
	 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
	 */
	public $options = [];

	/**
	 * @var string
	 */
	public $tag = 'div';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
		$this->options['contenteditable'] = 'true';

		parent::init();

		$this->initOptions();

		echo Html::beginTag($this->tag, $this->options);
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		echo Html::endTag($this->tag);

		$this->registerPlugin();
	}

	/**
	 * Registers CKEditor plugin
	 */
	protected function registerPlugin()
	{
		$view = $this->getView();

		CKEditorAsset::register($view);

		$id = $this->options['id'];

		$options = $this->clientOptions !== false && !empty($this->clientOptions)
			? Json::encode($this->clientOptions)
			: '{}';

		$js = "CKEDITOR.disableAutCKEDITOR.inline('$id', $options);";
		$view->registerJs($js);
	}
} 