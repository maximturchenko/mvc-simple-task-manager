<?php

namespace app\models;

use app\core\Model;

class Task extends Model {
	public function getTaskEdit() {		
		$result = $this->db->row('SELECT id,nameuser, email, texttask, status FROM tasks');
		return $result;		
	}
	public function addTasks($post) {	
		$params = [
			'nameuser' => htmlspecialchars($post['nameuser'], ENT_QUOTES), 
			'texttask' => htmlspecialchars($post['texttask'], ENT_QUOTES), 
			'email' => htmlspecialchars($post['email'], ENT_QUOTES),
			'status' => 0, 				
		]; 
		$response['errors']=[];
		$response['success']=[];
		if(empty($post['nameuser']) || empty($post['texttask']) || empty($post['email'])){
			$response['errors'][] = 'Поля обязательны для заполнения';
			echo json_encode($response);
			exit;			
		}

		if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {			 
			$response['errors'][] = 'E-mail адрес '.$post['email'].' указан неверно.';
			echo json_encode($response);
			exit;
		}
		 
		$result = $this->db->query('INSERT INTO tasks (nameuser, texttask, email,status) VALUES (:nameuser, :texttask, :email, :status) ', $params);
		$response['success'][] = 'Задача успешно добавлена';
		echo json_encode($response);
	}
	public function editTasks($params) { 
		$result = $this->db->query('UPDATE tasks SET texttask=:text, status=:status , editbyadmin=:editbyadmin where id=:id', $params);
		return $result;		
	}


	public function getText($params) {  
		$result = $this->db->row('SELECT texttask FROM tasks where id=:id', $params);
		return $result[0]["texttask"];
	} 


}