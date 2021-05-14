Stripe.setPublishableKey('pk_test_51HwnxzBhwbMEU8sQgaZKwD9hVFdn1eaRF70iu4fPXJpMW2eSrS1DEDYBC9i9vbU0A5XKnO5wlRYfCtXWubADZpPI00aRbI2los');

var $form = $('#checkout_form');

$form.submit(function(event) {
  $('#charge_error').addClass('d-none');
  $form.find('button').prop('disabled', true);
  Stripe.card.createToken({
    number: $('#card_no').val(),
    cvc: $('#card-cvc').val(),
    exp_month: $('#card_month').val(),
    exp_year: $('#card_year').val(),
    name: $('#card_name').val()
  }, stripeResponseHandler);
  return false;
});

function stripeResponseHandler(status, response){
  if (response.error) {
    $('#charge_error').removeClass('d-none');
    $('#charge_error').text(response.error.message);
    $form.find('button').prop('disabled', false);
  } else {
    var token = response.id;
    $form.append($('<input type="hidden" name="stripeToken"/>').val(token));        
    
    // submit the form:
    $form.get(0).submit();
  }
}
