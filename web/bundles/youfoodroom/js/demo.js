(function() {

  $(function() {
    $('.demo .numbers li').wrapInner('<a href="#"></a>').click(function(e) {
      e.preventDefault();
      return $('#card_number').val($(this).text()).trigger('input');
    });
    $('.vertical.maestro').hide().css({
      opacity: 0
    });
    return $('#card_number').validateCreditCard(function(result) {
      if (!(result.card_type != null)) {
        $('.cards span').removeClass('off');
        $('#card_number').removeClass('valid');
        $('.vertical.maestro').slideUp({
          duration: 200
        }).animate({
          opacity: 0
        }, {
          queue: false,
          duration: 200
        });
        return;
      }
      $('.cards span').addClass('off');
      $('.cards .' + result.card_type.name).removeClass('off');
      if (result.card_type.name === 'maestro') {
        $('.vertical.maestro').slideDown({
          duration: 200
        }).animate({
          opacity: 1
        }, {
          queue: false
        });
      } else {
        $('.vertical.maestro').slideUp({
          duration: 200
        }).animate({
          opacity: 0
        }, {
          queue: false,
          duration: 200
        });
      }
      if (result.length_valid && result.luhn_valid) {
        return $('#card_number').addClass('valid');
      } else {
        return $('#card_number').removeClass('valid');
      }
    });
  });

}).call(this);
