@extends('auth::layouts.master')

@section('content')
<div class="login-box">
        <div class="login-logo">
          <a href=""><b>ระบบสูตรอาหาร</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">เข้าสู่ระบบ</p>
        <form action="{{url('auth/login')}}" method="post">
            @csrf
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="username" placeholder="username">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="password" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox"> Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
              <div class="col-xs-12">
                  <br>
                @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-danger">
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> {{session('message')}}
                </div>
                @endif
            </div>
            </div>
          </form>

                    @if (count($errors) > 0)
                    <div class = "alert alert-danger">
                       <ul>
                          @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                          @endforeach
                       </ul>
                    </div>
                 @endif
          <!-- /.social-auth-links -->


        </div>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->
@endsection
