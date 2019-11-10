import 'blowup/lib/blowup';

$(document).ready(function(){
  if ($('.product-image__showcase img').length) {
    $('.product-image__showcase img').blowup({
      "width" : 350,
      "height" : 350
    });
  }

});