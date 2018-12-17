<div class="modal fade" id="preview-video" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="padding:5px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding:0px;">
        <div class="video-course-intro" style="padding:0px;">
          <div class="inner">
            <div align="center" class="video-js-box hu-css">
              <video id="previewPlayer" class="video-js vjs-default-skin vjs-big-play-centered"
                  controls preload="auto" width="60%" height="264"
                  data-setup='{"techOrder": ["vimeo", "youtube", "html5"], "fluid": true, "preload": "auto", "autoplay": false, "playbackRates": [0.5, 0.75, 1, 1.5, 2] }'
                  poster="">
                  <source type="video/{{$preview_lessons[0]->video_provider}}" src="{{$preview_lessons[0]->video_link}}"></source>
              </video>
            </div>
          </div>
        </div>
      
        <div class="playlist-components" style="padding: 10px;">
          <ul class="list-group playlist-menu">
            @foreach($preview_lessons as $video)
              <li class="list-group-item preview"><a href="#" class="lesson-title" data-video="{{$video->video_link}}" data-type="{{$video->video_provider}}">{{$video->title}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
