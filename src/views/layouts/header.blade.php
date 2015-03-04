<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/">LARADMIN</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav">
	@foreach (Config::get('laradmin.left_menus') as $menu)
		@if ( !($menu["auth"] XOR !Auth::guest()) ) 
			@if ( isset($menu["permissions"]) )
				@if ( in_array(Auth::user()->role,  $menu["permissions"]) )
				{{-- debug( $menu["href"] . " <=> " . Request::path() ) --}}
		<li {!! Request::is(ltrim($menu["href"]."*", "/"))?'class="active"':'' !!}>
			<a href="{{$menu["href"]}}">
				@if( Config::get('laradmin.left_menus_mode.icon') )
					{!! $menu["icon"] !!}
				@endif 
				@if( Config::get('laradmin.left_menus_mode.label') )
					<span>{{$menu["label"]}}</span>
				@endif 
			</a>
		</li>
				@endif
			@endif
		@endif
	@endforeach
	</ul>
	<ul class="nav navbar-nav navbar-right">
		@if( Auth::check() )
			<li><a href="#">{!! Auth::user()->name !!}</a></li>
		@endif
		@foreach (Config::get('laradmin.right_menus') as $menu)
		@if ( !($menu["auth"] XOR !Auth::guest()) ) 
		<li {{ Request::is($menu["href"]."*")?'class="active"':'' }}>
			<a href="{{$menu["href"]}}">
				@if( Config::get('laradmin.right_menus_mode.icon') )
					{!! $menu["icon"] !!}
				@endif 
				@if( Config::get('laradmin.right_menus_mode.label') )
					<span>{{$menu["label"]}}</span>
				@endif 
			</a>
		</li>
		@endif
		@endforeach
	</ul>
</div>
