<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {
		$page_number = $this->getPage(); 
		$order = $this->checkSort();
		$result = $this->model->getTasks($page_number , $order);
		$vars = [
			'tasks' => $result['body'],
			'pagination' => $result['pagination'],
			'isAdmin' => $this->isAdmin(),
			'column_name' => $result['column_name'],
			'order_new' => $result['order_new'],
		];	
			
		if(!empty($order)){
			$this->view->give($vars);
		}else{				
			$this->view->render('Главная страница', $vars);
		}			 	
	}

	public function getPage(){ 
		if(isset($_GET['page'])){
			return $_GET['page'];
		}
		return 1;
	}

	public function checkSort(){
		$order=[];
		if(isset($_POST['column_name'])){
			$order['column_name']=$_POST['column_name'];
			$order['order']=$_POST['order'];
			return $order;
		}else{ 
			return $order;
		}		
	}

}