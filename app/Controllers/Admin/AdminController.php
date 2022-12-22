<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\UserModel;


class AdminController extends ResourceController
{
    use ResponseTrait;
    // all users
    public function AllUsers(){
      $userModel = new UserModel();
      $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }

    public function index()
    {
        
        helper(['form']);
        $searchData = $this->request->getVar('search');
        $search = "";
        if(isset($searchData)){
           $search = $searchData;
        }

    // Get data 
    //$users = new Users();
    $users = new UserModel();


    if($search == ''){
      $paginateData = $users->paginate(5);
    }else{
      $paginateData = $users->select('*')
          ->orLike('name', $search)
          ->orLike('email', $search)
          ->orLike('contact_no', $search)
          ->paginate(5);
    }

    $data = [
      'users' => $paginateData,
      'pager' => $users->pager,
      //'search' => $search
    ];


        echo view('Admin/AdminDashboard');
    }
   
}
