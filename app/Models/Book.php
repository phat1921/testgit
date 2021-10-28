<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public $timestamps = false;
    public $primaryKey = 'Id_Book';

    public function getSubjectNameAttribute(){
          if ($this->Id_Subject == 1) {
              echo "Lập trình";
          } elseif ($this->Id_Subject == 2) {
              echo "Bảo mật";
          }else {
              echo "Quản trị kinh doanh";
          }
          
    }
}
