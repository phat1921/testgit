@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Thêm lớp</h4>
	
	<form action="{{ route('classroom.store') }}" method="post" class="form-horizontal">
		<div class="row">
		@csrf

		<label class="col-md-3 label-on-left">Tên lớp:</label>
		<div class="col-md-9">
            <div class="form-group label-floating is-empty">
                 <label class="control-label"></label>
                 <input type="text" class="form-control" name="name" required>
            </div>
        </div>

        <label class="col-md-3 label-on-left">Khóa học:</label>            
        <div class="col-md-3">
           <select class="selectpicker" data-style="btn btn-primary btn-round" title="Chọn khóa học" name="Name_Course" required>
                    @foreach ($listCourse as $course)
						<option value="{{ $course->Id_Course }}">{{ $course->Name_Course }}</option>
					@endforeach
            </select>
        </div>

		<label class="col-md-9 label-on-left"></label>
		<label class="col-md-3 label-on-left">Môn học:</label>            
        <div class="col-md-3">
           <select class="selectpicker" data-style="btn btn-primary btn-round" title="Chọn môn học" name="Name_Subject" required>
                    @foreach ($listSubject as $subject)
						<option value="{{ $subject->Id_Subject }}">{{ $subject->Name_Subject }}</option>
					@endforeach
            </select>
        </div>

		<div class="row">
            <label class="col-md-3"></label>
                <div class="col-md-9" style="left: 400px">
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