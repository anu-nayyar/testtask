<?php
	
namespace MailChimp\Api;

/**
 	* Class Transaction
	* This class will build data object for MailChimp API's
 	* @package MailChimp\Api
*/

class Transaction
{
	/**
	* List Name
	*
	* @param $name
 	* 
 	* @return $this
	*/
	public function setName($name)
 	{
		$this->name = $name;
		return $this;
	}
	/**
	*  List Name
	*
	* @return object
	*/
	public function getName()
 	{
		return $this->name;
 	}
 	/**
	* Contact details
	*
	* @param \MailChimp\Api\Contact $contact
 	* 
 	* @return $this
	*/
	public function setContact($contact)
 	{
		$this->contact = $contact;
		return $this;
	}
	/**
	* Contact details
	*
	* @return \MailChimp\Api\Contact
	*/
	public function getContact()
 	{
		return $this->contact;
 	}
 	/**
	* Permission Reminder
	*
	* @param permission_reminder
 	* 
 	* @return $this
	*/
	public function setPermissionReminder($permission_reminder)
 	{
		$this->permission_reminder = $permission_reminder;
		return $this;
	}
	/**
	* Contact Permission Reminder
	*
	* @return object
	*/
	public function getPermissionReminder()
 	{
		return $this->permission_reminder;
 	}
 	/**
	* Campaign Defaults
	*
	* @param campaign_defaults
 	* 
 	* @return $this
	*/
	public function setCampaignDefaults($campaign_defaults)
 	{
		$this->campaign_defaults = $campaign_defaults;
		return $this;
	}
	/**
	* Campaign Defaults
	*
	* @return object
	*/
	public function getCampaignDefaults()
 	{
		return $this->campaign_defaults;
 	}
 	/**
	* Email Type Option
	*
	* @param email_type_option
 	* 
 	* @return $this
	*/
	public function setEmailTypeOption($email_type_option)
 	{
		$this->email_type_option = $email_type_option;
		return $this;
	}
	/**
	* Email Type Option
	*
	* @return object
	*/
	public function getEmailTypeOption()
 	{
		return $this->email_type_option;
 	}
 	/**
	* Sender EmailAddress
	*
	* @param email_address
 	* 
 	* @return $this
	*/
	public function setEmailAddress($email_address)
 	{
		$this->email_address = $email_address;
		return $this;
	}
	/**
	* EmailAddress
	*
	* @return object
	*/
	public function getEmailAddress()
 	{
		return $this->email_address;
 	}
 	/**
	* Status
	*
	* @param status
 	* 
 	* @return $this
	*/
	public function setStatus($status)
 	{
		$this->status = $status;
		return $this;
	}
	/**
	* Status
	*
	* @return Object
	*/
	public function getStatus()
 	{
		return $this->status;
 	}
}