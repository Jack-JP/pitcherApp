@extends('layouts.app')

@section('styles')
<style>
.StripeElement {
  background-color: white;
  padding: 10px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}

#payment-form{
  width: 90%;
}
</style>

@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <legend class="text-center">Shipping Address</legend>
      <hr>
      <div class="row">
        <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @if($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
            @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('address') }}</span>
            @endif
          </div>

          <div class="half-form">
            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
              @if($errors->has('name'))
              <span class="help-block">{{ $errors->first('city') }}</span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
              <label for="province">Province</label>
              <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
              @if($errors->has('name'))
              <span class="help-block">{{ $errors->first('province') }}</span>
              @endif
            </div>
          </div>

          <div class="half-form">
            <div class="form-group{{ $errors->has('postalcode') ? ' has-error' : '' }}">
              <label for="postalcode">Postal Code</label>
              <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
              @if($errors->has('name'))
              <span class="help-block">{{ $errors->first('postalcode') }}</span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
              @if($errors->has('name'))
              <span class="help-block">{{ $errors->first('phone') }}</span>
              @endif
            </div>
          </div> <!-- end half-form -->
          <div class="form-group{{ $errors->has('name_on_card') ? ' has-error' : '' }}">
            <label for="name_on_card">Name on Card</label>
            <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
            @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name_on_card') }}</span>
            @endif
          </div>

          <div class="form-group">
            <label for="card-element">
              Credit or debit card
            </label>
            <div id="card-element">
              <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
          </div>

          <button type="submit" id="complete-order" class="button-primary full-width">Complete Order</button>
        </form>
      </div>
    </div>
    <div class="col-md-6 ">

      <legend  class="text-center">Review Order</legend>
      <hr>
      @foreach(Cart::content() as $item)
      <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-4">
          <a href="{{ route('shop.show', $item->model->slug) }}">
            @if($item->model->image)
            <img src="{{ asset('storage/'.$item->model->image) }}" alt="img" class="img-thumbnail">
            @else
            <img src="{{ asset('img/defaults/placeholder_default_350x180.png')}}" alt="img" class="img-thumbnail">
            @endif
          </a>
        </div>
        <div class="col-md-4">

          <div class="row">
            <strong>{{ $item->model->name }}</strong>
          </div>
          <div class="row">
            <p>Quantity: {{ $item->qty }}</p>
          </div>
        </div>
        <div class="col-md-4">
          <h6>{{ $item->model->presentPrice() }}</h6>
        </div>

      </div>
      <hr>
      @endforeach

      <div class="row justify-content-end">
        <div class="col-md-6 col-offset-md-6">
          <div class="row justify-content-end" style="border-bottom: gray solid 1px;">
            <h6><strong>SubTotal: <small>{{ presentPrice(Cart::subtotal()) }}</small></strong> </h6>
          </div>
          <div class="row justify-content-end" style="border-bottom: gray solid 1px;">
            <h6><strong>Tax (21%): <small>{{ presentPrice(Cart::tax()) }}</small></strong> </h6>
          </div>
          <div class="row justify-content-end" style="border-bottom: gray solid 1px;">
            <h6><strong>Total: <small>{{ presentPrice(Cart::total()) }}</small></strong> </h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection

  @section('scripts')
  <script>
  (function(){
    // Create a Stripe client.
    var stripe = Stripe('pk_test_JW7LEohNEr0UhF1MV0dfGtu2');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '18px',
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
      }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
      style: style,
      hidePostalCode: true
    });

    // Add an instance of the card Element into the `card-element` <div>.
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

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      document.getElementById('complete-order').disabled = true;

      var options = {
        name: document.getElementById('name_on_card').value,
        address_line1: document.getElementById('address').value,
        address_city: document.getElementById('city').value,
        address_state: document.getElementById('province').value,
        address_zip: document.getElementById('postalcode').value
      }

      stripe.createToken(card, options).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;

          document.getElementById('complete-order').disabled = flase;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);

      // Submit the form
      form.submit();
    }
  })();
</script>
@endsection
