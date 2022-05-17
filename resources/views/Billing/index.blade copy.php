{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'Dashboard')

@section('styles')

<style>
.btn.btn-primary {
color: #FFFFFF;
background-color: #01354a;
border-color: #01354A;
}
.btn.btn-primary:hover:not(.btn-text), .btn.btn-primary:focus:not(.btn-text), .btn.btn-primary.focus:not(.btn-text) {
    color: #FFFFFF;
    background-color: #01354a;
    border-color: #01354A;
}
.btn.btn-text-secondary {
    color: black;
}
.pricing-name img{
    width:15px;
}
.list-group-item {
    text-align:center;
}
.card{
 border: inherit;
}
#kt_wrapper .content{
 padding:0px 21px 0px 21px;

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
    <div class="row"><div class="col-md-12 hc_niche_content_box_pricing_table_cnt"><div class="list-group pricing-table    " style="">
    <div class="list-group-item pricing-price">Free Plan</div><div class="list-group-item pricing-name"><h3>For those who are curious <img draggable="false" role="img" class="emoji" alt="🐈" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f408.svg"></h3></div> <div class="list-group-item">Access to competitor ROAS data only (one month only)</div> <div class="list-group-item">-</div> <div class="list-group-item">-</div> <div class="list-group-item">-</div> <div class="list-group-item">-</div> <div class="list-group-item">-</div> <div class="list-group-item"><button data-tf-popup="NuTBwe9I" data-tf-size="70" data-tf-auto-close="" style="all:unset;font-family:Helvetica,Arial,sans-serif;display:inline-block;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;background-color:#28a745;color:#FFFFFF;font-size:20px;border-radius:25px;padding:0 33px;font-weight:bold;height:50px;cursor:pointer;line-height:50px;text-align:center;margin:0;text-decoration:none;" data-tf-loaded="true">Free... forever</button><script src="//embed.typeform.com/next/embed.js"></script></div><div class="list-group-item pricing-btn"><a class="btn" href="#">Free - Nothing to lose</a></div></div>
</div></div></div>

<div id="column_WXViN" class="hc_column_cnt col-md-4 anima fade-in" style="position: relative; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;" aid="0.472529711325385">
    <div class="row"><div class="col-md-12 hc_niche_content_box_pricing_table_cnt"><div class="list-group pricing-table     pricing-table-big" style="">
    <div class="list-group-item pricing-price">$67<span>/month</span></div><div class="list-group-item pricing-name"><h3>For small eCommerce stores <img draggable="false" role="img" class="emoji" alt="🌱" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f331.svg"></h3></div> <div class="list-group-item">Access to competitor ROAS, Sales &amp; marketing spend data</div> <div class="list-group-item">View 12 months of competitor ROAS/Sales data</div> <div class="list-group-item">Agency Spy tool, to track the activity of your marketing agency/team</div> <div class="list-group-item">Detailed Competitor sales &amp; marketing analysis</div> <div class="list-group-item">1  Free connection with an ad agency per month</div> <div class="list-group-item">-</div> <div class="list-group-item"><button data-tf-popup="BVUWagbT" data-tf-size="70" data-tf-auto-close="" style="all:unset;font-family:Helvetica,Arial,sans-serif;display:inline-block;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;background-color:#01354A;color:#FFFFFF;font-size:20px;border-radius:25px;padding:0 33px;font-weight:bold;height:50px;cursor:pointer;line-height:50px;text-align:center;margin:0;text-decoration:none;" data-tf-loaded="true"  onclick="show_add_credit_card_section('67')">Buy now</button><script src="//embed.typeform.com/next/embed.js"></script></div></div>
</div></div></div>

<div id="column_6V4Nx" class="hc_column_cnt col-md-4 anima fade-in" style="position: relative; animation-duration: 500ms; transition-timing-function: ease; transition-delay: 0ms;" aid="0.23363200454012256">
    <div class="row"><div class="col-md-12 hc_niche_content_box_pricing_table_cnt"><div class="list-group pricing-table    " style="">
    <div class="list-group-item pricing-price">$196<span>/month</span></div><div class="list-group-item pricing-name"><h3>For larger eCommerce stores  <img draggable="false" role="img" class="emoji" alt="💸" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f4b8.svg"></h3></div> <div class="list-group-item">Unlimited access to all features and Agency Spy</div> <div class="list-group-item">Live notifications when Yazey finds a marketing agency outperforming you/your agency.</div> <div class="list-group-item">Live notifications as industry/competitor marketing/sales performance fluctuate</div> <div class="list-group-item">Access to price distribution of a competitor store's products.</div> <div class="list-group-item">Dedicated Account Manager </div> <div class="list-group-item">24/7 support</div> <div class="list-group-item"><button data-tf-popup="nTjWi5te" data-tf-size="70" data-tf-auto-close="" style="all:unset;font-family:Helvetica,Arial,sans-serif;display:inline-block;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;background-color:#01354A;color:#FFFFFF;font-size:20px;border-radius:25px;padding:0 33px;font-weight:bold;height:50px;cursor:pointer;line-height:50px;text-align:center;margin:0;text-decoration:none;" data-tf-loaded="true" onclick="show_add_credit_card_section('196')">Buy now</button><script src="//embed.typeform.com/next/embed.js"></script></div></div>
</div></div>
</div>
 </div>
</div>
</div>
                                <p class="thankyoumsg" style="color: green;text-align: center;font-size: 17px;display:none;">Thanks for choosing plan. Your Services will be activated shortly</p>

                        <form  action="" id="frmStripePayment" method="post" style="display:none;" class="add-credit-card-section">
                            <input type="hidden" name="_token" value="onqX7kbEvPOyaHadjIAwShOtju2KpXpbvwt1eiCT">
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
                                        <input type="text" id="name" name="name" class="form-control label-toggle" placeholder="Your name on card">
                                        <p id="name_error" class="error d-none"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-text">Card Number</label>
                                        <input type="number"  id="card-number" name="card_number" class="form-control label-toggle" placeholder="xxxx xxxx xxxx xxxx">
                                        <p id="card_number_error" class="error d-none"></p>
                                    </div>
                                    <div class="row d-none d-md-flex d-lg-flex">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="label-text">Expiry Month</label>
                                                <select  name="month" id="month" class="form-control">
                                                    <option value="">Ex. Month</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                                <p id="expiry_month_error" class="error d-none"></p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label class="label-text">Expiry Year</label>
                                                <select  name="year" id="year" class="form-control">
                                                    <option value="">Ex. Year</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                                <p id="expiry_year_error" class="error d-none"></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="label-text">CVV / CVC</label>
                                                <input  type="text" name="cvc" id="cvc" class="form-control label-toggle" placeholder="***">
                                                <p id="cvv_error" class="error d-none"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12 col-md-6">
                                    <div class="btn btn-default payment-btn">
                                        <img src="http://dev.popcornapp.net/public/images/credit-card.svg" alt="">
                                        <div class="paid-div" style="margin-top:15px;">
                                            <div>No of participant: <span id="nop">0</span></div>
                                            <div>Per participant cost: <span id="ppc">$0</span></div>
                                            <div>Grant total: <span id="gt">$0</span></div>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                            <!-- <div class="card-divider divider"></div>
                            <div class="setting-label pt-2 pb-md-2 pb-lg-2" style="font-size:18px;color:black;font-weight:bold;">Billing details</div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="label-text">Email</label>
                                        <input onkeyup="cardValidation()" type="text" id="email" name="email" class="form-control label-toggle" placeholder="Your Email">
                                        <p id="email_error" class="error d-none"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-text">Country</label>
                                        <input type="text" id="address_country" value="IN" name="address_country" class="form-control label-toggle" placeholder="">
                                        <p id="address_country_error" class="error d-none"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-text">State/Province/Region</label>
                                        <input type="text" id="address_state" name="address_state" class="form-control label-toggle" placeholder="Your State/Province/Region">
                                        <p id="address_state_error" class="error d-none"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="label-text">Company Name</label>
                                        <input type="text" id="company_name" name="company_name" class="form-control label-toggle" placeholder="Your Company Name">
                                        <p id="company_name_error" class="error d-none"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-text">City</label>
                                        <input type="text" id="address_city" name="address_city" class="form-control label-toggle" placeholder="Your City">
                                        <p id="address_city_error" class="error d-none"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="label-text">Street Address</label>
                                        <input type="text" id="address_line1" name="address_line1" class="form-control label-toggle" placeholder="Your Street Address">
                                        <p id="address_line1_error" class="error d-none"></p>
                                    </div>

                                </div>
                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label class="label-text">Postal</label>
                                        <input type="text" id="address_zip" name="address_zip" class="form-control label-toggle" placeholder="Your Postal">
                                        <p id="address_zip_error" class="error d-none"></p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label class="label-text">TAX/Vat ID</label>
                                        <input type="text" id="tax_vat_id" name="tax_vat_id" class="form-control label-toggle" placeholder="Your TAX/Vat ID">
                                        <p id="tax_vat_id_error" class="error d-none"></p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="d-flex justify-content-end w-100 my-2">
                                <a class="btn btn-text-secondary sm mb-0" style="margin-top: 20px;" href="javascript:void(0)" onclick="show_add_credit_card_section()">Cancel</a>&nbsp;&nbsp;
                                <!--<button class="btn btn-primary payment-btn" id="payment-submit-btn" onclick="stripePay(event);">Make the payment</button>-->
                                <a class="btn btn-primary" onclick="stripePays()" style="margin-top: 20px">Make the payment</a>

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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script>
    function stripePays(){
        $('#loader').show();
       var delayInMilliseconds = 7000; //1 second
          $(window).scrollTop(40);

      setTimeout(function() {
        $('.thankyoumsg').show();
        $('#loader').hide();
       $('#frmStripePayment').hide();
      showNotify('Thanks for choosing plan. Your Services will be activated shortly', 'success', 'fa-check');

     }, delayInMilliseconds);
    }
</script>
<script>
     function show_add_credit_card_section(val){
         $('.add-credit-card-section').show();
         $('#amount').val(val);




     }

     function payment_method(){
         $('.payment_method').show();
         $('.invoices').hide();
     }

     function invoices(){
         $('.payment_method').hide();
         $('.invoices').show();
     }
</script>
<script>
  var STRIPEKEY = 'pk_test_51HuvbNA1B2myt00lICmrwAf6S9tiS5HoOqFdELweU0dK2TG8g99izfBXfS7ca4zA1Y2b0It7tjQ0q4XrCQsDTCCU00DGxbkDW7';
    Stripe.setPublishableKey(STRIPEKEY);
      function stripePay(e) {
        e.preventDefault();

            $('#payment-submit-btn').prop('disabled', true);
            $("#payment-submit-btn").html('<i class="fas fa-spinner fa-pulse fa-fw"></i>');
            Stripe.createToken({
                number: $('#card-number').val(),
                cvc: $('#cvc').val(),
                exp_month: $('#month').val(),
                exp_year: $('#year').val(),
                name: $("#name").val(),
                /* address_line1: $("#address_line1").val(),
                address_city: $("#address_city").val(),
                address_state: $("#address_state").val(),
                address_zip: $("#address_zip").val(),
                address_country: $("#address_country").val(), */
            }, stripeResponseHandler);
            return false;

    }

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#payment-submit-btn').prop('disabled', false);
            $("#payment-submit-btn").html('Submit Credit Card');
            // $("#submit-btn").show();
            // $( "#loader" ).css("display", "none");
            showNotify(response.error.message, 'danger', 'fa-times');
        } else {
            var token = response['id'];
            // $("#frmStripePayment").append("<input type='hidden' name='stripe_token' value='" + token + "' />");
            // let frmAction = $("#frmStripePayment").attr("action");
            if (token) {
                // $.ajax({
                //     type: "POST",
                //     url: frmAction,
                //     data: $("#frmStripePayment").serialize(),
                //     success: function(res) {
                //         if (res.status == 200) {
                //             $('#payment-submit-btn').prop('disabled', false);
                //             $("#payment-submit-btn").html('Submit Credit Card');
                //             showNotify(res.message, 'success', 'fa-check');
                //             setTimeout(() => {
                //                 // $('#frmStripePayment')[0].reset();
                //                 window.location.href = $("#frmStripePayment").attr("redirectTo");
                //             }, 2000);
                //         } else {
                //             showNotify(res.message, 'danger', 'fa-times');
                //         }
                //     },
                //     error: function(jqXHR, textStatus, err) {
                //         console.log("text status " + textStatus + ", err " + err);
                //     },
                // });
            }
        }
    }

</script>
@endsection

@section('scripts')

@endsection
