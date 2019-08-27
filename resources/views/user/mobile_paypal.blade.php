<html>
    <head>
        <title>
             PayPal Payment
        </title>

    </head>


    <body>

    <font face="Century Gothic">
         <h3>PAYMENT SUMMARY</h3> <br>

        <h4> <strong>Base Fee: </strong> 100 PHP </h4>
        <h4> <strong>Online Transaction Fee: </strong> 150 PHP </h4>
        <h4> <strong>Total Amount Due: </strong> 150 PHP </h4>
        <br>
        <strong> Note: After payment do not close the paypal page until you will be redirected to your dashboard in order to save the payment information. </strong>
        <br>
    </font>
        <script src="https://www.paypal.com/sdk/js?client-id=AbGnKOw7mQdj4DBfBvyzBuzyMKnpwbT5CBGjAi5gYphRGllGuJDd0aeRwcOHZrsc5BSibAn3qDYPmHIz&currency=PHP">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <div id="paypal-button-container"></div>  


    </body>

    <script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value:  150},

                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {

                Swal.fire('Success!', 'Your Payment has been submitted! Please wait for your payment to be verified. Thank You!', 'success');
                location.href = "asd"

                // Call your server to save the transaction

                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container');
</script>



</html>