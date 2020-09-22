<?php if(!$isAdmin):?>
  <form action="javascript:void(0);" method="post">
    <div class="form-group">
      <label for="logintext">Логин </label> 
      <input type="text" id="logintext" class="form-control" name="login"> 
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
    </div> 
    <button type="submit" class="btn btn-primary login">Вход</button>
  </form>
<?php endif; ?>