<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\UserModel;


class AdminController extends ResourceController
{
    use ResponseTrait;
    /**
        * Function to show admin dashboard with pagination,serach and other filters
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    13-12-2022
        
    */
    public function index()
    {
        
        helper(['form']);
        $session = session();
        $data =[];
        $users = new UserModel();
        $pager = service('pager');
        $user_id=$session->get('id');

        

        //for search
        $searchData = $this->request->getVar('search');
        $search = "";
        if(isset($searchData)){
           $search = $searchData;
        }
        
       
        //for show records per page
        if(!empty($this->request->getVar('getRows'))){
            $limit_per_page = $this->request->getVar('getRows');
        }else{
            $limit_per_page = 5;
        }

        //to get pagination data
        if($search == ''){
          $paginateData = $users->where('created_by', $user_id)->paginate($limit_per_page);
        }else{
            $paginateData = $users->select('*')
            ->where('created_by', $user_id)
            ->groupStart()
             ->Like('name', $search)
              ->orLike('email', $search)
              ->orLike('contact_no', $search)
              ->groupEnd()
            ->paginate($limit_per_page);
        }

        //for header
        if($user_id){
            $data['user_name'] = $session->get('name');
            $user_data = $users->where(array('id'=>$user_id,'is_deleted'=>0))->find();
            
        }


       // Call makeLinks() to make pagination links.
        $page    = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = $limit_per_page;
        $total   =  $users->where('created_by', $user_id)->countAllResults();
        //$total   =100;
        //echo $users->getLastQuery()->getQuery();die();


        $pager_links = $pager->makeLinks($page, $perPage, $total,'default_full');

        $getRows    = isset($_GET['getRows']) ? $_GET['getRows'] : $limit_per_page;

        $data = [
        'user_data'=>$user_data[0],
          'users' => $paginateData,
          //'pager' => $users->pager,
          'search' => $search,
           'pager_links' => $pager_links,
           'data'=>$users->paginate(5),
           'page'=>$page,
           'perPage'=>$perPage,
           'total'=>$total,
           'getRows'=>$getRows

        ];
       // print_r($data);die();
        echo view('Admin/AdminDashboard',$data);
    }
    /**
        * Function to Create admin 
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    14-12-2022
        
    */
    public function create_admin(){

        $session = session();
        $data = [];
        helper(['form']);
         $userModel = new UserModel();

        $user_id=$session->get('id');
        if($user_id){
            $data['user_name'] = $session->get('name');
            $user_data = $userModel->where(array('id'=>$user_id,'is_deleted'=>0))->find();
            $data['user_data'] = $user_data[0];
        }

        if($this->request->getMethod()=='post'){
             $rules=[
                'name'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required' => 'Name field is required',
                    ],
                ],
                'username'=>[
                    'rules'=>'required|min_length[6]|max_length[12]|is_unique[user_master.username]',
                    'errors'=>[
                        'required' => 'User field is required',
                        'min_length'=> 'The Username field must be at least 6 characters in length.',
                        'max_length'=> 'The Username field cannot exceed 12 characters in length.',
                        'is_unique'=>'Username is already exists.'
                    ],
                ], 
                'contact_no'=>[
                    'rules'=>'required|min_length[10]|max_length[16]',
                    'errors'=>[
                        'required' => 'Contact number field is required',
                        'min_length'=> 'The Contact number field must be at least 10 characters in length.',
                        'max_length'=> 'The Contact number field cannot exceed 16 characters in length.',
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
                'npwd'=>[
                    'rules'=>'required|min_length[6]|max_length[12]',
                    'errors'=>[
                        'required' => 'Password field is required',
                        'min_length'=> 'The Password field must be at least 6 characters in length.',
                        'max_length'=> 'The Password field cannot exceed 12 characters in length.'
                    ],
                ],
                'cpwd'=>[
                    'rules'=>'required|matches[npwd]',
                    'errors'=>[
                        'required' => 'Confirm password field is required',
                        'matches'=>'Confirm password does not matches with new password.'
                    ],
                ],
                 'email'=>[
                    'rules'=>'required|min_length[4]|max_length[100]|valid_email|is_unique[user_master.email]',
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
               
                $name = $this->request->getVar('name');
                $contact_no= $this->request->getVar('contact_no');
                $email_check=$this->request->getVar('email',FILTER_SANITIZE_EMAIL);

                $npwd = $this->request->getVar('npwd');
               
                $new_password_prepd = hash_hmac("sha256", $npwd,PASSWORD_SECRET);
                                
                $password = password_hash($new_password_prepd, PASSWORD_BCRYPT);
                $profile_pic='';

                $npwd = $this->request->getVar('npwd');

                $username=$this->request->getVar('username');
                $company=$this->request->getVar('company');
                $billing_term=$this->request->getVar('billing_term');
                $role=$this->request->getVar('role');
                
                $domains=$this->request->getVar('domains');
                $newDomains = implode(',',$domains);
                
                $check_email = $userModel->verifyemail($email_check);
                
                if(empty($check_email)){


                    //for profile pic
                    $file=$this->request->getFile('profile_pic');
                    if($file->isValid() && !$file->hasMoved()){
                       
                       $uploaded_profile_pic = $file->getRandomName();
                       if($file->move(FCPATH.'profile_pic',$uploaded_profile_pic))
                       {
                        $profile_pic=$uploaded_profile_pic;

                       }else{
                            $session->setTempdata('error', $file->getErrorString(),3);
                            return redirect()->to(current_url());

                       }
                    }
                   /* else{
                         $session->setTempdata('error', 'You have uploaded invalid file',3);
                            return redirect()->to(current_url());

                    }*/

                    $data = [
                        'name'     => $name,
                        'email'    => $email_check,
                        'password' => $password,
                        'contact_no'=>$contact_no,
                        'profile_pic'=>$profile_pic,
                        'is_admin'=>'2',
                        'username'=>$username,
                        'company'=>$company,
                        'domains'=>$newDomains,
                        'billing_term'=>$billing_term,
                        'role'=>$role,
                        'created_by'=>$user_id,
                        'created_at'=>date('Y-m-d H:i:s')
                    ];
                    //print_r($data);die();
                    $res=$userModel->save($data);
                   
                    if($res){
                        //update access key
                        $new_user_id = $userModel->insertID;
                        $new_acc_key = hash_hmac("sha256", $new_user_id,PASSWORD_SECRET);

                        $access_key = password_hash($new_acc_key, PASSWORD_BCRYPT);

                        $update_access_data=array(
                            'access_key'=>$access_key
                        );
                       
                        $userModel->update($new_user_id, $update_access_data);
                       

                        //send mail to user
                        $email = \Config\Services::email();
                       
                        $to=$email_check;
                        $subject='Welcome to Training Layer';
                      
                        $data1=array();
                        $data1['user_name']=$name;
                        $data1['email_check']=$email_check;
                        
                        $message = view('/Email-template/create_user_html', $data1);
                       
                        
                        $email->setFrom('priyankap@topsinfosolutions.com','Training Layer');
                        //$email->setTo('priyankap@topsinfosolutions.com');
                        $email->setTo($to);
                        $email->setSubject($subject);
                        $email->setMessage($message);
                        $email->setMailType('html');

                        if($email->send()){

                            $session->setTempdata('success', 'Admin created successfully.',3);
                            return redirect()->to('/adminDashboard');
                        }else{
                           
                            $data['validation']=$email->printDebugger(['headers']);
                            //print_r($data);die();
                        }
                    }else{
                      //unable to save  
                        $session->setTempdata('error', 'Sorry! Unable to create admin.try again.',3);
                        return redirect()->to(current_url());
                    }
                }else{
                    $session->setTempdata('error', 'Email Already exist.',3);
                    return redirect()->to(current_url());
                }
                
            }else{
                $data['validation'] = $this->validator;
                
            }
        }
        
        echo view('Admin/CreateAdmin',$data);
    }
    
     /**
        * Function to delete user
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    15-12-2022
        
    */

    public function delete_admin(){
        $session = session();
        $userModel = new UserModel();
        $data = [];
        $id= $this->request->getVar('id');
        $res=$userModel->delete($id);
        if($res){
            $session->setTempdata('success', 'Admin deleted successfully.',3);
            return redirect()->to('/adminDashboard');
        }else{
            $session->setTempdata('error', 'Sorry!try again.',3);
            return redirect()->to('/adminDashboard');
        }


    }
    /**
        * Function to edit user
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    15-12-2022
        
    */
    public function edit_admin($id){

        $session = session();
        $data = [];
        $userModel = new UserModel();

        $user_id=$session->get('id');

        if($user_id){
            $user_data = $userModel->where(array('id'=>$user_id,'is_deleted'=>0))->find();
            $data['user_data'] = $user_data[0];
        }

        if($id){

            $data['user_name'] = $session->get('name');
            $edit_user_data = $userModel->where(array('id'=>$id,'is_deleted'=>0))->find();
            $data['edit_user_data'] = $edit_user_data[0];
        }

        if($this->request->getMethod()=='post'){
            
            $uid=$_POST['uid'];
            $rules=[
                'name'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required' => 'Name field is required',
                    ],
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
                'contact_no'=>[
                    'rules'=>'required|min_length[10]|max_length[16]',
                    'errors'=>[
                        'required' => 'Contact number field is required',
                        'min_length'=> 'The Contact number field must be at least 10 characters in length.',
                        'max_length'=> 'The Contact number field cannot exceed 16 characters in length.',
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
                $userModel = new UserModel();

                $name = $this->request->getVar('name');
                $contact_no= $this->request->getVar('contact_no');
                $profile_pic=$user_data[0]['profile_pic'];

                //$username=$this->request->getVar('username');
                $company=$this->request->getVar('company');
                $billing_term=$this->request->getVar('billing_term');
                $role=$this->request->getVar('role');
                $email_check=$this->request->getVar('email');
                $domains=$this->request->getVar('domains');
                $newDomains = implode(',',$domains);
               // print_r($newDomains);die();

            
                    //for profile pic
                    $file=$this->request->getFile('profile_pic');
                    if($file->isValid() && !$file->hasMoved()){
                       
                       $uploaded_profile_pic = $file->getRandomName();
                       if($file->move(FCPATH.'profile_pic',$uploaded_profile_pic))
                       {
                        $profile_pic=$uploaded_profile_pic;

                       }else{
                            $session->setTempdata('error', $file->getErrorString(),3);
                            return redirect()->to(current_url());

                       }
                    }
                   /* else{
                         $session->setTempdata('error', 'You have uploaded invalid file',3);
                            return redirect()->to(current_url());

                    }*/

                    $data = [
                        'name'     => $name,
                        'contact_no'=>$contact_no,
                        'profile_pic'=>$profile_pic,
                        'company'=>$company,
                        'domains'=>$newDomains,
                        'billing_term'=>$billing_term,
                        'role'=>$role,
                        'email'=>$email_check,
                        'updated_at'=>date('Y-m-d H:i:s')
                    ];
                    $res=$userModel->update($id,$data);
                    
                    if($res){
                        $session->setTempdata('success', 'Admin details updated successfully.',3);
                        return redirect()->to('/adminDashboard');
                       
                    }else{
                        //unable to save  
                        $session->setTempdata('error', 'Sorry! Unable to update admin details.try again.',3);
                        return redirect()->to(current_url());
                    }
                
            }else{
                $data['validation'] = $this->validator;
                //echo view('Admin/EditAdmin', $data);
            }
        }
        echo view('Admin/EditAdmin',$data);

    }
    /**
        * Function to change user status for 1 user
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    16-12-2022
        
    */
    public function change_status_admin(){

        $session = session();
        $data = [];
        $userModel = new UserModel();

        $user_id=$this->request->getVar('id');
        $user_status=$this->request->getVar('user_status');
        //check condition
        if($user_status == '1'){
            $user_status = '0';
        }
        else{
            $user_status = '1';
        }

        $update_data=array(
                            'is_deleted'=>$user_status
                        );
                       
        if($userModel->update($user_id, $update_data)){
            $session->setTempdata('success', 'Admin status has been changed successfully.',3);
            return redirect()->to('/adminDashboard');
                       
        }else{
            $session->setTempdata('error', 'Unable to update.',3);
            return redirect()->to('/adminDashboard');
        }

     }
      /**
        * Function to change user status in bulk
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    16-12-2022
        
    */
     public function change_bulk_status_admin(){

        $session = session();
        $data = [];
        $userModel = new UserModel();

        $user_id=$this->request->getVar('user_ids');
        $user_status=$this->request->getVar('user_action');
        //check condition
        if($user_status == 'active'){
            $user_status = '0';
        }
        else{
            $user_status = '1';
        }
        $user_ids = explode (",", $user_id); 

        $update_data=array(
                            'is_deleted'=>$user_status
                        );
                       
        if($userModel->updateStatus($user_ids, $update_data)){
            $session->setTempdata('success', 'Admin status has been changed successfully.',3);
            return redirect()->to('/adminDashboard');
                       
        }else{
            $session->setTempdata('error', 'Unable to update.',3);
            return redirect()->to('/adminDashboard');
        }

     }


}
