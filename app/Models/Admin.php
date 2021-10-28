<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'Admin';
    public $timestamps = false;
    public $primaryKey = 'Id_Admin';

    public function getGenderNameAttribute(){
        if ($this->Gender == 1) {
            echo "Nam";
        } else {
            echo "Nữ";
        }
        
    }

    public function getRoleNameAttribute(){
        if ($this->Role == 1) {
            echo "Quản lý";
        } else {
            echo "Giáo Vụ";
        }
        
    }
}
