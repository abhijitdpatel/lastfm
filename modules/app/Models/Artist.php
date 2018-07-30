<?php

namespace Abhijit\App\Models;

use Abhijit\Library\Model\Model;
use Abhijit\App\Config;

/**
 * Example user model
 *
 */
class Artist extends Model
{
	protected $country;

	public function __construct()
	{
		$this->country = Config::DEFAULT_COUNTRY;
	}
    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function getCountry()
    {
		return $this->country;
    }
	
	public function setCountry($country=null)
	{
		
		if(isset($country) && $country!=null)
		{
			$this->country = $country;
		}
		elseif(isset($_SESSION['country']) && $_SESSION['country']!='')
		{
			$this->country = $_SESSION['country'];
		}
	}
}
