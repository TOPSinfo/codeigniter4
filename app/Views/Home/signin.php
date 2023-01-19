<?php echo view('/Home/includes/HeaderHome');  ?>
   
                        <div class="row justify-content-center">
                            <div class="col-md-12 col-lg-10">
                                <div class="wrap d-md-flex">
                                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last auth-sidebar">
                                        <div class="text w-100">
                                            <h2>Welcome to</h2>
                                            <h4>Admin Panel</h4>
                                        </div>
                                    </div>
                                    <div class="login-wrap p-4 p-lg-5">
                                        <div class="d-flex">
                                            <div class="w-100">
                                                <h3 class="mb-4">Sign In</h3>
                                            </div>
                                            <!-- <div class="w-100">
                                                <p class="social-media d-flex justify-content-end">
                                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                                </p>
                                            </div> -->
                                        </div>
                                        
                                <?php if(session()->getFlashdata('msg')):?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('msg') ?>
                                </div>
                                <?php endif;?>
                                        <form classclass="signin-form" action="<?php echo base_url(); ?>/signin" method="post">
                                            <div class="form-group mb-3">
                                                <label class="label" for="name">Email / Username<span class="text-danger">*</span></label>
                                                <input type="text" name="email" placeholder="Email/Username"  class="form-control" 
                                                value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" 
                                                >
                                                <!-- Error -->
                                                <?php if(isset($validation) && $validation->getError('email')) {?>
                                                    <div class='alert alert-danger mt-2'>
                                                      <?= $error = $validation->getError('email'); ?>
                                                    </div>
                                                <?php }?>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="label" for="password">Password <span class="text-danger">*</span></label>
                                                <input type="password" name="password" placeholder="Password" class="form-control" 
                                                value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"
                                                >
                                                <!-- Error -->
                                                <?php if(isset($validation) && $validation->getError('password')) {?>
                                                    <div class='alert alert-danger mt-2'>
                                                      <?= $error = $validation->getError('password'); ?>
                                                    </div>
                                                <?php }?>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                                            </div>
                                            <div class="form-group d-md-flex mt-3">
                                                <div class="row w-100 m-auto">
                                                    <div class="col-auto text-left ps-0">
                                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me

                                                            <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> /> 

                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col ps-0 pe-0 text-md-right text-end">
                                                        <a href="<?php echo base_url('forgot_password'); ?> " class="fs-14px" >Forgot password </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
              
<?php echo view('/Home/includes/FooterHome');  ?>