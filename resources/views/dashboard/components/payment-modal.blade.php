<div class="modal" id="agency_connect_modal">
    <div class="modal-overlay connect-agency"></div>
    <div class="modal-wrapper modal-transition">
        <div class="modal-header">
            <h3 style="margin-right: auto;">Connect With Agency</h3>
            <button class="modal-close connect-agency">✕</button>
        </div>

        <div class="modal-body">
            <div class="modal-content">
                <div class=" text-center" id="payment-agree-box">
                    <h3>To Connect With Agency Pay $29</h3>
                    <div class="modal-img-outer">
                        <img src="{{ asset('images/connect-agency-img.jpg') }}" class="img-fluid" alt="" />
                    </div>
                    <div class="btn-toggle-outer text-center">
                        <button type="button" class="btn btn-success" onclick="$('#payment-form').toggle()">I Agree</button>
                    </div>
                </div>

                <div class="thankyoumsg thanks-section" style="display:none;padding: 50px 0px;">
                    <div class="thanks-img-outer text-center">
                        <img src="{{ asset('images/icon_green-check-mark-in-circle.png') }}" class="img-fluid" alt="" style="height: 100px;" />
                    </div>
                    <div class="thanks-content text-center mt-5">
                        <h5 style="font-size: 1.75rem;">Thanks for payment.</h5>
                        <h6 class="mt-3">Your are successfully contected with the agency.</h6>
                    </div>

                </div>


                <form action="{{route('authenticate.agency-payment')}}" method="POST" id="payment-form">
                    @csrf
                    <!-- //Header -->
                    <!--<div class="form-header"><p>Powered by Stripe</p></div>-->
                    <h4>Enter Card Details</h4>
                    <div id="card-element">
                        <!-- a Stripe Element will be inserted here. -->
                    </div>
                    <span id="card-errors" class="payment-errors" style="color: red; font-size: 22px; "></span>
                    <input type="hidden" name="stripeToken" id="stripeToken" />

                    <!--Submit-->
                    <div class="form-group text-center" style="padding-top: 10px;">
                        <button type="submit" class="btn btn-primary" id="payment-button">Pay $29</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function mySubmitFunction(event) {
        event.preventDefault();
        doSome();
        return false;
    }

    function doSome() {
        $('.thankyoumsg').toggle();
        $('#payment-agree-box').toggle();
        $('#payment-form').toggle();
    }

    var stripe = Stripe('{{env("STRIPE_KEY")}}');
    var elements = stripe.elements();
    // Custom Styling
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '24px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        },
    };

    // Create an instance of the card Element
    var card = elements.create('card', {
        hidePostalCode: true,
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');

        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });


    // Handle form submission
    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        $('#loader').show();
        $('#payment-button').attr('disabled', true);
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                $('#loader').hide();
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                $('#payment-button').attr('disabled', false);
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });


    // Send Stripe Token to Server
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');

        // Add Stripe Token to hidden input
        var hiddenInput = document.getElementById('stripeToken');
        hiddenInput.setAttribute('value', token.id);

        // Submit form
        doAjaxPayment();
    }

    function doAjaxPayment() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        token = $('input[name="stripeToken"]').val();
        $.ajax({
            url: '{{route("authenticate.agency-payment")}}',
            data: {
                token: token,
                amount: 29
            },
            method: 'POST',
            success: function(response) {
                if (response.status == 200) {
                    card.clear();
                    doSome();
                } else {
                    card.clear();
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = response.message;
                }
                $('#loader').hide();
                $('#payment-button').attr('disabled', false);
            }
        })
    }
</script>
<script>
    function mySubmitFunction(event) {
        event.preventDefault();
        doSome();
        return false;
    }
  
    function doSome() {
        $('.thankyoumsg').toggle();
        $('#payment-agree-box').toggle();
        $('#payment-form2').toggle();
    }
  
    var stripe = Stripe('{{env("STRIPE_KEY")}}');
    var elements = stripe.elements();
    // Custom Styling
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '24px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        },
    };
  
    // Create an instance of the card Element
    var card = elements.create('card', {
        hidePostalCode: true,
        style: style
    });
    console.log(card);
  
    // Add an instance of the card Element into the `card-element2` <div>
    card.mount('#card-element2');
  
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
  
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
  
  
    // Handle form submission
    var form = document.getElementById('payment-form2');
  
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        $('#loader').show();
        $('#payment-button').attr('disabled', true);
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                $('#loader').hide();
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                $('#payment-button').attr('disabled', false);
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });
  
  
    // Send Stripe Token to Server
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form2');
  
        // Add Stripe Token to hidden input
        var hiddenInput = document.getElementById('stripeToken');
        hiddenInput.setAttribute('value', token.id);
  
        // Submit form
        doAjaxPayment();
    }
  
    function doAjaxPayment() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        token = $('input[name="stripeToken"]').val();
        $.ajax({
            url: '{{route("authenticate.agency-payment")}}',
            data: {
                token: token,
                amount: 29
            },
            method: 'POST',
            success: function(response) {
                if (response.status == 200) {
                    card.clear();
                    doSome();
                } else {
                    card.clear();
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = response.message;
                }
                $('#loader').hide();
                $('#payment-button').attr('disabled', false);
            }
        })
    }
  </script>
  
@endsection
