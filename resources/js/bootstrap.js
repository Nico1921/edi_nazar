import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Swal = Swal;


const Toast = Swal.mixin({
   toast: true,
   position: 'bottom-start',
   showConfirmButton: false,
   timer: 5000,
   timerProgressBar: true,
   background:'#DAD3CD',
   didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
   }
});

window.Toast = Toast;

if (!("path" in Event.prototype))
      Object.defineProperty(Event.prototype, "path", {
      get: function() {
         var path = [];
         var currentElem = this.target;
         while (currentElem) {
            path.push(currentElem);
            currentElem = currentElem.parentElement;
         }
         if (path.indexOf(window) === -1 && path.indexOf(document) === -1)
            path.push(document);
         if (path.indexOf(window) === -1)
            path.push(window);
         return path;
      }
});


var HtmlEntities = function() {};

HtmlEntities.map = {
    "'": "&apos;",
    "<": "&lt;",
    ">": "&gt;",
    " ": "&nbsp;",
    "¡": "&iexcl;",
    "¢": "&cent;",
    "£": "&pound;",
    "¤": "&curren;",
    "¥": "&yen;",
    "¦": "&brvbar;",
    "§": "&sect;",
    "¨": "&uml;",
    "©": "&copy;",
    "ª": "&ordf;",
    "«": "&laquo;",
    "¬": "&not;",
    "®": "&reg;",
    "¯": "&macr;",
    "°": "&deg;",
    "±": "&plusmn;",
    "²": "&sup2;",
    "³": "&sup3;",
    "´": "&acute;",
    "µ": "&micro;",
    "¶": "&para;",
    "·": "&middot;",
    "¸": "&cedil;",
    "¹": "&sup1;",
    "º": "&ordm;",
    "»": "&raquo;",
    "¼": "&frac14;",
    "½": "&frac12;",
    "¾": "&frac34;",
    "¿": "&iquest;",
    "À": "&Agrave;",
    "Á": "&Aacute;",
    "Â": "&Acirc;",
    "Ã": "&Atilde;",
    "Ä": "&Auml;",
    "Å": "&Aring;",
    "Æ": "&AElig;",
    "Ç": "&Ccedil;",
    "È": "&Egrave;",
    "É": "&Eacute;",
    "Ê": "&Ecirc;",
    "Ë": "&Euml;",
    "Ì": "&Igrave;",
    "Í": "&Iacute;",
    "Î": "&Icirc;",
    "Ï": "&Iuml;",
    "Ð": "&ETH;",
    "Ñ": "&Ntilde;",
    "Ò": "&Ograve;",
    "Ó": "&Oacute;",
    "Ô": "&Ocirc;",
    "Õ": "&Otilde;",
    "Ö": "&Ouml;",
    "×": "&times;",
    "Ø": "&Oslash;",
    "Ù": "&Ugrave;",
    "Ú": "&Uacute;",
    "Û": "&Ucirc;",
    "Ü": "&Uuml;",
    "Ý": "&Yacute;",
    "Þ": "&THORN;",
    "ß": "&szlig;",
    "à": "&agrave;",
    "á": "&aacute;",
    "â": "&acirc;",
    "ã": "&atilde;",
    "ä": "&auml;",
    "å": "&aring;",
    "æ": "&aelig;",
    "ç": "&ccedil;",
    "è": "&egrave;",
    "é": "&eacute;",
    "ê": "&ecirc;",
    "ë": "&euml;",
    "ì": "&igrave;",
    "í": "&iacute;",
    "î": "&icirc;",
    "ï": "&iuml;",
    "ð": "&eth;",
    "ñ": "&ntilde;",
    "ò": "&ograve;",
    "ó": "&oacute;",
    "ô": "&ocirc;",
    "õ": "&otilde;",
    "ö": "&ouml;",
    "÷": "&divide;",
    "ø": "&oslash;",
    "ù": "&ugrave;",
    "ú": "&uacute;",
    "û": "&ucirc;",
    "ü": "&uuml;",
    "ý": "&yacute;",
    "þ": "&thorn;",
    "ÿ": "&yuml;",
    "Œ": "&OElig;",
    "œ": "&oelig;",
    "Š": "&Scaron;",
    "š": "&scaron;",
    "Ÿ": "&Yuml;",
    "ƒ": "&fnof;",
    "ˆ": "&circ;",
    "˜": "&tilde;",
    "Α": "&Alpha;",
    "Β": "&Beta;",
    "Γ": "&Gamma;",
    "Δ": "&Delta;",
    "Ε": "&Epsilon;",
    "Ζ": "&Zeta;",
    "Η": "&Eta;",
    "Θ": "&Theta;",
    "Ι": "&Iota;",
    "Κ": "&Kappa;",
    "Λ": "&Lambda;",
    "Μ": "&Mu;",
    "Ν": "&Nu;",
    "Ξ": "&Xi;",
    "Ο": "&Omicron;",
    "Π": "&Pi;",
    "Ρ": "&Rho;",
    "Σ": "&Sigma;",
    "Τ": "&Tau;",
    "Υ": "&Upsilon;",
    "Φ": "&Phi;",
    "Χ": "&Chi;",
    "Ψ": "&Psi;",
    "Ω": "&Omega;",
    "α": "&alpha;",
    "β": "&beta;",
    "γ": "&gamma;",
    "δ": "&delta;",
    "ε": "&epsilon;",
    "ζ": "&zeta;",
    "η": "&eta;",
    "θ": "&theta;",
    "ι": "&iota;",
    "κ": "&kappa;",
    "λ": "&lambda;",
    "μ": "&mu;",
    "ν": "&nu;",
    "ξ": "&xi;",
    "ο": "&omicron;",
    "π": "&pi;",
    "ρ": "&rho;",
    "ς": "&sigmaf;",
    "σ": "&sigma;",
    "τ": "&tau;",
    "υ": "&upsilon;",
    "φ": "&phi;",
    "χ": "&chi;",
    "ψ": "&psi;",
    "ω": "&omega;",
    "ϑ": "&thetasym;",
    "ϒ": "&Upsih;",
    "ϖ": "&piv;",
    "–": "&ndash;",
    "—": "&mdash;",
    "‘": "&lsquo;",
    "’": "&rsquo;",
    "‚": "&sbquo;",
    "“": "&ldquo;",
    "”": "&rdquo;",
    "„": "&bdquo;",
    "†": "&dagger;",
    "‡": "&Dagger;",
    "•": "&bull;",
    "…": "&hellip;",
    "‰": "&permil;",
    "′": "&prime;",
    "″": "&Prime;",
    "‹": "&lsaquo;",
    "›": "&rsaquo;",
    "‾": "&oline;",
    "⁄": "&frasl;",
    "€": "&euro;",
    "ℑ": "&image;",
    "℘": "&weierp;",
    "ℜ": "&real;",
    "™": "&trade;",
    "ℵ": "&alefsym;",
    "←": "&larr;",
    "↑": "&uarr;",
    "→": "&rarr;",
    "↓": "&darr;",
    "↔": "&harr;",
    "↵": "&crarr;",
    "⇐": "&lArr;",
    "⇑": "&UArr;",
    "⇒": "&rArr;",
    "⇓": "&dArr;",
    "⇔": "&hArr;",
    "∀": "&forall;",
    "∂": "&part;",
    "∃": "&exist;",
    "∅": "&empty;",
    "∇": "&nabla;",
    "∈": "&isin;",
    "∉": "&notin;",
    "∋": "&ni;",
    "∏": "&prod;",
    "∑": "&sum;",
    "−": "&minus;",
    "∗": "&lowast;",
    "√": "&radic;",
    "∝": "&prop;",
    "∞": "&infin;",
    "∠": "&ang;",
    "∧": "&and;",
    "∨": "&or;",
    "∩": "&cap;",
    "∪": "&cup;",
    "∫": "&int;",
    "∴": "&there4;",
    "∼": "&sim;",
    "≅": "&cong;",
    "≈": "&asymp;",
    "≠": "&ne;",
    "≡": "&equiv;",
    "≤": "&le;",
    "≥": "&ge;",
    "⊂": "&sub;",
    "⊃": "&sup;",
    "⊄": "&nsub;",
    "⊆": "&sube;",
    "⊇": "&supe;",
    "⊕": "&oplus;",
    "⊗": "&otimes;",
    "⊥": "&perp;",
    "⋅": "&sdot;",
    "⌈": "&lceil;",
    "⌉": "&rceil;",
    "⌊": "&lfloor;",
    "⌋": "&rfloor;",
    "⟨": "&lang;",
    "⟩": "&rang;",
    "◊": "&loz;",
    "♠": "&spades;",
    "♣": "&clubs;",
    "♥": "&hearts;",
    "♦": "&diams;"
};

HtmlEntities.decode = function(string) {
    var entityMap = HtmlEntities.map;
    for (var key in entityMap) {
        var entity = entityMap[key];
        var regex = new RegExp(entity, 'g');
        string = string.replace(regex, key);
    }
    string = string.replace(/&quot;/g, '"');
    string = string.replace(/&amp;/g, '&');
    return string;
}

HtmlEntities.encode = function(string) {
    var entityMap = HtmlEntities.map;
    string = string.replace(/&/g, '&amp;');
    string = string.replace(/"/g, '&quot;');
    for (var key in entityMap) {
        var entity = entityMap[key];
        var regex = new RegExp(key, 'g');
        string = string.replace(regex, entity);
    }
    return string;
}

window.HtmlEntities = HtmlEntities;
window.HtmlEntities.encode = HtmlEntities.encode;
window.HtmlEntities.decode = HtmlEntities.decode;
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
