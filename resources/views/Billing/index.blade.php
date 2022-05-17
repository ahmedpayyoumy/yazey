@extends('layout.default')
@section('title', 'Dashboard')
@section('styles')

<style>
    .btn.btn-primary {
        color: #FFFFFF;
        background-color: #01354a;
        border-color: #01354A;
    }

    .btn.btn-primary:hover:not(.btn-text),
    .btn.btn-primary:focus:not(.btn-text),
    .btn.btn-primary.focus:not(.btn-text) {
        color: #FFFFFF;
        background-color: #01354a;
        border-color: #01354A;
    }

    .btn.btn-text-secondary {
        color: black;
    }

    .pricing-name img {
        width: 15px;
    }

    .list-group-item {
        text-align: center;
    }

    .card {
        border: inherit;
    }

    #kt_wrapper .content {
        padding: 0px 21px 0px 21px;

    }
</style>

<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper" style="min-height: 300px;">
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid" style="padding-bottom: 26px;">
                <div class="btn-tab-wrap" style="margin-top: 22px;">
                    <a class="btn-link" href="#" id="payment_method" onclick="payment_method()">
                        <button class="btn btn-outline-secondary  tab-btn">Payment Method</button>
                    </a>

                    <a class="btn-link" href="#" id="invoices" onclick="invoices()">
                        <button class="btn btn-outline-secondary  tab-btn">Invoices</button>
                    </a>

                </div>


                <div class="card mb-0" style="padding: 28px;min-height: 0;margin-top: 48px;">
                    <div class="plan-wrap">

                    </div>


                    <div class="plan-wrap payment_method">
                        <div id="pricing" class="section-item section-empty" data-anima="" data-time="500" data-timeline="asc" style="">
                            <div class="content container" style="">
                                <div class="row">

                                    <div id="column_fOpPI" class="hc_column_cnt col-md-4 anima fade-in" style="position: relative; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;" aid="0.05613694543447134">
                                        <div class="row">
                                            <div class="col-md-12 hc_niche_content_box_pricing_table_cnt">
                                                <div class="list-group pricing-table    " style="">
                                                    <div class="list-group-item pricing-price">Free Plan</div>
                                                    <div class="list-group-item pricing-name">
                                                        <h3>For those who are curious <img draggable="false" role="img" class="emoji" alt="🐈" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f408.svg"></h3>
                                                    </div>
                                                    <div class="list-group-item">Access to competitor ROAS data only (one month only)</div>
                                                    <div class="list-group-item">-</div>
                                                    <div class="list-group-item">-</div>
                                                    <div class="list-group-item">-</div>
                                                    <div class="list-group-item">-</div>
                                                    <div class="list-group-item">-</div>
                                                    <div class="list-group-item"><button data-tf-popup="NuTBwe9I" data-tf-size="70" data-tf-auto-close="" style="all:unset;font-family:Helvetica,Arial,sans-serif;display:inline-block;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;background-color:#28a745;color:#FFFFFF;font-size:20px;border-radius:25px;padding:0 33px;font-weight:bold;height:50px;cursor:pointer;line-height:50px;text-align:center;margin:0;text-decoration:none;" data-tf-loaded="true">Free... forever</button>
                                                        <script src="//embed.typeform.com/next/embed.js"></script>
                                                    </div>
                                                    <div class="list-group-item pricing-btn"><a class="btn" href="#">Free - Nothing to lose</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="column_WXViN" class="hc_column_cnt col-md-4 anima fade-in" style="position: relative; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;" aid="0.472529711325385">
                                        <div class="row">
                                            <div class="col-md-12 hc_niche_content_box_pricing_table_cnt">
                                                <div class="list-group pricing-table     pricing-table-big" style="">
                                                    <div class="list-group-item pricing-price">$67<span>/month</span></div>
                                                    <div class="list-group-item pricing-name">
                                                        <h3>For small eCommerce stores <img draggable="false" role="img" class="emoji" alt="🌱" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f331.svg"></h3>
                                                    </div>
                                                    <div class="list-group-item">Access to competitor ROAS, Sales &amp; marketing spend data</div>
                                                    <div class="list-group-item">View 12 months of competitor ROAS/Sales data</div>
                                                    <div class="list-group-item">Agency Spy tool, to track the activity of your marketing agency/team</div>
                                                    <div class="list-group-item">Detailed Competitor sales &amp; marketing analysis</div>
                                                    <div class="list-group-item">1 Free connection with an ad agency per month</div>
                                                    <div class="list-group-item">-</div>
                                                    <div class="list-group-item"><button data-tf-popup="BVUWagbT" data-tf-size="70" data-tf-auto-close="" style="all:unset;font-family:Helvetica,Arial,sans-serif;display:inline-block;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;background-color:#01354A;color:#FFFFFF;font-size:20px;border-radius:25px;padding:0 33px;font-weight:bold;height:50px;cursor:pointer;line-height:50px;text-align:center;margin:0;text-decoration:none;" data-tf-loaded="true" onclick="show_add_credit_card_section('67')">Buy now</button>
                                                        <script src="//embed.typeform.com/next/embed.js"></script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="column_6V4Nx" class="hc_column_cnt col-md-4 anima fade-in" style="position: relative; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;" aid="0.23363200454012256">
                                        <div class="row">
                                            <div class="col-md-12 hc_niche_content_box_pricing_table_cnt">
                                                <div class="list-group pricing-table    " style="">
                                                    <div class="list-group-item pricing-price">$196<span>/month</span></div>
                                                    <div class="list-group-item pricing-name">
                                                        <h3>For larger eCommerce stores <img draggable="false" role="img" class="emoji" alt="💸" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f4b8.svg"></h3>
                                                    </div>
                                                    <div class="list-group-item">Unlimited access to all features and Agency Spy</div>
                                                    <div class="list-group-item">Live notifications when Yazey finds a marketing agency outperforming you/your agency.</div>
                                                    <div class="list-group-item">Live notifications as industry/competitor marketing/sales performance fluctuate</div>
                                                    <div class="list-group-item">Access to price distribution of a competitor store's products.</div>
                                                    <div class="list-group-item">Dedicated Account Manager </div>
                                                    <div class="list-group-item">24/7 support</div>
                                                    <div class="list-group-item"><button data-tf-popup="nTjWi5te" data-tf-size="70" data-tf-auto-close="" style="all:unset;font-family:Helvetica,Arial,sans-serif;display:inline-block;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;background-color:#01354A;color:#FFFFFF;font-size:20px;border-radius:25px;padding:0 33px;font-weight:bold;height:50px;cursor:pointer;line-height:50px;text-align:center;margin:0;text-decoration:none;" data-tf-loaded="true" onclick="show_add_credit_card_section('196')">Buy now</button>
                                                        <script src="//embed.typeform.com/next/embed.js"></script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="thankyoumsg" style="color: green;text-align: center;font-size: 17px;display:none;">Thanks for choosing plan. Your Services will be activated shortly</p>

                        <form action="" id="frmStripePayment" method="post" style="display:none;" class="add-credit-card-section">
                            @csrf
                            <div class="setting-label pt-2 pb-md-2 pb-lg-2" style="font-size:18px;color:black;font-weight:bold;">Payment details</div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="label-text">Amount</label>
                                        <input type="text" id="amount" name="amount" class="form-control label-toggle" placeholder="" readonly>
                                        <p id="name_error" class="error d-none"></p>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="label-text">Cardholder Name</label>
                                        <input type="text" id="name" name="name" class="form-control label-toggle" placeholder="Your name on card" required>
                                        <p id="name_error" class="error d-none"></p>
                                    </div>
                                </div>
                            </div>
                            <!-- //Header -->
                            <!--<div class="form-header"><p>Powered by Stripe</p></div>-->
                            <h4>Enter Card Details</h4>
                            <div class="row mt-3">
                                <div class="col-12 col-md-6">
                                    <div id="card-element">
                                        <!-- a Stripe Element will be inserted here. -->
                                    </div>
                                    <span id="card-errors" class="payment-errors text-danger"></span>
                                </div>
                            </div>
                            <input type="hidden" name="stripeToken" id="stripeToken" />

                            <!--Submit-->
                            <div class="d-flex justify-content-end w-100 my-2">
                                <a class="btn btn-text-secondary sm mb-0" style="margin-top: 20px;" href="javascript:void(0)" onclick="show_add_credit_card_section()">Cancel</a>&nbsp;&nbsp;
                                <!--<button class="btn btn-primary payment-btn" id="payment-submit-btn" onclick="stripePay(event);">Make the payment</button>-->
                                <button class="btn btn-primary" id="payment-button" style="margin-top: 20px">Make the payment</button>

                            </div>

                        </form>
                    </div>

                    <div class="plan-wrap invoices" style="display:none;">
                        <div class="card mb-0">
                            <div class="table-outer with-header wo-padding">
                                <table class="table table-striped">
                                    <thead class="table-head">
                                        <tr>
                                            <th class="head-item d-none d-md-table-cell">S no.</th>
                                            <th class="head-item d-none d-md-table-cell">Name</th>
                                            <th class="head-item">Transaction Id</th>
                                            <th class="head-item d-none d-md-table-cell">Amount</th>
                                            <th class="head-item">Date</th>
                                            <th class="head-item">Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <tr class="table-row">
                                            <td colspan="8" style="text-align: center;">No records found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function show_add_credit_card_section(val) {
        if (val) {
            $('.add-credit-card-section').show();
        } else {
            $('.add-credit-card-section').hide();

        }
        $('.thankyoumsg').hide();
        $('#amount').val(val);
    }

    function payment_method() {
        $('.payment_method').show();
        $('.invoices').hide();
    }

    function invoices() {
        $('.payment_method').hide();
        $('.invoices').show();
    }
</script>
<script>
    var stripe = Stripe('{{env("STRIPE_KEY")}}');
    var elements = stripe.elements();
    // Custom Styling
    var style = {};

    // Create an instance of the card Element
    var card = elements.create('card', {
        hidePostalCode: true,
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    var form = document.getElementById('frmStripePayment');

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
        amount = $('input[name="amount"]').val();
        token = $('input[name="stripeToken"]').val();
        $.ajax({
            url: '{{route("authenticate.plan-payment")}}',
            data: {
                amount: amount,
                token: token
            },
            method: 'POST',
            success: function(response) {
                if (response.status == 200) {
                    $('.thankyoumsg').show();
                    $('.add-credit-card-section').hide();
                    card.clear();
                } else {
                    $('#card-errors').text(response.message);
                }
                $('#payment-button').attr('disabled', false);
                $('#loader').hide();

            }
        })
    }
</script>
@endsection
