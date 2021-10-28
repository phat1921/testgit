@extends('layout.app')
@section('content')

	<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Tạo Phiếu Đăng kí</h4>
            <div class="row">
            	<form >
            		<label class="col-md-2 label-on-left">Lớp:</label>
						<div class="col-md-3">
						<select name="Id_Class" class="selectpicker" data-style="btn btn-primary btn-round" title="Chọn lớp" data-size="4" required>
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

                </div>	

                <div class="row">	
                	<form action="{{ route('book.create-bill-process') }}" method="post">
                		@csrf
            		<label class="col-md-2 label-on-left">Sách:</label> 
        			<div class="col-md-3">
        			   <select class="selectpicker" data-style="btn btn-primary btn-round" title="Chọn sách" name="Id_Book" required>
                    		@foreach ($listBook as $book)
								<option value="{{ $book->Id_Book }}">{{ $book->Name_Book }}</option>
							@endforeach
            			</select>
        			</div>
        		</div>

        			<table class="table">
                  			<thead class="text-primary">
								<th>Tên Sinh Viên</th>
								<th width="100px">Đăng ký </th>
								<th>Chưa Đăng ký</th>
							</thead>
							@foreach ($listStudent as $student)
							<tr>
								<td>{{ $student->Name_Name }}<input type="text" name="Id_Student" value="{{ $student->Id_Student }}" hidden></td>		
								<td>
									<input type="radio" id="status" checked name="{{ $student->Id_Student }}" value="1">
								</td>
								<td>
									<input type="radio" id="status" name="{{ $student->Id_Student }}" value="0">
								</td>
								
								
								<td><input type="text" name="idClass" value="{{ $IdClass }}" hidden></td>
							</tr>
							@endforeach
                  		</table>

                  		<div class="row">
            
                <div class="col-md-2" style="margin-left: 800px" >
                    <div class="form-group form-button">
                        <button type="submit" class="btn btn-fill btn-rose">Tạo phiếu</button>
                    </div>
                </div>
        </div>
            	</form>
     	</div>
	</div>	


@endsection
