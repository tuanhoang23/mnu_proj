<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ManagerModel extends Model
{
    use HasFactory;

    protected $table = 'users';
    
    public function getAllUser($fillter = 0 , $keyword=null , $sort = null, $perpage = null){
        $user = DB::table($this->table)
        ->select('users.*','group_user.group_name as group_name')
        ->join('group_user','users.group_id','=','group_user.id');
        

        // sắp xếp khi ấn vào tên nó tự động sắp xếp tăng dần hoặc giảm dần 
        $orderBy = 'users.create_at';
        $orderType = 'desc';
        if(!empty($sort) && is_array($sort)){
            if(!empty($sort['sortby']) && !empty($sort['sorttype'])){
                $orderBy = trim($sort['sortby']);
                $orderType = trim($sort['sorttype']);
            }
        }

        $user = $user->orderBy($orderBy,$orderType);

        if(!empty($fillter)){
            $user = $user->where($fillter);
        }

        if(!empty($keyword)){
            $user = $user->where(function($query) use($keyword){
                $query->orwhere('fullname','like','%'.$keyword.'%');
                $query->orwhere('email','like','%'.$keyword.'%');
            });
        }

        if(!empty($perpage)){
            $user = $user->paginate($perpage); //->withQueryString();
        }else{
            $user = $user->get();
        }


        return $user;
    }

    public function add($data){
        return DB::table($this->table)->insert($data);
    }

    public function getDetail($id){
        return DB::table($this->table)->select('*')->where('id','=', $id)->get();
    }

    public function updateUser($id, $data){
        return DB::table($this->table)->where('id',$id)->update($data);
    }

    public function deleteUs($id){
        return DB::table($this->table)->where('id',$id)->delete();
    }


    
}
