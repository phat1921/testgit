@extends('layout.app')
@section('content')
	<div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
             <i class="material-icons">assignment</i>
         </div>
             <div class="card-content">
                 <h4 class="card-title">Danh sách khóa</h4>
                  <div class="table-responsive">
	
	<form class="navbar-form navbar-right" style="margin-right: 0px" role="search">
        <div class="form-group form-search is-empty">
            <input type="text" class="form-control" placeholder=" Search " value="{{ $search }}" name="search">
            <span class="material-input"></span>
        </div>
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
            </button>
    </form>
    <a class="btn btn-fill btn-rose" href="{{ route('course.create') }}">Thêm Khóa</a>
	<table class="table">
		 <thead class="text-primary">
			<th>Mã</th>
			<th>Tên khóa</th>
		</thead>

		@foreach ($listCourse as $course)
			<tr>
				<td >{{ $course->Id_Course }}</td>
				<td>{{ $course->Name_Course }}</td>
				<td></td>
				<td>
					<a class="btn btn-sm btn-fill btn-success" title="Sửa" href="{{ route('course.edit', $course->Id_Course) }}">
						<i class="material-icons">edit</i>
					</a>
					<a class="btn btn-sm btn-fill btn-danger" title="Ẩn" href="{{ route('course.hide', $course->Id_Course) }}">
						<i class="material-icons">close</i>
					</a>
				</td>
			</tr>
		@endforeach
	</table>
	{{ $listCourse->appends([[
		'search' =>$search,
		]])->links('pagination::bootstrap-4') }}

		</div>
	</div>
</div>
@endsection