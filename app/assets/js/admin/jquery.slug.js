/*
 * Slug 1.1, jQuery plugin
 * 
 * Copyright(c) 2013, Samuel De Backer
 * http://www.typi.be
 *	
 * Transform field to slug.
 * Thanks to jQuery community 
 * Licenced under the MIT Licence
 */
(function($)
{
	var settings = {
		slugField: '#slug'
	};
	var methods = {
		init: function (options) {
			return this.each(function() {

				if (options) {
					$.extend(settings, options);
				}

				this.slugField = settings.slugField;

				this.slugGenerateButton = $(this.slugField).parent().find('.btn-slug');

				if ( ! $(this).val()) {
					$(this).keyup( function(){
						slug = methods.convertToSlug( $(this).val() );
						$(this.slugField).val(slug);
					});
				};

				$('.btn-slug').click(function(){
					var string = $(this).closest('.form-group').prev().find('input').val(),
						slugField = $(this).parent().parent().find('input');

					slug = methods.convertToSlug( string );
					slugField.val(slug);

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
			var from = "ÃÀÁÄÂẼÈÉËÊÌÍÏÎÕÒÓÖÔÙÚÜÛÑÇãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;-'’!";
			var to   = "AAAAAEEEEEIIIIOOOOOUUUUNCaaaaaeeeeeiiiiooooouuuunc          ";
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
})(jQuery);
