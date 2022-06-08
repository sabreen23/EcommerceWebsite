/*
 * 	Themex Autosave 1.0 - jQuery plugin
 *	written by Ihor Ahnianikov	
 *  https://themex.co
 *
 *	Copyright (c) 2015 Ihor Ahnianikov
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
 
(function($) {
	$.fn.themexAutosave = function (options) {
		var form=$(this);
		var	fields=form.find('input,select,textarea');
		
		//init fields
		function init() {
			var data=localStorage.getItem(form.attr('id')),
				time=localStorage.getItem(form.attr('id')+'_time'),
				date=new Date(),
				current=0;
			
			current=Math.round(+date/1000);
			if(time!==null && time!==undefined && time<current) {
				clear();
				data=null;
			}
			
			if(data==null && form.data('default')) {
				var defaults=localStorage.getItem(form.data('default'));
				
				if(defaults) {
					data=defaults;
					
					localStorage.setItem(form.attr('id'), defaults);
					localStorage.removeItem(form.data('default'));
				}
			}
			
			if(data) {
				data=JSON.parse(data);
				
				$.each(data, function(index, object) {
					if(object.name.indexOf('[]')<0) {
						var field=form.find('[name="'+object.name+'"]');
						
						if(field.length && field.attr('type')!='hidden' && object.value) {
							field.val(object.value);
						}
					}
				});
			}
		}
		
		//save fields
		function save() {
			var data=fields.not('.exclude').serializeArray(),
				date=new Date(),
				time=0;
			
			if(data) {				
				data=JSON.stringify(data);
				time=Math.round((date.setSeconds(date.getSeconds()+3600))/1000);
				
				localStorage.setItem(form.attr('id'), data);
				localStorage.setItem(form.attr('id')+'_time', time);
			}
		}
		
		//clear fields
		function clear() {
			localStorage.removeItem(form.attr('id'));
			localStorage.removeItem(form.attr('id')+'_time');
		}
		
		//update tinyMCE
		if(typeof(tinyMCE)!='undefined') {
			$(document).click(function(){
				tinyMCE.triggerSave();
				save();
			});
		}
		
		//autosave on change
		fields.change(function() {
			save();
		});
		
		//clear on submit
		form.submit(function() {
			clear();
		});
		
		//init on loading
		init();
	}
})(jQuery);