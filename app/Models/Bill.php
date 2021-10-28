<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'Bill';
    public $timestamps = false;
    public $primaryKey = 'Id_Bill';

    public function getStatusNameAttribute(){
        if($this->Status == 1){
            echo "Đăng ký";
        }else{
            echo "Chưa đăng ký";
        }
    }
}
