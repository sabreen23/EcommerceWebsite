jQuery(document).ready(function($) {
    var themexPopup={
    	loadVals: function() {
			var shortcode=$(themexElements.shortcodeModule).find('form').children(themexElements.shortcodeModulePattern).html();
			var clones='';

    		$(themexElements.shortcodeModule).find('input, select, textarea').each(function() {
    			var id=$(this).attr('id'),
    				re=new RegExp('{{'+id+'}}','g');

    			shortcode=shortcode.replace(re, $(this).val());
    		});

			$(themexElements.shortcodeModule).find(themexElements.shortcodeModuleClone).each(function() {
				var shortcode=$(this).children(themexElements.shortcodeModulePattern).html();

				$(this).find('input, select, textarea').each(function() {
					var id=$(this).attr('id'),
						re=new RegExp('{{'+id+'}}','g');

					shortcode=shortcode.replace(re, $(this).val());
				});

				clones=clones+shortcode;
			});

			shortcode=shortcode.replace('{{clone}}', clones);
			shortcode=shortcode.replace('="null"', '="0"');
			$(themexElements.shortcodeModuleValue).html(shortcode);
    	},

		resize: function() {
			$('#TB_ajaxContent').outerHeight($('#TB_window').outerHeight()-$('#TB_title').outerHeight()-2);
		},

    	init: function() {
    		var	themexPopup=this,
    			formElement=themexElements.shortcodeModule+' form ';

			//update values
			$('body').on('change', formElement+'select', function() {
				themexPopup.loadVals();
			});

			$('body').on('change', formElement+'input', function() {
				themexPopup.loadVals();
			});

			$('body').on('propertychange keyup input paste', formElement+'textarea', function(event){
				themexPopup.loadVals();
			});

			//update clones
			$('body').on('click', formElement+themexElements.buttonClone, function() {
				themexPopup.loadVals();
				themexPopup.resize();
			});

			$('body').on('click', formElement+themexElements.buttonRemove, function() {
				themexPopup.loadVals();
				themexPopup.resize();
			});

			//send to editor
			$('body').on('submit', formElement, function() {
				themexPopup.loadVals();
				if(window.tinyMCE) {
					if(window.tinyMCE.majorVersion>3) {
						window.tinyMCE.execCommand('mceInsertContent', false, $(themexElements.shortcodeModuleValue).html());
					} else {
						window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $(themexElements.shortcodeModuleValue).html());
					}

					tb_remove();
				}

				return false;
			});
    	}
	}

	//init popup
	themexPopup.init();

	//resize popup
	$(window).resize(function() {
		themexPopup.resize();
	});
});
