<?php
/**
 *
 * TestCKEditorAsset.php
 *
 * Date: 02/03/15
 * Time: 11:30
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

namespace tests;


use dosamigos\ckeditor\CKEditorAsset;
use yii\web\AssetBundle;

class CKEditorAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        CKEditorAsset::register($view);
        $this->assertEquals(3, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['dosamigos\\ckeditor\\CKEditorAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/data/views/rawlayout.php');
        $this->assertContains('jquery.js', $content);
        $this->assertContains('ckeditor.js', $content);
    }
}
