@extends('layouts.master')

@section('title', 'shops')
@section('content')

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header title">
			</div>
			<div class="modal-body">
             'Are you sure you want to continue? This action is irreversible and will eliminate all the related employees!'</div>
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
					shops
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
					<a href="{{ route('shops.create') }}" type="submit" class="btn btn-primary btn-flat margin-bottom-1">
                    New Shop
					</a>
				<hr>
				<table class="table table table-striped table-bordered" style="width:100%" id="shops-dt">
					<thead>
						<tr>
						   <th>Id</th>
							<th>name</th>
							<th>email</th>
							<th>website</th>
                            <th>logo</th>

							<th>edit</th>
                            <th>delete</th>

						</tr>
					</thead>
					<tbody>

					@foreach($shops as $key=>$row)

                        <tr>
						<td>{{ $key +1 }}</td>

                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->website}}</td>
                            <td> <img src="{{ URL::to($row->logo) }}" height="70px;" width="80px;"> </td>
                  


                            <td class = "text-center">
                              <a href = "{{url(route('shops.edit' , $row->id))}}" class = "btn btn-success btn-sm"><i class = "fa fa-edit"></i></a>
                            </td>
                            <td class = "text-center">
                                {!!Form::open([
                                    'route' => ['shops.destroy' , $row->id ] , 
                                    'method' => 'delete'
                                ]) !!}
								<button type="submit"  class = "btn btn-danger btn-xs"><i class = "fa fa-trash"></i></button>

                                
                                
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach

					</tbody>
				</table>
                {{$shops->links()}}

			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>

	$('#confirm-delete').on('show.bs.modal', function(e) {
		var data = $(e.relatedTarget).data();
		var route = "/shops/"+data.recordId;

		$('.title', this).text('Confirm delete ' + data.recordTitle);
		$('#delete-form').attr('action', route);
	});

	/**
	 * Shops DataTable
	 */
	$('#shops-dt').DataTable({
		ajax : '/shops?ws=getShop',
		columns : [
			{data: 'first_name', name: 'first_name'},
			{data: 'email', name: 'email'},
			{data: 'website', name: 'website'},
			{data: 'actions', render : function (data, type, row) {
				return ' <a type="submit" href="/shops/'+row.id+'" class="btn btn-sm btn-success"> show </a> <a type="submit" href="/shops/'+row.id+'/edit" class="btn btn-sm btn-primary">edit</a> <a type="submit" href="#" class="btn btn-sm btn-danger" data-record-id="'+row.id+'" data-record-title="'+row.first_name+'" data-toggle="modal" data-target="#confirm-delete"> delete </a>'
			}},
		],
		lengthChange : true,
	});
</script>
@stop
