@extends('layouts.frontend.app')
@push('css')
	<link href="{{asset('assets/frontend/css/category-sidebar/css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('assets/frontend/css/category-sidebar/css/responsive.css')}}" rel="stylesheet">
    
<style>
.slider {
    height: 400px;
    width: 100%;
    background-image: url({{asset('assets/frontend/images/category-1.jpg')}});
    background-size: cover;
}
</style>
@endpush

@section('title', 'Profile')
@section('content')
<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{Str::upper($author->name)}}</b></h1>
</div>

<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">

							@forelse($posts as $key => $post)
				<div class="col-lg-6 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">
							<div class="blog-image"><img src="{{  Storage::disk('public')->url('post/'.$post->image) }}" alt="Blog Image"></div>
							<a class="avatar" href="{{route('author.profile',$post->user->username)}}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="Profile Image"></a>
							<div class="blog-info">
								<h4 class="title"><a href="{{route('post.detail', $post->slug)}}"><b> {{ $post->title }} </b></a></h4>
								<ul class="post-footer">
									<li>
										@guest
										<a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info', {
											closeButton: true,
											progressBar: true,
										})"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
									@else
										<a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
										   class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>

								<form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
											@csrf
										</form>
									@endguest
									</li>
									<li><a href=""><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
								<li><a href=""><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
								</ul>
							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @empty 
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1 p-2">
                        <strong>No Post Found :(</strong>
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
				@endforelse
				</div><!-- row -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">
					<div class="single-post info-area ">
						<div class="about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p> {{$author->about}} </p>
                             <br/>
                              <strong>Author Since: {{ $author->created_at->toDateString() }}</strong><br>
                            <strong>Total Posts : {{ $author->posts->count() }}</strong>
						</div>
					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>



@endsection

@push('js')    
@endpush