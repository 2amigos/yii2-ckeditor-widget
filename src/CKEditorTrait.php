<?php
/**
 * @copyright Copyright (c) 2013-2019 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\ckeditor;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * CKEditorTrait has common methods for both CKEditor and CKEditorInline widgets.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\ckeditor
 */
trait CKEditorTrait
{
    /**
     * @var string the toolbar preset. It can be any of the following:
     *
     * - basic: will load the configuration on presets/basic.php
     * - full: will load the configuration on presets/full.php
     * - standard: will load the configuration on presets/standard.php
     * - custom: configuration will be based on [[clientOptions]].
     *
     * Defaults to 'standard'. It is important to note that any configuration item of the loaded presets can be
     * overrided by [[clientOptions]]
     */
    public $preset = 'standard';

    /**
     * Enable or disable kcfinder
     * @link https://kcfinder.sunhater.com
     * @var boolean
     */
    public $kcfinder = false;

    /**
     * KCFinder dynamic settings (using session)
     * @link http://kcfinder.sunhater.com/install#dynamic
     * @var array
     */
    public $kcfOptions = [];

    /**
     * KCFinder default dynamic settings
     * @link http://kcfinder.sunhater.com/install#dynamic
     * @var array
     */
    public static $kcfDefaultOptions = [
        'disabled' => false,
        'uploadURL' => '@web/upload',
        'uploadDir' => '@webroot/upload',
        'denyZipDownload' => true,
        'denyUpdateCheck' => true,
        'denyExtensionRename' => true,
        'theme' => 'default',
        'access' => [ // @link http://kcfinder.sunhater.com/install#_access
            'files' => [
                'upload' => true,
                'delete' => true,
                'copy' => true,
                'move' => true,
                'rename' => true,
            ],
            'dirs' => [
                'create' => true,
                'delete' => true,
                'rename' => true,
            ],
        ],
        'types' => [  // @link http://kcfinder.sunhater.com/install#_types
            'files' => [
                'type' => '',
            ],
        ],
        'thumbsDir' => '.thumbs',
        'thumbWidth' => 100,
        'thumbHeight' => 100,
    ];

    /**
     * @var array the options for the CKEditor 4 JS plugin.
     * Please refer to the CKEditor 4 plugin Web page for possible options.
     * @see http://docs.ckeditor.com/#!/guide/dev_installation
     */
    public $clientOptions = [];

    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        if ($this->kcfinder) {
            $this->registerKCFinder();
        }

        $options = [];
        switch ($this->preset) {
            case 'custom':
                $preset = null;
                break;
            case 'basic':
            case 'full':
            case 'standard':
                $preset = 'presets/' . $this->preset . '.php';
                break;
            default:
                $preset = 'presets/standard.php';
        }
        if ($preset !== null) {
            $options = require($preset);
        }
        $this->clientOptions = ArrayHelper::merge($options, $this->clientOptions);
    }

    /**
     * Registers KCFinder (@link https://kcfinder.sunhater.com)
     * @author Nabi KaramAliZadeh <NabiKAZ@gmail.com
     * @link http://www.nabi.ir
     */
    protected function registerKCFinder()
    {
        $this->kcfOptions = array_merge(self::$kcfDefaultOptions, $this->kcfOptions);

        $this->kcfOptions['uploadURL'] = Yii::getAlias($this->kcfOptions['uploadURL']);
        $this->kcfOptions['uploadDir'] = Yii::getAlias($this->kcfOptions['uploadDir']);

        Yii::$app->session['KCFINDER'] = $this->kcfOptions;

        $register = KCFinderAsset::register($this->view);
        $kcfinderUrl = $register->baseUrl;

        $browseOptions = [
            'filebrowserBrowseUrl' => $kcfinderUrl . '/browse.php?opener=ckeditor&type=files',
            'filebrowserUploadUrl' => $kcfinderUrl . '/upload.php?opener=ckeditor&type=files',
        ];

        $this->clientOptions = ArrayHelper::merge($browseOptions, $this->clientOptions);
    }
}
