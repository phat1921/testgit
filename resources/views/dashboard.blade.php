@extends('layout.app')
@section('content')
    <div class="row">
           <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">weekend</i>
                    </div>
                        <div class="card-content">
                            <p class="category">Sinh viên chưa đăng ký</p>
                            <h3 class="card-title" style="padding-right:50px">{{ $stunNotDone }}</h3>
                        </div>
                                
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="rose">
                         <i class="material-icons">equalizer</i>
                    </div>
                        <div class="card-content">
                            <p class="category">Sinh Viên được phát</p>
                            <h3 class="card-title" style="padding-right:50px">{{ $stunDone }}</h3>
                        </div>
                                
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">store</i>
                    </div>
                        <div class="card-content">
                            <p class="category">Tổng sách</p>
                            <h3 class="card-title" style="padding-right:50px">{{ $sum_book }}</h3>
                        </div>
                              
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="fa fa-twitter"></i>
                    </div>
                        <div class="card-content">
                            <p class="category">Đơn chưa phát</p>
                            <h3 class="card-title">{{ $billNotDone }}</h3>
                        </div>   
                </div>
            </div>                                 
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">account_box</i>
            </div>
            <div class="card-content" >
                <h4 class="card-title"> Danh sách Sinh Viên đã được phát sách</h4>
                <form action="{{ route('export-excel-process2') }}" method="POST" >
                  @csrf
                     <input type="submit" value="Exports"  class="table-responsive ">
                 </form>
                <div class="row">
                    
                        <table class="table" >
                            <thead class="text-primary">
                                <th>Tên sinh viên</th>
                                <th>Lớp</th>
                                <th>Sách</th>
                                <th>Ngày phát</th>
                            </thead>

                           @foreach ($listBillHO as $billho)
                            <tr>
                                <td>{{ $billho->Name_Name }}</td>
                                <td>{{ $billho->Name_Class }}</td>
                                <td>{{ $billho->Name_Book }}</td>
                                <td>{{ $billho->Time }}</td>   
                            </tr>
                           @endforeach
                        </table>
                   {{-- {{ $listBillHO->appends(0)->links('pagination::bootstrap-4') }} --}}

                    
                </div>

            </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">account_box</i>
                </div>

                <div class="card-content" >
                <h4 class="card-title">Danh sách Sinh Viên chưa đăng ký mua sách</h4>
                <form action="{{ route('export-excel-process') }}" method="POST" >
                  @csrf
                     <input type="submit" value="Exports"  class="table-responsive ">
                 </form>
                <div class="row">
                   
                        <table class="table" >
                            <thead class="text-primary">
                                <th>Tên sinh viên</th>
                                <th>Lớp</th>
                                <th>Sách</th>
                            </thead>

                           @foreach ($listBill as $bill)
                            <tr>
                                <td>{{ $bill->Name_Name }}</td> 
                                <td>{{ $bill->Name_Class }}</td>
                                <td>{{ $bill->Name_Book }}</td>   
                            </tr>
                           @endforeach
                        </table>
                   {{-- {{ $listBill->appends(0)->links('pagination::bootstrap-4') }} --}}

                    
                </div>

            </div>

            </div>   
        </div>   
    </div>
        
               
        @endsection    
            