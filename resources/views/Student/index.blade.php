@extends('layout.app')
@section('content')
	<div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
             <i class="material-icons">assignment</i>
         </div>
             <div class="card-content">
                 <h4 class="card-title">Danh sách sinh viên</h4>
                  <div class="table-responsive">
	<a class="btn btn-fill btn-rose" href="{{ route('student.create') }}">Thêm Sinh Viên</a>
	<a class="btn btn-fill btn-rose" href="{{ route('student.insert-excel') }}">Thêm bằng Excel</a>

	<form class="navbar-form navbar-right" style="margin-right: 0px">
	<div class="form-group form-search is-empty">
		<select name="Id_Class" class="selectpicker" data-style="select-with-transition" title="Chọn lớp" data-size="4">
			@foreach ($listClassroom as $classroom)
				<option value="{{ $classroom->Id_Class }}"
					@if ($classroom->Id_Class == $IdClass)
						{{ "selected" }}
					@endif
					>{{ $classroom->Name_Class  }}</option>
			@endforeach
			
		</select>
	</div>	
		<button type="submit" class="btn btn-white btn-round btn-just-icon">
            <i class="material-icons">search</i>
            <div class="ripple-container"></div>
        </button>
	</form>

	<table class="table">
		<thead class="text-primary">
			<th>Mã</th>
			<th>Họ Tên</th>
			<th>Lớp Học</th>
			<th>Giới Tính</th>
			<th>Ngày Sinh</th>
			<th>Email</th>
			<th>Số ĐT</th>
			
		</thead>

		@foreach ($listStudent as $student)
			<tr>
				<td>{{ $student->Id_Student }}</td>
				<td>{{ $student->Name_Name }}</td>
				<td>{{ $student->Name_Class }}</td>
				<td>{{ $student->GenderName }}</td>
				<td>{{ $student->DoB }}</td>
				<td>{{ $student->Email }}</td>
				<td>{{ $student->Phone_Number }}</td>	
				<td></td>
				<td>
					<a class="btn btn-sm btn-fill btn-success" title="Sửa" href="{{ route('student.edit', $student->Id_Student) }}">
						<i class="material-icons">edit</i>
					</a>
					<a class="btn btn-sm btn-fill btn-rose" title="Ẩn" href="{{ route('student.hide', $student->Id_Student) }}">
						<i class="material-icons">close</i>
					</a>
				</td>
			</tr>
		@endforeach
	</table>
					</div>
				</div>
	</div>		
@endsection