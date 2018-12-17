@extends('frontend.layouts.app')


@section('title')
    {{$user->name}}
@stop

@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay" style="text-align:left;">
            <div class="container">
                <div class="info-author">
                    <div class="image">
                        <img src="{{ $user->picture }}" alt="">
                    </div>
                    <div class="name-author">
                        <h2 style="font-size:35px;">
                            {{$user->name}}
                            <p>
                                {{ $user->tagline }} 
                                <span style="font-size:12px;">({{trans('strings.frontend.member-since')}} {{ $user->created_at->format('F jS, Y') }})</span>
                            </p>
                        </h2>
                    </div>
                </div>
                
                @if($user->hasRole('Author'))
                    <div class="info-follow">
                        @if($user->authored_courses)
                            <div class="trophies">
                                <span>{{ $user->students()->sum('enrollment_count') }}</span>
                                <p>{{str_plural('Student', $user->students()->sum('enrollment_count')) }}</p>
                            </div>
                        
                            <div class="trophies">
                                <span>{{ $user->authored_courses->count() }}</span>
                                <p>{{ str_plural(trans('strings.frontend.course'), $user->authored_courses->count()) }}</p>
                            </div>
                            
                            <div class="trophies">
                                <span>{{$user->average_rating()}}</span>
                                <p>{{trans('strings.frontend.average-rating')}}</p>
                            </div>
                            
                            <div class="trophies">
                                <span>{{$user->total_ratings()}}</span>
                                <p>{{trans('strings.frontend.total-reviews')}}</p>
                            </div>
                        @endif
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    
    
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="avatar-acount clearfix">
                        <div class="changes-avatar">
                            <div class="img-acount">
                                <img src="{{$user->picture}}" alt="">
                                
                            </div>
                            @if(Auth::check() && Auth::user()->id != $user->id)
                                <a class="btn btn-xs btn-success sendMessage" href="#" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-id="{{$user->id}}" data-target="#sendMessage">
                                    <i class="fa fa-envelope-o"></i> {{trans('strings.frontend.contact-me')}}
                                </a>
                            @endif
                            
                            
                        </div>
                        <div class="info-acount">
                            <h3 class="md black">{{$user->name}} ({{$user->username}})</h3>
                            {!! $user->bio !!}
                            
                            <ul class="list-inline" style="font-size: 22px;">
                                @if($user->twitter)
                                    <li><a href="https://www.twitter.com/{{$user->twitter}}" target="_blank"><i class="icon fa fa-twitter-square"></i></a></li>
                                @endif
                                @if($user->facebook)
                                    <li><a href="https://www.facebook.com/{{$user->facebook}}" target="_blank"><i class="icon fa fa-facebook-square"></i></a></li>
                                @endif
                                @if($user->github)
                                    <li><a href="https://www.github.com/{{$user->github}}" target="_blank"><i class="icon fa fa-github-square"></i></a></li>
                                @endif
                                @if($user->linkedin)
                                    <li><a href="https://www.linkedin.com/{{$user->linkedin}}" target="_blank"><i class="icon fa fa-linkedin-square"></i></a></li>
                                @endif
                                @if($user->youtube)
                                    <li><a href="https://www.youtube.com/{{$user->youtube}}" target="_blank"><i class="icon fa fa-youtube-square"></i></a></li>
                                @endif
                                @if($user->web)
                                    <li><a href="{{$user->web}}" target="_blank"><i class="icon fa fa-globe"></i></a></li>
                                @endif
                            </ul>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    @if($courses->count())
                        <h5>{{trans('strings.frontend.courses-taught-by')}} {{ $user->name }}</h5>
                        
                        @foreach($courses->chunk(3) as $collection)
                            <div class="row" style="margin-bottom: 20px;">
                                @foreach($collection as $course)
                                    @include('frontend.user.course._course')
                                @endforeach
                            </div>
                        @endforeach
                        
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </section>
@endsection


