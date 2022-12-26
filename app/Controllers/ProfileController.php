<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class ProfileController extends BaseController
{
    /**
        * Function to show dashboard
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    08-12-2022
        
    */
    public function index()
    {
        $session = session();
        helper(['form']);
        $userModel = new UserModel();
        $data = [];
        $user_id=$session->get('id');
        if($user_id){
            //$data['user_name'] = $session->get('name');
            $user_data = $userModel->where(array('id'=>$user_id,'is_deleted'=>0))->find();
            $data['user_data'] = $user_data[0];
        }
        echo view('/Home/profile', $data);
    }

    /**
        * Function to change password
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    08-12-2022
        
    */
    
    public function change_password(){

        helper(['form']);
        $session = session();
        $userModel = new UserModel();
        $data = [];

         $user_id=$session->get('id');
        if($user_id){
            $data['user_name'] = $session->get('name');
            $user_data = $userModel->where(array('id'=>$user_id,'is_deleted'=>0))->find();
            $data['user_data'] = $user_data[0];
        }
        $data['user_name'] = $session->get('name');
        
        if($this->request->getMethod()=='post'){
            $data['isPost'] = $this->request->getMethod()=='post'; 
            $rules=[
                'opwd'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required' => 'Current password field is required',
                    ],
                ],
                'npwd'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>[
                        'required' => 'New password field is required',
                        'min_length'=> 'The New password field must be at least 6 characters in length.',
                        'max_length'=> 'The New password field cannot exceed 12 characters in length.'
                    ],
                ],
                'cpwd'=>[
                    'rules'=>'required|matches[npwd]',
                    'errors'=>[
                        'required' => 'Confirm password field is required',
                        'matches'=>'Confirm password does not matche with new password.'
                    ],
                ],
               
            ];
            if($this->validate($rules)){
               
                $opwd = $this->request->getVar('opwd');
                $npwd = $this->request->getVar('npwd');
                  

                if($opwd!=$npwd){
                $user_data = $userModel->where(array('id'=>$user_id,'is_deleted'=>0))->find();
                   
                $db_pass = $user_data[0]['password'];
                    

                
                    //compare password
                $confirm_pass_hash=hash_hmac("sha256", $opwd,PASSWORD_SECRET);
                $match_pwd= password_verify($confirm_pass_hash,$db_pass);
                    if($match_pwd==1){
                        
                       $new_password_prepd = hash_hmac("sha256", $npwd,PASSWORD_SECRET);
                        
                        $new_password = password_hash($new_password_prepd, PASSWORD_BCRYPT);
                        $update_data=array(
                            'password'=>$new_password
                        );

                        if($userModel->update($user_id,$update_data))
                        {
                            $session->setTempdata('success', 'Password Updated successfully',3);
                           return redirect()->to('/dashboard');

                        }else{
                            $session->setTempdata('error', 'Unable to update password',3);
                            return redirect()->to(current_url());
                        }
                    }         
                    else{
                        $session->setTempdata('error', 'Old password is incorrect.',3);
                        return redirect()->to(current_url());
                    }
                }
                 else{
                        $session->setTempdata('error', 'Current password can not be same as New password.',3);
                        return redirect()->to(current_url());
                    }

            }else{
                
                $data['validation'] = $this->validator;
            }
        }
        echo view('/Home/change_password', $data);   
    }
    /**
        * Function to edit profile
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    09-12-2022
        
    */
    public function edit_profile(){

        helper(['form']);
        $session = session();
        $userModel = new UserModel();
        $data = [];
        $user_id=$session->get('id');
        
        //get data and fill it
       
        $user_data = $userModel->where(array('id'=>$user_id,'is_deleted'=>0))->find();
        $data['user_data'] = $user_data[0];
        if($this->request->getMethod()=='post'){
            $uid=$_POST['uid'];
            $rules=[
                'name'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required' => 'Name field is required',
                    ],
                ],
                'contact_number'=>[
                    'rules'=>'required|min_length[10]|max_length[30]',
                    'errors'=>[
                        'required' => 'Contact number field is required',
                        'min_length'=> 'The Contact number field must be at least 10 characters in length.',
                        'max_length'=> 'The Contact number field cannot exceed 12 characters in length.',
                        //'numeric'=>'The Contact number field should be numeric only'
                    ],
                ],
                'profile_pic'=>[
                    'rules'=>'max_size[profile_pic,1024]|ext_in[profile_pic,png,jpg,jpeg,gif]',
                    'errors'=>[
                        'ext_in'=>'Profile pic does not have a valid extension.',
                        'max_size'=>'Profile pic max size is 1024'
                    ]

                ],
                'username'=>[
                    'rules'=>'required|min_length[6]|max_length[12]|is_unique[user_master.username,id,{uid}]',
                    'errors'=>[
                        'required' => 'User field is required',
                        'min_length'=> 'The Username field must be at least 6 characters in length.',
                        'max_length'=> 'The Username field cannot exceed 12 characters in length.',
                        'is_unique'=>'Username is already exists.'
                    ],
                ],
                'email'=>[
                    'rules'=>'required|min_length[4]|max_length[100]|valid_email|is_unique[user_master.email,id,{uid}]',
                    'errors'=>[
                        'required' => 'Email field is required',
                        'valid_email'=>'Valid Email required',
                        'min_length'=> 'The Email field must be at least 4 characters in length.',
                        'max_length'=> 'The Email field cannot exceed 100 characters in length.',
                        'is_unique'=>'Email is already exists.'
                    ],
                ],
            
           
            ];
            if($this->validate($rules)){
                
                //edit profile
                $name = $this->request->getVar('name');
                $contact_number= $this->request->getVar('contact_number');
                $profile_pic=$user_data[0]['profile_pic'];
                //for profile pic
                $file=$this->request->getFile('profile_pic');
                $username=$this->request->getVar('username');
                $email_check=$this->request->getVar('email');


                if($file->isValid() && !$file->hasMoved()){
                   
                   $uploaded_profile_pic = $file->getRandomName();
                  // if($file->move(WRITEPATH.'uploads/profile_pic',$uploaded_profile_pic))
                   if($file->move(FCPATH.'profile_pic',$uploaded_profile_pic))
                   {
                    $profile_pic=$uploaded_profile_pic;

                   }else{
                        $session->setTempdata('error', $file->getErrorString(),3);
                        return redirect()->to(current_url());

                   }
                }
                /*else{
                     $session->setTempdata('error', 'You have uploaded invalid file',3);
                        return redirect()->to(current_url());

                }
*/
                

                $profile_data=array(
                    'name'=>$name,
                    'contact_no'=>$contact_number,
                    'profile_pic'=>$profile_pic,
                    'username'=>$username,
                    'email'=>$email_check,
                    'updated_at'=>date('Y-m-d H:i:s')
                );


                if($userModel->update($user_id, $profile_data)){

                    $session->setTempdata('success', 'Profile updated successfully.',3);
                    return redirect()->to('/dashboard');
                }else{
                    $session->setTempdata('error', 'Unable to update Profile.',3);

                }
                return redirect()->to(current_url());

            }else{

                $data['validation'] = $this->validator;
            }
        }

        
        echo view('/Home/edit_profile', $data);   
    }
    /**
        * Function to send email on forgot password
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    09-12-2022
        
    */
    public function forgot_password()
    {

        $encrypter = \Config\Services::encrypter();

       
        $session = session();
        helper(['form']);
        $userModel = new UserModel();
        $data = [];
       
        if($this->request->getMethod() ==='post')
        {
           
            //$data['email']=$this->request->getVar('email');
            $rules=[
                'email'=>[
                    'label' => 'email',
                    'rules'=>'required|min_length[4]|max_length[100]|valid_email',
                    'errors'=>[
                        'required' => 'Email field is required',
                        'valid_email'=>'Valid Email required',
                        'min_length'=> 'The Email field must be at least 4 characters in length.',
                        'max_length'=> 'The Email field cannot exceed 100 characters in length.',
                    ],
                ],
            ];

            if($this->validate($rules)){
                $email_check=$this->request->getVar('email',FILTER_SANITIZE_EMAIL);
                $check_email = $userModel->verifyemail($email_check);
                
                if(!empty($check_email)){
                    //update updated_at field for 15 min expiration link
                    $user_id=$check_email[0]['id'];
                     $update_data=array(
                        'updated_at'=>date('Y-m-d H:i:s')
                    );
                   
                    if($userModel->update($user_id,$update_data))
                    {
                        $email = \Config\Services::email();
                       
                        $to=$email_check;
                        $subject='Reset Password Link';
                      
                        $token =  bin2hex($encrypter->encrypt($check_email[0]['id']));

                        $user_name=$check_email[0]['name'];
                        $data1=array();
                        $data1['user_name']=$user_name;
                        $data1['token']=$token;
                        $message = view('/Email-template/reset_password_html', $data1);
                      

                        $email->setFrom('priyankap@topsinfosolutions.com','Training Layer');
                        //$email->setTo('priyankap@topsinfosolutions.com');
                        $email->setTo($to);
                        $email->setSubject( $subject);
                        $email->setMessage($message);
                        $email->setMailType('html');


                        if($email->send()){

                            $session->setTempdata('success', 'Email Sent Succesfully.Link expire within 15 minutes.',3);
                            
                        }else{
                           
                            $data['validation']=$email->printDebugger(['headers']);
                            
                        }
                    }else{
                         $session->setTempdata('error', 'Sorry! Unable to update. try again.',3);
                       
                    }

                }else{

                   
                     $session->setTempdata('error', 'Email does not exist.',3);
                      
                }
               
            }else{
                $data['validation'] = $this->validator;
                
            }
        }
        
        return view('/Home/forgot_password',$data);

        
    }
    /**
        * Function to Reset password via url
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    09-12-2022
        
    */
    public function reset_password($token=null){
        helper(['form']);
        $session = session();
        $userModel = new UserModel();
        $data = [];
        if(!empty($token)){

            $data['token']=$token;
            if($this->request->getMethod()=='post'){
                //decrypt token to get user id
                $encrypter = \Config\Services::encrypter(); 

                $user_id = $encrypter->decrypt(hex2bin($token));

                $userdata= $userModel->verifyToken($user_id);
                if($userdata){
                    if($this->checkExpiryDate($userdata[0]['updated_at'])){
                        $rules=[
                                'npwd'=>[
                                'rules'=>'required|min_length[6]|max_length[16]',
                                'errors'=>[
                                    'required' => 'Password field is required',
                                    'min_length'=> 'The Password field must be at least 6 characters in length.',
                                    'max_length'=> 'The Password field cannot exceed 16 characters in length.',
                                ],
                            ],
                        ];
                        if($this->validate($rules)){
                          
                            
                            $npwd = $this->request->getVar('npwd');
                            $new_password_prepd = hash_hmac("sha256", $npwd,PASSWORD_SECRET);
                                
                            $new_password = password_hash($new_password_prepd, PASSWORD_BCRYPT);
                                $update_data=array(
                                    'password'=>$new_password
                                );
                               

                                if($userModel->update($user_id,$update_data))
                                {
                                    $session->setTempdata('success', 'Password Changed successfully',3);
                                    return redirect()->to(current_url());

                                }else{
                                    $session->setTempdata('error', 'Unable to update password',3);
                                    return redirect()->to(current_url());
                                }

                        }else{
                            $data['validation'] = $this->validator;
                        }
                    }else{
                        $session->setTempdata('error', 'Reset password link is expired.',3);
                        return redirect()->to(current_url());
                    }   
                }else{
                    $session->setTempdata('error', 'Unable to find users acoount',3);
                    return redirect()->to(current_url());
                }
             
            }
        }else{
            $session->setTempdata('error', 'Sorry Unauthorized access',3);
            return redirect()->to(current_url());
                       
        }
        return view('/Home/reset_password',$data);
    }
    /**
        * Function to check expiry date of reset password url
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    09-12-2022
        
    */
     public function checkExpiryDate($time){
        $update_time=strtotime($time);
        $current_time=time();
        $time_diff=$current_time - $update_time;
        if($time_diff < 900){
            return true;
        }else{
            return false;
        }
    }

}

