import './auto-search-select/auto-search-select';

document.addEventListener('DOMContentLoaded', () => {

  /**
   * Присвоение класса - desktop / touchpad тэгу "html"
   * для решения проблемы с ховером в мобильных устройствах
   */

  if (('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
    document.querySelector('html').classList.add('touch');
  } else {
    document.querySelector('html').classList.add('no-touch');
  }

  [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
    img.setAttribute('src', img.getAttribute('data-src'));
    img.onload = function() {
      img.removeAttribute('data-src');
    };
  });

});