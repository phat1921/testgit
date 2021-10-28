@extends('layout.app')
@section('content')

	<div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
             <i class="material-icons">assignment</i>
         </div>
             <div class="card-content">
                 <h4 class="card-title">Danh sách Sinh Viên Đăng ký Mua Sách</h4>
                  <div class="table-responsive">
                  	
                  	<form action="{{ route('book.handing-out-process', $mainBill->Id_Bill_Main) }}" class="form-horizontal" method="post">
                  		@csrf
                  		<input type="text" name="statusMainBill" value="{{ $mainBill->Status }}" hidden>
                  		<table class="table">
                  			<thead class="text-primary">
								<th>Tên Sinh Viên</th>
								<th>Tên Sách</th>
								<th>Tình Trạng</th>
							</thead>
							@foreach ($listBill as $bill)
							<tr>
								<td>{{ $bill->Name_Name }}<input type="text" name="Id_Student" value="{{ $bill->Id_Student }}" hidden></td>
								
								<td>
									{{ $bill->Name_Book }}
									<input type="text" name="Id_Book" value="{{ $bill->Id_Book }}" hidden>
									<input type="text" name="amountBook" value="{{ $bill->Amount }}" hidden>
								</td>

								<td>{{ $bill->StatusName }}<input type="text" id="statusName" name="{{ $bill->Id_Student }}" value="{{ $bill->Status }}" hidden></td>

								<td><input type="text" name="Id_Class" value="{{ $bill->Id_Class }}" hidden></td>
								@if($bill->Status == 0)
								<td>
									<a class="btn btn-sm btn-fill btn-success" title="Sửa" href="{{ route('book.update-bill', $bill->Id_Bill) }}">
										<i class="material-icons">edit</i>
									</a>
								</td>
								@endif	
							</tr>
							@endforeach
                  		</table>
    					@if( $mainBill->Status  == 0 && $countStudent == $countStatus)
          		 		<label class="col-md-10"></label>
              		 		<div class="col-md-1" >
                   	 		<div class="form-group form-button">
                       			<button type="submit" class="btn btn-fill btn-rose">Phát sách</button>
                   			</div>
                	   		</div>
       					@endif
                  	</form>	
                  </div>
             </div>
    </div>    	
@endsection