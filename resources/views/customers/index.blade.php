@extends('layouts.master')
@section('title', 'Customers')

@section('content')

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header title">
			</div>
			<div class="modal-body">
			{{trans('front.actions.delete_warning')}}
			</div>
			<div class="modal-footer">
				<form id="delete-form" method="POST">
				<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
				{{ method_field('DELETE')}} {{csrf_field()}}
				<button type="submit" id="delete-btn" class="btn btn-danger">ok</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
				customer
				</h2>
			</div>

			<div class="body">
				@if (session('success'))
					<div class="alert alert-success" role="alert">
						{{ session('success') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<div class="text-left">
					<a href="{{ route('customers.create') }}" type="submit" class="btn btn-primary">
					New customer
					</a>
				</div>

				<hr>
				<table class="table table table-striped table-bordered" style="width:100%" id="customer-dt">
					<thead>
						<tr>
							<th>ID</th>
							<th>first name</th>
							<th>last name</th>
							<th>shop</th>
							<th>email</th>
							<th>phone</th>
							<th>edit</th>
							<th>delete</th>

						</tr>
					</thead>


					<tbody>

					
					@foreach($customers as $key=>$row)

                        <tr>
						<td>{{ $key +1 }}</td>
							<td>{{$row->first_name}}</td>
							<td>{{$row->last_name}}</td>
							<td>{{$row->shop->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->phone}}</td>
                  


                            <td class = "text-center">
                              <a href = "{{url(route('customers.edit' , $row->id))}}" class = "btn btn-success btn-sm"><i class = "fa fa-edit"></i></a>
                            </td>
                            <td class = "text-center">
                                {!!Form::open([
                                    'route' => ['customers.destroy' , $row->id ] , 
                                    'method' => 'delete'
                                ]) !!}
								<button type="submit"  class = "btn btn-danger btn-xs"><i class = "fa fa-trash"></i></button>

                                
                                
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
					</tbody>
				</table>
				{{$customers->links()}}

			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')

@stop
