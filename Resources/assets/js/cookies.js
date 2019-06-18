/**
 * Add Cookie
 * @param {string} name
 * @param {string} value
 * @param {string} domain
 * @param {string} path
 * @param {boolean} secure
 */
function setCookie(name, value, domain='', path ='/', secure) {
  var expireDate = new Date();
  expireDate.setMonth(expireDate.getMonth() + 12);
  var _nameValue = name + '=' + value + '; ';
  var _date = 'expires=' + expireDate.toUTCString() + '; ';
  var _domain = 'domain=' + domain + '; ';
  var _path = 'path=' + path + '; ';
  var _secure = secure ? ' secure;' : '';
  document.cookie = _nameValue + _date + _domain + _path + _secure;
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
