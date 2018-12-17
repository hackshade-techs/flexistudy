<nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          
          <!--<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-main" aria-expanded="false">-->
          <button class="navbar-toggle visible-xs" type="button" data-toggle="push" data-target="#navbar-main" aria-expanded="false" aria-controls="navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="{{ url('/') }}" class="navbar-brand" style="padding:5px 15px; ">
            <img src="/logo.png" style="max-height:90%;" />
          </a>
        </div>
        
        <div class="navbar-main" id="navbar-main">
          <ul class="nav navbar-nav">
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">{{trans('strings.frontend.categories')}} <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="themes">
                  <li><a href="{{route('frontend.course.get')}}?category=">{{trans('strings.frontend.all-categories')}}</a></li>
                  <li class="divider hidden-xs hidden-sm"></li>
                  @foreach($categories as $category)
                    @if(count($category->courses))
                      <li>
                        <a href="{{route('frontend.course.get')}}?category={{$category->slug}}">{{ $category->name }}</a>
                      </li>
                    @endif
                  @endforeach
                </ul>
                
                <li>
                  <a href="#" class="mk-fullscreen-triggerx">
                    <i class="fa fa-search" id="search-button"></i>
                  </a>
                </li>
  
              </li>
          </ul>

          <!------------------------------------->
          <div class="mk-fullscreen-search-overlay" id="mk-search-overlay">
            <a href="#" class="mk-fullscreen-close" id="mk-fullscreen-close-button"><i class="fa fa-times"></i></a>
            <div id="mk-fullscreen-search-wrapper">
              <form action="{{ route('frontend.course.get') }}" method="get" id="mk-fullscreen-searchform">
                <input type="text" autocomplete="off" name="search" class="main-search" placeholder="{{trans('strings.frontend.search-author-or-title')}}..." id="mk-fullscreen-search-input">
                <i class="fa fa-search fullscreen-search-icon">
                <input value="" type="{{trans('strings.frontend.submit')}}"></i>
              </form>
            </div>
          </div>
          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{route('frontend.course.get')}}">{{trans('strings.frontend.courses')}}</a></li>
            
            @if($menuBlog->count())
              <li><a href="{{route('frontend.blog.index')}}">{{trans('strings.frontend.blog')}}</a></li>
            @endif
           
            
            @if($menuPages->count())
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="pages">
                    {{trans('strings.frontend.pages')}}<span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="pages">
                  @foreach($menuPages as $page)
                    <li><a href="{{route('frontend.pages.show', $page->slug)}}">{{$page->title}}</a></li>
                  @endforeach
                </ul>
              </li>
            @endif
            
            @if (! $logged_in_user)
                <li><a href="{{route('frontend.auth.login')}}">{{trans('navs.frontend.login')}}</a></li>
                @if (config('access.users.registration'))
                    <li><a href="{{route('frontend.auth.register')}}">{{trans('navs.frontend.register')}}</a></li>
                @endif
            @else
            
            @if(auth()->user()->hasRole('User') && !auth()->user()->hasRole('Administrator'))
              <li><a href="{{route('frontend.user.become.author')}}">{{trans('strings.frontend.start-teaching')}}</a></li>
            @endif
              
            @permission('view-backend')
                <li>{{ link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
            @endauth
              <!--
              <li>{{ link_to_route('frontend.macros', trans('navs.frontend.macros'), [], ['class' => active_class(Active::checkRoute('frontend.macros')) ]) }}</li>
              -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell"></i> 
                    @if(count(auth()->user()->unreadNotifications))
                    <sup>
                      <span style="font-size: 8px; margin-left: -5px; top: 100%;">
                        <i class="fa fa-circle text-primary"></i>
                      </span>
                    </sup>
                    @endif
                </a>
                <ul class="dropdown-menu notify-drop">
                  <div class="notify-drop-title">
                  	<div class="row">
                  		<div class="col-md-6 col-sm-6 col-xs-6">{{trans('strings.frontend.unread')}} (<b>{{count(auth()->user()->unreadNotifications)}}</b>)</div>
                  	</div>
                  </div>
                  <!-- end notify title -->
                  <!-- notify content -->
                  <div class="drop-content">
                    @foreach(auth()->user()->notifications as $notification)
                      @include('frontend.includes.notifications.'.snake_case(class_basename($notification->type)))
                  	@endforeach
      
                  	
                  </div>
                  <div class="notify-drop-footer text-center">
                    <form method="POST" action="/user/{{Auth::user()->username}}/notifications" id="delete-notification">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                  	<a href="#" id="mark-all-as-read" class="mark-all-as-read"><i class="fa fa-eye"></i> {{trans('strings.frontend.mark-all-as-read')}}</a>
                  </div>
                </ul>
              </li>
              
              <li>
                <a href="{{ route('frontend.user.messages', Auth::user()) }}">
                  <i class="fa fa-envelope"></i> 
                  @if($myUnreadMessages)
                    <sup>
                      <span style="font-size: 8px; margin-left: -5px; top: 100%;">
                        <i class="fa fa-circle text-primary"></i>
                      </span>
                    </sup>
                  @endif
                </a>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    {{ $logged_in_user->name }}
                    <img src="{{$logged_in_user->picture}}" width="20px" class="img-circle"></img>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="download">
                    @if(!Auth::user()->hasRole('Administrator'))
                      <li><a href="{{route('frontend.user.revenue.affiliate')}}">
                        {{trans('strings.frontend.revenue-report')}} 
                        <span class="label label-success">{{Helper::currency(Auth::user()->account_balance())}}</span>
                        </a>
                      </li>
                    @endif
                    <li><a href="{{ route('frontend.user.public.profile', auth()->user()) }}">{{trans('strings.frontend.profile')}}</a></li>
                    <li><a href="{{route('frontend.user.account')}}">{{trans('navs.frontend.user.account')}}</a></li>
                    <li><a href="{{ route('frontend.user.messages', Auth::user()) }}">{{trans('strings.frontend.messages')}}</a></li>
                    @if(auth()->user()->payments->count())
                      <li><a href="{{route('frontend.user.courses.purchases')}}">{{trans('strings.frontend.purchases')}}</a></li>
                    @endif
                    
                    @if(auth()->user()->enrollments->count() || auth()->user()->bookmarks->count())
                      <li class="divider"></li>
                        <li class="disabled"><a href="#">{{trans('strings.frontend.student')}}</a></li>
                      <li class="divider"></li>
                      @if(auth()->user()->enrollments->count())
                        <li><a href="{{route('frontend.user.courses.learning')}}">{{trans('strings.frontend.my-courses')}}</a></li>
                      @endif
                      @if(auth()->user()->bookmarks->count())
                        <li><a href="{{route('frontend.user.courses.wishlist')}}">{{trans('strings.frontend.my-wishlist')}}</a></li>
                      @endif
                    @endif
                    
                    @if(auth()->user()->hasRole('Author') && !auth()->user()->hasRole('Administrator'))
                      <li class="divider"></li>
                        <li class="disabled"><a href="#">{{ trans('navs.frontend.instructor') }}</a></li>
                      <li class="divider"></li>
                      <li><a href="{{route('frontend.author.course.index')}}">{{ trans('navs.frontend.instructor_dashboard') }}</a></li>
                      <!--
                      <li><a href="{{route('frontend.author.revenue.index')}}">{{trans('strings.frontend.revenue-report')}}</a></li>
                      -->
                      <li><a href="{{route('frontend.author.course.create')}}">{{trans('strings.frontend.create-new-course')}}</a></li>
                    @endif
                    
                    <li class="divider"></li>
                    <li>
                    <a href="{{route('frontend.auth.logout')}}">{{trans('navs.general.logout')}}</a>
                    
                  </li>
                </ul>
              </li>
            @endif
          </ul>

        </div>
      </div>
    </nav>
    <!--/ end navigation -->
<!------------------------------------>