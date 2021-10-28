<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainBill extends Model
{
    protected $table = 'billmain';
    public $timestamps = false;
    public $primaryKey = 'Id_Bill_Main';

    public function getStatusNameAttribute(){
        if ($this->Status == 0) {
            echo "Chưa phát sách";
        } else {
            echo "Đã phát sách";
        }
        
    }
}
