@extends('frontend.frontend_master')

@section('frontend_content')
<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="">Sign in</h4>
					<p class="">Hello, Welcome to your account.</p>
					<form class="register-form outer-top-xs" role="form" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}" method="POST">
				        @csrf
						<div class="form-group">
						    <label class="info-title" for="exampleInputEmail1">Mobile Number<span>*</span></label>
						    <input type="number" name="mobileNum" class="form-control unicase-form-control text-input" id="mobileNum" placeholder="1234567890">
						</div>
				        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
