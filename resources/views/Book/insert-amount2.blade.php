@extends('layout.app')
@section('content')

<div class="col-md-10 ">
	<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Nhập Sách</h4>

            <form action="{{ route('book.insert-amount-process', $book->Id_Book) }}" method="post" class="form-horizontal">
				<div class="row">
					@csrf
					
					<label class="col-md-3 label-on-left">Tên sách:</label>
						<div class="col-md-3">
       			     	<div class="form-group label-floating is-empty">
                			 <label class="control-label"></label>
                			 <input type="text" class="form-control" value="{{ $book->Name_Book }}" readonly="readonly">
           				 </div>
       					 </div>

       					 <label class="col-md-2 label-on-left">Số lượng trong kho:</label>
							<div class="col-md-1">
           					<div class="form-group label-floating is-empty">
                				 <label class="control-label"></label>
                				 <input type="number" class="form-control" name="amountstrorage" value="{{ $book->Amount }}" readonly="readonly">
           					</div>
        					</div>

        				<label class="col-md-2 label-on-left">Số lượng:</label>
							<div class="col-md-1">
           					<div class="form-group label-floating is-empty">
                				 <label class="control-label"></label>
                				 <input type="number" class="form-control" name="amount2"  required>
           					</div>
        					</div>	
				</div>

				<div class="row">
          		  <label class="col-md-9"></label>
              		  <div class="col-md-3" >
                   	 	<div class="form-group form-button">
                       		<button type="submit" class="btn btn-fill btn-rose">Nhập</button>
                   		 </div>
                	   </div>
        		</div>
			</form>		
        </div>
    </div>
</div>            
@endsection