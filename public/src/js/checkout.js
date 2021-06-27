Stripe.setPublishableKey('pk_test_51Ils9uGIRJCEJdml7aAgy5VtHpNz7FZ9oKsNOMnazgbBLtMqvigUCKr5x3j7Shb3bcicR2Rg9PyFV6uv2kjxOoZB00fY67GM8I');

var $form = $('#checkout_form');

$form.submit(function(e) {
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
    $form.append($('<input type="hidden" name="stripe_token"/>').val(token));        
    
    // submit the form:
    $form.get(0).submit();
  }
}
