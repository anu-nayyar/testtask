<?php

namespace MailChimp\Validation;

/**
  * Class StringValidator
  *
  * @package MailChimp\Validation
*/
class StringValidator
{
	/**
	* Helper method for validating address fields
	*
	* @param mixed $argument
	* @param string|null $argumentName
	* @return bool
	*/
	public static function validate($key, $value = null)
	{		
		switch ($key)
      {
           		 case 'name':
           			if(empty($value)){
           				throw new \InvalidArgumentException("$key is a required field");
           			}
           			break;
           		 case 'company':
           			if(empty($value)){
           				throw new \InvalidArgumentException("$key is a required field");           				
           			}
           			break;
           		case 'address1':
           			if(empty($value)){
           				throw new \InvalidArgumentException("$key is a required field");   
           			}
           			break;
           		case 'city':
           			if(empty($value)){
           				throw new \InvalidArgumentException("$key is a required field"); 
           			}
           			break;
           		case 'state':
           			if(empty($value)){
           				throw new \InvalidArgumentException("$key is a required field"); 
           			}
                break;
              case 'zip':
                if(empty($value)){
                  throw new \InvalidArgumentException("Please provide valid email address"); 
                }
           			break;
              case 'country':
                if(empty($value)){
                  throw new \InvalidArgumentException("$key is a required field"); 
                }
                break;
              case 'id':
                if(empty($value)){
                  throw new \InvalidArgumentException("$key is a required field"); 
                }
                break;
              case 'email_address':
                if(empty($value)){
                  throw new \InvalidArgumentException("$key is a required field"); 
                }
                break;
           		default:
           			break;
           }
		return true;
	}
}