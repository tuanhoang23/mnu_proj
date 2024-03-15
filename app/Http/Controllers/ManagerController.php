<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManagerModel;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;


class ManagerController extends Controller
{

    private $us;
    const _PER_PAGE = 3 ;


    public function __construct(){

        $this->us = new ManagerModel();
    }

    public function index(Request $request){

        $title = 'Quản lý người dùng';


        // lọc theo trạng thái
        $fillter= [];
        if(!empty($request->status)){
            $status = $request->status;
            if($status=='active'){
                $status = 1;
            }else{
                $status = 0;
            }
            
            $fillter[] = ['users.status','=',$status];
        }

        //lọc theo nhóm
        
        if(!empty($request->group_id)){
            $groupId = $request->group_id;
            $fillter[] = ['users.group_id','=',$groupId];
        }
        
        //lọc theo từ khóa
        $keyword = null;
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
        }

        // sắp xếp theo tên tăng hay giảm 
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allow = ['asc','desc'];

        if(!empty($sortType) && in_array($sortType , $allow)){
            if($sortType == 'asc'){
                $sortType = 'desc';
            }else{
                $sortType = 'asc';
            }
        }else{
            $sortType = 'asc';
        }
        $sortArr = [
            'sortby' =>$sortBy,
            'sorttype' =>$sortType
        ];

        // dd($sortArr);
        $list = $this->us->getAllUser($fillter ,$keyword , $sortArr , self:: _PER_PAGE );
       
        return view('display.homepage ',compact('title', 'list','sortBy','sortType'));
    }

    public function add(){
        $title = 'Thêm người dùng';
        $allGroup = getAllGroup();
        return view('display.add',compact('title','allGroup'));
    }

    public function postAdd(UserRequest $request){

        $datainsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $this->us->add($datainsert);
        return redirect()->route('home.index')->with('msg','Thêm người dùng thành công');
    }

    public function getEdit($id = 0 , Request $request ){
        $title = 'Cập nhật người dùng';



        if(!empty($id)){
            $userDetail = $this->us->getDetail($id);
            if(!empty($userDetail[0])){
                $request->session()->put('id',$id);
                $userDetail=$userDetail[0];
            }else{
                return redirect()->route('home.index')->with('msg','Người dùng không tồn tại');
            }
        }else{
            return redirect()->route('home.index')->with('msg','Liên kết không tồn tại');
        }
        $allGroup = getAllGroup();
        return view('display.edit',compact('title','allGroup','userDetail'));
    }

    public function postEdit(UserRequest $request){
        $id = session('id');
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
      
        $datainsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s'),
        ];

        $this->us->updateUser($id ,$datainsert); 

        return redirect()->route('home.edit',['id'=>$id])->with('msg','Cập nhật thành công');
    }

    public function deleteUser($id){

        if(!empty($id)){
            $userDetail = $this->us->getDetail($id);
            
            if(!empty($userDetail[0])){
                $deleteStatus =$this->us->deleteUs($id);
                if(!$deleteStatus){
                    $msg = 'Xóa người dùng không thành công';
                }else{
                    $msg = 'Xóa người dùng thành công';
                }
            }else{
                $msg = ' Người dùng không tồn tại';
            }
        }else{
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->back()->with('msg', $msg);
    }
}
