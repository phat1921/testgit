@extends('layout.app')
@section('content')

	<div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
             <i class="material-icons">assignment</i>
         </div>
             <div class="card-content">
                 <h4 class="card-title">Thêm bằng Excel</h4>
                 (Họ tên, Giới tính, Ngày sinh, Email, Số đt, Lớp học)
                  <div class="table-responsive">
                  	<form action="{{ route('student.insert-excel-process') }}" method="post" enctype="multipart/form-data" >
                  		@csrf
                  		<input type="file" name="excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                  		<button type="submit" class="btn btn-fill btn-rose">Thêm</button>
                  	</form>
				  </div>
			 </div>
		 		 	  
	</div>

@endsection