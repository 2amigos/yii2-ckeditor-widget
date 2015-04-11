<?php

namespace tests;


use tests\data\models\Post;
use tests\data\overrides\TestCKEditor;
use yii\web\View;

class CKEditorTest extends TestCase
{

    public function testRenderWithModel()
    {
        $model = new Post();
        $out = TestCKEditor::widget([
            'model' => $model,
            'attribute' => 'message'
        ]);
        $expected = '<textarea id="post-message" name="Post[message]"></textarea>';

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithNameAndValue()
    {
        $out = TestCKEditor::widget([
            'id' => 'test',
            'name' => 'test-editor-name',
            'value' => 'test-editor-value'
        ]);
        $expected = '<textarea id="test" name="test-editor-name">test-editor-value</textarea>';

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testCKEditorBasic()
    {
        $model = new Post();

        $widget = TestCKEditor::begin(
            [
                'model' => $model,
                'attribute' => 'message',
                'preset' => 'basic'
            ]
        );
        $basic = [
            ['name' => 'undo'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
            ['name' => 'colors'],
            ['name' => 'links', 'groups' => ['links', 'insert']],
            ['name' => 'others', 'groups' => ['others', 'about']],
        ];
        $this->assertArrayHasKey('toolbarGroups', $widget->clientOptions);
        $this->assertEquals($basic, $widget->clientOptions['toolbarGroups']);

    }

    public function testCKEditorStandard()
    {
        $model = new Post();

        $widget = TestCKEditor::begin(
            [
                'model' => $model,
                'attribute' => 'message',
                'preset' => 'standard'
            ]
        );
        $standard = [
            ['name' => 'clipboard', 'groups' => ['mode', 'undo', 'selection', 'clipboard', 'doctools']],
            ['name' => 'editing', 'groups' => ['tools', 'about']],
            '/',
            ['name' => 'paragraph', 'groups' => ['templates', 'list', 'indent', 'align']],
            ['name' => 'insert'],
            '/',
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
            ['name' => 'colors'],
            ['name' => 'links'],
            ['name' => 'others'],
        ];
        $this->assertArrayHasKey('toolbarGroups', $widget->clientOptions);
        $this->assertEquals($standard, $widget->clientOptions['toolbarGroups']);
    }

    public function testCKEditorFull()
    {
        $model = new Post();

        $widget = TestCKEditor::begin(
            [
                'model' => $model,
                'attribute' => 'message',
                'preset' => 'full'
            ]
        );
        $full = [
            ['name' => 'document', 'groups' => ['mode', 'document', 'doctools']],
            ['name' => 'clipboard', 'groups' => ['clipboard', 'undo']],
            ['name' => 'editing', 'groups' => [ 'find', 'selection', 'spellchecker']],
            ['name' => 'forms'],
            '/',
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors','cleanup']],
            ['name' => 'paragraph', 'groups' => [ 'list', 'indent', 'blocks', 'align', 'bidi' ]],
            ['name' => 'links'],
            ['name' => 'insert'],
            '/',
            ['name' => 'styles'],
            ['name' => 'blocks'],
            ['name' => 'colors'],
            ['name' => 'tools'],
            ['name' => 'others'],
        ];
        $this->assertArrayHasKey('toolbarGroups', $widget->clientOptions);
        $this->assertEquals($full, $widget->clientOptions['toolbarGroups']);
    }

    public function testCKEditorRegisterPluginScriptMethod()
    {
        $class = new \ReflectionClass('tests\\data\\overrides\\TestCKEditor');
        $method = $class->getMethod('registerPlugin');
        $method->setAccessible(true);

        $model = new Post();
        $widget = TestCKEditor::begin(
            [
                'model' => $model,
                'attribute' => 'message',
                'preset' => 'basic'
            ]
        );
        $view = $this->getView();
        $widget->setView($view);
        $method->invoke($widget);

        $test = 'CKEDITOR.replace(\'post-message\', {"height":200,"toolbarGroups":[{"name":"undo"},{"name":"basicstyles","groups":["basicstyles","cleanup"]},{"name":"colors"},{"name":"links","groups":["links","insert"]},{"name":"others","groups":["others","about"]}],"removeButtons":"Subscript,Superscript,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe","removePlugins":"elementspath","resize_enabled":false});'
            . "\n"
            . 'dosamigos.ckEditorWidget.registerOnChangeHandler(\'post-message\');';
        $this->assertEquals($test, $view->js[View::POS_READY]['test-ckeditor-js']);
    }
}
