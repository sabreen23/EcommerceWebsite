jQuery(document).ready( function(e) {
	jQuery.validator.addClassRules('require', {
        required: true 
    });
    setTimeout( function() {
	    jQuery(".acf-checkbox-list.require li input[type='checkbox']").each(function (item) {
	        jQuery(this).rules("add", {
	            required: true
	        });
	    });
	    jQuery.validator.addMethod("notEqualTo", function(value, element, param) {
			return this.optional(element) || value != param;
		}, "Please select a different value");
	    if( jQuery("select.require").length )  {
		    jQuery("select.require").rules("add", {
	            notEqualTo: "0"
	        });
		}
    }, 3000);
	jQuery(".dokan-product-edit-form").validate( {  
		ignore: '*:not([name]), :hidden'
	} );
	jQuery( ".dokan-add-product-link" ).on( "click", ".dokan-add-new-product", function() {
		setTimeout(function(){
			acf.do_action('append', jQuery('#dokan-add-new-product-form'));
		}, 1000);
	});
} );