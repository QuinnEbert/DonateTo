<?php
require_once(dirname(__FILE__).'/config.php');
$details = array(
	'to' => 'Who they\'re paying',
	'for' => 'What they\'re paying for',
	'amount' => 'select',
	'currency' => 'usd'
);
?>
<html>
<head>
<title>Payment to <?php echo($details['to']); ?></title>
<script type="text/javascript">
function runTiger() {
	var myScript = document.createElement('script');
	myScript.setAttribute('src','https://checkout.stripe.com/checkout.js');
	myScript.setAttribute('class','stripe-button');
	myScript.setAttribute('data-key','<?php echo($stripe_key_public); ?>');
	<?php if ($details['amount']=='select') { ?>
	var amt_prog = (parseInt(parseFloat(document.getElementById('user_amt').value)*100)).toString();
	myScript.setAttribute('data-amount',amt_prog);
	document.getElementById('amt_prog').value = amt_prog;
	document.getElementById('user_amt').setAttribute('readonly','yes');
	<?php } else { ?>
	myScript.setAttribute('data-amount','<?php echo($details['amount']); ?>');
	<?php } ?>
	myScript.setAttribute('data-name','<?php echo($details['to']); ?>');
	myScript.setAttribute('data-description','<?php echo($details['for']); ?>');
	myScript.setAttribute('data-currency','<?php echo($details['currency']); ?>');
	document.getElementById('pay_form').appendChild(myScript);
}
function runTigerSafe() {
	setTimeout(function(){runTiger();},900);
}
</script>
</head>
<body style="background-color: #efefef;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td align="center" valign="top" style="font-family: sans-serif;">
<h1>Payment to <?php echo($details['to']); ?></h1>
<p style="font-family: serif;"><em>&ndash;&nbsp;for&nbsp;&ndash;</em></p>
<?php if ($details['amount']!='select') { ?>
<p><?php echo(strval((intval($details['amount'])/100))); ?> <?php echo(strtoupper($details['currency'])); ?> for <?php echo($details['for']); ?></p>
<?php } else { ?>
<p><?php echo($details['for']); ?></p>
<?php } ?>
<?php if (isset($details['by'])) { ?>
<p style="font-family: serif;"><em>&ndash;&nbsp;by&nbsp;&ndash;</em></p>
<p><strong><?php echo($details['by']); ?></strong></p>
<?php } ?>
<p style="font-family: serif;"><em>This payment will be handled securely by Stripe, your full<br />card number will not be made available to <?php echo($details['to']); ?></em></p>
<form action="tigerpay.php" method="POST" id="pay_form">
  <?php if ($details['amount']=='select') { ?>
  <p style="font-family: serif;">Please Enter a donation amount:<br />
  <input type="text" id="user_amt" value="0.00" /><?php echo('('.strtoupper($details['currency']).')'); ?><br />
  <input type="button" name="Confirm (Click to Show Payment Options Below)" value="Confirm (Click to Show Payment Options Below)" onclick="javascript:runTigerSafe();" /></p>
  <?php } ?>
  <input type="hidden" name="description" value="<?php echo($details['for']); ?> (<?php echo(strval((intval($details['amount'])/100))); ?> <?php echo(strtoupper($details['currency'])); ?>)" />
  <input type="hidden" name="currency" value="<?php echo(strtolower($details['currency'])); ?>" />
  <input type="hidden" name="amount" id="amt_prog" value="<?php echo($details['amount']); ?>" />
</form>
</td>
</tr>
</table>
</body>
</html>