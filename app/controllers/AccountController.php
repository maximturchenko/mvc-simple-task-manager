<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

	public function loginAction() {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->model->checkadmin($_POST); 
		}else{
			$vars = [
				'isAdmin' => $this->isAdmin(),
			];	 
			$this->view->render('Вход',$vars);
		}			
	} 

	public function logoutAction() {
		$this->model->outadmin();	 
		$this->view->redirect('/'); 
	}  
	
}