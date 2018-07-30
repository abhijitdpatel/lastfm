<?php

namespace Abhijit\App\Controllers;

use Abhijit\Library\Controller\BaseController;
use Abhijit\Library\View\View;
use Abhijit\App\Service\GeoTopArtist;


/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends BaseController
{
    /**
     * Show the index page
     *
     * @return void
     */
	public function indexAction()
    {
		return new View('Home/index.phtml',$this->controllerData);
	}
    public function listAction()
    {
		$page = (isset($_REQUEST['p']) && $_REQUEST['p']>0)?$_REQUEST['p']:1;	
        $apiService = new GeoTopArtist();
		$topGeoArtist = $apiService->getGeoTopArtist($page);
		$this->controllerData['artists'] = $topGeoArtist;
        
		return new View('Home/view.phtml',$this->controllerData);
    }
	
}
