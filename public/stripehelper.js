jQuery(function($) {

	Stripe.setPublishableKey('Your_Publishable_Key_Goes_Here'); // EDIT THIS LINE!!! starts with pk_...

	var stripeResponseHandler = function(status, response) {
		var $form = $('#payment-form'); // If your form id is not $payment-form, update as necessary here

		if (response.error) {
			// Show the errors on the form
			$form.find('.payment-errors').text(response.error.message); // If your errors span is not .payment_errors, update as necessary here
			$form.find('button').prop('disabled', false);
		} else {
			var token = response.id;
			// Insert the token into the form so it gets submitted to the server
			$form.append($('<input type="hidden" name="stripeToken" />').val(token));
			// and submit
			$form.get(0).submit();
		}
	};

	$('#payment-form').submit(function(event) { // If your form id is not $payment-form, update as necessary here
		var $form = $(this);

		// Disable the submit button to prevent repeated clicks
		$form.find('button').prop('disabled', true);

		Stripe.card.createToken($form, stripeResponseHandler);

		// Prevent the form from submitting with the default action
		return false;
	});

});