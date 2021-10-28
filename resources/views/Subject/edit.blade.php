@extends('layout.app')
@section('content')
<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Cập nhật môn học</h4>

	<form action="{{ route('subject.update', $subject->Id_Subject) }}" method="post" class="form-horizontal">
		<div class="row">
		@csrf
		@method('PUT')

		<label class="col-md-3 label-on-left">Tên môn học:</label>
		<div class="col-md-9">
            <div class="form-group label-floating is-empty">
                 <label class="control-label"></label>
                 <input type="text" class="form-control" name="name" value="{{ $subject->Name_Subject }}">
            </div>
        </div>

        <div class="row">
            <label class="col-md-3"></label>
                 <div class="col-md-9">
                        <div class="form-group form-button">
                            <button type="submit" class="btn btn-fill btn-rose">Cập nhật</button>
                        </div>
                 </div>
        </div>	
	</div>
	</form>
		</div>
</div>	
@endsection