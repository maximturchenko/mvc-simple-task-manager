<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>	


	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">		
			<a class="btn btn-light" href="/" role="button">Главная</a>    
			<?php if(!$isAdmin):?> 
				<a class="btn btn-info" href="/account/login" role="button">Войти</a>  
			<?php endif;?>				
			<a class="btn btn-primary" href="/task/add" role="button">Добавить новую задачу</a> 			
			<?php if($isAdmin):?> 
				<a class="btn btn-dark" href="/task/edit" role="button">Редактировать задачи</a> 
			<?php endif;?>
			<?php if($isAdmin):?> 
				<a class="btn btn-secondary" href="/account/logout" role="button">Выйти</a> 
			<?php endif;?>
		</nav>
	</div>


	<div class="container">
		<?php echo $content; ?>
	</div>

	<script src="/public/js/jquery-3.4.1.min.js"></script>	
	<script src="https://use.fontawesome.com/6d4a84515a.js"></script>
	<script async src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
	<script>
		$(document).ready(function(){  
			$(document).on('click','.column_sort',function(){
				var column_name = $(this).attr('id');
				var order = $(this).data('order');
				var arrow = '';
				if(order == 'desc'){
				//	arrow = "&nbsp; <i class='fa fa-sort-desc' aria-hidden='true'></i>";
				}else{
				//	arrow = "&nbsp; <i class='fa fa-sort-asc' aria-hidden='true'></i>";
				}
				$.ajax({ 
					method:"POST",
					data:{column_name:column_name, order:order},
					success:function(data){
						$('.tasks').html(data);  
						$('#'+column_name).append(arrow);
					}
				})
			});

			$(document).on('click','.login',function(){	 
				 var login = $("input[name='login']").val();
				 var pas = $("input[name='password']").val();
				 $.ajax({
					method: "POST",
					data:{login:login,password:pas},
					success:function(data){
						$( ".alert" ).remove();
						var res = JSON.parse(data);
						if(res.errors.length > 0){							
							$( "form" ).before(function(i){
								var text = res.errors;									
								return "<div class='alert alert-danger' role='alert'>"+text+"</div>";
							} );	
						}else if(res.success.length > 0){
							$( "form" ).before(function(i){
								var text = res.success;									
								return "<div class='alert alert-success' role='alert'>"+text+"</div>";
							} ); 
							window.setTimeout("window.location.replace('/')" , 700);							 
						}
						
					},
				 }); 
			}); 

			$(document).on('click','.add_new_task button',function(){	 
				 var nameuser = $("input[name='nameuser']").val();
				 var email = $("input[name='email']").val();
				 var texttask = $("input[name='texttask']").val(); 
				 
				 $.ajax({
					method: "POST",
					data:{nameuser:nameuser,email:email,texttask:texttask},
					success:function(data){
						$( ".alert" ).remove();
						var res = JSON.parse(data);
						if(res.errors.length > 0){							
							$( "form" ).before(function(i){
								var text = res.errors;									
								return "<div class='alert alert-danger' role='alert'>"+text+"</div>";
							} );	
						}else if(res.success.length > 0){
							$( "form" ).before(function(i){
								var text = res.success;									
								return "<div class='alert alert-success' role='alert'>"+text+"</div>";
							} ); 
						}
						
					},
				 }); 
			}); 

			
		});
	</script>
</body>
</html>