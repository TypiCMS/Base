/*
 * Slug 3.0
 *
 * Copyright(c) 2023, Samuel De Backer
 * https://typi.be
 *
 * Fill a field with a slug generated from another field value.
 * Add data-slug="origin-field-id" attribute to a slug field.
 *
 * Inspired by jQuery slugIt plug-in
 * https://github.com/diegok/slugit-jquery/blob/master/jquery.slugit.js
 * Licenced under the MIT Licence
 */
export default class Slug {
    private readonly input: HTMLInputElement;
    private readonly titleField: HTMLInputElement;
    private slugGenerateButton: HTMLButtonElement;

    constructor(input: HTMLInputElement) {
        this.input = input;
        if (!this.input) {
            throw new Error('Slug: input is not defined');
        }
        if (!this.input.dataset.slug) {
            throw new Error('Slug: data-slug attribute is not defined');
        }
        this.titleField = document.getElementById(this.input.dataset.slug) as HTMLInputElement;
        if (!this.titleField) {
            throw new Error('Slug: titleField is not defined');
        }
        const parentElement = this.input.parentElement as HTMLElement;
        if (!parentElement) {
            throw new Error('Slug: parentElement is not defined');
        }
        this.slugGenerateButton = parentElement.querySelector('.btn-slug') as HTMLButtonElement;
        this.init();
    }

    private init() {
        if (this.titleField.value === '') {
            this.titleField.addEventListener('keyup', () => {
                this.input.value = this.convertToSlug(this.titleField.value);
            });
        }
        this.slugGenerateButton.addEventListener('click', (event: Event) => {
            this.input.value = this.convertToSlug(this.titleField.value);
            event.preventDefault();
        });
    }

    private convertToSlug(text: string): string {
        let opts = {
                separator: '-',
            },
            chars: { [key: string]: string } = this.latin_map(),
            slug: string = '';

        chars = Object.assign(chars, this.greek_map());
        chars = Object.assign(chars, this.turkish_map());
        chars = Object.assign(chars, this.russian_map());
        chars = Object.assign(chars, this.ukranian_map());
        chars = Object.assign(chars, this.czech_map());
        chars = Object.assign(chars, this.latvian_map());
        chars = Object.assign(chars, this.polish_map());
        chars = Object.assign(chars, this.symbols_map());
        chars = Object.assign(chars, this.currency_map());

        text = text.toString().trim();

        for (const char of text) {
            if (chars[char]) {
                slug += chars[char];
            } else {
                slug += char;
            }
        }

        // Ensure separator is composable into regexes
        const sep_esc = opts.separator.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, '\\$1');
        const re_trail = new RegExp('^' + sep_esc + '+|' + sep_esc + '+$', 'g');
        const re_multi = new RegExp(sep_esc + '+', 'g');

        slug = slug.replace(/[^-\w]/g, opts.separator); // swap spaces and unwanted chars
        slug = slug.replace(re_trail, ''); // trim leading/trailing separators
        slug = slug.replace(re_multi, opts.separator); // eliminate repeated separatos
        slug = slug.toLowerCase();

        return slug;
    }

    private latin_map() {
        // prettier-ignore
        return {
            'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
            'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
            'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
            'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
            'ß': 'ss', 'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae',
            'ç': 'c', 'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i',
            'ï': 'i', 'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o',
            'ő': 'o', 'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y',
            'þ': 'th', 'ÿ': 'y'
        };
    }

    private greek_map() {
        // prettier-ignore
        return {
            'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
            'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
            'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
            'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
            'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',
            'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
            'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
            'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
            'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
            'Ϋ': 'Y'
        };
    }

    private turkish_map() {
        // prettier-ignore
        return {
            'ş': 's', 'Ş': 'S', 'ı': 'i', 'İ': 'I', 'ç': 'c', 'Ç': 'C', 'ü': 'u', 'Ü': 'U',
            'ö': 'o', 'Ö': 'O', 'ğ': 'g', 'Ğ': 'G'
        };
    }

    private russian_map() {
        // prettier-ignore
        return {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
            'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
            'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
            'я': 'ya',
            'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
            'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
            'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
            'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
            'Я': 'Ya'
        };
    }

    private ukranian_map() {
        // prettier-ignore
        return {
            'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G', 'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g'
        };
    }

    private czech_map() {
        // prettier-ignore
        return {
            'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
            'ž': 'z', 'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T',
            'Ů': 'U', 'Ž': 'Z'
        };
    }

    private polish_map() {
        // prettier-ignore
        return {
            'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
            'ż': 'z', 'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S',
            'Ź': 'Z', 'Ż': 'Z'
        };
    }

    private latvian_map() {
        // prettier-ignore
        return {
            'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
            'š': 's', 'ū': 'u', 'ž': 'z', 'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i',
            'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N', 'Š': 'S', 'Ū': 'u', 'Ž': 'Z'
        };
    }

    private currency_map() {
        // prettier-ignore
        return {
            '€': 'euro', '$': 'dollar', '₢': 'cruzeiro', '₣': 'french franc', '£': 'pound',
            '₤': 'lira', '₥': 'mill', '₦': 'naira', '₧': 'peseta', '₨': 'rupee',
            '₩': 'won', '₪': 'new shequel', '₫': 'dong', '₭': 'kip', '₮': 'tugrik',
            '₯': 'drachma', '₰': 'penny', '₱': 'peso', '₲': 'guarani', '₳': 'austral',
            '₴': 'hryvnia', '₵': 'cedi', '¢': 'cent', '¥': 'yen', '元': 'yuan',
            '円': 'yen', '﷼': 'rial', '₠': 'ecu', '¤': 'currency', '฿': 'baht'
        };
    }

    private symbols_map() {
        // prettier-ignore
        return {
            '©': '(c)', 'œ': 'oe', 'Œ': 'OE', '∑': 'sum', '®': '(r)', '†': '+',
            '“': '"', '”': '"', '‘': "'", '’': "'", '∂': 'd', 'ƒ': 'f', '™': 'tm',
            '℠': 'sm', '…': '...', '˚': 'o', 'º': 'o', 'ª': 'a', '•': '*',
            '∆': 'delta', '∞': 'infinity', '♥': 'love', '&': 'and', 'ᵉ': 'e', '²': '2', '³': '3', '×': 'x'
        };
    }
}
