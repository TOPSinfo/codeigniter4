
<?php echo view('/includes/Header');  ?>


    <div class="container-fluid p-4">
        <div class="row justify-content-md-center">

            <div class="col-12 col-md-8 col-lg-6 col-xl-4 m-auto">
                
                <div class="mt-3 mb-4"><h3>Edit Profile</h3></div>
                
                <form action="<?php echo base_url(); ?>/edit_profile" method="post"  enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" placeholder="Name"  class="form-control" value="<?= $user_data['name']; ?>" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('name')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('name'); ?>
                            </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-4">
                        <label>Contact number <span class="text-danger">*</span></label>
                        <input id="contact_number" type="tel" name="contact_number" placeholder="Contact Number"  class="form-control" value="<?= $user_data['contact_no']; ?>" >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('contact_number')) {?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('contact_number'); ?>
                            </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" placeholder="Username" class="form-control" value="<?= $user_data['username']; ?>">
                        <input type="hidden" name="uid"  class="form-control" value="<?= $user_data['id']; ?>" readonly>
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('username')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('username'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-4">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" placeholder="Email"  class="form-control" value="<?= $user_data['email']; ?>"  >
                        <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-4">
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
                        <!--  <button type="submit" class="btn btn-success">Change Password</button> -->
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>     
                </form>
            </div>
              
        </div>
    </div>
  <script>
   // pattern="^(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}$"
   let telEl = document.querySelector('#contact_number')

telEl.addEventListener('keyup', (e) => {
  let val = e.target.value;
 /* e.target.value = val
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
   /* phone = val.replace(/\D/g, '');
const match = phone.match(/^(\d{1,3})(\d{0,3})(\d{0,4})(\d{0,4})$/);
if (match) {
    //phone = `(${match[1]}${match[2] ? ') ' : ''}${match[2]}${match[3] ? '-' : ''}${match[3]}${match[4] ? ' x' : ''}${match[4]}`;
     phone = `(${match[1]}${match[2] ? ') ' : ''}${match[2]}${match[3] ? '-' : ''}${match[3]}${match[4] ? ' x' : ''}${match[4]}`;
}
e.target.value = phone*/

phone = val.replace(/[^\d]/g, "");

    //check if number length equals to 10
    if (phone.length == 10) {
        //reformat and return phone number
        e.target.value = phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
    }

})
 </script>
<?php echo view('/includes/Footer');  ?>