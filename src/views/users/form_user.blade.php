<div class="row">
<div class="col-md-12">
<div class="content-panel">
	@if( isset($edit) )
	<h4><i class="fa fa-user"></i> Edit User</h4>
	@else
	<h4><i class="fa fa-user"></i> User</h4>
	@endif
	<hr>

	{{ Form::open(['method'=>'PATCH', 'action' => ['UsersController@update', $user->id], 'class'=>'form-horizontal']); }} 
	{{ Form::token(); }} 

	{{ Form::group_start(); }}
	{{ Form::label('name', 'Name', ['class' => 'control-label']); }}
	{{ Form::group_next(); }}
	{{ Form::text('name', $user->name, ['class' => 'form-control']); }}
	{{ Form::group_stop(); }}

	{{ Form::group_start(); }}
	{{ Form::label('email', 'E-Mail Address', ['class' => 'control-label']); }}
	{{ Form::group_next(); }}
	{{ Form::text('email', $user->email, ['class' => 'form-control']); }}
	{{ Form::group_stop(); }}

	{{ Form::group_start(); }}
	{{ Form::label('role', 'Role', ['class' => 'control-label']); }}
	{{ Form::group_next(5); }}
	{{ Form::select('role', ['admin' => 'Admin', 'user' => 'User'], $user->role, ['class' => 'form-control']); }}
	{{ Form::group_stop(); }}

	{{ Form::group_start(); }}
	{{ Form::label('enable', 'Enable', ['class' => 'control-label']); }}
	{{ Form::group_next(5); }}
	{{ Form::checkbox('enable', "1", $user->enable); }}
	{{ Form::group_stop(); }}

	{{ Form::group_start(); }}
	{{ Form::label('created_at', 'Creation Date', ['class' => 'control-label']); }}
	{{ Form::group_next(4); }}
	{{ Form::text('created_at', $user->created_at, ['class' => 'form-control', 'readonly']); }}	
	{{ Form::group_stop(); }}

	{{ Form::group_start(); }}
	{{ Form::label('updated_at', 'Update Date', ['class' => 'control-label']); }}
	{{ Form::group_next(4); }}
	{{ Form::text('updated_at', $user->updated_at, ['class' => 'form-control', 'readonly']); }}
	{{ Form::group_stop(); }}

	{{ Form::group_start(); }}
	{{ Form::group_next(3); }}
	{{ Form::submit('Apply', ['class' => 'btn btn-primary btn-block']); }}
	{{ Form::group_stop(); }}

	{{ Form::close(); }} 


	{{-- "<pre>" . print_r($user, true) . "</pre>" --}}

</div>
</div>
</div>