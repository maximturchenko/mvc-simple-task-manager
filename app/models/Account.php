<?php

namespace app\models;

use app\core\Model;

class Account extends Model { 
	public function checkadmin($post) {	
		$response['success']=[];
		$response['errors']=[];
		if($post['login']=="admin" && $post['password']=='123'){
			$_SESSION['admin']=1;
			$response['success'][] = 'Вы успешно авторизовались';
			echo json_encode($response);	
			return true;
		}elseif(empty($post['login']) || empty($post['password'])){
			$response['errors'][] = 'Поля обязательны для заполнения';
			echo json_encode($response);			
		}else{
			$response['errors'][] = 'Неправильные реквизиты доступа';
			echo json_encode($response);
		}  		
	
	}

	public function outadmin() {	
		$_SESSION['admin']=0;
	}
}