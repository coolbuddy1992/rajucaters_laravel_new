@extends('frontend.frontend_master')

@section('frontend_content')
<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="">Sign in</h4>
					<p class="">Hello, Welcome to your account.</p>
					<form class="register-form outer-top-xs" role="form" action="{{ route('otpVerification') }}" method="POST">
				        @csrf
						<div class="form-group">
						    <label class="info-title" for="exampleInputEmail1">Please Enter Otp<span>*</span></label>
						    <input type="hidden" name="mobileNum" class="form-control" value="{{$userMobile}}">
						    <input type="hidden" name="loginType" class="form-control" value="{{$loginType}}">
						    <input type="hidden" name="otpRequestId" class="form-control" value="{{$otpRequestId}}">
						    <input type="number" name="otpNum" class="form-control unicase-form-control text-input" placeholder="1234">
						</div>
				        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Verify Otp</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
