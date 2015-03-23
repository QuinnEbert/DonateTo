<?php
require_once(dirname(__FILE__).'/config.php');
?>
<html>
<head><title>Payment Status</title></head>
<body style="background-color: #efefef;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="center" valign="top" style="font-family: sans-serif;">
<p><em>Please, do not refresh this page, you may be doubly charged by refreshing this page.</em></p>
<p><?php
require_once(dirname(__FILE__).'/stripe/lib/Stripe.php');
// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account
Stripe::setApiKey($stripe_key_secret);
// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];
// Create the charge on Stripe's servers - this will charge the user's card
try {
	$charge = Stripe_Charge::create(
		array(
			"amount" => $_POST['amount'], // amount in cents, again
			"currency" => $_POST['currency'],
			"card" => $token,
			"description" => $_POST['description']
		)
	);
	echo('<h1>Success!</h1><p><strong>Thank you!</strong>  Your payment was received, we\'ll be in touch very soon!</p>');
} catch(Stripe_CardError $e) {
	echo('<h1>Uh oh!</h1><p><strong>Your payment was declined!</strong>  You may go back and try again if you wish!</p>');
} ?>
</td>
</tr>
</table>
</body>
</html>