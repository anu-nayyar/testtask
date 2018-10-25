<?php

namespace MailChimp\Exception;
 
 /**
 	* Class MailChimpConfigurationException
 	*
 	* @package MailChimp\Exception
 */

class MailChimpConfigurationException extends \Exception
{

	/**
	* Default Constructor
	*
	* @param string|null $message
	* @param int  $code
	*/
	public function __construct($message = null, $code = 0)
	{
		parent::__construct($message, $code);
	}
}