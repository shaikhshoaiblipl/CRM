@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        {!! Form::open(['method' => 'POST','files'=>true,'route' => ['admin.users.update',$user->id],'class' => 'form-horizontal','id' => 'frmUser']) !!}
            @method('PUT')
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <div class="form-group {{$errors->has('role_id') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                <label class="col-md-3 control-label" for="role_id">Roles <span style="color:red">*</span></label>
                <div class="col-md-6">
                    {!! Form::select('role_id[]', $roles, old('role_id', $user->roles->pluck('id')), ['class' => 'form-control','id'=>'role_id','title'=>'Select Type', 'data-error-container'=>'#role_id-errors']) !!}
                    @if($errors->has('role_id'))
                    <strong for="role_id" class="help-block">{{ $errors->first('role_id') }}</strong>
                    @endif
                    <span id="role_id-errors"></span>
                </div>
            </div>
            <div class="form-group {{$errors->has('name') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                <label class="col-md-3 control-label" for="name">Name <span style="color:red">*</span></label>
                 <div class="col-md-6">
                    {!! Form::text('name', old('name',$user->name), ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                    @if($errors->has('name'))
                    <strong for="name" class="help-block">{{ $errors->first('name') }}</strong>
                    @endif
                </div>
            </div>
            
            <div class="form-group {{$errors->has('email') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                <label class="col-md-3 control-label" for="email">Email <span style="color:red">*</span></label>
                <div class="col-md-6">
                    {!! Form::text('email',old('email',$user->email), ['class' => 'form-control autoFillOff', 'placeholder' => 'Email']) !!}
                    @if($errors->has('email'))
                    <strong for="email" class="help-block">{{ $errors->first('email') }}</strong>
                    @endif
                </div>
            </div>
            <div class="form-group {{$errors->has('mobile_number') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                <label class="col-md-3 control-label" for="mobile_number">Mobile Number <span style="color:red">*</span></label>
                <div class="col-md-6">
                    {!! Form::text('mobile_number',old('mobile_number',$user->mobile_number), ['class' => 'form-control autoFillOff', 'placeholder' => 'Mobile Number']) !!}
                    @if($errors->has('mobile_number'))
                    <strong for="mobile_number" class="help-block">{{ $errors->first('mobile_number') }}</strong>
                    @endif
                </div>
            </div>

            <div class="form-group {{$errors->has('employee_id') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                <label class="col-md-3 control-label" for="employee_id">Employee Id <span style="color:red">*</span></label>
                <div class="col-md-6">
                    {!! Form::text('employee_id',old('employee_id',$user->employee_id), ['class' => 'form-control autoFillOff', 'placeholder' => 'Employee Id']) !!}
                    @if($errors->has('employee_id'))
                    <strong for="employee_id" class="help-block">{{ $errors->first('employee_id') }}</strong>
                    @endif
                </div>
            </div>

            <div class="form-group">
                 <div class="col-md-6">
                    <label>
                        {{Form::checkbox('reset_password', TRUE, null,['id'=>'reset_password'])}}
                        {{ __('Reset Password') }}
                    </label>
                </div>
            </div>

            <div  id="password_container">
                <div class="form-group {{$errors->has('password') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                    <label class="col-md-3 control-label" for="password">New Password <span style="color:red">*</span></label>
                    <div class="col-md-6">
                        {!! Form::password('password',['class' => 'form-control autoFillOff', 'placeholder' => 'New Password', 'id'=>'password']) !!}
                        @if($errors->has('password'))
                        <strong for="password" class="help-block">{{ $errors->first('password') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="form-group {{$errors->has('password_confirmation') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                    <label class="col-md-3 control-label" for="password_confirmation">Confirm Password <span style="color:red">*</span></label>
                    <div class="col-md-6">
                        {!! Form::password('password_confirmation', ['class' => 'form-control autoFillOff', 'placeholder' => 'Confirm Password']) !!}
                        @if($errors->has('password_confirmation'))
                        <strong for="password_confirmation" class="help-block">{{ $errors->first('password_confirmation') }}</strong>
                        @endif
                    </div>
                </div>
            </div>

            @php $profile_picture = $user->profile_picture; @endphp
            @if(isset($profile_picture) && $profile_picture!=''  && \Storage::exists(config('constants.USERS_UPLOADS_PATH').$profile_picture)) 
            <div class="form-group">
                <div class="col-md-6">
                    <img width="100" src="{{ \Storage::url(config('constants.USERS_UPLOADS_PATH').$profile_picture) }}">
                </div>
            </div>
            @endif
            
            <div class="form-group {{$errors->has('profile_picture') ? config('constants.ERROR_FORM_GROUP_CLASS') : ''}}">
                <label class="col-md-3 control-label" for="title">Profile Picture </label>
                <div class="col-md-6">
                     {{ Form::file('profile_picture') }}
                    @if($errors->has('profile_picture'))
                    <strong for="profile_picture" class="help-block">{{ $errors->first('profile_picture') }}</strong>
                    @endif
                </div>
            </div>
        </div> 
        <div class="card-footer">
            <button type="submit" class="btn btn-responsive btn-primary btn-sm">{{ __('Submit') }}</button>
            <a href="{{route('admin.users.index')}}"  class="btn btn-responsive btn-danger btn-sm">{{ __('Cancel') }}</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('admin-theme/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin-theme/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin-theme/vendor/bootstrap-select/dist/js/i18n/defaults-en_US.min.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('#reset_password').change(function(){
        resetPassword();
    }).trigger('change');

    $('[name="role_id[]"]').selectpicker();

    jQuery('#frmUser').validate({
        rules: {
            'role_id[]':{
                required: true
            },
            name:{
                required: true
            },
            employee_id: {
                required: true
            },
            email: {
                required: true,
                email:true
            },
            mobile_number: {
                required: true
            },
            password: {
                required: function(){
                    if(jQuery('#frmUser #reset_password').prop('checked')==false){
                        return false;
                    }else{
                        return true;
                    }
                }
            },
            password_confirmation: {
                required: function(){  
                    if(jQuery('#frmUser #reset_password').prop('checked')==false){
                        return false;
                    }else{
                        return true;
                    }
                },
                equalTo: "#password"
            }
        }
    });
});
function resetPassword(){
    jQuery('#password_container').hide();
    if(jQuery('#reset_password').prop('checked')==true){
        jQuery('#password_container').show();
    }
}
</script>
@endsection