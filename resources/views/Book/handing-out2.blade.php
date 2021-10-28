{{-- @extends('layout.app')
@section('content')

<script type="text/javascript">
    function toggle_check(){
        var checkboxes = document.getElementsByName('Id_Student');
        var checkbox = document.getElementById('toggle');

        if (checkbox.value == 'select'){
            for(var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            checkbox.value = 'Deselect'
        }
        else{
            for(var i in checkboxes){
                checkboxes[i].checked = '';
            }
            checkbox.value = 'select'
        }
    }
</script>



<div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">contacts</i>
    </div>
        <div class="card-content">
            <h4 class="card-title">Phát Sách</h4>   

            <form>
                    <select  id="Id_Subject" name="Id_Subject" class="selectpicker choosen Id-Subject" data-style="select-with-transition" title="Chọn Môn học">
                        @foreach ($listSubject as $subject)
                            <option value="{{ $subject->Id_Subject }}"
                                @if ($subject->Id_Subject == $IdSubject)
                                          {{"selected"}}
                                 @endif
                                >{{ $subject->Name_Subject }}</option>
                        @endforeach
                    </select>    
                
                    <button  type="submit" class="btn btn-white btn-round btn-just-icon">
                          <i class="material-icons">search</i>
                         <div class="ripple-container"></div>
                     </button>
            </form>        
            <form action="{{ route('book.handing-out-process') }}" method="post" class="form-horizontal">
               @csrf
                <div class="col-lg-3 col-md-6 col-sm-3" style="margin-left: 200px">
                    

                    <select  name="Id_Book" class="selectpicker " data-style="select-with-transition" multiple title="Chọn sách">
                       @foreach ($listBook as $book)
                            <option value="{{ $book->Id_Book }}">{{ $book->Name_Book }}</option>
                        @endforeach
                    </select>
                </div>
            
                <table class="table">
                    <thead class="text-primary">
                        <th>Sinh viên</th>
                        <th>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="select" onclick="toggle_check()" id="toggle">
                                </label>
                            </div>  
                        </th>
                    </thead>
                        @foreach ($listStudent as $student)
                            <tr>  
                                <td>{{ $student->Name_Name }}</td>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                           <input type="checkbox" name="Id_Student" value="{{ $student->Id_Student }}">
                                        </label>
                                    </div>
                                </td>
                            </tr>    
                        @endforeach    
                </table> 

                <div class="row">
                  <label class="col-md-9"></label>
                      <div class="col-md-3" >
                        <div class="form-group form-button">
                            <button type="submit" class="btn btn-fill btn-rose">Phát sách</button>
                         </div>
                       </div>
                </div>

            </form>       
        </div>
         
</div>

@endsection     --}}