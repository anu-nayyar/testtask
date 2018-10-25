<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Include all Required classes

include('../MailChimp/Api/Contact.php');
include('../MailChimp/Api/CampaignDefaults.php');
include('../MailChimp/Api/Transaction.php');
include('../MailChimp/Validation/StringValidator.php');
include('../MailChimp/Api/MailChimp.php');

use MailChimp\Api\Contact;
use MailChimp\Api\CampaignDefaults;
use MailChimp\Api\Transaction;
use MailChimp\Validation\StringValidator;
use MailChimp\Api\MailChimp;
?>
<!-- UI Code for the Front end elements -->
<html>
	<head>
		<style type="text/css">
			th {
				text-align: right;
			}
			.msgbox {
				margin: 16px;
				border-style: solid;
				border-width: 1px;
				padding: 15px;
			}
			.msgbox.error {
				border-color: #900;
				background-color: #fdd;
				color: #900;
			}
			.msgbox.error th, .msgbox.error td {
				color: #900;
			}
			.msgbox.warning {
				border-color: #b29501;
				background-color: #eddd90;
				color: #b29501;
			}
			.msgbox.warning th, .msgbox.warning td {
				color: #b29501;
			}
			.msgbox.notice {
				border-color: #009;
				background-color: #ddf;
				color: #009;
			}
			.msgbox.notice th, .msgbox.notice td {
				color: #009;
			}
			.msgbox.success {
				border-color: #090;
				background-color: #dfd;
				color: #090;
			}
			.msgbox.success th, .msgbox.success td {
				color: #090;
			}
			.email-template {
				border: 1px dashed #808080;
				padding: 1rem;
				max-height: 300px;
				overflow-y: auto;
			}
			.email-template, .email-template table th, .email-template table td {
				font-family: Calibri, sans-serif;
				font-size: 11pt;
			}
			.email-template table th, .email-template table td {
				border: 1px solid #000;
				padding: 4px 8px;
			}
			.email-template table th {
				background-color: #24a1d3;
				color: #fff;
				text-align: left;
				font-weight: bold;
			}
			.email-template table {
				border-collapse: collapse;
			}
			.email-template p {
				margin: 0
			}
			.email-template a {
				color: #00e;
				text-decoration: underline;
				text-decoration-color: #00e;
			}
		</style>
	</head>
	<body>
		<p><Strong>MailChimp New List Creation</Strong></p>
		<p>Please provide the following details for New List Creation</p>
		<form method="POST" enctype="application/x-www-form-urlencoded">
			<table>
				<tbody>
					<tr>
						<td>List Name</td>
						<td><input type="text" name="name" value="test"></td>
					</tr>
					<tr>
						<td>Company Name</td>
						<td><input type="text" name="company" value="test"></td>
					</tr>
					<tr>
						<td>Address1</td>
						<td><input type="text" name="address1" value="test"></td>
					</tr>
					<tr>
						<td>Address2</td>
						<td><input type="text" name="address2" value="test"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="city" value="Melbourne"></td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="state" value="VIC"></td>
					</tr>
					<tr>
						<td>Zipcode</td>
						<td><input type="text" name="zip" value="2000"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="country" value="AU"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td><input type="text" name="phone" value="040000000"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Create New List"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
<!-- End of UI code -->

<?php

	//If the Form response is not empty.
	if (!empty($_POST)) {
		foreach ($_POST as $key => $value)	{
			//Run validation on all required data values.
			$mailChimpValidate = StringValidator::validate($key,$value);
		}
		//If all the required field values are set, create the transaction object.
		if($mailChimpValidate) {
			//Create Contact Object.
			$contactArray = [];
			$contactArray['company'] = $_POST['company'];
			$contactArray['address1'] = $_POST['address1'];
			$contactArray['address2'] = $_POST['address2'];
			$contactArray['city'] = $_POST['city'];
			$contactArray['state'] = $_POST['state'];
			$contactArray['zip'] = $_POST['zip'];
			$contactArray['country'] = $_POST['country'];
			$contactArray['phone'] = $_POST['phone'];


			//Call Contact class to set the values.
			$contact = new Contact($contactArray);

			//Prepration for the Campaign Default Data.
			$campaignDefaults = [];
			$campaignDefaults['from_name'] = 'Anu Nayyar';
			$campaignDefaults['from_email'] = 'anunayy@gmail.com';
			$campaignDefaults['subject'] = 'Create New List for MailChimp';
			$campaignDefaults['language'] = 'en';

			//Create CampaignDefaut object to set the values.
			$campaignDefaults = new CampaignDefaults($campaignDefaults);

			//Build a new transaction to create the data object
			$transaction = new Transaction();
			$transaction->setName($_POST['name'])
			            ->setContact($contact)
			            ->setPermissionReminder("You'\''re receiving this email because you signed up for updates about Anu'\''s newest hats.")
			            ->setCampaignDefaults($campaignDefaults)
			            ->setEmailTypeOption((bool)1);
	 
			//Create Object of MailChimp.
			$mailChimpObj = new MailChimp();
			//Call createList Function.
			$mailChimpListID = $mailChimpObj->createList($transaction);

			if($mailChimpListID) {
				echo "<div class='msgbox success'>New Mail list has successfully created with ".$mailChimpListID." list ID</div>";
			}
			echo "<br><a href='../index.php'>Back to Main Page</a>";
		}
	}