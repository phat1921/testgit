@extends('layout.app')
@section('content')
<div class="card">
	<div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">assignment</i>
    </div>
    	<div class="card-content">
			<h4 class="card-title">Danh sách lớp</h4>
				<div class="table-responsive">
		<a class="btn btn-fill btn-rose" href="{{ route('classroom.create') }} ">Thêm Lớp</a>

	<form class="navbar-form navbar-right" style="margin-right: 0px">
	<div class="form-group form-search is-empty">
		<select name="Id_Course" class="selectpicker" data-style="select-with-transition" title="Chọn khóa" data-size="4">
			@foreach ($listCourse as $course)
				<option value="{{ $course->Id_Course }}"
						@if ($course->Id_Course == $IdCourse)
							{{"selected"}}
						@endif
					>{{ $course->Name_Course  }}</option>
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
			<th>Tên Lớp</th>
			<th>Khóa</th>
			<th>Môn học</th>
		</thead>

		@foreach ($listClassroom as $classroom)
			<tr>
				<td>{{ $classroom->Id_Class }}</td>
				<td>{{ $classroom->Name_Class }}</td>
				<td>{{ $classroom->Name_Course }}</td>
				<td>{{ $classroom->Name_Subject }}</td>
				<td></td>
				<td>
					<a class="btn btn-sm btn-fill btn-success" title="Sửa" href="{{ route('classroom.edit', $classroom->Id_Class) }}">
						<i class="material-icons">edit</i>
					</a>
					<a class="btn btn-sm btn-fill btn-danger" title="Ẩn" href="{{ route('classroom.hide', $classroom->Id_Class) }}">
						<i class="material-icons">close</i>	
					</a>
				</td>
			</tr>
		@endforeach
	</table>
	{{ $listClassroom->links('pagination::bootstrap-4') }}
		</div>
	</div>
</div>
@endsection