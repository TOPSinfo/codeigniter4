<?php echo view('/includes/Header');  ?>

    <div class="container-fluid mt-1">
         
        
        <div class="row justify-content-md-center">
             <div class="col-12 col-md-8 col-lg-6 col-xl-4 m-auto mb-3">
                <div class="mt-3 mb-4"><h3>Create Admin</h3></div>
                
                
                
                <form action="<?php echo base_url(); ?>/create_admin" method="post" enctype="multipart/form-data">
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
                        <input id="contact_number" type="tel" name="contact_no" placeholder="Contact No" value="<?= set_value('contact_no') ?>" class="form-control" >
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
                         <label>Company</label>
                        <input type="text" name="company" placeholder="Company" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('company')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('company'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Billing Term </label>
                        <input type="text" name="billing_term" placeholder="Billing term" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('billing_term')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('billing_term'); ?>
                        </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                         <label>Role</label>
                        <input type="text" name="role" placeholder="Role" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('role')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('role'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3" id="dynamic_domain_div">
                        <label>Domain(s)</label>
                        <div id="row">
                            <input type="text" id="domains" name="domains[]" placeholder="Domain" class="form-control" >
                        </div>
                        <button type="button" name="add" id="add_domain" class="btn btn-success">Add More</button></td>

                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('domains')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('domains'); ?>
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
 <script>
$(document).ready(function(){
var i=1;
$('#add_domain').click(function(){
i++;
$('#dynamic_domain_div').append('<div id="row'+i+'"><input type="text" id="domains'+i+'"  name="domains[]" placeholder="Domain" class="form-control" ><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div>');
});
    
$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id"); 
$('#row'+button_id+'').remove();
});
});
</script>
