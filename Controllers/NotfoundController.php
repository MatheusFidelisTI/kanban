<?php
namespace Controllers;

use \Core\Controller;

class NotfoundController extends Controller {


	public function __construct(){
		
	}

	public function index() {
		$dados = array();
        
        $this->loadView('home', $dados);
	}

}