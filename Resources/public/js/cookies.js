/**
 * Add Cookie
 * @param {string} name
 * @param {string} value
 * @param {string} path
 * @param {boolean} secure
 */
function setCookie(name, value, path ='/', secure) {
  var expireDate = new Date();
  expireDate.setMonth(expireDate.getMonth() + 12);
  var _nameValue = name + '=' + value + '; ';
  var _date = 'expires=' + expireDate.toUTCString() + '; ';
  var _path = 'path=' + path + '; ';
  var _secure = secure ? ' secure;' : '';
  document.cookie = _nameValue + _date + _path + _secure;
}

/**
 * Get Cookie's value
 * @param {string} name
 * @returns {string}
 */
function getCookie(name) {
  var value = '; ' + document.cookie;
  var parts = value.split('; ' + name + '=');
  return parts.length < 2 ? undefined : parts.pop().split(';').shift();
}

/**
 *  Add all cookies...
 * @param {string[]} $cookieNames
 * @param {string} value
 */
function addCookies($cookieNames, value) {
  for (var i = 0; i < optionnalCookies.length; i++) {
    setCookie(optionnalCookies[i], value);
  }
  document.body.removeChild($ffCookiesBar);
}

var $ffCookiesBar = document.getElementById('js-ff-cookie-bar');
var $ffCookiesDeny = document.getElementById('js-ff-cookies-deny');
var $ffCookiesAllow = document.getElementById('js-ff-cookies-allow');

if (optionnalCookies.length > 0 && $ffCookiesBar && $ffCookiesDeny) {
  $ffCookiesDeny.addEventListener('click', function (e) {
    e.preventDefault();
    addCookies(optionnalCookies, '0');
  });
}

if (optionnalCookies.length > 0 && $ffCookiesBar && $ffCookiesAllow) {
  $ffCookiesAllow.addEventListener('click', function(e) {
    e.preventDefault();
    addCookies(optionnalCookies, '1');
    window.location.reload();
  });
}
