<?php

namespace tests;

use tests\data\overrides\TestCKEditorWidgetAsset;
use yii\web\AssetBundle;

class CKEditorWidgetAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TestCKEditorWidgetAsset::register($view);
        $this->assertEquals(4, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['tests\\data\\overrides\\TestCKEditorWidgetAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/data/views/rawlayout.php');
        $this->assertContains('jquery.js', $content);
        $this->assertContains('ckeditor.js', $content);
        $this->assertContains('dosamigos-ckeditor.widget.js', $content);
    }
}
