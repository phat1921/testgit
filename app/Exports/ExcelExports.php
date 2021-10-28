<?php

namespace App\Exports;

use App\Models\Bill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelExports implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): 
        array { 
            return [ 'Tên Sinh Viên', 'Lớp', 'Sách']; 
        }

    public function collection()
    {
       
        return bill::where("bill.Status", 0)
                    ->join("billmain", "bill.Id_Bill_Main", "=", "billmain.Id_Bill_Main")
                    ->join("classroom", "billmain.Id_Class", "=", "classroom.Id_Class")
                    ->join("student", "bill.Id_Student", "=", "student.Id_Student")
                    ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                    ->select( "student.Name_Name", "classroom.Name_Class", "book.Name_Book")
                    ->get();
    }
    
}
