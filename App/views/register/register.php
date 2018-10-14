<?php $this->start('head') ?>


<?php $this->end() ?>
<?php $this->setSiteTitle('BIXTER | Registeration') ?>

<?php $this->start('body') ?>

<div class="col-md-6 col-md-offset-3 well">
<form class="form" action="<?=PROOT?>register/register" method="post">
  <div class="bg-danger"><?=$this->displayErrors?></div>
  <h3 class="text-center">Sign Up</h3>
  <div class="form-group">
  <label for="username">Username</label>
  <input type="text" name="username"  id="username" class="form-control" value="" >
  </div>
  <div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="password"  id="password" class="form-control" value="" >
  </div>
  <div class="form-group">
  <label for="password">Password Again</label>
  <input type="password" name="password_Again"  id="password_Again" placeholder="Insert The Passwor Again Here" class="form-control" value="" >
  </div>
  <div class="form-group">
    <label for="Email">Email</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Mail@mail.com" value="" >
  </div>
  <div class="form-group">
    <label for="First_name">First Name</label>
    <input type="text" name="First_name" class="form-control" placeholder="Aboodma" value="" >
  </div>
  <div class="form-group">
    <label for="Last_Name">Last Name</label>
    <input type="text" name="Last_Name" class="form-control" placeholder="Mardini" value="" >
  </div>

  <div class="form-group">
    <input type="submit" name="" class="btn btn-large btn-primary" value="Register">
  </div>
  <div class="text-right">
    <a href="<?=PROOT?>register/login" class="btn btn-primary"> Login</a>
  </div>
</form>
</div>
<?php $this->end() ?>
