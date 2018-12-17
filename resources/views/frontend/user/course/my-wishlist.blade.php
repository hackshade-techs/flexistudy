@extends('frontend.layouts.app')

@section('content')

    @include('frontend.user.course._top')
        
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-md-push-0">
                    <div class="content grid">
                        <div class="row">
                            @forelse($courses as $course)
                                @include('frontend.user.course._course')
                            @empty
                                <center>
                                    <p class="lead">
                                        {{trans('strings.frontend.nothing-in-wishlist')}}
                                        
                                    </p>
                                    <p class="lead">
                                        <a href="{{route('frontend.course.get')}}">{{trans('strings.frontend.browse-and-add-to-wishlist')}}</a>
                                    </p>
                                    
                                </center>
                            @endforelse
                        </div><!-- end row -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
@endsection