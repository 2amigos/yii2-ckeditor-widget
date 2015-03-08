<?php

namespace tests;


use dosamigos\ckeditor\CKEditorTrait;


class CKEditorTraitTest extends TestCase
{
    public function testPreset() {
        $trait = new TestCKEditorTrait();
        $this->assertAttributeEquals('standard', 'preset', $trait);
    }

    public function testInitOptions()
    {
        $class = new \ReflectionClass('tests\\TestCKEditorTrait');
        $method = $class->getMethod('initOptions');
        $method->setAccessible(true);

        $trait = new TestCKEditorTrait();
        $trait->preset = 'basic';

        $method->invoke($trait);
        $basic = [
            ['name' => 'undo'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
            ['name' => 'colors'],
            ['name' => 'links', 'groups' => ['links', 'insert']],
            ['name' => 'others', 'groups' => ['others', 'about']],
        ];
        $this->assertArrayHasKey('toolbarGroups', $trait->clientOptions);

        $this->assertEquals($basic, $trait->clientOptions['toolbarGroups']);
    }

    public function testCustomAndDefaultPresets()
    {
        $class = new \ReflectionClass('tests\\TestCKEditorTrait');
        $method = $class->getMethod('initOptions');
        $method->setAccessible(true);

        $trait = new TestCKEditorTrait();
        $trait->preset = 'custom';

        $method->invoke($trait);

        $this->assertEquals([], $trait->clientOptions);

        $trait->preset = 'non-existent-preset';
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
        $method->invoke($trait);
        $this->assertArrayHasKey('toolbarGroups', $trait->clientOptions);

        $this->assertEquals($standard, $trait->clientOptions['toolbarGroups']);

    }
}

class TestCKEditorTrait {
    use CKEditorTrait;
}
