<?php echo view('/includes/Header');  ?>

    <div class="container-fluid p-4">
        
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 m-auto">
                <div class="mt-3 mb-4"><h3>Update Admin</h3></div>
                
                
              
                <form action="<?php echo base_url(); ?>/edit_admin/<?= $edit_user_data['id']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" placeholder="Name" value="<?= $edit_user_data['name']; ?>" class="form-control" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('name')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('name'); ?>
                        </div>
                        <?php }?>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Contact Number <span class="text-danger">*</span></label>
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
                    <div class="form-group mb-4">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" placeholder="Email"  class="form-control" value="<?= $edit_user_data['email']; ?>"  >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('email')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3">
                         <label>Company</label>
                        <input type="text" name="company" placeholder="Company" class="form-control" value="<?= $edit_user_data['company']; ?>" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('company')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('company'); ?>
                        </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                         <label>Billing Term </label>
                        <input type="text" name="billing_term" placeholder="Billing term" class="form-control" value="<?= $edit_user_data['billing_term']; ?>" >
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('billing_term')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('billing_term'); ?>
                        </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                         <label>Role</label>
                        <input type="text" name="role" placeholder="Role" class="form-control" value="<?= $edit_user_data['role']; ?>">
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('role')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('role'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-3" id="dynamic_domain_div">
                        <label>Domain(s)</label>
                        <?php 
                       
                        //echo $edit_user_data['domains'];die();
                        $d_domains=explode(",",$edit_user_data['domains']);

                        $i=1;
                        foreach($d_domains as $dom){
                            
                        ?>
                        <div id="row<?php echo $i;?>">
                            <input type="text" id="domains<?php echo $i;?>" name="domains[]" placeholder="Domain" class="form-control" value="<?= $dom; ?>">
                            <?php if($i>1){ ?>
                                <button type="button" name="remove" id="<?php echo $i;?>" class="btn btn-danger btn_remove">X</button>
                            <?php }?>
                        </div>
                        <?php $i++; } ?>
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
                    <div class="mb-3">
                        <div class="border rounded d-inline-block">
                     <?php if($edit_user_data['profile_pic'] != ''):?>
                   
                    <img src=' <?php echo getenv('ImageURL').'public/profile_pic/'.$edit_user_data['profile_pic']; ?>' height="60"> 
                <?php else: ?>
                     <img src='<?php echo getenv('ImageURL') ?>public/profile_pic/user_profile.png' height="60"> 
                <?php endif;?>
                </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
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
  var domain_count=  <?php echo count($d_domains); ?>;
var i=domain_count;
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