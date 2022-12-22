<?php echo view('/Home/includes/HeaderHome');  ?>
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-6">
                                <div class=" d-md-flex">
                                    
                                    <div class="login-wrap w-100 p-4 p-lg-5">
                                        <div class="d-flex">
                                            <div class="w-100">
                                                <h3 class="mb-4">Reset Password </h3>
                                            </div>
                                            
                                        </div>
                                         
                    <?php if(session()->getTempdata('error')):?>
                    <div class="alert alert-danger">
                        <?= session()->getTempdata('error') ?>
                    </div>
                    <?php endif;?>
                    <?php if(session()->getTempdata('success')):?>
                    <div class="alert alert-success">
                        <?= session()->getTempdata('success') ?>
                    </div>
                    <?php endif;?>
                                        <form lassclass="signin-form" action="<?php echo base_url().'/reset_password/'.$token ?>" method="post">
                                            <div class="form-group mb-4">
                                                <label class="label" for="name">New Password <span class="text-danger">*</span></label>
                                                <input type="password" name="npwd" placeholder="New Password"  class="form-control" >
                                               <!-- Error -->
                                                <?php if(isset($validation) && $validation->getError('npwd')) {?>
                                                    <div class='alert alert-danger mt-2'>
                                                        <?= $error = $validation->getError('npwd'); ?>
                                                    </div>
                                                <?php }?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" class="form-control btn btn-primary submit px-3">Change Password</button>
                                            </div>
                                            <div class=" text-md-right text-end mt-2">
                                                    <a href="<?php echo base_url(); ?> " >Back to Login </a>
                                                </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php echo view('/Home/includes/FooterHome');  ?>