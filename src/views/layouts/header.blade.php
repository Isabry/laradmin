<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/">
		<strong class="text-primary"><i class="fa fa-openid"></i></strong>
		<strong class="text-danger">{!!Config::get('laradmin.project.title')!!}</strong>
	</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav">
	@foreach ( Laradmin::getMenus('left') as $menu )
		<li {!! Request::is(ltrim($menu["href"]."*", "/"))?'class="active"':'' !!}>
			<a href="{{$menu["href"]}}">
				@if( $menu["icon_visible"] )
					{!! $menu["icon"] !!}
				@endif 
				@if( $menu["label_visible"]  )
					<span>{{$menu["label"]}}</span>
				@endif 
			</a>
		</li>
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
