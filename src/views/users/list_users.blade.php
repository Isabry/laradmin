<div class="row">
<div class="col-md-12">
<div class="content-panel">
	<h4><i class="fa fa-users"></i> Users</h4>
	<hr>

	<table class="table table-striped table-condensed table-hover">
		<thead>
			<tr>
				<th class="tools"></th>
				<th><i class="fa fa-user"></i> Name</th>
				<th><i class="fa fa-envelope-o"></i> Email</th>
				<th><i class="fa fa-graduation-cap"></i> Role</th>
				<th><i class="fa fa-calendar-o"></i> Since</th>
				<th class="tools"></th>
				<th class="tools"></th>
				<th class="tools"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>
					{!! Form::open(['route' => ['users.enable', $user->id], 'class'=>'form-horizontal']) !!} 
					{!! Form::token() !!}
					{!! Form::hidden('enable', $user->enable ) !!}
					{!! Form::hidden('page', Input::get("page", 1) ) !!}
					<button type="submit" class="btn btn-default btn-xs"><i class="fa fa-toggle-{{$user->enable?'on':'off'}}"></i></button>
					{!! Form::close() !!} 

				</td>
				<td class="{{$user->enable?'enable':'disable'}}"> {{ $user->name }} </td>
				<td class="{{$user->enable?'enable':'disable'}}"> {{ $user->email }}</td>
				<td class="{{$user->enable?'enable':'disable'}}"> {{ $user->role }} </td>
				<td class="{{$user->enable?'enable':'disable'}}"> {{ $user->created_at }} </td>

				<td>
					<a role="button" href="/users/{{$user->id}}" class="btn btn-info btn-circle btn-xs"><i class="fa fa-eye "></i></a>
				</td>
				<td>
					<a role="button" href="/users/{{$user->id}}/edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-pencil "></i></a>
				</td>
				<td>
					{!! Form::open(['method'=>'DELETE', 'route' => ['users.destroy', $user->id], 'class'=>'form-horizontal']) !!} 
					{!! Form::token() !!}
					{!! Form::hidden('page', Input::get("page", 1) ) !!}
					<button type="submit" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash-o "></i></button>
					{!! Form::close() !!} 
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{!! $users !!}
	<a role="button" href="/users/create" class="btn btn-primary"><i class="fa fa-user"></i> Add User</a>

</div>
</div>
</div>