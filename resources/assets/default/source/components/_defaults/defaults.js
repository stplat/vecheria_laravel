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

  /*[].forEach.call(document.querySelectorAll('img[data-src], source[data-src]'), function(img) {
    img.setAttribute('src', img.getAttribute('data-src'));
    img.onload = function() {
      img.removeAttribute('data-src');
    };
  });*/

  const webP = new Image();
  webP.src = 'data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA';
  if (webP.height === 2) {
    document.querySelector('html').classList.add('webp');
  } else {
    document.querySelector('html').classList.add('no-webp');
  }
});