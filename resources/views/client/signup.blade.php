@extends('layouts.login')

@section('title')
    Signup
@endsection

@section('content')
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('frontend/login/images/bg-01.jpg');">
			<div class="wrap-login100">

        @if (Session::has('success'))
          <div class="alert alert-success">
            {{ Session::get('success') }}
          </div>
        @endif

        @if (count($errors) > 0)
          <div class="alert alert-success">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
        @endif

				<form class="login100-form validate-form" method="POST" action="{{ url('/create_account') }}">
          {{ csrf_field() }}
          <a href="{{URL::to('/')}}">
            <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span>
          </a>

					<span class="login100-form-title p-b-34 p-t-27">
						Sign Up
					</span>

          <div class="wrap-input100 validate-input" data-validate="Enter First name">
						<input class="input100" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf201;"></span>
					</div>

          <div class="wrap-input100 validate-input" data-validate="Enter Last name">
						<input class="input100" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf201;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100 password" type="password" name="password" placeholder="Password" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
            <span class="pwd_warning text-white d-none" style="font-size: 10px;"></span>
					</div>

          <div class="wrap-input100 validate-input" data-validate="Repeat password">
						<input class="input100 repeat_password" type="password" name="repeat_password" placeholder="Repeat Password" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
            <span class="unmatched text-white d-none" style="font-size: 10px;"></span>
					</div>

          <div class="wrap-input100 validate-input" data-validate="Enter phone">
						<input class="input100" type="text" name="phone" placeholder="Phone" value="{{ old('phone') }}" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf095;"></span>
					</div>

					{{-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div> --}}

					<div class="container-login100-form-btn">
						<button class="login100-form-btn signup">
							Signup
						</button>
					</div>

					{{-- <div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div> --}}

          <div class="text-center p-t-90">
            <a class="txt1" href="/login">
              Already have an account? Login
            </a>
          </div>
  
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
  @endsection

  @section('scripts')
  <script>
    $(document).ready(function() {

      $('.signup').prop("disabled", true);

      $(document).on('keyup change', '.password', function () {
        var password = $('.password').val();

        if (password.length < 6) {
          $('.pwd_warning').removeClass('d-none');
          $('.pwd_warning').text('Password must be at least 6 characters long.');
          $('.signup').prop("disabled", true);
        } else {
          $('.pwd_warning').addClass('d-none');
          $('.signup').prop("disabled", false);
        }
      });


      $(document).on('keyup change', '.repeat_password', function () {
        var password = $('.password').val();
        var repeat_password = $('.repeat_password').val();

        // console.log(password);
        // console.log(repeat_password);

        if (password == repeat_password && password.length >= 6) {
          $('.unmatched').addClass('d-none');
          // $('.matched').removeClass('d-none');
          // $('.matched').text('Password matched.');
          $('.signup').prop("disabled", false);
        } else {
          $('.unmatched').removeClass('d-none');
          $('.matched').addClass('d-none');
          $('.unmatched').text('Password didn\'t matched. Try again.');
          $('.signup').prop("disabled", true);
        }
      });
      return false;
    });
  </script>
  @endsection