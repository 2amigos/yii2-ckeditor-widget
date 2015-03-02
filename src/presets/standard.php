<?php
/**
 *
 * standard preset returns the basic toolbar configuration set for CKEditor.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
return [
    'height' => 300,
    'toolbarGroups' => [
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
    ],
    'removeButtons' => 'Smiley,Iframe'
];
