<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\ckeditor;

use yii\web\AssetBundle;

class CKEditorAsset extends AssetBundle
{
	public $sourcePath = '@vendor/ckeditor/ckeditor';

	public $js = [
		'ckeditor.js',
		'adapters/jquery.js'
	];

	public $depends = [
		'yii\web\JqueryAsset'
	];
} 