<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->full_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        <!--
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
        </div>
    {{ Form::close() }}-->
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!--<li class="header">{{ trans('menus.backend.sidebar.general') }}</li>-->

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

          <!--  <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>-->

            @role('Administrator')
            <!-- Access -->
                <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span>{{ trans('menus.backend.access.title') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
    
                    <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                        <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                            <a href="{{ route('admin.access.user.index') }}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('labels.backend.access.users.management') }}</span>
                            </a>
                        </li>
    
                        <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                            <a href="{{ route('admin.access.role.index') }}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('labels.backend.access.roles.management') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- courses -->
                <li class="{{ active_class(Active::checkUriPattern('admin/courses*') || Active::checkUriPattern('admin/categories*')) }} treeview">
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>{{ trans('menus.backend.sidebar.course-management') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
    
                    <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/courses*') || Active::checkUriPattern('admin/categories*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/courses*') || Active::checkUriPattern('admin/categories*'), 'display: block;') }}">
                        
                        <li class="{{ active_class(Active::checkUriPattern('admin/categories')) }}">
                            <a href="{{route('admin.categories.index')}}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('menus.backend.sidebar.manage-categories') }}</span>
                            </a>
                        </li>
                        
                        <li class="{{ active_class(Active::checkUriPattern('admin/courses')) }}">
                            <a href="{{route('admin.courses.index')}}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('menus.backend.sidebar.courses') }}</span>
                            </a>
                        </li>
    
                        <li class="{{ active_class(Active::checkUriPattern('admin/courses/featured')) }}">
                            <a href="{{route('admin.courses.featured')}}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('menus.backend.sidebar.featured-courses') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- courses -->
                <li class="{{ active_class(Active::checkUriPattern('admin/blog*') || Active::checkUriPattern('admin/page*')) }} treeview">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i>
                        <span>{{ trans('menus.backend.sidebar.blog-and-pages') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
    
                    <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/blog-categories*') || Active::checkUriPattern('admin/page*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/blog-categories*') || Active::checkUriPattern('admin/page*'), 'display: block;') }}">
                        
                        <li class="{{ active_class(Active::checkUriPattern('admin/blog-categories')) }}">
                            <a href="{{route('admin.blog.categories.index')}}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('menus.backend.sidebar.manage-categories') }}</span>
                            </a>
                        </li>
                        
                        <li class="{{ active_class(Active::checkUriPattern('admin/pages')) }}">
                            <a href="{{route('admin.pages.index')}}">
                                <i class="fa fa-circle-o"></i>
                                <span>{{ trans('menus.backend.sidebar.pages-and-articles') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- revenue -->
                <li class="{{ active_class(Active::checkUriPattern('admin/withdrawals*')) }}">
                    <a href="{{route('admin.withdrawals.index')}}">
                        <i class="fa fa-money"></i>
                        <span>{{ trans('menus.backend.sidebar.withdrawal-requests') }}</span>
                    </a>
                </li>
                
                <li class="{{ active_class(Active::checkUriPattern('admin/coupons')) }}">
                    <a href="{{ route('admin.coupons') }}">
                        <i class="fa fa-tag"></i>
                        <span>{{ trans('menus.backend.sidebar.coupons') }}</span>
                    </a>
                </li>
            @endauth

            
            <li class="header">{{ trans('menus.backend.sidebar.admin-messaging') }}</li>
            <li class="{{ active_class(Active::checkUriPattern('admin/messages*')) }}">
                <a href="{{ route('admin.messages.index') }}">
                    <i class="fa fa-envelope"></i>
                    <span>{{ trans('menus.backend.sidebar.admin-messages') }}</span>
                </a>
            </li>
            
            
            <li class="header">{{ trans('menus.backend.sidebar.site-configuration') }}</li>
            <li class="{{ active_class(Active::checkUriPattern('admin/settings/env')) }}">
                <a href="{{ route('admin.settings.env') }}">
                    <i class="fa fa-cog"></i>
                    <span>{{ trans('menus.backend.sidebar.environmental-variables') }}</span>
                </a>
            </li>
            <li class="{{ active_class(Active::checkUriPattern('admin/settings')) }}">
                <a href="{{ route('admin.settings.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>{{ trans('menus.backend.sidebar.site-settings') }}</span>
                </a>
            </li>
            <li class="header">{{ trans('menus.backend.sidebar.maintenance') }}</li>
            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>