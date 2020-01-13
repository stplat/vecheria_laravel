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

  /*function changeCss() {
    let w = screen.width;  //- ширина экрана  монитора
    let h = screen.height; //- высота экрана монитора
    if (w <= '1024' && h <= '768') {
      document.getElementById("stylesheet").href = "css/style_1024х768.css";
    }

  }

  document.querySelector('head').append('<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700&display=swap" rel="stylesheet">');*/
});