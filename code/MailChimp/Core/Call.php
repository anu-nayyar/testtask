<?php

namespace MailChimp\Core;

require_once(dirname(__FILE__) . "/../Exception/MailChimpConfigurationException.php");
require_once(dirname(__FILE__) . '/MailChimpConfig.php');

use MailChimp\Exception\MailChimpConfigurationException;	
use MailChimp\Core\MailChimpConfig;	


/**
* Class Call
* Make all API calls and send back the response
* Includes API execute function
*
* @package MailChimp\Core
*/

class Call
{   

    /**
    * MailChimp Username
    */    
    protected $username;
    /**
    * MailChimp Key
    */
	protected $key;
	/**
    * MailChimp API Config
    */
	protected $apiConfigObj;
	/**
	* Default Constructor
	*
	* 
	* Assign values for Username and API Key
	* @param Array $apiParams 
 	* 
	*/
	public function __construct( $input = NULL )
	{
		//Set Config Parameters.
		$this->apiConfigObj = new MailChimpConfig( $input );
		$this->username = $this->apiConfigObj->getMailChimpUser();
		$this->key = $this->apiConfigObj->getMailChimpKey();
	}

	/**
	* Function to call Create List API
	* @return Array Api Response
 	* 
	*/
	public function callCreateListApi($listObject)
	{
		try 
		{
			$curlURL = $this->apiConfigObj->getListUrl();
			$curlResponse = $this->execute($curlURL,'POST',$listObject);

			//Check if errors are returned from API Calls
			$apiResponse = $this->handleApiErros($curlResponse);

			if($apiResponse) {
				return $curlResponse;
			} else {
				return null;
			}
			
		}
		catch (Exception $e) {
			throw new MailChimpConfigurationException("Something went wrong in preparing for Create List API Call.");

		}
	}

	/**
	* Function to call Add New Member API
	* @return Array Api Response
 	* 
	*/
	public function callAddMemberApi($listObject,$listId)
	{
		try 
		{
			$curlURL = $this->apiConfigObj->getListUrl();
			$curlResponse = $this->execute($curlURL,'POST',$listObject,$listId);

			//Check if errors are returned from API Calls
			$apiResponse = $this->handleApiErros($curlResponse);
			
			if($apiResponse) {
				return $curlResponse;
			} else {
				return null;
			}
			
		}
		catch (Exception $e) {
			throw new MailChimpConfigurationException("Something went wrong in preparing for Create List API Call.");

		}
	}
	/**
	* Function to call update Member API
	* @return Array Api Response
 	* 
	*/
	public function callUpdateMemberApi($listObject,$listId,$memberId)
	{
		try 
		{
			$curlURL = $this->apiConfigObj->getListUrl();
			$curlResponse = $this->execute($curlURL,'PATCH',$listObject,$listId,$memberId);

			//Check if errors are returned from API Calls
			$apiResponse = $this->handleApiErros($curlResponse);
			
			if($apiResponse) {
				return $curlResponse;
			} else {
				return null;
			}
			
		}
		catch (Exception $e) {
			throw new MailChimpConfigurationException("Something went wrong in preparing for Create List API Call.");

		}
	}
	/**
	* Function to call delete Member API
	* @return Array Api Response
 	* 
	*/
	public function callDeleteMemberApi($listObject,$listId,$memberId)
	{
		try 
		{
			$curlURL = $this->apiConfigObj->getListUrl();
			$curlResponse = $this->execute($curlURL,'DELETE',$listObject,$listId,$memberId);

			//Check if errors are returned from API Calls
			if(isset($curlResponse->status)) {
				$apiResponse = $this->handleApiErros($curlResponse);
			} else {
				return true;
			}
		}
		catch (Exception $e) {
			throw new MailChimpConfigurationException("Something went wrong in preparing for Create List API Call.");

		}
	}
	/**
	* Function to call delete List API
	* @return Array Api Response
 	* 
	*/
	public function callDeleteListApi($listObject,$listId)
	{
		try 
		{
			$curlURL = $this->apiConfigObj->getListUrl();
			$curlResponse = $this->execute($curlURL,'DELETE',$listObject,$listId);

			//Check if errors are returned from API Calls
			if(isset($curlResponse->status)) {
				$apiResponse = $this->handleApiErros($curlResponse);
			} else {
				return true;
			}
		}
		catch (Exception $e) {
			throw new MailChimpConfigurationException("Something went wrong in preparing for Create List API Call.");

		}
	}

	/**
	* Execute API Request
	* @param string $curlURL
	* @param string $curlMethod
	* @param Object $dataObject
	* @param String $listId
	* @param String $memberId
	* @throws MailChimpConfigurationException
	*
	* @return array
 	*/

	Protected function execute($curlURL,$curlMethod,$dataObject ='',$listId ='',$memberId ='')
	{

		//Check if CURL module exists. 
		if (!function_exists("curl_init")) {
 			throw new MailChimpConfigurationException("Curl module is not available on this system");
 		}
 		try {
			//Curl Implementation

			// create a new cURL resource
			$ch = curl_init();

			//Call fucntion to create CURL Headers

			$curlHeaders = $this->createHeaders();

			//Call CURL URL
			//Form CURL URL for Add new member
			if($listId != '' && $curlMethod != 'DELETE')
			{
				$curlURL = $curlURL.'/'.$listId.'/members';
			} else if($listId != '' && $curlMethod == 'DELETE') //For List Delete Function
			{
				$curlURL = $curlURL.'/'.$listId;
			}
			//Form CURL URL for update new member
			if($memberId != '')
			{
				$curlURL = $curlURL.'/'.$memberId;
			}
			curl_setopt($ch, CURLOPT_URL, $curlURL);
			curl_setopt($ch, CURLOPT_USERPWD, $this->username.':'.$this->key);
			curl_setopt($ch, CURLOPT_TIMEOUT,80); // Set timeout to 80s			
			curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders); //Pass CURL HEADERS
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //Do not output response on screen
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $curlMethod);  
			if($dataObject != ''){
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataObject, JSON_UNESCAPED_SLASHES));   
			}
			
			// grab URL and pass it to the browser
			$curlResponse = curl_exec($ch);
			$curlResponse = json_decode($curlResponse);

			if(empty($curlResponse) && $curlMethod != 'DELETE') {
				throw new MailChimpConfigurationException("Invalid Response from MailChimp API");
			}
			
			// close cURL resource, and free up system resources
			curl_close($ch);

			return $curlResponse;
		}
		catch (Exception $e) {
			throw new MailChimpConfigurationException("Something went wrong in MailChimp API Connection");

		}

	}

	/**
	* Create CURL Headers
	* @throws MailChimpConfigurationException
	*
	* @return array
 	*/

 	Private function createHeaders($customHeaders = "")
 	{
 		$headers = array(
    			'Content-Type:application/json',
    			'User-Agent: MailChimp/PHP 7.1.2'
		);
		return $headers;
 	}

 	/**
	* Handle API Error Responses
	* @throws MailChimpConfigurationException
	*
	* @return array
 	*/

 	Private function handleApiErros($curlResponse)
 	{
 		//Handle if error object is there in API Response.
 		if(isset($curlResponse->errors)) {
 			$this->displayApiErros($curlResponse);
 			return false;
		} else if(!isset($curlResponse->id)) { //Error Handling based on the status.
 			$this->displayApiErros($curlResponse);
 			return false;
 		} else {
 			return true;
 		}
 	}
 	//Display API Responses on Front End.
 	Private function displayApiErros($curlResponse)
 	{
 		switch ($curlResponse->status)
      		{
           		 case '401':
          				echo "<div class='msgbox error'>API Response is - Unauthorized Error Code: ".$curlResponse->status."----".$curlResponse->title."--Verify API Key</div>";
           			break;
           		 case '404':
          				echo "<div class='msgbox error'>API Response is - Error Code: ".$curlResponse->status."----".$curlResponse->title."--Verify provided List or Member ID</div>";
           			break;
           		case '400':
          				echo "<div class='msgbox error'>API Response is - Error Code: ".$curlResponse->status."----".$curlResponse->title."--Bad Request. Your request can not be proccessed</div>";
           			break;
           		case '403':
          				echo "<div class='msgbox error'>API Response is - Error Code: ".$curlResponse->status."----".$curlResponse->title."--Forbidden. Please check if your MailChimp account is active</div>";
           			break;
           		case '405':
          				echo "<div class='msgbox error'>API Response is - Error Code: ".$curlResponse->status."----".$curlResponse->title."--Method Not Allowed. Please check the requested method and resource</div>";
           			break;
           		case '429':
          				echo "<div class='msgbox error'>API Response is - Error Code: ".$curlResponse->status."----".$curlResponse->title."-- . Too many concurrent requests</div>";
           			break;
           		default:
           			echo "API Response is - Error Code: ".$curlResponse->status."----".$curlResponse->title;
           			break;
           }
 	}

}