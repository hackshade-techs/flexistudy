@extends('frontend.layouts.app')

@section('content')
    <section class="profile-feature">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <div class="info-author">
                <div class="image">
                    <img src="{{ $logged_in_user->picture }}" alt="">
                </div>
                <div class="name-author">
                    <h2 class="big">{{$logged_in_user->name}}</h2>
                </div>
                <div class="address-author">
                    <i class="fa fa-map-marker"></i>
                    <h3>{{ $logged_in_user->email }} | {{trans('strings.frontend.member-since')}} {{ $logged_in_user->created_at->format('F jS, Y') }}</h3>
                    
                </div>
            </div>

        </div>
    </section>
    
    <section id="create-course-section" class="create-course-section">
        <div class="container">
            <div class="row">
				<div class="col-md-12">
					<div class="panel panel-body">
					    <pre>
                            {{ auth()->user()->unreadNotifications }}
                        </pre>
                        <ul class="list-unstyled">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li>{{$notification->type}}</li>
                            @endforeach
                        </ul>
					</div>
				</div>
				
			</div>
		</div>
	</section>
@endsection
