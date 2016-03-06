@extends('login')

@section('content')
<div class="container-fluid" style="margin: 70px 0;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="background-color: transparent;">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" id="forget-password-val" role="form" method="POST" action="/reset/password">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">						
						<div class="form-group" style="margin-bottom:15px">
				            <label class="col-md-4 control-label">New Password</label>
				            <div class="col-md-8">
				              <div class="input-icon right ">
				                <i class="fa"></i>
				                <input type="password" id="new_password" class="form-control" name="password" required>
				              </div>
				            </div>
				          </div>

				          <div class="form-group" style="margin-bottom:15px">
				            <label class="col-md-4 control-label">Confirm Password</label>
				            <div class="col-md-8">
				              <div class="input-icon right ">
				                <i class="fa"></i>
				                <input type="password" class="form-control" name="password_confirmation" required>
				              </div> 
				            </div>
				          </div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
