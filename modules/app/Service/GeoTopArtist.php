<?php

namespace Abhijit\App\Service;

use Abhijit\App\Config;

class GeoTopArtist extends Api
{

	protected $apiMethod;
	protected $limit;
	
	public function __construct()
    {
        $this->apiMethod = 'geo.gettopartists';
        $this->limit     = Config::DEFAULT_LIMIT;  
		parent::__construct($this->apiMethod,$this->limit);
    }
    /**
     * Get all the Geo Top Artist and return as an array
     *
     * @return array
     */
    public function getGeoTopArtist($page=1,$country = Config::DEFAULT_COUNTRY)
    {
		$params = array('country'=>strtoupper($country),'limit'=>$this->limit,'page'=>$page);
        $result = $this->callApi($params);
		/**
		 *Decode Json in Array and return to Controller
		 */
		$artists = json_decode($result,true);
		return $artists;
    }
}
