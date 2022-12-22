<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\UserModel;


class SigninController extends ResourceController
{
    use ResponseTrait;
    // all users
    public function AllUsers(){
      $userModel = new UserModel();
      $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }

    /**
        * Function to show login page
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    06-12-2022
        
    */

    public function index()
    {
        
        helper(['form']);
        
        if (!session()->get('isLoggedIn'))
        {
            echo view('Home/signin');
        }else{
            return redirect()->to('/dashboard');
          
        }
    }
    /**
        * Function to login api
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    06-12-2022
        
    */
    public function login_post(){
        
        $session = session();
        $userModel = new UserModel();
        if($this->request->getMethod()=='post'){
            $rules=[
                'email'=>[
                    'rules'=>'required|min_length[4]|max_length[100]|valid_email',
                    'errors'=>[
                        'required' => 'Email field is required',
                        'valid_email'=>'Valid Email required',
                        'min_length'=> 'The Email field must be at least 4 characters in length.',
                        'max_length'=> 'The Email field cannot exceed 100 characters in length.',
                    ],
                ],
                'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>[
                        'required' => 'Password field is required',
                        'min_length'=> 'The Password field must be at least 6 characters in length.',
                        'max_length'=> 'The Password field cannot exceed 16 characters in length.'
                    ],
                ],
            ];
            if($this->validate($rules)){
            }else{
                /*$response = [
                  'status'   => 501,
                  'error'    => 501,
                  'messages' => [
                      'error' => $this->validator
                ];*/
            }
        }
        return $this->respondCreated($response);
    }
    /**
        * Function to login user via email and password
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    07-12-2022
        
    */
    
    public function loginAuth()
    {
        helper("cookie");
       
        $session = session();
        $userModel = new UserModel();
        $data = [];

        if($this->request->getMethod()=='post'){
            $rules=[
                'email'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required' => 'Email field is required',
                        //'valid_email'=>'Valid Email required',
                        //'min_length'=> 'The Email field must be at least 4 characters in length.',
                        //'max_length'=> 'The Email field cannot exceed 100 characters in length.',
                    ],
                ],
                'password'=>[
                    'rules'=>'required|min_length[6]|max_length[16]',
                    'errors'=>[
                        'required' => 'Password field is required',
                        'min_length'=> 'The Password field must be at least 6 characters in length.',
                        'max_length'=> 'The Password field cannot exceed 16 characters in length.'
                    ],
                ],
            ];
            if($this->validate($rules)){

                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                
                //$data = $userModel->where('email', $email)->first();
                $data = $userModel->where('username' , $email)->orWhere('email',$email)->first();

                if($data){
                    $is_user_active = $userModel->where(array('email'=> $email,'is_deleted'=>0))->orWhere(array('username'=> $email,'is_deleted'=>0))->first();
                    if($is_user_active){
                            $pass = $data['password'];

                        
                            //compare password
                            $confirm_pass_hash=hash_hmac("sha256", $password,PASSWORD_SECRET);
                            
                            $authenticatePassword = password_verify($confirm_pass_hash, $pass);

                            //print_r($authenticatePassword);die();
                            if($authenticatePassword){
                                //remember me functionality
                                $remember = $this->request->getVar('remember');

                                if(!empty($remember))   
                               {  
                                
                                setcookie ("member_login",$email,time()+ (10 * 365 * 24 * 60 * 60));  
                                setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                                //$_SESSION["admin_name"] = $name;
                               }  
                                else  
                                {  
                                    if(isset($_COOKIE["member_login"]))   
                                    {  
                                     setcookie ("member_login","");  
                                    }  
                                    if(isset($_COOKIE["member_password"]))   
                                    {  
                                     setcookie ("member_password","");  
                                    }  
                               }  

                              //echo get_cookie("member_login");die();
                                $ses_data = [
                                    'id' => $data['id'],
                                    'name' => $data['name'],
                                    'email' => $data['email'],
                                    'password'=>$data['password'],
                                    'created_by'=>$data['created_by'],
                                    'isLoggedIn' => TRUE
                                ];
                                $session->set($ses_data);
                                return redirect()->to('/dashboard');
                            
                            }else{
                                $session->setFlashdata('msg', 'Password is incorrect.');
                                return redirect()->to('/signin');
                            }
                    }else{
                        $session->setFlashdata('msg', 'Your account is inactive.Please contact to admin.');
                        return redirect()->to('/signin');
                    }
                }
                else{
                    $session->setFlashdata('msg', 'Email/Username does not exist.');
                    return redirect()->to('/signin');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        echo view('/Home/signin', $data);

    }
    /**
        * Function to logout api
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    07-12-2022
        
    */
    public function signout(){
        $session = session();
        $ses_data = [
                    'id' => '',
                    'name' => '',
                    'email' => '',
                    'isLoggedIn' => False
                ];
                $session->set($ses_data);
                return redirect()->to('/signin');
    }
}
