/*
 * Slug 2.0.1, jQuery plugin
 *
 * Copyright(c) 2015, Samuel De Backer
 * http://www.typi.be
 *
 * Fill a field with a generated slug from another field value.
 * add data-slug="origin-field-id" attribut to you slug field.
 * Thanks to jQuery community
 * Licenced under the MIT Licence
 */
(function($)
{
	var methods = {
		init: function () {
			return this.each(function() {

				var self = this;

				this.titleField = $('[id="' + $(this).data('slug') + '"]');
				this.slugGenerateButton = $(this).parent().find('.btn-slug');

				if ( ! this.titleField.val()) {
					this.titleField.keyup( function(){
						var slug = methods.convertToSlug( $(this).val() );
						$(self).val(slug);
					});
				};

				this.slugGenerateButton.click(function(){
					var string = self.titleField.val(),
						slug = methods.convertToSlug( string );
					$(self).val(slug);
					return false;
				});

			});
		},
		convertToSlug: function (string) {
			var slug = string
				.replace('œ','oe')
				.replace('?','')
				.replace('æ','ae');

			// remove accents, swap ñ for n, etc
			var from = "ÃÀÁÄÂẼÈÉËÊÌÍÏÎÕÒÓÖÔÙÚÜÛÑÇãàáäâẽèéëêìíïîõòóöôùúüûñç$€£·/_,:;-'’! ";
			var to   = "AAAAAEEEEEIIIIOOOOOUUUUNCaaaaaeeeeeiiiiooooouuuunc              ";
			for (var i=0, l=from.length ; i<l ; i++) {
				slug = slug.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
			}
			slug = $.trim(slug);
			slug = slug
				.toLowerCase()
				.replace(/[^\w ]+/g,'')
				.replace(/ +/g,'-');

			return slug;
		},

	};
	$.fn.slug = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method == 'object' || ! method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on jQuery.slug');
		}
	};

	// launch plugin
    $('[data-slug]').slug();

})(jQuery);
