<div class="create-course-sidebar">
    <ul class="list-bar">
        <a href="{{route('frontend.author.course.edit', $course)}}">
            <li {!! Request::path() == 'author/course/'. $course->slug . '/manage' ? ' class="active"' : null !!}>
                <span class="count"><i class="fa fa-check"></i></span>{{trans('strings.frontend.course-info')}}
            </li>
        </a>
        <a href="{{route('frontend.author.course.curriculum', $course)}}">
            <li {!! Request::path() == 'author/course/'. $course->slug . '/curriculum' ? ' class="active"' : null !!}>
                <span class="count"><i class="fa fa-check"></i></span>{{trans('strings.frontend.course-content')}}
            </li>
        </a>
        <a href="{{route('frontend.author.coupons.index', $course)}}">
            <li {!! Request::path() == 'author/courses/'. $course->slug . '/manage/price-and-coupons' ? ' class="active"' : null !!}>
                <span class="count"><i class="fa fa-check"></i></span>{{trans('strings.frontend.pricing-and-coupons')}}
            </li>
        </a>
        @if(count($course->approvals))
            <a href="{{route('frontend.author.course.approval', $course)}}">
                <li {!! Request::path() == 'author/courses/'. $course->slug . '/manage/approval' ? ' class="active"' : null !!}>
                    <span class="count"><i class="fa fa-check"></i></span>{{trans('strings.frontend.admin-review')}}
                </li>
            </a>
        @endif
        @if(!$course->published)
            
    		<form action="{{ route('frontend.author.submit.review', $course->id) }}" method="post">
				{{	csrf_field() }}
				{{ method_field('PUT') }}
				<li>
					<button type="submit" class="btn btn-block btn-success">{!! !$course->approved  ? trans('strings.frontend.submit-for-review') : trans('strings.frontend.publish-course') !!}</button>
				</li>
			</form>
			
		@else
		    <a href="{{route('frontend.author.announcements.index', $course)}}">
                <li {!! Request::path() == 'author/courses/'. $course->slug . '/manage/announcements' || Request::path() == 'author/courses/'. $course->slug . '/manage/announcements/create' ? ' class="active"' : null !!}>
                    <span class="count"><i class="fa fa-check"></i></span>{{trans('strings.frontend.announcements')}}
                </li>
            </a>
            @if($course->approved)
                <form action="{{ route('frontend.author.submit.review', $course->id) }}" method="post">
    				{{	csrf_field() }}
    				{{ method_field('PUT') }}
    				<li>
    					<button type="submit" {{count($course->students) ? 'disabled':''}} class="btn btn-block btn-danger">{{trans('strings.frontend.unpublish-course')}}</button>
    				</li>
    			</form>
			@endif
        @endif
        
        @if($course->published && !$course->approved)
			<li>
				<button type="submit" class="btn btn-block btn-warning disabled">{{trans('strings.frontend.under-review')}}</button>
			</li>
        @endif
        
        @if($course->canBeDeleted())
			<li>
			    <a href="{{route('frontend.author.course.destroy', $course)}}"
                     data-method="delete"
                     data-trans-button-cancel="{{trans('buttons.general.cancel')}}"
                     data-trans-button-confirm="{{trans('buttons.general.crud.delete')}}"
                     data-trans-title="{{trans('strings.backend.general.are_you_sure')}}"
                     class="btn btn-block btn-danger"><i class="fa fa-trash"></i> {{ trans('buttons.general.crud.delete') }}
                 </a>
			</li>
        @endif
        
    </ul>
</div>


