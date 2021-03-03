@extends('layouts.clean', ['background_image' => "/images/background.jpg"])

@section('title', 'Pay with SEPA Direct Debit')

@section('above_container')
    <div class="header-section bg-secondary">
        <h1>Pay with SEPA Direct Debit</h1>
    </div>

<div class="action-section card row mt-5">
    <div class="six columns d-none">
      <label for="name">
        Full name
      </label>
      <input type="text" id="name" name="name" placeholder="Jenny Rosen" class="form-control" value="{{$user->name}} {{$user->surname}}" required>
    </div>
    <div class="six columns d-none">
      <label for="email">
        Email Address
      </label>
      <input type="text" id="email" name="email" type="email" placeholder="jenny.rosen@example.com" class="form-control" value="{{$user->email}}" required>
    </div>

  <div class="col-12">
        <label for="card-element">
        IBAN
      </label>
<div class="form-control mb-4" style="color: inherit; border: 1px solid rgb(209, 209, 209); border-radius: var(--border-radius); padding: 0.5rem 0.75rem; margin-bottom: 1rem;">
	<div id="card-element"></div>
</div>

</div>
<div class="col-12">
<button id="card-button" data-secret="{{ $intent->client_secret }}" class="button button-primary">
    Add bank account
</button>
<div class="text-muted small">
		<b>This bank account must be in the name of {{$user->name}} {{$user->surname}}. To add a bank account under another name, <a href="/contact">contact us</a>.</b>
		<hr/>
    By providing your IBAN and confirming this payment, you authorise (A) {{config('app.name')}} and Stripe, our payment service provider, to send instructions to your bank to debit your account and (B) your bank to debit your account in accordance with those instructions. You are entitled to a refund from your bank under the terms and conditions of your agreement with your bank. A refund must be claimed within 8 weeks starting from the date on which your account was debited.
</div>
</div>
</div>


@endsection
@section('footer_scripts')
<script>

  var style = {
        base: {
            // color: '#32325d',
            lineHeight: '1.8',
            fontFamily: '"Roboto", "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '18px',
            '::placeholder': {
                // color: '#aab7c4'
            }
        },
        invalid: {
            // color: '#fa755a',
            // iconColor: '#fa755a'
        }
    };

    const stripe = Stripe('{{config('services.stripe.key')}}');

    const elements = stripe.elements();
    const cardElement = elements.create('iban', { style: style, supportedCountries: ['SEPA'] });

    cardElement.mount('#card-element');

    //const cardHolderName = document.getElementById('card-holder-name');
	const cardButton = document.getElementById('card-button');
	const clientSecret = cardButton.dataset.secret;

cardElement.on('change', function(event) {
  // Handle real-time validation errors from the iban Element.
  if (event.error) {
  	console.log(event.error);

  } else {
  }

  // Display bank name corresponding to IBAN, if available.
  if (event.bankName) {
  	console.log(event.bankName);

  } else {
  }
});

	cardButton.addEventListener('click', async (e) => {
		cardButton.setAttribute("disabled", "disabled");
		cardButton.innerText = 'Please wait...';
	    const { setupIntent, error } = await stripe.confirmSepaDebitSetup(
	        clientSecret, {
	            payment_method: {
	                sepa_debit: cardElement,
	                 billing_details: {
	                 	name: document.querySelector('input[name="name"]').value,
      					email: document.querySelector('input[name="email"]').value,
	                 }
	            }
	        }
	    );

	    if (error) {
	        // Display "error.message" to the user...
	        alert(error.message)
			cardButton.innerText = 'Try again';
	       	cardButton.removeAttribute("disabled");
	    } else {
	    	console.log(setupIntent);
	        axios.post('/api/users/{{$user->id}}/update-card', {
                    card_token: setupIntent.payment_method,
                }).then(response => {
                	console.log(response)
                	cardButton.innerText = 'Done! Bank account added';
					//location.reload();
                }).catch(e => {
                    console.log(e)
                	cardButton.innerText = 'Something went wrong';
                })
	    }
	});
</script>
@endsection
