@extends('layouts.master')
@section('title', 'Edit customer')

@section('content')
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2> Edit {{ $customer->first_name }} </h2>
				</div>
				<div class="body">
					<form class="form-horizontal" method="POST" action="{{ route('customers.update', $customer->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}

						<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">first name</label>

							<div class="col-md-6">
								<div class="form-line">
									<input id="name" type="text" class="form-control" name="first_name" value="{{ $customer['first_name'] }}" autofocus>
								</div>
								@if ($errors->has('first_name'))
									<span class="help-block">
										<strong>{{ $errors->first('first_name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">last name</label>

							<div class="col-md-6">
								<div class="form-line">
									<input id="name" type="text" class="form-control" name="last_name" value="{{ $customer['last_name'] }}">
								</div>
								@if ($errors->has('last_name'))
									<span class="help-block">
										<strong>{{ $errors->first('last_name') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">email</label>

							<div class="col-md-6">
								<div class="form-line">
									<input id="email" type="email" class="form-control" name="email" value="{{ $customer['email'] }}">
								</div>
								@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
							<label for="phone" class="col-md-4 control-label">phone</label>

							<div class="col-md-6">
								<div class="form-line">
									<input id="phone" type="text" class="form-control" name="phone" value="{{ $customer['phone'] }}">
								</div>
								@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
								@endif
							</div>
						</div>

						 <div class="form-group{{ $errors->has('shop_id') ? ' has-error' : '' }}">
							<label for="shop_id" class="col-md-4 control-label">shop</label>

							<div class="col-md-6">
								<select class="" name="shop_id">
									@foreach($shops as $shop)
										@if($shop->id == $customer->shop_id)
											<option selected value="{{$shop->id}}"> {{$shop->first_name}} </option>
										@else
											<option value="{{$shop->id}}"> {{$shop->first_name}} </option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('shop_id'))
									<span class="help-block">
										<strong>{{ $errors->first('shop_id') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a href="{{ route('customers.index') }}" type="submit" class="btn btn-info">
									cancel
								</a>
								<button type="submit" class="btn btn-primary">
								update	
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
