	<header>
		<div class="container-fluid position-relative no-side-padding">
			<a href="{{ route('home') }}" class="logo"><img src="{{ asset('assets/frontend/images/logo.png') }}" alt="Logo Image"></a>
			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>
			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li><a href="{{ route('post.index') }}">Posts</a></li>
				@guest
				<li><a href="{{ route('login') }}">Login</a></li>
				<li><a href="{{ route('register') }}">Register</a></li>
					@else
					@if (Auth::user()->role->id==1)
					<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
					@endif
					
					@if( Auth::user()->role->id == 2 )
					<li><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
					@endif
					
					<li> <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
					</li>
				@endguest
			</ul><!-- main-menu -->

			<div class="src-area">
				<form action="{{ route('search') }}" method="GET">
					<input class="src-input" type="text" name="query" placeholder="Type of search" value="{{ isset($query) ? $query : '' }}" >
					<button class="src-btn"  type="submit"><i class="ion-ios-search-strong"></i></button>
				</form>
			</div>

		</div><!-- conatiner -->
	</header>