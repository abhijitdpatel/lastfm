<?php

namespace Abhijit\App\Controllers;

use Abhijit\Library\Controller\BaseController;
use Abhijit\Library\View\View;
use Abhijit\App\Service\ArtistInfo;


/**
 * Home controller
 *
 * PHP version 7.0
 */
class Artist extends BaseController
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
		//var_dump($_REQUEST['mbid']);
        $apiService = new ArtistInfo();
		$artistDetail = $apiService->getArtistInfo($_REQUEST['mbid']);
		$this->controllerData['artist']=$artistDetail;
		$this->controllerData['page_title']=$artistDetail['artist']['name'].' - Artist Info';
        return new View('Artist/index.phtml',$this->controllerData);
    }
}
