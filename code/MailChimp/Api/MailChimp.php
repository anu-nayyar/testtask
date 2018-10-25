<?php

namespace MailChimp\Api;

require_once(dirname(__FILE__) . "/../Core/Call.php");
require_once(dirname(__FILE__) . "/../Exception/MailChimpConfigurationException.php");

use MailChimp\Core\Call;
use MailChimp\Core\MailChimpConfig;
use MailChimp\Exception\MailChimpConfigurationException;	

/**
	* Class MailChimp
	*
	* Prepare for MailChimp API Calls
	* Include functions for List Functions
	* @package MailChimp\Core
*/

class MailChimp
{
	/**
	* Default Constructor
	*
	* 
	* Assign values for Call
	* Fetch values from MailChimp Config
	* @param Array $input 
 	* 
	*/
	protected $call;

	public function __construct( $input = NULL )
	{
		$this->call = new Call( $input );
	}

	/**
	* Call Create MailChimp API
	*
	* Throw Exception if error occurs
	* On success, return list ID.
 	* 
	*/
	public function createList($transaction)
	{
		$listApiResponse = $this->call->callCreateListApi($transaction);

		if(!$listApiResponse)
		{
		    return false;
		}else {
		    return $listApiResponse->id;
		}
	
	}
	/**
	* Call Add Member API
	*
	* Throw Exception if error occurs
	* On success Member creation, return Member subscription ID
 	* 
	*/
	public function addNewMember($transaction,$listId)
	{
		$addMemberApiResponse = $this->call->callAddMemberApi($transaction,$listId);

		if(!$addMemberApiResponse)
		{
		    return false;
		}else {
		    return $addMemberApiResponse->id;
		}
	
	}
	/**
	* Update Existing Member API
	*
	* Throw Exception if error occurs
	* On success Member updation, return Member subscription ID
 	* 
	*/
	public function updateExistingMember($transaction,$listId,$memberId)
	{
		$updateMemberApiResponse = $this->call->callUpdateMemberApi($transaction,$listId,$memberId);

		if(!$updateMemberApiResponse)
		{
		    return false;
		}else {
		    return $updateMemberApiResponse->id;
		}
	
	}
	/**
	* Delete Existing Member API
	*
	* Throw Exception if error occurs
	* On success Member updation, return Member subscription ID
 	* 
	*/
	public function deleteExistingMember($transaction,$listId,$memberId)
	{
		$deleteMemberApiResponse = $this->call->callDeleteMemberApi($transaction,$listId,$memberId);

		if(!$deleteMemberApiResponse)
		{
		    return false;
		}else {
		    return true;
		}
	
	}
	/**
	* Delete Existing List API
	*
	* Throw Exception if error occurs
	* On success List Deletion, return list ID
 	* 
	*/
	public function deleteExistingList($transaction,$listId)
	{
		//Call API execute function.
		$deleteListApiResponse = $this->call->callDeleteListApi($transaction,$listId);

		if(!$deleteListApiResponse)
		{
		    return false;
		}else {
		    return true;
		}
	
	}
}
?>
