<?php echo view('/includes/Header');  ?>

    <div class="container-fluid p-4">

   <h2>Dashboard</h2>
        <?php if($user_name):?>
        <div class="alert alert-success">
            Hello <?= $user_name; ?>,
            Welcome to Training Layer
        </div>
        <?php endif;
        ?>
    </div>
   
<?php echo view('/includes/Footer');  ?>
 
   