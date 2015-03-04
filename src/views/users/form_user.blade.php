<div class="row">
<div class="col-sm-12">
<div class="content-panel">
	<div class="col-sm-offset-2 col-sm-10">
	@if( isset($edit) )
	<h4><i class="fa fa-user"></i> Edit User</h4>
	@elseif( isset($create) )
	<h4><i class="fa fa-user"></i> Add User</h4>
	@else
	<h4><i class="fa fa-user"></i> User</h4>
	@endif
	</div>

	@if( isset($create) )
	{!! Form::open(['method'=>'POST', 'action' => ['UsersController@store'], 'class'=>'form-horizontal']) !!} 
	@else
	{!! Form::open(['method'=>'PUT', 'action' => ['UsersController@update', $user->id], 'class'=>'form-horizontal']) !!} 
	@endif
	{!! Form::token() !!} 

	<div class="form-group">
	{!! Form::label('name', 'Name', ['class' => 'control-label col-sm-2']) !!}
	<div class="col-sm-8">
	{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
	</div>
	<div class="col-sm-2"></div>
	</div>

	<div class="form-group">
	{!! Form::label('email', 'E-Mail Address', ['class' => 'control-label col-sm-2']) !!}
	<div class="col-sm-8">
	{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
	</div>
	<div class="col-sm-2"></div>
	</div>

	@if( isset($create) )
	<div class="form-group">
	{!! Form::label('password', 'Password', ['class' => 'control-label col-sm-2']) !!}
	<div class="col-sm-8">
	{!! Form::text('password', $user->password, ['class' => 'form-control']) !!}
	</div>
	<div class="col-sm-2"></div>
	</div>
	@endif

	<div class="form-group">
	{!! Form::label('role', 'Role', ['class' => 'control-label col-sm-2']) !!}
	<div class="col-sm-8">
	{!! Form::select('role', ['admin' => 'Admin', 'manager' => 'Manager', 'user' => 'User'], $user->role, ['class' => 'form-control']) !!}
	</div>
	<div class="col-sm-2"></div>
	</div>

	<div class="form-group">
	{!! Form::label('enable', 'Enable', ['class' => 'control-label col-sm-2']) !!}
	<div class="col-sm-8">
	{!! Form::checkbox('enable', "1", $user->enable) !!}
	</div>
	<div class="col-sm-2"></div>
	</div>

	@if( !isset($create) )
	<div class="form-group">
	{!! Form::label('created_at', 'Creation Date', ['class' => 'control-label col-sm-2']) !!}
	<div class="col-sm-8">
	{!! Form::text('created_at', $user->created_at, ['class' => 'form-control', 'readonly']) !!}
	</div>
	<div class="col-sm-2"></div>
	</div>
	@endif

	@if( !isset($create) )
	<div class="form-group">
	{!! Form::label('updated_at', 'Update Date', ['class' => 'control-label col-sm-2']); !!}
	<div class="col-sm-8">
	{!! Form::text('updated_at', $user->updated_at, ['class' => 'form-control', 'readonly']); !!}
	</div>
	<div class="col-sm-2"></div>
	</div>
	@endif

	@if( isset($edit) OR isset($create) )
	<div class="form-group">
	<div class="col-sm-offset-2 col-sm-4">
	{!! Form::submit('Apply', ['class' => 'btn btn-primary btn-block']); !!}
	</div>
	<div class="col-sm-6"></div>
	</div>
	@else
	<div class="form-group">
	<div class="col-sm-offset-2 col-sm-4">
	<a role="button" href="/users" class="btn btn-primary"><i class="fa fa-mail-reply"></i> Back to Users List</a>		
	</div>
	<div class="col-sm-6"></div>
	</div>
	@endif

	{!! Form::close(); !!} 

</div>
</div>
</div>