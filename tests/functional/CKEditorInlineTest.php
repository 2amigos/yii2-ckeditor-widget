<?php

namespace tests;


use tests\data\overrides\TestCKEditorInline;

class CKEditorInlineTest extends TestCase
{

    public function testRenderWithModel()
    {
        $out = TestCKEditorInline::widget([
            'id' => 'test-inline',
        ]);
        $expected = '<div id="test-inline" contenteditable="true"></div>';

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
