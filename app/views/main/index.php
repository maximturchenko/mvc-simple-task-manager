<p>Главная страница</p>

<?php  
	$array_name = [
		'nameuser' => 'имя пользователя',
		'email' => 'email',	
		'texttask' => 'текст задачи',
		'status' => 'статус',	
	]; 
?>

<div class="tasks">
	<table class="table table-bordered table-hover ">
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
</div> 

<?php if(isset($pagination)): ?> 
	<nav aria-label="Page navigation">
		<ul class="pagination">
			<?php if($pagination['prev']>=1): ?>			
				<li class="page-item">
					<a class="page-link" href="<?php echo "/index.php?page=".$pagination['prev']; ?>" aria-label="Previous" >
					<span aria-hidden="true">&laquo;</span>
						<span class="sr-only">Previous</span>
					</a>
				</li>
			<?php endif; ?>	

			<?php for($i=1 ; $i<$pagination['all']+1 ; $i++): ?>	
				<?php
					if($pagination['now']==$i){
						$class="active";
						$next=$i+1;  
					}else{
						$class="";  
					}
				?>
				<li class="page-item <?php echo $class;?>">
					<a class="page-link" href="<?php echo "/index.php?page=".$i;?>"><?php echo $i; ?></a>
					</li> 
			<?php endfor; ?>
			<?php if($pagination['all']>=2 && $pagination['now']<$pagination['all']): ?>			
				<li class="page-item">
					<a class="page-link" href="<?php echo "/index.php?page=".$next; ?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
					</a>


				</li>
			<?php endif; ?>	
 
		</ul>
	</nav> 
<?php endif; ?>  
