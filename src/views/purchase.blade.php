<!-- SAMPLE FORM -->
<!-- Copy this into your view and edit as necessary -->
<!-- Pay attention to form id and payment-errors span -->
<!-- Form ID is a hook in stripehelper.js, and errors span used to hold errors from Stripe -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/packages/anthonyvipond/stripehelper/stripehelper.js"></script>

<form action="/process" method="POST" id="payment-form">
  <span class="payment-errors"></span>

  <div class="form-row">
    <label>
      <span>Email</span>
      <input type="text" size="20" name="email" value="anthonytrading81@gmail.com"/>
    </label>
  </div>

  <div class="form-row">
    <label>
      <span>Card Number</span>
      <input type="text" size="20" value="4242424242424242" data-stripe="number"/>
    </label>
  </div>

  <div class="form-row">
    <label>
      <span>CVC</span>
      <input type="text" value="123" size="4" data-stripe="cvc"/>
    </label>
  </div>

  <div class="form-row">
    <label>
      <span>Expiration (MM/YYYY)</span>
      <input type="text" size="2" value="01" data-stripe="exp-month"/>
    </label>
    <span> / </span>
    <input type="text" size="4" value="2019" data-stripe="exp-year"/>
  </div>

  <button type="submit">Submit Payment</button>
</form>