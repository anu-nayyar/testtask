<?php
	 
namespace MailChimp\Api;

use MailChimp\Validation\StringValidator;

/**
 	* Class Contact
	* Contact information displayed in campaign footers
 	* @package MailChimp\Api
  	* 
  	* @property string company
	* @property string address1
	* @property string address2
	* @property string city
	* @property string state
	* @property string zip
	* @property string country
	* @property string phone
*/

class Contact
{
	/**
    * Contact Company Name
    */
	public $company;
	/**
    * Contact Address1
    */
	public $address1;
	/**
    * Contact Address2
    */
	public $address2;
	/**
    * Contact City
    */
	public $city;
	/**
    * Contact State
    */
	public $state;
	/**
    * Contact Zipcode
    */
	public $zip;
	/**
    * Contact Country
    */
	public $country;
	/**
    * Contact Country
    */
	public $phone;
	

	/**
	* Default Constructor
	* Set Contact information displayed in campaign footers
	* @param Array $contact Array
 	* 
	*/
	public function __construct($contact)
	{
		$this->setCompany($contact['company']);
		$this->setAddress1($contact['address1']);
		$this->setAddress2($contact['address2']);
		$this->setCity($contact['city']);	
		$this->setstate($contact['state']);
		$this->setZip($contact['zip']);
		$this->setCountry($contact['country']);
		$this->setPhone($contact['phone']);		
	}	
	/**
	* The company name for the list.
 	*
	* @param string $company
	* 
	* @return $this
	*/
	protected function setCompany($company)
 	{
		$this->company = $company;
 		return $this;
	}	
	/**
 	* The company name for the list.
 	*
	* @return string
	*/
	protected function getCompany()
 	{
		return $this->company;
 	}
 	/**
	* The street address1 for the list contact.
	*
	* @param string $address1
	* 
	* @return $this
	*/
	protected function setAddress1($address1)
	{
		$this->address1 = $address1;
		return $this;
	}
	
	/**
	* The street address1 for the list contact.
	*
	* @return string
	*/
	protected function getAddress1()
	{
		return $this->address1;
	}
	/**
	* The street address2 for the list contact.
	*
	* @param string $address2
	* 
	* @return $this
	*/
	protected function setAddress2($address2)
	{
		$this->address2 = $address2;
		return $this;
	}
	
	/**
	* The street address2 for the list contact.
	*
	* @return string
	*/
	protected function getAddress2()
	{
		return $this->address2;
	}
	/**
	* The city for the list contact.
	*
	* @param string $city
	* 
	* @return $this
	*/
	protected function setCity($city)
	{
		$this->city = $city;
		return $this;
	}
	
	/**
	* The city for the list contact.
	*
	* @return string
	*/
	protected function getCity()
	{
		return $this->city;
	}
	/**
	* The state for the list contact.
	*
	* @param string $state
	* 
	* @return $this
	*/
	protected function setState($state)
	{
		$this->state = $state;
		return $this;
	}
	/**
	* The state for the list contact.
	*
	* @return string
	*/
	protected function getState()
	{
		return $this->state;
	}
	/**
	* The postal or zip code for the list contact.
	*
	* @param string $zip
	* 
	* @return $this
	*/
	protected function setZip($zip)
	{
		$this->zip = $zip;
		return $this;
	}
	/**
	* The postal or zip code for the list contact.
	*
	* @return string
	*/
	protected function getZip()
	{
		return $this->zip;
	}
	/**
	* A two-character ISO3166 country code. Defaults to US if invalid.
	*
	* @param string $country
	* 
	* @return $this
	*/
	protected function setCountry($country)
	{
		$this->country = $country;
		return $this;
	}
	/**
	* A two-character ISO3166 country code. Defaults to US if invalid.
	*	*
	* @return string
	*/
	protected function getCountry()
	{
		return $this->country;
	}
	/**
	* The phone number for the list contact.
	*
	* @param string $phone
	* 
	* @return $this
	*/
	protected function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}
	/**
	* The phone number for the list contact.
	*	*
	* @return string
	*/
	protected function getPhone()
	{
		return $this->phone;
	}
} 