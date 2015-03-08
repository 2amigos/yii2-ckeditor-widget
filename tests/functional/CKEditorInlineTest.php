<?php
/**
 *
 * CKEditorTest.php
 *
 * Date: 02/03/15
 * Time: 12:07
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */

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
