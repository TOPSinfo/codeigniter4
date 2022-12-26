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
                        <input id="contact_number" type="tel" name="contact_no" placeholder="Contact Number" value="<?= $edit_user_data['contact_no']; ?>" class="form-control" maxlength="26">
                         <!-- Error -->
                        <?php if(isset($validation) && $validation->getError('contact_no')) {?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('contact_no'); ?>
                        </div>
                        <?php }?>
                    </div>
                     <div class="form-group mb-3">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" placeholder="Username" class="form-control" value="<?= $edit_user_data['username']; ?>" >
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