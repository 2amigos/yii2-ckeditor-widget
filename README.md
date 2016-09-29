CKEditor Widget for Yii2
========================

[![Latest Version](https://img.shields.io/github/tag/2amigos/yii2-ckeditor-widget.svg?style=flat-square&label=release)](https://github.com/2amigos/yii2-ckeditor-widget/tags)
[![Software License](https://img.shields.io/badge/license-BSD-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-ckeditor-widget/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-ckeditor-widget)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-ckeditor-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-ckeditor-widget/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-ckeditor-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-ckeditor-widget)
[![Total Downloads](https://img.shields.io/packagist/dt/2amigos/yii2-ckeditor-widget.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-ckeditor-widget)

Renders a [CKEditor WYSIWYG text editor plugin](http://www.ckeditor.com) widget.

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require 2amigos/yii2-ckeditor-widget
```
or add

```json
"2amigos/yii2-ckeditor-widget" : "2.0"
```

to the require section of your application's `composer.json` file.

Skins & Plugins
---------------

This widget works with default's `dev-full/stable` branch of CKEditor, with a set of plugins and skins. If you wish to
configure a different skins or plugins that the one proposed, you will have to download them separately and configure
the widget's `clientOptions` attribute accordingly.


Usage
-----
The library comes with two widgets: `CKEditor` and `CKEditorInline`. One is for classic edition and the other for inline
editing respectively.

Using a model with a basic preset:

```

use dosamigos\ckeditor\CKEditor;


<?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
```
Using inline edition with basic preset:

```

use dosamigos\ckeditor\CKEditorInline;

<?php CKEditorInline::begin(['preset' => 'basic']);?>
    This text can be edited now :)
<?php CKEditorInline::end();?>
```

How to add custom plugins
-------------------------
This is the way to add custom plugins to the editor. Since version 2.0 we are working with the packagist version of the 
CKEditor library, therefore we are required to use its configuration API in order to add external plugins. 

Lets add the popular [Code Editor Plugin](http://ckeditor.com/addon/pbckcode) for example. This plugin would allow us to 
add a button to our editor's toolbar so we can add code to the content we are editing. 

Assuming you have downloaded the plugin and added to the root directory of your Yii2 site. I have it this way: 

<pre>
+ frontend 
+ -- web 
    + -- pbckcode 
</pre>

We can now add it to our CKEditor widget. For this example I am using `CKEditorInline` widget. One thing you notice on 
this example is that we do not use the preset attribute; this is highly important as we want to add a customized toolbar to our 
widget. No more talking, here is the code:
 
```php 
<?php
 
use dosamigos\ckeditor\CKEditorInline;

// First we need to tell CKEDITOR variable where is our external plufin 
$this->registerJs("CKEDITOR.plugins.addExternal('pbckcode', '/pbckcode/plugin.js', '');");

// ... 
// Using the plugin
<?php CKEditorInline::begin(['preset' => 'custom', 'clientOptions' => [
    'extraPlugins' => 'pbckcode',
    'toolbarGroups' => [
        ['name' => 'undo'],
        ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
        ['name' => 'colors'],
        ['name' => 'links', 'groups' => ['links', 'insert']],
        ['name' => 'others', 'groups' => ['others', 'about']],
        
        ['name' => 'pbckcode'] // <--- OUR NEW PLUGIN YAY!
    ]
]]) ?>

<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
    dolore magna aliqua. 
</p>
<?php CKEditorInline::end() ?>
```

About extra assets 
------------------
You maybe wonder why there is file `dosamigos-ckeditor.widget.js`. The reason is that due to the way Yii2 works with 
forms and Cross-Site Request Forgery (csrf). CKEditor does not trigger the on change event nor collects the CSRF token 
when using file uploads. 

The asset tackles both issues. 

Testing
-------

To test the extension, is better to clone this repository on your computer. After, go to the extensions folder and do
the following (assuming you have `composer` installed on your computer): 

```bash 
$ composer install --no-interaction --prefer-source --dev
```
Once all required libraries are installed then do: 

```bash 
$ vendor/bin/phpunit
```

Further Information
-------------------
Please, check the [CKEditor plugin site](http://www.ckeditor.com) documentation for further information about its configuration options.

Contributing
------------

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

Credits
-------

- [Antonio Ramirez](https://github.com/tonydspaniard)
- [All Contributors](../../contributors)

License
-------

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.


> [![2amigOS!](http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png)](http://www.2amigos.us)  
<i>Web development has never been so fun!</i>  
[www.2amigos.us](http://www.2amigos.us)
