<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'group_user';
    // dùng cho helper để render ra nhóm trong select bên homepage
    public function getAll(){
        $group = DB::table($this->table)->orderBy('group_name', 'ASC')->get();
        return $group;
    }
}
