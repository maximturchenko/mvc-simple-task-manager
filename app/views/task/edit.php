<p>Главная страница</p>


<?php foreach ($tasks as $val): ?>
	<form action="/task/edit" method="post">
		<h3><?php echo $val['nameuser']; ?></h3>
		<p><?php echo $val['email']; ?></p> 

		<p><input type="text" id="text" name="text" value="<?php echo $val['texttask']; ?>">

		<p>
			<?php 
				if($val['status']==0){
					echo "Статус задачи: не выполнена";
				} else{
					echo "Статус задачи: выполнена";
				}
			?>
		</p>
		<p><input type="checkbox" id="status" name="status" value="YES" <?php if($val['status']==1){echo "checked";}?>>
			<label for name="status">		
				Статус выполнения
			</label>
		</p>
		<input id="id" name="id" type="hidden" value="<?php echo $val['id']; ?>">		
		<b><button type="submit" name="enter">Изменить</button></b>	
	</form>
	<hr>
<?php endforeach; ?> 
 
 
	