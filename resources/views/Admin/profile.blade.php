@extends('layout.app')
@section('content')

<div class="col-md-10 ">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="rose">
            <i class="material-icons">perm_identity</i>
        </div>
        
        <div class="card-content">
            <h4 class="card-title">Profile</h4>
                @if (Session::exists('idAd') || Session::exists('iduser') )
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group label-floating">
                            <label class="control-label">Họ Tên</label>
                            <h1 class="form-control" >{{ Session::get('namead') }} {{Session::get('nameuser')  }}</h1>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group label-floating">
                            <label class="control-label">Giới tính</label>
                            <h1 class="form-control">
                                
                                @if (Session::get('genderad')  == '1' || Session::get('genderuser') == '1')
                                    Nam
                                @else
                                    Nữ
                                @endif
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="control-label">Ngày sinh</label>
                            <h1 class="form-control" >{{ Session::get('DoBad') }} {{Session::get('DoBuser')  }}</h1>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Số điện thoại</label>
                            <h1 class="form-control" >{{ Session::get('phonead') }} {{Session::get('phoneuser')  }}</h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Email</label>
                            <h1 class="form-control" >{{ Session::get('emailad') }} {{Session::get('emailuser')  }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Adress</label>
                            <h1 class="form-control" >{{ Session::get('addressad') }} {{Session::get('addressuser')  }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group label-floating">
                            <label class="control-label">Chức vụ</label>
                            <h1 class="form-control">
                                
                                @if (Session::get('idAd'))
                                    Quản lý
                                @else
                                    Giáo vụ
                                @endif
                            </h1>
                        </div>
                    </div>
                </div>
                 @endif                         
            </div>
        </div>       
                                   
    </div>


                      
@endsection                        