@extends('layout.app')
@section('content')
	<div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
             <i class="material-icons">assignment</i>
         </div>
             <div class="card-content">
                 <h4 class="card-title">Danh sách AD</h4>
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
	<a class="btn btn-fill btn-rose" href="{{ route('admin.create') }}">Thêm AD</a>
	<table class="table">
		<thead class="text-primary">
			<th>Mã</th>
			<th>Tên AD</th>
			<th>Ngày Sinh</th>
			<th>Giới Tính</th>
			<th>Số ĐT</th>
			<th>Địa Chỉ</th>
			<th>Email</th>
			<th>Tên Đăng Nhập</th>
			<th>Mật Khẩu</th>
			<th>Chức Vụ</th>	
		</thead>
		@foreach ($listAdmin as $admin)
			<tr>
				<td>{{ $admin->Id_Admin }}</td>
				<td>{{ $admin->Name_Admin }}</td>
				<td>{{ $admin->DoB }}</td>
				<td>{{ $admin->GenderName }}</td>
				<td>{{ $admin->Phone_Number }}</td>
				<td>{{ $admin->Address }}</td>
				<td>{{ $admin->Email }}</td>
				<td>{{ $admin->User_Name }}</td>
				<td>{{ $admin->PassWord }}</td>
				<td>{{ $admin->RoleName }}</td>
				<td></td>
				<td>
					<a class="btn btn-sm btn-fill btn-success" title="Sửa" href="{{ route('admin.edit', $admin->Id_Admin) }}">
						<i class="material-icons">edit</i>
					</a>
					<a class="btn btn-sm btn-fill btn-danger" title="Ẩn" href="{{ route('admin.hide', $admin->Id_Admin) }}">
						<i class="material-icons">close</i>
					</a>
				</td>
			</tr>
		@endforeach
	</table>
	{{ $listAdmin->appends([
		'search' => $search
		])->links('pagination::bootstrap-4') }}
			</div>
	</div>
</div>
@endsection