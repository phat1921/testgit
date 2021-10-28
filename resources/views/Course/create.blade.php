@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Thêm Khóa</h4>
	
	<form action="{{ route('course.store') }}" method="post" class="form-horizontal">
		<div class="row">
                    
	@csrf
	<label class="col-md-3 label-on-left">Tên khóa:</label>
		<div class="col-md-9">
            <div class="form-group label-floating is-empty">
                 <label class="control-label"></label>
                 <input type="text" class="form-control" name="name" required>
            </div>
        </div>
		<div class="row">
            <label class="col-md-3"></label>
                 <div class="col-md-9">
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