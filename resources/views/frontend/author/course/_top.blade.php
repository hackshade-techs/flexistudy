<div class="jumbotron">
    <div class="bg-stripe-overlay" style="text-align:left; padding: 55px;">
        <div class="container">
            <div class="info-author">
                <div class="image course" style="margin-top:0;">
                    <img src="{{ Helper::coverImage($course) }}" alt="">
                </div>
                <div class="name-author">
                    <h2 style="font-size:35px; margin-top:0px;">
                        {{ $course->title }}
                        <p style="margin-bottom:0px;">{{$course->subtitle}}</p>
                        <div class="well button-set one" style="margin:0; opacity:0.7; text-transform:uppercase; font-size:20px;"> 
                            {{$course->statusCode()}}
                            <p style="margin-bottom:0px;font-size:15px;">{!! $course->status() !!}</p>
                           
                        </div>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
