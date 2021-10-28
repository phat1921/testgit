@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Thêm sinh viên</h4>
	
	<form action="{{ route('student.store') }}" method="post" class="form-horizontal">
		<div class="row">
		@csrf

		<label class="col-md-3 label-on-left">Họ Tên:</label>
		<div class="col-md-9">
            <div class="form-group label-floating is-empty">
                 <label class="control-label"></label>
                 <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <label class="col-md-3 label-on-left">Lớp học:</label>            
        <div class="col-md-3">
           <select class="selectpicker" data-style="btn btn-primary btn-round" title="Chọn lớp" name="Name_Class" required>
                    @foreach ($listClassroom as $classroom)
						<option value="{{ $classroom->Id_Class }}">{{ $classroom->Name_Class }}</option>
					@endforeach
            </select>
        </div>

        <label class="col-md-9 label-on-left"></label>
		<label class="col-md-3 label-on-left">Giới tính:</label>            
        <div class="col-md-3">
           <select class="selectpicker" data-style="btn btn-primary btn-round" title="Chọn Giới tính" name="gender" required>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
            </select>
        </div>

<label class="col-md-9 label-on-left"></label>
        <label class="col-md-3 label-on-left">Ngày sinh:</label>
        <div class="col-md-9">
        	<div class="form-group label-floating is-empty">
     			<label class="label-control"></label>
        		<input type="date" class="form-control datepicker" name="DoB" required />
        	</div>
        </div>

        <label class="col-md-3 label-on-left">Email:</label>
		<div class="col-md-9">
            <div class="form-group label-floating is-empty">
                 <label class="control-label"></label>
                 <input type="text" class="form-control" name="email" required>
            </div>
        </div>
		
		<label class="col-md-3 label-on-left">Số ĐT:</label>
		<div class="col-md-9">
            <div class="form-group label-floating is-empty">
                 <label class="control-label"></label>
                 <input type="number" class="form-control" name="phone" required>
            </div>
        </div>

		<div class="row">
            <label class="col-md-3"></label>
                <div class="col-md-9" >
                    <div class="form-group form-button">
                        <button type="submit" class="btn btn-fill btn-rose">Thêm</button>
                    </div>
                </div>
        </div>
		
		</div>	
	</form>

			</div>
</div>	
@endsection