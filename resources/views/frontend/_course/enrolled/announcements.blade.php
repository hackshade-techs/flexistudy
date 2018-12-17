@extends('frontend.layouts.app')
@section('title')
    {{$course->title}}
@stop
@section('content')

    @include('frontend._course.enrolled._top')
    
    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">
                <!-- left -->
                <div class="col-md-12">
                    <div class="sidebar-course-intro">
                        @foreach($course->announcements as $announcement)
                            <div class="panel panel-body">
                                <h4 class="xsm black bold">{{$announcement->title}}</h4>
                                <ul class="announcement">
                                    <li>
                                        <div class="image-instructor text-center">
                                            <img src="{{ $course->author->picture }}" alt="">
                                        </div>
                                        <div class="info-instructor">
                                            <a href="#">{{$course->author->name}}</a>
                                            <span>{{$announcement->created_at->diffForHumans()}}</span>
                                            
                                            <p>
                                                {!! $announcement->body !!}
                                            </p>
                                        </div>
                                        <hr class="line">
                                        
                                    </li>
                                </ul>
                                
                                <!-- comments -->
                                <announcement-comments :announcement_id="{{$announcement->id}}" inline-template>
                                    <span v-cloak>
                                        <div id="respond">
                                            <form @submit.prevent="storeComment()">
                                                <textarea class="comment-box" placeholder="{{trans('strings.frontend.enter-comment')}}..." v-model="body"></textarea>
                                                <div class="form-submit">
                                                    <input type="{{trans('strings.frontend.submit')}}" value="{{trans('strings.frontend.post')}}" class="btn btn-success btn-sm">
                                                </div>
                                            </form>
                                        </div>
                                        <h5>{{trans('strings.frontend.comments')}}: @{{meta.total}}</h5>
                                        <ul class="commentlist" v-for="comment in comments">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <div class="comment-author">
                                                        <a href="#" class="pull-left avatar-img">
                                                            <img :src="comment.user.image" alt="">
                                                        </a>
                                                        <!--<img :src="comment.user.image" alt="">-->
                                                        <span class="author-meta">
                                                            <a href="">@{{comment.user.full_name}}</a>
                                                            <span class="text-muted">
                                                                <small>@{{comment.created_at_human}}</small>
                                                                <small v-if="comment.updated_at_human"></small>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="comment-content">
                                                        <span class="pull-right">
                                                            <a href="#" @click.prevent="fetchEditComment(comment.id)" v-if="comment.user.can_edit && !showEdit">{{trans('strings.frontend.edit')}}</a>
                                                            <a href="#" v-if="showEdit && editComment.id == comment.id" @click.prevent="showEdit=false">{{trans('strings.frontend.cancel')}}</a>
                                                            <a href="#" @click.prevent="deleteComment(comment.id)" v-if="comment.user.can_edit && !showEdit" class="text-danger">{{trans('strings.frontend.delete')}}</a>
                                                        </span>
                                                        <p>@{{ comment.body }}</p>
                                                        
                                                        <div v-if="showEdit && editComment.id == comment.id">
                                                            <form @submit.prevent="updateComment(comment.id)">
                                                                <textarea class="comment-box" v-model="editComment.body"></textarea>
                                                                <div class="form-submit">
                                                                    <input type="{{trans('strings.frontend.submit')}}" value="Update" class="btn btn-success btn-sm pull-right">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                      
                                        <div class="load-more" v-if="comments.length > 0 && current_page < total_pages">
                                            <a href="" @click.prevent="fetchMoreComments()"><i class="icon md-time"></i>{{trans('strings.frontend.load-more')}}</a>
                                        </div>
                                    </span>
                                    
                                </announcement-comments>
                                
                                
                            </div>
                            
                            <hr>
                        @endforeach
                        
                        
                        
                        
                    </div>
                </div>
                
                
                <!-- right -->

            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
    

@endsection

@section('after-scripts')
    
@endsection