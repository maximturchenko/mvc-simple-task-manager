<?php

namespace app\controllers;

use app\core\Controller;

class TaskController extends Controller {

	public function addAction() {  
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->model->addTasks($_POST);
		}else{
			$vars = [ 
				'isAdmin' => $this->isAdmin(),
			];  
			$this->view->render('Добавление задачи',$vars);
		}  
	}

	public function editAction() {
		if($this->isAdmin()){		
			if($_POST){			
				if($_POST['status']=="YES"){
					$_POST['status']=1;
				}else{
					$_POST['status']=0;
				}
				$params = [
					'id' => $_POST['id'],
					'text' => htmlspecialchars($_POST['text']), 			
					'status' => $_POST['status'],
					'editbyadmin'=> 0,
				];

				$id=[
					'id' =>$_POST['id']
				];
				$text = $this->model->getText($id);

				if($params['text'] != $text){
					$params['editbyadmin'] = 1;
				}

				$result = $this->model->editTasks($params);
			}
			$result = $this->model->getTaskEdit();
			$vars = [
				'tasks' => $result,
				'isAdmin' => $this->isAdmin(),
			];  
			$this->view->render('Отметка выполненных', $vars);
		}else{
			$this->view->redirect('/account/login');  
		}	
	}

}