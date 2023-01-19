<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo getenv('ImageURL');?>assets/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Dashboard</title>
    </head>
    <body>
        <div id="wrapper" class="toggled-2">
            <header>
                <!-- navbar-header : Start-->
                <div class="cointainer-fluid">
                    <nav class="navbar navbar-default ">
                        
                        <div class="navbar-header fixed-brand">
                            <button type="button" class="navbar-toggle collapsed border-0 bg-white ms-2" data-toggle="collapse" id="menu-toggle">
                            <i class="fa fa-bars" aria-hidden="true"></i>

                            </button>
                        </div>
                             <div class="logo-sidebar logo-mobile">
                    <img src="<?php echo getenv('ImageURL');?>assets/images/logo-app.png" class="admin-full-logo">
                </div>
                        
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active">
                                    <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="dropdown me-4">
                            <a class=" dropdown-toggle d-flex align-items-center text-decoration-none text-dark pe-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if($user_data['profile_pic'] != ''):?>
                                
                                <img class="avtar-pics" src=' <?php echo getenv('ImageURL').'profile_pic/'.$user_data['profile_pic']; ?>' height="60">
                                <?php else: ?>
                                <img class="avtar-pics" src='<?php echo getenv('ImageURL') ?>profile_pic/user_profile.png' height="60">
                                <?php endif;?>
                                <span class="mx-1 fs-14px m-w-100px text-truncate"><?php echo ucfirst($user_data['name']);?></span>
                            </a>
                            
                            
                            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>/edit_profile">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>/change_password">
                                        Change Password
                                    </a>
                                </li>
                                
                                <li>
                                    
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>/signout" method="post">
                                        SignOut
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                    </nav>
                    <!-- navbar-header : End-->
                </div>
                <!-- Sidebar : Start -->
            </header>
            <?php $uri = current_url(true);?>

            <div id="sidebar-wrapper" class="sidebar-wrapper">
                <div class="logo-sidebar">
                    <img src="<?php echo getenv('ImageURL');?>assets/images/logo-app.png" class="admin-full-logo">
                </div>
                <div class="flex-1 oveflow-auto">
                    <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                        <li <?php if($uri->getSegment(1)=="dashboard" || $uri->getSegment(1)=="edit_profile" || $uri->getSegment(1)=="change_password"){echo 'class="active"';} ?> >
                            <a href="<?php echo base_url('/dashboard');?>">
                                <span class="fa-stack fa-lg pull-left">
                                    <i class="fa fa-dashboard fa-stack-1x "></i>
                                </span>
                                Dashboard
                            </a>
                            <!-- <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                                <li><a href="#">link1</a></li>
                                <li><a href="#">link2</a></li>
                            </ul> -->
                        </li>
                        <li <?php if($uri->getSegment(1)=="adminDashboard" || $uri->getSegment(1)=="userDashboard" || $uri->getSegment(1)=="create_admin" || $uri->getSegment(1)=="edit_admin" || $uri->getSegment(1)=="create_user" || $uri->getSegment(1)=="edit_user"){echo 'class="active"';} ?>>
                            
                            <?php if($user_data['is_admin']==1){?>
                            <a href="<?php echo base_url(); ?>/adminDashboard">
                                
                                <span class="fa-stack fa-lg pull-left">
                                    <i class="fa fa-user fa-stack-1x" aria-hidden="true"></i>
                                </span>
                            Admin Management</a>
                            <?php }else if($user_data['is_admin']==2){?>
                            <a href="<?php echo base_url(); ?>/userDashboard">
                                <span class="fa-stack fa-lg pull-left">
                                    <i class="fa fa-user fa-stack-1x" aria-hidden="true"></i>
                                </span>
                            User Management</a>
                            
                            
                            <?php }?>
                            
                        </li>
                    </ul>
                </div>
            </div>
          
            <!-- Page container : Start-->
            <div class="page-container" id="page-content-wrapper">
                <!--success alert-->
                <div class="position-fixed bottom-0 end-0 p-3 top-0 " style="z-index: 9999">
                    <div id="SuccessToast" class="toast hide align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" >
                        <div class="toast-header">
                            <button id="close_toast_success" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                       
                        </div>
                        <div class="toast-body" id="success_div_toast">
                              Success
                        </div>
                    </div>
                </div>
                <!--error alert-->
                <div class="position-fixed bottom-0 end-0 p-3 top-0 " style="z-index: 9999">
                    <div id="ErrorToast" class="toast hide align-items-center text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true" >
                        <div class="toast-header">
                            <button id="close_toast_error" type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                       
                        </div>
                        <div class="toast-body" id="error_div_toast">
                          Error

                        </div>
                    </div>
                </div>

          
