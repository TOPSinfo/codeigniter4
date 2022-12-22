<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_master';

    protected $allowedFields = ['name', 'email', 'password','contact_no','is_deleted','profile_pic','created_at','updated_at','is_admin','created_by','access_key','company','username','domains','billing_term','role'];

    
    /**
        * Function to change user status in 
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    14-12-2022
        
    */
    public function updateStatus($id,$data){
        $builder = $this->db->table('user_master');
        $builder->whereIn('id',$id);
        $builder->update($data);
        if($this->db->affectedRows() > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
        * Function to check user email exist or not
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    12-12-2022
        
    */

    public function verifyemail($email){

        $query=$this->db->table('user_master');
        $query->select('id,email,name');
        $query->where('email',$email);
        $result=$query->get()->getResultArray();
        if(count($result)==1){
           return $result;
        }else{
            return false;
        }

    }
    /**
        * Function to verify token for reset password
        * @access_url
        * @access_method
        * @author  Priyanka Pathak
        * @date    14-12-2022
        
    */
    public function verifyToken($user_id){

        $query=$this->db->table('user_master');
        $query->select('id,updated_at');
        $query->where('id',$user_id);
        $result=$query->get()->getResultArray();
        if(count($result)==1){
           return $result;
        }else{
            return false;
        }

    }

}
