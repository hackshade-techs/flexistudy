<div class="jumbotron">
    <div class="bg-stripe-overlay" style="text-align:left; padding: 55px;">
        <div class="container">
            <div class="info-author">
                <div class="name-author">
                    <h2 style="font-size:35px; margin-top:0px;">{{ trans('navs.frontend.instructor_dashboard') }}</h2>
                </div>
            </div>
            
            <div class="info-follow">
                <div class="trophies">
                    <span>{{Helper::currency(Auth::user()->account_balance())}}</span>
                    <p>{{trans('strings.frontend.account-balance')}}</p>
                </div>
                <div class="trophies"> 
                    <span>{{ Auth::user()->students()->sum('enrollment_count') }}</span>
                    <p>{{trans('strings.frontend.total-students')}}</p>
                </div>
                <div class="trophies">
                    <span>{{Auth::user()->average_rating()}}</span>
                    <p>{{trans('strings.frontend.average-rating')}}</p>
                </div>
                <div class="trophies">
                    <span>{{Auth::user()->total_ratings()}}</span>
                    <p>{{trans('strings.frontend.total-reviews')}}</p>
                </div>
                <div class="trophies">
                    <span>{{Auth::user()->authored_courses->count()}}</span>
                    <p>{{trans('strings.frontend.total-courses')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PAGE CONTROL -->
<section class="page-control content-bar ps-container">
    <div class="container">
        <ul>
            <li class="{{ active_class(Active::checkUriPattern('author/courses')) }}">
                <a href="{{route('frontend.author.course.index')}}">
                    <i class="icon fa fa-book"></i>
                    {{trans('strings.frontend.courses')}}
                </a>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('author/earnings')) }}">
                <a href="{{route('frontend.author.revenue.index')}}">
                    <i class="icon fa fa-money"></i>
                    {{trans('strings.frontend.revenue-report')}}
                </a>
            </li>
        </ul>
    </div>
</section>
<!-- END / PAGE CONTROL -->