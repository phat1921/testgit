@extends('layout.app')
@section('content')

	<div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
             <i class="material-icons">assignment</i>
         </div>
             <div class="card-content">
                 <h4 class="card-title">Danh sách Sinh Viên Đăng ký Mua Sách</h4>
                  <div class="table-responsive">
                  	<a class="btn btn-fill btn-rose" href="{{ route('book.create-bill') }}">Thêm phiếu đăng kí</a>
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
								<th>Ngày tạo phiếu</th>
							
							</thead>
							@foreach ($listMainBill as $mainBill)
							<tr>
								<td>{{ $mainBill->Time }}<input type="text" name="Id_Bill_Main" value="{{ $mainBill->Id_Bill_Main }}" hidden></td>
								
								<td>{{ $mainBill->StatusName }}</td>
								<td>
									<a class="btn btn-sm btn-fill btn-success" title="Xem" href="{{ route('book.handing-out', $mainBill->Id_Bill_Main) }}">
										<i class="material-icons">art_track</i>
									</a>
									<a class="btn btn-sm btn-fill btn-danger" title="Ẩn" href="{{ route('book.delete-main-bill', $mainBill->Id_Bill_Main) }}">
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