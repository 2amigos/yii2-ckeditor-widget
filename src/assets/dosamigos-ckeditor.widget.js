/**
 * @copyright Copyright (c) 2012-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
if (typeof dosamigos == "undefined" || !dosamigos) {
    var dosamigos = {};
}

dosamigos.ckEditorWidget = (function ($) {

    var pub = {
        registerOnChangeHandler: function (id) {
            CKEDITOR && CKEDITOR.instances[id] && CKEDITOR.instances[id].on('change', function () {
                CKEDITOR.instances[id].updateElement();
                $('#' + id).trigger('change');
                return false;
            });
        },
		registerCsrfUploadHandler: function (id) {
			CKEDITOR && CKEDITOR.instances[id] && CKEDITOR.instances[id].on('fileUploadRequest', function (evt) {
				var csrfName = yii.getCsrfParam();
				var csrfToken = $($(CKEDITOR.instances[id].element.$.form).find('input[name=' + csrfName + ']')[0]).val();
				var xhr = evt.data.fileLoader.xhr;
				xhr.setRequestHeader('X-CSRF-Token', csrfToken);
			});
		},
    };
    return pub;
})(jQuery);
