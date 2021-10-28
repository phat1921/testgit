<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = str_replace('/', '-', $row['ngay_sinh']);

        return new Student([
            'Name_Name' => $row['ho_ten'],
            'Gender' => $row['gioi_tinh'] == "Nam" ? 1: 0,
            'DoB' => date('Y-m-d', strtotime($date)),
            'Email' => $row['email'],
            'Phone_Number' => $row['so_dt'],
            'Id_Class' => $row['lop_hoc'],
            'availabel' => 1,
        ]);
    }
}
