
<div class="jumbotron">
    <div class="bg-stripe-overlay">
        <div class="container">
            <div class="left">
                <h2 style="font-size: 35px;">{{trans('strings.frontend.my-courses')}}</h2>
                <p>{{trans('strings.frontend.enrolled-and-wishlist')}}</p>
                <p><i class="fa fa-minus"></i><i class="fa fa-minus"></i></p>
            </div>
        </div>
    </div>
</div>

    
<!-- PAGE CONTROL -->
<section class="page-control content-bar ps-container">
    <div class="container">
        <ul>
            @if(auth()->user()->enrollments->count())
                <li class="{{ active_class(Active::checkUriPattern('courses/my-courses*')) }}">
                    <a href="{{route('frontend.user.courses.learning')}}">
                        {{trans('strings.frontend.my-enrolled-courses')}}
                    </a>
                </li>
            @endif
            @if(auth()->user()->bookmarks->count())
                <li class="{{ active_class(Active::checkUriPattern('courses/my-wishlist*')) }}">
                    <a href="{{route('frontend.user.courses.wishlist')}}">
                        {{trans('strings.frontend.my-wishlist')}}
                    </a>
                </li>
            @endif
            @if(auth()->user()->payments->count())
                <li><a href="{{route('frontend.user.courses.purchases')}}">{{trans('strings.frontend.purchases')}}</a></li>
            @endif
        </ul>
    </div>
</section>
<!-- END / PAGE CONTROL -->