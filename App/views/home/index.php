<?php $this->setSiteTitle('Home'); ?>


<?php $this->start('head'); ?>

<?php $this->end(); ?>
<?php $this->start('body'); ?>

<h1 class="text-center red">Hello From My First Bixter </h1>
<p class="text-center"> <?=print_r($_SESSION)?></p>
<?php if (CURRENT_USER_SESSION_NAME): ?>
  


<a class="btn btn-primary" href="<?=PROOT?>register/logout">Logout</a>
<?php endif; ?>
<?php $this->end(); ?>
