@extends('frontend.layouts.app')

@section('title')
    {{$logged_in_user->name}}
@endsection

@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay" style="text-align:left;">
            <div class="container">
                <div class="info-author">
                    <div class="image">
                        <img src="{{ $logged_in_user->picture }}" alt="">
                    </div>
                    <div class="name-author">
                        <h2 style="font-size:35px;">
                            {{$logged_in_user->name}}
                            <p>
                                {{ $logged_in_user->tagline }} 
                                <span style="font-size:12px;">({{trans('strings.frontend.member-since')}} {{ $logged_in_user->created_at->format('F jS, Y') }})</span>
                            </p>
                        </h2>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <section id="create-course-sectionx" class="create-course-section">
        <div class="container">
            <div class="row">
            	<div class="col-md-3">
					@include('frontend.user.account.profile._sidebar')
				</div>
				
				<div class="col-md-9">
					<div class="tab-content">
						<div id="edit-profile" class="panel panel-primary tab-pane active">
							@include('frontend.user.account.profile._profile')
						</div>
						<div id="change-password" class="panel panel-primary tab-pane">
							@include('frontend.user.account.profile._change-password')
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
@endsection

