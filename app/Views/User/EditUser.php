<?php echo view('/includes/Header');  ?>
    <div class="container mt-4">
        
        <div class="row justify-content-md-center">
           <div class="col-12 col-md-8 col-lg-6 col-xl-4 m-auto mb-5">
                <div class="mt-3 mb-4"><h3>Update User</h3></div>
                
                
               
                <form action="<?php echo base_url(); ?>/edit_user/<?= $edit_user_data['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" placeholder="Name" value="<?= $edit_user_data['name']; ?>" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('name')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('name'); ?>
                        </div>
                        <?php }?>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Contact Number<span class="text-danger">*</span></label>
                        <input id="contact_number" type="tel" name="contact_no" placeholder="Contact Number" value="<?= $edit_user_data['contact_no']; ?>" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('contact_no')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('contact_no'); ?>
                        </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" placeholder="Username" class="form-control" value="<?= $edit_user_data['username']; ?>" readonly>
                        <input type="hidden" name="uid"  class="form-control" value="<?= $edit_user_data['id']; ?>" readonly>
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('username')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('username'); ?>
                        </div>
                        <?php }?>
                    </div>

                     <div class="form-group mb-3">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" placeholder="Email"  class="form-control" value="<?= $edit_user_data['email']; ?>" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
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

                    <div class="d-inline-block mb-3">
                     <?php if($edit_user_data['profile_pic'] != ''):?>
                   
                    <img src=' <?php echo getenv('ImageURL').'public/profile_pic/'.$edit_user_data['profile_pic']; ?>' height="60"> 
                <?php else: ?>
                     <img src='<?php echo getenv('ImageURL') ?>public/profile_pic/user_profile.png' height="60"> 
                <?php endif;?>
                </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
   let telEl = document.querySelector('#contact_number')

telEl.addEventListener('keyup', (e) => {
  let val = e.target.value;
  /*e.target.value = val
    .replace(/\D/g, '')
    .replace(/(\d{1,4})(\d{1,3})?(\d{1,3})?/g, function(txt, f, s, t) {
      if (t) {
        return `(${f}) ${s}-${t}`
      } else if (s) {
        return `(${f}) ${s}`
      } else if (f) {
        return `(${f})`
      }
    });*/
    phone = val.replace(/[^\d]/g, "");

    //check if number length equals to 10
    if (phone.length == 10) {
        //reformat and return phone number
        e.target.value = phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
    }
})
 </script>
<?php echo view('/includes/Footer');  ?>