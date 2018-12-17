<!-- FOOTER -->
    <footer id="footer" class="footer">
        <div class="first-footer">
            <div class="container">
                <div class="row">
                    
                    
                    <div class="widget">
                        <div class="col-md-10">
                            <ul class="list-inline" style="text-aligh:center !important;">
                                <li><a href="/contact-us">{{trans('strings.frontend.contact-us')}}</a></li>
                                @foreach($footerPages as $page)
                                    <li><a href="{{route('frontend.pages.show', $page)}}">{{$page->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                                
                        <div class="col-md-2">
                            @if (config('locale.status') && count(config('locale.languages')) > 1)
                                <div class="dropup" style="margin-top:10px;">
                                    <a href="#" class="dropdown-toggle white" data-toggle="dropdown">
                                        <img src="/images/flags/{{app()->getLocale()}}.svg" style="width:16px;"/> 
                                        {{ trans('menus.language-picker.language') }} <i class="caret"></i>
                                    </a>
                                    @include('includes.partials.lang')
                                </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="second-footer">
            <div class="container">
                <div class="contact">
                    <div class="email">
                        @if(!is_null(config('settings.social_facebook')) && !empty(config('settings.social_facebook')))
                            <a href="#">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        @endif
                        @if(!is_null(config('settings.social_google')) && !empty(config('settings.social_google')))
                            <a href="#">
                                <i class="fa fa-google-plus-square "></i>
                            </a>
                        @endif
                        @if(!is_null(config('settings.social_youtube')) && !empty(config('settings.social_youtube')))
                            <a href="#">
                                <i class="fa fa-youtube-square"></i>
                            </a>
                        @endif
                        @if(!is_null(config('settings.social_twitter')) && !empty(config('settings.social_twitter')))
                            <a href="#">
                                <i class="fa fa-twitter-square"></i>
                            </a>
                        @endif
                    </div>
                    
                    @if(!is_null(config('settings.contact_email')) && !empty(config('settings.contact_email')))
                        <div class="email">
                            <i class="fa fa-envelope"></i>{{config('settings.contact_email')}}
                        </div>
                    @endif
                    
                </div>
                <p class="copyright">© 2017 {{config('app.name')}}. {{trans('strings.frontend.all-rights-reserved')}}.</p>
            </div>
        </div>
    </footer>
    <!-- END / FOOTER -->