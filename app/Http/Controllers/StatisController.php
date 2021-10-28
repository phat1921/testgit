<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\BillHO;
use App\Models\Bill;
use App\Models\Book;
use App\Models\MainBill;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExports;
use App\Exports\ExcelExports2;

use DB;
use Session;
class StatisController extends Controller
{
    public function statis(){
        $listBill = Bill::where('bill.Status', 0)
                          ->join("student", "student.Id_Student", "=", "bill.Id_Student")
                          ->join("book", "book.Id_Book", "=", "bill.Id_Book")
                          ->join("billmain", "billmain.Id_Bill_Main", "=", "bill.Id_Bill_Main")
                          ->where("billmain.availabel", 1)
                          ->join("classroom", "classroom.Id_Class", "=", "billmain.Id_Class")
                          ->get();

        $listBillHO = BillHO::join("student", "student.Id_Student", "=", "billho.Id_Student")
                          ->join("classroom", "classroom.Id_Class", "=", "billho.Id_Class")
                          ->join("book", "book.Id_Book", "=", "billho.Id_Book")
                          ->orderBy('Time', 'desc')
                          ->get();

        $listMainBill = MainBill::where("Status", 0)
                                  ->where('availabel', 1)  
                                  ->get();                  

        $book = DB::table('book')->get();
        $sum_book = $book->sum('Amount');
        
        $stunNotDone = collect($listBill)->count();
        $stunDone = collect($listBillHO)->count();  
        $billNotDone = collect($listMainBill)->count();

        return view('dashboard',[
            'listBill' => $listBill,
            'listBillHO' => $listBillHO,
            'stunNotDone' => $stunNotDone,
            'stunDone' => $stunDone,
            'billNotDone' => $billNotDone,
            'sum_book' => $sum_book,
            'listMainBill' => $listMainBill
        ]);   
    }

    public function exportExcelProcess(){
        return Excel::download(new ExcelExports,'SVchuaDK.xlsx');
    }

     public function exportExcelProcess2(){
        return Excel::download(new ExcelExports2,'SVdangky.xlsx');
    }
}
