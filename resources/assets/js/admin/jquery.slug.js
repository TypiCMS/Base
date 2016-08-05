/*
 * Slug 2.1.0, jQuery plugin
 *
 * Copyright(c) 2016, Samuel De Backer
 * http://www.typi.be
 *
 * Fill a field with a slug generated from another field value.
 * Add data-slug="origin-field-id" attribute to a slug field.
 *
 * Inspired by jQuery slugIt plug-in
 * https://github.com/diegok/slugit-jquery/blob/master/jquery.slugit.js
 * Thanks to the jQuery community
 * Licenced under the MIT Licence
 */
(function ($) {
    'use strict';

    var methods = {
        init: function () {
            return this.each(function () {

                var self = this;

                this.titleField = $('[id="' + $(this).data('slug') + '"]');
                this.slugGenerateButton = $(this).parent().find('.btn-slug');

                if (!this.titleField.val()) {
                    this.titleField.keyup(function () {
                        var slug = methods.convertToSlug($(this).val());
                        $(self).val(slug);
                    });
                }

                this.slugGenerateButton.click(function () {
                    var string = self.titleField.val(),
                        slug = methods.convertToSlug(string);
                    $(self).val(slug);
                    return false;
                });

            });
        },
        convertToSlug: function (text) {

            var defaults = {
                    separator: '-',
                    map: false,
                    before: false,
                    after: false
                },
                opts = defaults,
                chars = {},
                slug = '',
                i;

            chars = methods.latin_map();
            chars = jQuery.extend(chars, methods.greek_map());
            chars = jQuery.extend(chars, methods.turkish_map());
            chars = jQuery.extend(chars, methods.russian_map());
            chars = jQuery.extend(chars, methods.ukranian_map());
            chars = jQuery.extend(chars, methods.czech_map());
            chars = jQuery.extend(chars, methods.latvian_map());
            chars = jQuery.extend(chars, methods.polish_map());
            chars = jQuery.extend(chars, methods.symbols_map());
            chars = jQuery.extend(chars, methods.currency_map());

            text = jQuery.trim(text.toString());

            for (i = 0; i < text.length; i++) {
                if (chars[text.charAt(i)]) {
                    slug += chars[text.charAt(i)];
                } else {
                    slug += text.charAt(i);
                }
            }

            // Ensure separator is composable into regexes
            var sep_esc = opts.separator.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
            var re_trail = new RegExp('^' + sep_esc + '+|' + sep_esc + '+$', 'g');
            var re_multi = new RegExp(sep_esc + '+', 'g');

            slug = slug.replace(/[^-\w]/g, opts.separator); // swap spaces and unwanted chars
            slug = slug.replace(re_trail, '');              // trim leading/trailing separators
            slug = slug.replace(re_multi, opts.separator);  // eliminate repeated separatos
            slug = slug.toLowerCase();

            return slug;

        },

        latin_map: function () {
            return {
                'À':'A', 'Á':'A', 'Â':'A', 'Ã':'A', 'Ä':'A', 'Å':'A', 'Æ':'AE', 'Ç':'C',
                'È':'E', 'É':'E', 'Ê':'E', 'Ë':'E', 'Ì':'I', 'Í':'I', 'Î':'I', 'Ï':'I',
                'Ð':'D', 'Ñ':'N', 'Ò':'O', 'Ó':'O', 'Ô':'O', 'Õ':'O', 'Ö':'O', 'Ő':'O',
                'Ø':'O', 'Ù':'U', 'Ú':'U', 'Û':'U', 'Ü':'U', 'Ű':'U', 'Ý':'Y', 'Þ':'TH',
                'ß':'ss', 'à':'a', 'á':'a', 'â':'a', 'ã':'a', 'ä':'a', 'å':'a', 'æ':'ae',
                'ç':'c', 'è':'e', 'é':'e', 'ê':'e', 'ë':'e', 'ì':'i', 'í':'i', 'î':'i',
                'ï':'i', 'ð':'d', 'ñ':'n', 'ò':'o', 'ó':'o', 'ô':'o', 'õ':'o', 'ö':'o',
                'ő':'o', 'ø':'o', 'ù':'u', 'ú':'u', 'û':'u', 'ü':'u', 'ű':'u', 'ý':'y',
                'þ':'th', 'ÿ':'y'
            };
        },

        greek_map: function () {
            return {
                'α':'a', 'β':'b', 'γ':'g', 'δ':'d', 'ε':'e', 'ζ':'z', 'η':'h', 'θ':'8',
                'ι':'i', 'κ':'k', 'λ':'l', 'μ':'m', 'ν':'n', 'ξ':'3', 'ο':'o', 'π':'p',
                'ρ':'r', 'σ':'s', 'τ':'t', 'υ':'y', 'φ':'f', 'χ':'x', 'ψ':'ps', 'ω':'w',
                'ά':'a', 'έ':'e', 'ί':'i', 'ό':'o', 'ύ':'y', 'ή':'h', 'ώ':'w', 'ς':'s',
                'ϊ':'i', 'ΰ':'y', 'ϋ':'y', 'ΐ':'i',
                'Α':'A', 'Β':'B', 'Γ':'G', 'Δ':'D', 'Ε':'E', 'Ζ':'Z', 'Η':'H', 'Θ':'8',
                'Ι':'I', 'Κ':'K', 'Λ':'L', 'Μ':'M', 'Ν':'N', 'Ξ':'3', 'Ο':'O', 'Π':'P',
                'Ρ':'R', 'Σ':'S', 'Τ':'T', 'Υ':'Y', 'Φ':'F', 'Χ':'X', 'Ψ':'PS', 'Ω':'W',
                'Ά':'A', 'Έ':'E', 'Ί':'I', 'Ό':'O', 'Ύ':'Y', 'Ή':'H', 'Ώ':'W', 'Ϊ':'I',
                'Ϋ':'Y'
            };
        },

        turkish_map: function () {
            return {
                'ş':'s', 'Ş':'S', 'ı':'i', 'İ':'I', 'ç':'c', 'Ç':'C', 'ü':'u', 'Ü':'U',
                'ö':'o', 'Ö':'O', 'ğ':'g', 'Ğ':'G'
            };
        },

        russian_map: function () {
            return {
                'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ё':'yo', 'ж':'zh',
                'з':'z', 'и':'i', 'й':'j', 'к':'k', 'л':'l', 'м':'m', 'н':'n', 'о':'o',
                'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'х':'h', 'ц':'c',
                'ч':'ch', 'ш':'sh', 'щ':'sh', 'ъ':'', 'ы':'y', 'ь':'', 'э':'e', 'ю':'yu',
                'я':'ya',
                'А':'A', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Yo', 'Ж':'Zh',
                'З':'Z', 'И':'I', 'Й':'J', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O',
                'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Х':'H', 'Ц':'C',
                'Ч':'Ch', 'Ш':'Sh', 'Щ':'Sh', 'Ъ':'', 'Ы':'Y', 'Ь':'', 'Э':'E', 'Ю':'Yu',
                'Я':'Ya'
            };
        },

        ukranian_map: function () {
            return {
                'Є':'Ye', 'І':'I', 'Ї':'Yi', 'Ґ':'G', 'є':'ye', 'і':'i', 'ї':'yi', 'ґ':'g'
            };
        },

        czech_map: function () {
            return {
                'č':'c', 'ď':'d', 'ě':'e', 'ň': 'n', 'ř':'r', 'š':'s', 'ť':'t', 'ů':'u',
                'ž':'z', 'Č':'C', 'Ď':'D', 'Ě':'E', 'Ň': 'N', 'Ř':'R', 'Š':'S', 'Ť':'T',
                'Ů':'U', 'Ž':'Z'
            };
        },

        polish_map: function () {
            return {
                'ą':'a', 'ć':'c', 'ę':'e', 'ł':'l', 'ń':'n', 'ó':'o', 'ś':'s', 'ź':'z',
                'ż':'z', 'Ą':'A', 'Ć':'C', 'Ę':'e', 'Ł':'L', 'Ń':'N', 'Ó':'o', 'Ś':'S',
                'Ź':'Z', 'Ż':'Z'
            };
        },

        latvian_map: function () {
            return {
                'ā':'a', 'č':'c', 'ē':'e', 'ģ':'g', 'ī':'i', 'ķ':'k', 'ļ':'l', 'ņ':'n',
                'š':'s', 'ū':'u', 'ž':'z', 'Ā':'A', 'Č':'C', 'Ē':'E', 'Ģ':'G', 'Ī':'i',
                'Ķ':'k', 'Ļ':'L', 'Ņ':'N', 'Š':'S', 'Ū':'u', 'Ž':'Z'
            };
        },

        currency_map: function () {
            return {
                '€':'euro', '$':'dollar', '₢':'cruzeiro', '₣':'french franc', '£':'pound',
                '₤':'lira', '₥':'mill', '₦':'naira', '₧':'peseta', '₨':'rupee',
                '₩':'won', '₪':'new shequel', '₫':'dong', '₭':'kip', '₮':'tugrik',
                '₯':'drachma', '₰':'penny', '₱':'peso', '₲':'guarani', '₳':'austral',
                '₴':'hryvnia', '₵':'cedi', '¢':'cent', '¥':'yen', '元':'yuan',
                '円':'yen', '﷼':'rial', '₠':'ecu', '¤':'currency', '฿': 'baht'
            };
        },

        symbols_map: function symbols_map() {
            return {
                '©':'(c)', 'œ':'oe', 'Œ':'OE', '∑':'sum', '®':'(r)', '†':'+',
                '“':'"', '”':'"', '‘':"'", '’':"'", '∂':'d', 'ƒ':'f', '™':'tm',
                '℠':'sm', '…':'...', '˚':'o', 'º':'o', 'ª':'a', '•':'*',
                '∆':'delta', '∞':'infinity', '♥':'love', '&':'and'
            };
        }
    };
    $.fn.slug = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.slug');
        }
    };

    // launch plugin
    $('[data-slug]').slug();

})(jQuery);
