<div class="mc-item mc-item-1">
    <div class="image-heading">
        <a href="{{ route('frontend.course.show', $course) }}">
            <img src="{{$course->image}}" style="max-width: 100%;" alt="">
        </a>
    </div>
    <div class="meta-categories"><a href="#">{{ $course->category->name }}</a></div>
    <div class="content-item">
        <div class="image-author">
            <img src="{{ $course->author->picture }}" alt="">
        </div>
        <h4><a href="{{ route('frontend.course.show', $course) }}">{{ $course->title }}</a></h4>
        <div class="name-author">
            <a href="{{route('frontend.user.public.profile', $course->author)}}">{{ $course->author->name }}</a>
        </div>
    </div>
    <div class="ft-item">
        <div class="ratingx">
            <stars :rating="{{$course->average_rating}}" size="20"></stars>
            @if($course->total_reviews > 0 )
                <span>{{$course->average_rating}}</span>
                <span class="text-muted"> ({{$course->total_reviews}})</span>
            @endif
        </div>
        
        <div class="view-info">
            @if(Auth::user() && $course->price > 0)
                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#affiliateLink-{{$course->id}}">
                    {{trans('strings.frontend.promote-this-course')}}
                </button>
                <!--<affiliate-button link="{{ URL::route('frontend.course.show', ['course' => $course, 'ref' => Auth::user()->username]) }}">
                </affiliate-button>-->
            @endif
        </div>
            
        <div class="price">
           {{ Helper::getPrice($course) }}
        </div>
    </div>
</div>

