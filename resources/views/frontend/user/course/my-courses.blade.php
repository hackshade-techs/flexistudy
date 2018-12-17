@extends('frontend.layouts.app')

@section('content')

    @include('frontend.user.course._top')
        
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-push-0">
                    <div class="content grid">
                        <div class="row">
                            @foreach($courses as $course)
                                @include('frontend.user.course._course')
                            @endforeach
                            <!-- END / ITEM -->
                        </div><!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
@endsection