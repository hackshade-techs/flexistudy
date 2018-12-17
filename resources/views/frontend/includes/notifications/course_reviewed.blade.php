<li>
  <div class="col-md-12 col-sm-12 col-xs-12 pd-l0">
    <p class="{{ $notification->read() ? 'read-notification' : 'unread-notification' }}">
      <a href="/author/courses/{{$notification->data['course_slug']}}/manage/approval">
        {{trans('strings.frontend.course-reviewed')}}: <b>{{ $notification->data['course_title'] }}</b></a> 
      
      <a href="{{route('frontend.user.notification.mark-as-read', $notification->id)}}" class="rIcon"><i class="fa fa-dot-circle-o pull-right"></i></a>
      
    </p>

    <p class="time">{{$notification->created_at->diffForHumans()}} </p>
  </div>
</li>