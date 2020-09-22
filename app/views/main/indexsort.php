
<?php  
	$array_name = [
		'nameuser' => 'имя пользователя',
		'email' => 'email',	
		'texttask' => 'текст задачи',
		'status' => 'статус',	
	]; 
?>
<table class="table table-bordered table-hover">
	<thead> 
	<tr> 
		<?php foreach ($array_name as $key => $column): ?> 			
			<?php 
				if($key==$column_name){
					$sort = $order_new;
				}else{
					$sort = "desc";
				}		
			?>
			<th scope="col"><a class="column_sort" id="<?php echo $key; ?>" data-order="<?php echo $sort; ?>" href="#"> <?php echo $column; ?></a></th>		
		<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tasks as $val): ?> 
			<tr>
				<th scope="row"><?php echo $val['nameuser']; ?></th>
				<td><?php echo $val['email']; ?></td>
				<td><?php echo $val['texttask']; ?></td>
				<td>
					<?php 
						if($val['status']==1){
							$text = "Выполнено";
						}else{
							$text = "Не выполнена";
						}
						if($val['editbyadmin']==1){
							$text = $text.", "."Отредактировано администратором";
						} 
						echo $text; 
					?>
				</td>
			</tr>
		<?php endforeach; ?> 
	</tbody>
</table>

