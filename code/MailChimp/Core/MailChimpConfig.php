<?php

namespace MailChimp\Core;

/**
    * Class MailChimpConfig
    * Placeholder for MailChimp API Settings.
    *
    * @package MailChimp\Core
*/

class MailChimpConfig
{
    /**
    * MailChimp Name
    */
    protected $mailChimpName;
    /**
    * MailChimp Version
    */
    protected $mailChimpVersion;
    /**
    * MailChimp Username
    */
    protected $username;
    /**
    * MailChimp API Key
    */
    protected $key;
    /**
    * MailChimp List URL
    */
    protected $listUrl;
    

    public function __construct( $input = NULL ) {

        if( empty($input) ) {
            $filename = '../config.ini';
            //Check if all parameters are set properly in config.ini
            $validateConfigResponse = $this->validateConfigFile($filename);

            //If Config.ini is valid and all values are set properly.
            if ($validateConfigResponse)
            {
                $ini_array = parse_ini_file($filename, true);
                $this->setConfigParams($ini_array);
            }
            else
            {
                echo "Please check if config.ini exists and all values are set properly.";
                exit;
            }  
        }
    }

    /*
    * Validate config.ini array and values
    * params config.ini file name $fileName
    * Returns boolean
    */
    protected function validateConfigFile($fileName)
    {
        //Check if config.ini file exists in the root directory
        if (!file_exists($fileName))
        {
            return false;
        }
        //Parse config.ini file to set configuration variables.
        $ini_array = parse_ini_file($fileName, true);
       
        //Check if Account Key exists
        if(!array_key_exists("Account",$ini_array))
        {
            return false;
        } 
        //Check if Merchant Id is blank
        if($ini_array['Account']['Username'] == '')
        {
            return false;
        }
        //Check if Merchant Secret is blank
        if($ini_array['Account']['Key'] == '')
        {
            return false;
        }
        //If all validations are correct, return true
        return true;
    }

    /**
    * Set MailChimp URL's based on the config file
    */
    protected function setConfigParams($configArray)
    {
        //Set API Username, key and MailChimp API Url
        $this->setMailChimpUser($configArray['Account']['Username']);
        $this->setMailChimpKey($configArray['Account']['Key']);
        $this->setListUrl($configArray['Account']['Url']);
    }

    /**
    * MailChimp Username
    *
    * @param string $username
    * 
    * @return $this
    */
    protected function setMailChimpUser($username)
    {
        $this->username = $username;
        return $this;
    }    
    /**
    * MailChimp Username
    *
    * @return string
    */
    public function getMailChimpUser()
    {
        return $this->username;
    }
    /**
    * MailChimp API Key
    *
    * @param string $key
    * 
    * @return $this
    */
    protected function setMailChimpKey($key)
    {
        $this->key = $key;
        return $this;
    }    
    /**
    * MailChimp API Key
    *
    * @return string
    */
    public function getMailChimpKey()
    {
        return $this->key;
    }  
    /**
    * MailChimp API URL
    *
    * @param string $listUrl
    * 
    * @return $this
    */
    protected function setListUrl($listUrl)
    {
        $this->listUrl = $listUrl;
        return $this;
    }    
    
    /**
    * MailChimp API URL
    *
    * @return string
    */
    public function getListUrl()
    {
        return $this->listUrl;
    }
}