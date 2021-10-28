@extends('layout.app')
@section('content')

<div class="col-md-10 ">
	<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Nhập Sách</h4>			
				<table class="table">
					<thead class="text-primary">
						<th>Sách</th>
						<th>Số Lượng</th>
						<th style="text-align:left">
							<form class="navbar-form" >
								<div class="form-group form-search is-empty">

								<select name="Id_Subject" class="selectpicker" data-style="select-with-transition"  title="Chọn môn">
									@foreach ($listSubject as $subject)
										<option value="{{ $subject->Id_Subject }}"
											@if ($subject->Id_Subject == $IdSubject)
												{{"selected"}}
											@endif
										>{{ $subject->Name_Subject  }}</option>
									@endforeach	
											
								</select>
							</div>
								<button type="submit" class="btn btn-white btn-round btn-just-icon">
           							 <i class="material-icons">search</i>
          					 		 <div class="ripple-container"></div>
          					 	</button>
          					 </form>
          				</th>
					</thead>
						@foreach ($listBook as $book)	
					<tr>
						<td>{{ $book->Name_Book  }}</td>
						<td>{{ $book->Amount  }}</td>
						<td>
							<a class="btn btn-sm btn-fill btn-rose" href="{{ route('book.show', $book->Id_Book) }}" title="Nhập sách">
								<i class="material-icons ">add</i>
							</a>
							{{-- <a class="btn btn-sm btn-fill btn-rose" href="{{ route('book.handing-out', $book->Id_Subject) }}"  title="Phát sách">
								<i class="material-icons ">north_east</i>
							</a> --}}
						</td>			
					</tr>
					@endforeach
				</table>				
        </div>
    </div>    
</div>

@endsection

