<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@400;600;700&display=swap");

      .body-class {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        font-family: "Rubik", sans-serif;
      }
      .redirect-btn {
        padding: 10px 20px;
        border-radius: 5px;
        border: 1px solid #e4e4e4;
        color: white;
        cursor: pointer;
        background-color: #008080;
        text-decoration: none;
        text-transform: capitalize;
        display: inline-block;
        transition: all cubic-bezier(0.39, 0.575, 0.565, 1);
      }
      .redirect-btn:hover {
        background-color: white;
        border-color: #008080;
        color: #008080;
      }
      .payment-card {
        width: 400px;
        padding: 30px;
        border-radius: 20px;
        background-color: #f3f4f6;
        text-align: center;
        box-shadow: 0px 0px 20px 10px rgba(0,0,0,0.1);
      }
      .payment-card ul {
        list-style: none;
        padding: 20px 0;
        margin: 0;
      }
      .payment-card ul li {
        line-height: 2;
      }
      h4 {
        font-size: 24px;
        padding: 0;
        margin: 0;
        font-weight: 500;
        text-transform: capitalize;
      }
    #cardNumber,
    #securityCode,
    #expirationDate {
      display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    margin: 10px 0;
    }
    </style>
  </head>
  <body class="body-class">
    <div class="payment-card">

      <form id="{{ $gateway->keyword == 'mercadopago' ? 'mercadopago' : '' }}" action="{{ $route }}" method="get">
      <h4>payment details</h4>

      @php
          $user= DB::table('users')->where('id', $user)->first();
      @endphp
      <ul>
        <li>
          <span> <b>User name:</b> </span>
          <span>{{ $user->name }}</span>
        </li>
        <li>
          <span> <b>User Email:</b> </span>
          <span>{{ $user->email }} </span>
        </li>
        <li>
          <span> <b>Amount:</b> </span>
          <span>{{ $amount }} {{ $curr->code }}</span>
        </li>
        <li>
          <span> <b>Pyament method:</b> </span>
          <span> {{ $gateway->keyword }}</span>
        </li>
      </ul>
      
        @if ($gateway->keyword == 'mercadopago')
          <div class="my-2"></div>
          <div id="cardNumber"></div>
          <div id="expirationDate"></div>
          <div id="securityCode"> </div>


          <div class="form-group pb-2">
              <input class="form-control" type="text" id="cardholderName" data-checkout="cardholderName"
                  placeholder="{{ __('Card Holder Name') }}" required />
          </div>
          <div class="form-group py-2">
              <input class="form-control" type="text" id="docNumber" data-checkout="docNumber"
                  placeholder="{{ __('Document Number') }}" required />
          </div>
          <div class="form-group py-2">
              <select id="docType" class="form-control" name="docType" data-checkout="docType" type="text"></select>
          </div>
          @endif

      <button type="submit"   class="redirect-btn">confirm deposit</a>
    </form>
    </div>



    <script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>



    
@if ($gateway->keyword == 'mercadopago')
@php
$paydata = $gateway->convertAutoData();
@endphp
<script src="{{asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ $paydata['key'] }}");
    
        const cardNumberElement = mp.fields.create('cardNumber', {
            placeholder: "Card Number"
        }).mount('cardNumber');

        const expirationDateElement = mp.fields.create('expirationDate', {
            placeholder: "MM/YY",
        }).mount('expirationDate');

        const securityCodeElement = mp.fields.create('securityCode', {
            placeholder: "Security Code"
        }).mount('securityCode');


        (async function getIdentificationTypes() {
            try {
                const identificationTypes = await mp.getIdentificationTypes();

                const identificationTypeElement = document.getElementById('docType');

                createSelectOptions(identificationTypeElement, identificationTypes);

            } catch (e) {
                return console.error('Error getting identificationTypes: ', e);
            }
        })();

        function createSelectOptions(elem, options, labelsAndKeys = {
            label: "name",
            value: "id"
        }) {

            const {
                label,
                value
            } = labelsAndKeys;

            //heem.options.length = 0;

            const tempOptions = document.createDocumentFragment();

            options.forEach(option => {
                const optValue = option[value];
                const optLabel = option[label];

                const opt = document.createElement('option');
                opt.value = optValue;
                opt.textContent = optLabel;


                tempOptions.appendChild(opt);
            });

            elem.appendChild(tempOptions);
        }
        cardNumberElement.on('binChange', getPaymentMethods);
        async function getPaymentMethods(data) {
            const {
                bin
            } = data
            const {
                results
            } = await mp.getPaymentMethods({
                bin
            });
            console.log(results);
            return results[0];
        }

        async function getIssuers(paymentMethodId, bin) {
            const issuears = await mp.getIssuers({
                paymentMethodId,
                bin
            });
            console.log(issuers)
            return issuers;
        };

        async function getInstallments(paymentMethodId, bin) {
            const installments = await mp.getInstallments({
                amount: document.getElementById('transactionAmount').value,
                bin,
                paymentTypeId: 'credit_card'
            });

        };

        async function createCardToken() {
            const token = await mp.fields.createCardToken({
                cardholderName,
                identificationType,
                identificationNumber,
            });

        }
        let doSubmit = false;
        $(document).on('submit', '#mercadopago', function(e) {
            getCardToken();
            e.preventDefault();
        });
        async function getCardToken() {
            if (!doSubmit) {
                let $form = document.getElementById('mercadopago');
                const token = await mp.fields.createCardToken({
                    cardholderName: document.getElementById('cardholderName').value,
                    identificationType: document.getElementById('docType').value,
                    identificationNumber: document.getElementById('docNumber').value,
                })
                setCardTokenAndPay(token.id)
            }
        };

        function setCardTokenAndPay(token) {
            let form = document.getElementById('mercadopago');
            let card = document.createElement('input');
            card.setAttribute('name', 'token');
            card.setAttribute('type', 'hidden');
            card.setAttribute('value', token);
            form.appendChild(card);
            doSubmit = true;
            form.submit();
        };
</script>
@endif

  </body>

</html>

