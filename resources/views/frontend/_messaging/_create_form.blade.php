<form action="{{ route('frontend.user.messages.store') }}" method="post">
    <div class="col-md-12">
        <!-- Subject Form Input -->
        <div class="form-group">
            <input type="text" class="form-control" name="subject" placeholder="{{trans('strings.frontend.subject')}}" value="{{ old('subject') }}">
        </div>
        
        <input type="hidden" name="receiver_id[]" id="receiver_id"/>
        <!-- Message Form Input -->
        <div class="form-group">
            <!--<label class="control-label">Message</label>-->
            <textarea name="message" class="form-controlx" placeholder="{{trans('strings.frontend.enter-your-message')}}">{{ old('message') }}</textarea>
        </div>
        {{ csrf_field() }}
        <!-- Submit Form Input -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{trans('strings.frontend.send')}}</button>
        </div>
    </div>
    
</form>