<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Book;
use App\Models\Subject;
use App\Models\classroom;
use App\Models\Student;
use App\Models\BillHO;
use App\Models\Bill;
use App\Models\MainBill;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DateTime;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    //Quản lý sách
    public function index(Request $request)
    {
        $search = $request->get('search');
        $listBook = book::join("subject", "book.Id_Subject", "=", "subject.Id_Subject")
                          ->where('Name_Book', 'like', "%$search%")
                          ->where('Book.availabel', 1)
                          ->paginate(3);
        return view ('book.index', [
            'search' => $search,
            'listBook' => $listBook
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listSubject = subject::all();
        return view('book.create', [
            'listSubject' => $listSubject,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $Name_Subject = $request->get('Name_Subject');
        $amount = $request->get('amount');

        if (book::where('Name_Book', $name)->exists()) {
                session()->flash('danger', 'Sách đã tồn tại!!');
                return redirect(route('book.create'));
        }else{
            $book = new book();
            $book->Name_Book = $name;
            $book->Id_Subject = $Name_Subject;
            $book->Amount = $amount;
            $book->availabel = 1;

            $book->save();
            session()->flash('success', 'Thêm sách thành công!!');

        return redirect(route('book.index'));
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = book::find($id);
        return view('book.insert-amount2', [
            'book' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = book::find($id);
        $listSubject = Subject::all();

        return view('book.edit', [
            'book' => $book,
            'listSubject' => $listSubject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');
        $Name_Subject = $request->get('Name_Subject');
        $amount = $request->get('amount');

        $book = book::find($id);
        $book->Name_Book = $name;
        $book->Id_Subject = $Name_Subject;
        $book->Amount = $amount;

        $book->save();

         session()->flash('success', 'Cập nhật sách thành công!!');

        return redirect(route('book.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hide($id){ 
        $book = book::find($id);
        $book->availabel = 0;
        $book->save();

         session()->flash('success', 'Xóa sách thành công!!');
        return redirect(route('book.index'));
    }


    //Nhập sách
    public function insertAmount(Request $request){

        $listSubject = subject::where('Subject.availabel', 1)->get();
        $IdSubject = $request->get('Id_Subject');

        $listBook = book::join("subject", "book.Id_Subject", "=", "subject.Id_Subject")
                          ->where('subject.Id_Subject', $IdSubject)
                          ->where('book.availabel', 1)
                          ->get();
        return view('book.insert-amount',[
            'listSubject' => $listSubject,
            'listBook' => $listBook,
            'IdSubject' => $IdSubject,
        ]);
     }


     public function insertAmountProcess(Request $request, $id){
        
        
        $amount = $request->get('amountstrorage');
        $amount2 = $request->get('amount2');

        $book = book::find($id);
        
        if($amount2 <= 0){
            session()->flash('danger', 'Số lượng nhập phải lớn hơn 0!!');

            return redirect(route('book.insert-amount'));
        }else{
        $Collection = collect([$amount, $amount2])->sum();
        $book->Amount = $Collection;
        $book->save();
        
         session()->flash('success', 'Nhập sách thành công!!');
         return redirect(route('book.insert-amount'));
        }
     }

  //Phiếu phát   
    public function mainBill(Request $request){
        $IdClass = $request->get('Id_Class');
        $listClassroom = classroom::where('classroom.availabel', 1)
                            ->get();
        $listMainBill = MainBill::where('billmain.Id_Class', $IdClass)
                                 ->where('availabel', 1)
                                  ->orderBy('Status')
                                  ->get();  
        return view('book.main-bill',[
            'listMainBill' => $listMainBill,
            'listClassroom' => $listClassroom,
            'IdClass' => $IdClass
        ]);
    }
//thêm phiếu
     public function createBill(Request $request){
        $listBook = book::all();
        $listClassroom = classroom::all();
        $IdClass = $request->get('Id_Class');
        $listStudent = student::where("Id_Class", "=", $IdClass)->get();

        return view('book.createBill',[
            'listBook' => $listBook,
            'listClassroom' => $listClassroom,
            'IdClass' => $IdClass,
            'listStudent' => $listStudent
        ]);
     }

     public function createBillProcess(Request $request){
        $mydate = new DateTime();
        $mydate->modify('+7 hours');
        $curentDate = $mydate->format('Y-m-d,H-i-s');  
        
         $idClass = $request->get('idClass');
        $MainBill = new MainBill();
        $MainBill->Id_Class = $idClass;
        $MainBill->Time = $curentDate;
        $MainBill->Status = 0;
        $MainBill->availabel = 1;
        $MainBill->save(); 


         $IdMainBill = DB::table('billmain')->orderBy('Id_Bill_Main', 'desc')->first();
         $IMB = $IdMainBill->Id_Bill_Main;
         $student = DB::table('student')->where('Id_Class', '=', $idClass)->get(); 
         $IdBook = $request->get('Id_Book');
         $status = $request->get('Status');
         foreach ($student as $student) {                 
                if($student->Id_Student != null){
                    $status = $_REQUEST[$student->Id_Student];
                    
                        $Bill = new Bill();
                        $Bill->Id_Book = $IdBook;
                        $Bill->Id_Bill_Main = $IMB;
                        $Bill->Status = $status;
                        $Bill->Id_Student = $student->Id_Student;
                        $Bill->save(); 
                }
            }
               
                     

        session()->flash('success', 'Tạo phiếu thành công!!');
        return redirect(route('book.main-bill'));
     }
//xóa phiếu
     public function deleteMainBill($id){
        $mainBill = MainBill::find($id);
        $mainBill->availabel = 0;
        $mainBill->save();

        session()->flash('success', 'Xóa phiếu thành công!!');
        return redirect(route('book.main-bill'));        
     }
//Sửa phiếu
    public function updateBill(Request $request, $id){
        $status = $request->get('statusName');
        $bill = bill::find($id);

        if ($status == 0) {
            $bill->Status = 1;
        } 
        
        $bill->save();
        $idBill = bill::where("Id_Bill",$id)->get();
        foreach($idBill as $idBill){
            $IdmainBill = $idBill->Id_Bill_Main;
        }
        
        // dd($IdMainBill);
        $mainBill = MainBill::find($IdmainBill); 
        $listBill = bill::where("bill.Id_Bill_Main", $IdmainBill)
                          ->join("student", "bill.Id_Student", "=", "student.Id_Student")  
                          ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                          ->get();
        $countStatus =  bill::where("bill.Id_Bill_Main", $IdmainBill)
                          ->join("student", "bill.Id_Student", "=", "student.Id_Student")  
                          ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                          ->where("status",1)
                          ->count();  
        $countStudent =  bill::where("bill.Id_Bill_Main", $IdmainBill)
                          ->join("student", "bill.Id_Student", "=", "student.Id_Student")  
                          ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                          ->count();
        session()->flash('success', 'Sửa thành công!!');
        return view('book.handing-out', [
          
            'mainBill' => $mainBill,  
            'listBill' => $listBill,
            'countStatus' => $countStatus,
            'countStudent' => $countStudent         
        ]);
    }     

//Phát sách
     public function handingOut($id){   
       $mainBill = MainBill::find($id);                       
      
        
        $listBill = bill::where("bill.Id_Bill_Main", $id)
                          ->join("student", "bill.Id_Student", "=", "student.Id_Student")  
                          ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                          ->get();
        $countStatus =  bill::where("bill.Id_Bill_Main", $id)
                          ->join("student", "bill.Id_Student", "=", "student.Id_Student")  
                          ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                          ->where("status",1)
                          ->count();  
        $countStudent =  bill::where("bill.Id_Bill_Main", $id)
                          ->join("student", "bill.Id_Student", "=", "student.Id_Student")  
                          ->join("book", "bill.Id_Book", "=", "book.Id_Book")
                          ->count();
        // dd($countStudent);                
        return view('book.handing-out', [
          
            'mainBill' => $mainBill,  
            'listBill' => $listBill,
            'countStatus' => $countStatus,
            'countStudent' => $countStudent         
        ]);
     }

     public function handingOutProcess(Request $request, $id){
            $mydate = new DateTime();
            $mydate->modify('+7 hours');
            $curentDate = $mydate->format('Y-m-d,H-i-s');

            $idClass = $request->get('Id_Class');
            $student = DB::table('student')->where('Id_Class', '=', $idClass)->get(); 

            $IdBook = $request->get('Id_Book');
            $amountBook = $request->get('amountBook');
            $bill = DB::table('bill')->get();

            $countAmount = collect($student)->count();
            
           
            if($amountBook >= $countAmount){
              foreach ($student as $student) {

                if($student->Id_Student != null){
                    $status = $_REQUEST[$student->Id_Student];
                    // if($status == 0){
                    //     session()->flash('danger', 'Vẫn còn sinh viên chưa đăng ký!!');
                    //     return redirect(route('book.main-bill'));
                    // }
                    if($status == 1){
                        $Bill = new BillHO();
                        $Bill->Id_Book = $IdBook;
                        $Bill->id_Class = $idClass;
                        $Bill->Id_Student = $student->Id_Student;
                        $Bill->Time = $curentDate;
                        $Bill->save();                             
                    }  
                }  
            }
             //Trừ số lượng sách khi phát
             $amountBookAF = $amountBook - $countAmount;
             $BookAF = book::find($IdBook);
             $BookAF->Amount = $amountBookAF;
             $BookAF->save();   
              
             //Đổi trạng thái phiếu sau khi phát sách   
             $mainBill = MainBill::find($id);
             $statusMain = $request->get('statusMainBill');
           
            if($statusMain == 0){ 
                $mainBill->Status = 1;
            }
            
            $mainBill->save();

           
        session()->flash('success', 'Phát sách thành công!!');
        return redirect(route('book.main-bill'));
    

        }
        session()->flash('danger', 'Số lượng sách không đủ!!');
        return redirect(route('book.main-bill'));
   }
}
