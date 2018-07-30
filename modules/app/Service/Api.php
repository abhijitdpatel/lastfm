<?php
namespace Abhijit\App\Service;

use Abhijit\Library\Model;
use Abhijit\App\Config;

class Api
{
	protected $apiMethod;
	protected $apiPath;
	protected $apiKey;
	protected $apiSignature;
	
	protected function __construct($apiMethod)
    {
        $this->apiMethod= 	$apiMethod; 
		$this->apiPath  = 	Config::LASTFM_API_URL;
		$this->apiKey	=	Config::LASTFM_API_KEY;
		$this->apiSignature	=	Config::LASTFM_API_SIGNATURE;
    }

    /**
     * Call API and get JSON
     *
     * @return curl JSON
     */
    protected function callApi($params = array())
    {
		if(!(isset($this->apiKey) && $this->apiKey) || !(isset($this->apiSignature) && $this->apiSignature) )
			return "Invalid API Key and Signature.";
		if(isset($this->apiMethod)&& $this->apiMethod!='')
		{
			$url = $this->apiPath.'?method='.$this->apiMethod;
			$url .= '&api_key='.$this->apiKey;
			$paramsurl = '';
			foreach($params as $key=>$value)
			{
				$paramsurl .= '&'.$key.'='.$value;
			}
			$url .= '&format=json';
			$stamp = "";
			
			$parameters = array(
				CURLOPT_HTTPHEADER  => array('X-PCK: '. $this->apiKey, 'X-Stamp: '. $stamp, 'X-Signature: '. $this->apiSignature),
				CURLOPT_RETURNTRANSFER  =>true,
				//CURLOPT_VERBOSE     => 1
			);
			$parameters[CURLOPT_POST]= 1;
			$parameters[CURLOPT_POSTFIELDS] = $paramsurl;
			
			$ch = curl_init($url);
			curl_setopt_array($ch, $parameters);
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}
		return "Invalid API method passed.";
    }
}
