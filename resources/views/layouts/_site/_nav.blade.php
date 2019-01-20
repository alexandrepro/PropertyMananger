<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper grey lighten-3">
			<div class="container">
				<a href="{{ route('property.home') }}" class="brand-logo grey-text text-darken-1">Your Logo Here</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse grey-text text-darken-1"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li class="grey-text text-darken-3"><a class="grey-text text-darken-3" href="{{ route('property.home') }}">Properties</a></li>
				</ul>
			</div>
		</div>
	</nav>
</div>

<ul class="side-nav" id="mobile-demo">
	<li class="grey-text text-darken-3"><a class="grey-text text-darken-3" href="{{ route('property.home') }}"><i class="material-icons">home</i>Properties</a></li>
</ul>