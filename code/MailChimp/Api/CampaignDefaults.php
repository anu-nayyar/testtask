<?php
	 
namespace MailChimp\Api;

use MailChimp\Validation\StringValidator;

/**
 	* Class CampaignDefaults
	* Contact information displayed in campaign footers
 	* @package MailChimp\Api
  	* 
  	* @property string from_name
	* @property string from_email
	* @property string subject
	* @property string language
*/

class CampaignDefaults
{
	/**
    * Sender From Nane
    */
	public $from_name;
	/**
    * Sender From Email
    */
	public $from_email;
	/**
    * Campaign Subject
    */
	public $subject;
	/**
    * Campaign Language
    */
	public $language;
	
	

	/**
	* Default Constructor
	* Default values for campaigns created for this list.
	* @param Array $contact Array
 	* 
	*/
	public function __construct($campaignDefaults)
	{
		$this->setFromName($campaignDefaults['from_name']);
		$this->setFromEmail($campaignDefaults['from_email']);
		$this->setSubject($campaignDefaults['subject']);
		$this->setLanguage($campaignDefaults['language']);	
		
	}	
	/**
	* The default from name for campaigns sent to this list.
 	*
	* @param string $from_name
	* 
	* @return $this
	*/
	protected function setFromName($from_name)
 	{
		$this->from_name = $from_name;
 		return $this;
	}	
	/**
 	* The default from name for campaigns sent to this list.
 	*
	* @return string
	*/
	protected function getFromName()
 	{
		return $this->from_name;
 	}
 	/**
	* The default from email for campaigns sent to this list.
 	*
	* @param string $from_email
	* 
	* @return $this
	*/
	protected function setFromEmail($from_email)
 	{
		$this->from_email = $from_email;
 		return $this;
	}	
	/**
 	* The default from email for campaigns sent to this list.
 	*
	* @return string
	*/
	protected function getFromEmail()
 	{
		return $this->from_email;
 	}
 	/**
	* The default subject line for campaigns sent to this list.
 	*
	* @param string $subject
	* 
	* @return $this
	*/
	protected function setSubject($subject)
 	{
		$this->subject = $subject;
 		return $this;
	}	
	/**
 	* The default subject line for campaigns sent to this list.
 	*
	* @return string
	*/
	protected function getSubject()
 	{
		return $this->subject;
 	}
 	/**
	* The default language for this lists’s forms.
 	*
	* @param string $language
	* 
	* @return $this
	*/
	protected function setLanguage($language)
 	{
		$this->language = $language;
 		return $this;
	}	
	/**
 	* The default language for this lists’s forms.
 	*
	* @return string
	*/
	protected function getLanguage()
 	{
		return $this->language;
 	}
} 