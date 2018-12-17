@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.manage-environment-variables'))

@section('after-styles')
    <link href="/public/css/backend/plugin/jquery-linedtextarea.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style type="text/css">
        .textarea{
            width: 100%;
            height: 80%;
            background: #e5f2f7;
        }
        
        textarea {
            resize: none;
        }
    </style>
@endsection

@section('page-header')
    <h1>
        {{trans('strings.backend.manage-environment-variables')}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-body">
            <p class="alert alert-warning">
                **{{ trans('installer_messages.no-spaces') }}
            </p>
            
            <form method="post" action="{{ config('demo.demo_mode') ? '#': route('admin.settings.env.save') }}">
                {!! csrf_field() !!}
                <div class="form-group clearfix">
                    <textarea id="env" spellcheck="false" class="textarea form-control" rows="40" name="envConfig">{{ $envConfig }}</textarea>
                </div>
                <div class="buttons buttons--right form-group">
                    <button class="btn btn-success btn-lg pull-right" {{config('demo.demo_mode') ? 'disabled':''}} type="submit">{{ trans('installer_messages.environment.save') }}</button>
                </div>
            </form>
            
        </div><!-- /.box-body -->
    </div><!--box-->

@endsection

@section('after-scripts')

@endsection