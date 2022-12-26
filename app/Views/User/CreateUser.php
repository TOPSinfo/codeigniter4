<?php echo view('/includes/Header');  ?>

    <div class="container mt-4">
        
        <div class="row justify-content-md-center">
             <div class="col-12 col-md-8 col-lg-6 col-xl-4 m-auto mb-5">
                <div class="mt-3 mb-4"><h3>Create User</h3></div>
               
                
               
                <form action="<?php echo base_url(); ?>/create_user" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                         <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" placeholder="Name" value="<?= set_value('name') ?>" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('name')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('name'); ?>
                        </div>
                        <?php }?>
                    </div>
                      <div class="form-group mb-3">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" placeholder="Username" class="form-control" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('username')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('username'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Contact Number <span class="text-danger">*</span></label>
                        <input id="contact_number" type="tel" name="contact_no" placeholder="Contact Number" value="<?= set_value('contact_no') ?>" class="form-control" maxlength="26">
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('contact_no')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('contact_no'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="npwd" placeholder="Password" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('npwd')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('npwd'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="cpwd" placeholder="Confirm Password" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('cpwd')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('cpwd'); ?>
                        </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                        <label>Profile Pic</label>
                        <input type="file" name="profile_pic"  class="form-control"  >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('profile_pic')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('profile_pic'); ?>
                        </div>
                        <?php }?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php echo view('/includes/Footer');  ?>
<script type="text/javascript">
    $('#contact_number')

    .keydown(function (e) {
        var key = e.which || e.charCode || e.keyCode || 0;
        $phone = $(this);

    // Don't let them remove the starting '('
    if ($phone.val().length === 1 && (key === 8 || key === 46)) {
            $phone.val('('); 
      return false;
        } 
    // Reset if they highlight and type over first char.
    else if ($phone.val().charAt(0) !== '(') {
            $phone.val('('+String.fromCharCode(e.keyCode)+''); 
        }

        // Auto-format- do not expose the mask as the user begins to type
        if (key !== 8 && key !== 9) {
            if ($phone.val().length === 4) {
                $phone.val($phone.val() + ')');
            }
            if ($phone.val().length === 5) {
                $phone.val($phone.val() + ' ');
            }           
            if ($phone.val().length === 9) {
                $phone.val($phone.val() + '-');
            }
      if ($phone.val().length === 14) {
                $phone.val($phone.val() + ' ext. ');
            }
      
        }

        // Allow numeric (and tab, backspace, delete) keys only
        return (key == 8 || 
                key == 9 ||
                key == 46 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105)); 
    })
    
    .bind('focus click', function () {
        $phone = $(this);
        
        if ($phone.val().length === 0) {
            $phone.val('(');
        }
        else {
            var val = $phone.val();
            $phone.val('').val(val); // Ensure cursor remains at the end
        }
    })
    
    .blur(function () {
        $phone = $(this);
        
        if ($phone.val() === '(') {
            $phone.val('');
        }
    });
</script>