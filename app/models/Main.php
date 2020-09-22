<?php

namespace app\models;

use app\core\Model;

class Main extends Model {
	public $limitpage = 3;
	public $counttasks;
	public $nowpage;
	public $totalPages;   

	public function getTasks($nowpage,$order = null) { 
		
		$order_sql = '';
		$result = [];
		$result['order_new']='desc';
		$result['column_name']='';

		if(isset($_COOKIE['column_name']) && !isset($order['column_name'])){
			$this->setSqlwithSort($order_sql,$order_new,$result, $_COOKIE);	
		}
		if(isset($order['column_name'])){  
			$this->setSqlwithSort($order_sql,$order_new,$result,$order, true);					
		} 		

		$this->nowpage = $nowpage;
		$this->counttasks=$this->db->query("SELECT COUNT(*) as count FROM tasks")->fetchColumn(); 
		$this->totalPages = ceil($this->counttasks/ $this->limitpage);
		$start = ($this->nowpage * $this->limitpage)-$this->limitpage; 

		$sql  = "SELECT nameuser, email, texttask, status , editbyadmin FROM tasks ".$order_sql." LIMIT ".$this->limitpage." OFFSET ".$start;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result['body'] = $stmt->fetchAll(); 
		if($this->totalPages>1){
			$pagination = array(
				'now'=> $this->nowpage, 
				'prev'=> $this->nowpage-1,
				'all'=>$this->totalPages,
			); 
		}
		
		$result['pagination']=$pagination;
		return $result;
	} 

	public function changeOrder($ord){
		if($ord=='desc'){
			$order_new = 'asc';				
		}else{
			$order_new = 'desc';
		}
		return $order_new;
	}

	public function setSqlwithSort(&$order_sql,&$order_new,	&$result, $ord, $cookie=false){
		if($cookie){
			setcookie("column_name", $ord['column_name']);
			setcookie("order", $ord['order']);
		}
		$order_sql = "ORDER BY ".$ord['column_name']." ".$ord['order']; 
		$order_new = $this->changeOrder($ord['order']);			
		$result['order_new']=$order_new;
		$result['column_name']=$ord['column_name'];	
	}
}