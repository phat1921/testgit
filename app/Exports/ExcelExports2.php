<?php

namespace App\Exports;

use App\Models\BillHO;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelExports2 implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): 
        array { 
            return [ 'Lớp', 'Tên Sinh Viên', 'Sách', 'Ngày phát sách']; 
        }

    public function collection()
    {
       
        return billho::join("student", "billho.Id_Student", "=", "student.Id_Student")
                    ->join("classroom", "billho.Id_Class", "=", "classroom.Id_Class")
                    ->join("book", "billho.Id_Book", "=", "book.Id_Book")
                    ->select("classroom.Name_Class", "student.Name_Name", "book.Name_Book","billho.Time")
                    ->get();
    }
    
}
