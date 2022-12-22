<?php echo view('/includes/Header');  ?>
  

  
   <div class="container-fluid p-4">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 m-auto">
            
                <div class="mt-3 mb-4"><h3>Change Password</h3></div>
               
               
                <form action="<?php echo base_url(); ?>/change_password" method="post">
                    <div class="form-group mb-4">
                        <label>Current Password <span class="text-danger">*</span></label>
                        <input type="password" name="opwd" placeholder="Current Password"  class="form-control" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('opwd')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('opwd'); ?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-4">
                        <label>New Password <span class="text-danger">*</span></label>
                        <input type="password" name="npwd" placeholder="New Password"  class="form-control" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('npwd')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('npwd'); ?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-4">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="cpwd" placeholder="Retype New Password"  class="form-control" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('cpwd')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('cpwd'); ?>
                            </div>
                        <?php }?>
                    </div>
                    
                    <div class="d-grid">
                        <!--  <button type="submit" class="btn btn-success">Change Password</button> -->
                        <input type="submit" value="Change Password" class="btn btn-primary">
                    </div>     
                </form>
            </div>
              
        </div>
    </div>

<?php echo view('/includes/Footer');  ?>