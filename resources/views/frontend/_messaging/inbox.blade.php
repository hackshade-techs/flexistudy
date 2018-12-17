@extends('frontend.layouts.app')

@section('title')
    {{trans('strings.frontend.messages')}}
@stop

@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay">
            <div class="container">
                <div class="left">
                    <h2 style="font-size: 35px;">{{trans('strings.frontend.messages')}}</h2>
                    <p>{{$myUnreadMessages}} {{trans('strings.frontend.unread')}}</p>
                    <p><i class="fa fa-minus"></i><i class="fa fa-minus"></i></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CONTEN BAR -->
    <section id="course-concern" class="course-concern">
        <div class="container">

            <div class="message-body">
                <threads is_admin="{{ Auth::user()->hasRole('Administrator') }}" first_thread="{{$firstThread ? $firstThread->id : null}}" inline-template>
                    
                    <div class="row" v-cloak>
                        <div class="col-md-4">
                            <div class="message-sb">
                                <div class="message-sb-title">
                                    <form class="form-horizontal clearfix">
                                        <div class="col-md-12">
                                            <span v-if="searching" class="thread-search">
                                                <vue-fuse :keys="keys" :list="threads" :default-all="false" :threshold="0.3"></vue-fuse>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="list-wrap ps-container ps-active-y">
                                    <ul class="list-message">
                                        <li class="ac-new" v-for="thread in threads">
                                            <a href="#" @click.prevent="handler(thread.id)">
                                                <div class="image">
                                                    <img :src="thread.creator_image" alt="">
                                                </div>
                                                <div class="list-body">
                                                    <div class="author">
                                                        <span>@{{thread.creator}}</span>
                                                        <div class="div-x" v-if="thread.isUnread"></div>
                                                    </div>
                                                    <p>@{{ thread.subject }}</p>
                                                    <div class="time">
                                                        <span>@{{thread.created_at }}</span>
                                                    </div>
                                                    <div class="indicator">
                                                        <i class="icon md-paperclip"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                   
                                    <div class="ps-scrollbar-x-rail" style="width: 366px; display: none; left: 0px;">
                                        <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps-scrollbar-y-rail" style="top: 0px; height: 440px; display: inherit; right: 0px;">
                                        <div class="ps-scrollbar-y" style="top: 0px; height: 150px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="col-md-8">
                            <messages v-if="selected_thread" :thread="selected_thread" :key="selected_thread" inline-template>
                                <div class="panel-body">
                                    <div class="bootstrap snippet">
                                        <div class="portlet portlet-green">
                                            <div id="chat" class="panel-collapse collapse in">
                                                <div id="chat-widget" class="portlet-body chat-widget" style="overflow-y: auto; width: auto; max-height: 700px;">
                                                    <div v-for="message in messages">
                                                        <div class="row">
                                                            <div class="col-lg-12" :class="message.creator_id == message.auth_user ? 'author-chat':''">
                                                                <div class="media">
                                                                    <a class="pull-left" href="#">
                                                                        <img class="media-object img-circle chat-image" :src="message.creator_image" alt="">
                                                                    </a>
                                                                    
                                                                    <div class="media-body">
                                                                        <h5 class="media-heading" style="color: #3dabf2; font-weight: normal; font-size: 14px;">
                                                                            <span v-if="message.creator_id != message.auth_user">@{{ message.creator }}</span>
                                                                            <span v-else>{{trans('strings.frontend.you')}}</span>
                                                                            <span class="small pull-right"><small>@{{ message.created_at }}</small></span>
                                                                        </h5>
                                                                        <p>@{{ message.body }}</p>
                                                                    </div>
                                                                </div>
                                                                <hr style="margin-top: 5px; margin-bottom: 5px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="portlet-footer">
                                                <form role="form" @keydown.enter.ctrl="sendMessage(thread)" >
                                                    <div class="form-group">
                                                        <textarea placeholder="{{trans('strings.frontend.enter-your-message')}}..." v-model="body"></textarea>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <small>{!!trans('strings.frontend.enter-command-to-send')!!}</small>
                                                        <button type="submit" class="btn btn-default pull-right" @click.prevent="sendMessage(thread)">{{trans('strings.frontend.send')}}</button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>                
                                </div>
                            </messages>
                        </div>
                    </div>
                    
                </threads>
            </div>
        </div>
    </section>
    <!-- END / CONTENT BAR -->
@endsection

@section('after-scripts')
    

    <style>
        .chat-image{max-width: 50px;}
        .portlet { margin-bottom: 15px;}
        .btn-white {
            border-color: #cccccc;
            color: #333333;
            background-color: #ffffff;}
        .portlet {border: 1px solid;}
        .portlet .portlet-heading {padding: 0 15px;}
        .portlet .portlet-heading a {color: #fff;}
        .portlet .portlet-heading a:hover,
        .portlet .portlet-heading a:active,
        .portlet .portlet-heading a:focus {outline: none;}
        .portlet .portlet-heading .portlet-title {float: left;}
        .portlet .portlet-heading .portlet-title h4 {margin: 10px 0;}
        .portlet .portlet-heading .portlet-widgets {float: right;margin: 8px 0;}
        .portlet .portlet-heading .portlet-widgets .tabbed-portlets {display: inline;}
        .portlet .portlet-heading .portlet-widgets .divider {margin: 0 5px;}
        .portlet .portlet-body {padding: 15px;background: #fff;}
        .portlet .portlet-footer {padding: 10px;background: #fbfbfb;}
        .portlet .portlet-footer ul {margin: 0;}
        .portlet-green,.portlet-green>.portlet-heading {border-color: #5bc0de;}
        .portlet-green>.portlet-heading {color: #fff; background-color: #16a085;}
        @media(min-width:768px) {
            .portlet {margin-bottom: 30px;}
        }
        
        .text-green {color: #16a085;}
        .text-orange {color: #f39c12;}
        .text-red {color: #e74c3c;}  
    </style>
@endsection