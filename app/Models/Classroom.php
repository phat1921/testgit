<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'Classroom';
    public $timestamps = false;
    public $primaryKey = 'Id_Class';

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

// class Course extends Model
// {
//     protected $table = 'course';
//     public $timestamps = false;
//     public $primaryKey = 'Id_Course';
// }

// class Subject extends Model
// {
//     protected $table = 'subject';
//     public $timestamps = false;
//     public $primaryKey = 'Id_Subject';
// }