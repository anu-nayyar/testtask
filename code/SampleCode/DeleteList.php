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
		<p><Strong>MailChimp List Deletion</Strong></p>
		<p>Please provide the List Id to be deleted</p>
		<form method="POST" enctype="application/x-www-form-urlencoded">
			<table>
				<tbody>
					<tr>
						<td>List ID</td>
						<td><input type="text" name="id" value="2963f30591"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Delete Existing List"></td>
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
			
			//Create Object of MailChimp.
			$mailChimpObj = new MailChimp();
			//Call delete list Function.
			$mailChimpListID = $mailChimpObj->deleteExistingList('',$_POST['id']);

			if($mailChimpListID) {
				echo "<div class='msgbox success'>List has been successfully deleted.</div>";
			}
			echo "<br><a href='../index.php'>Back to Main Page</a>";
		}
	}