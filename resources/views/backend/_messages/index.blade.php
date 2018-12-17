@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.manage-messages'))

@section('after-styles')
    <style type="text/css">
      .badge {
        padding: 1px 8px 1px;
        background-color: #aaa !important;
      }
    </style>
@endsection

@section('page-header')
    <h1>
        {{trans('strings.backend.manage-messages')}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            
            <div class="pull-left">
                <div id="tri" class="btn-group btn-group-sm">
                    <a href="{{route('admin.messages.index')}}" type="button" name="total" class="btn btn-default {{$filter=='all' ? 'active':''}}">{{trans('strings.backend.all')}}
                    </a>
                    <a href="{{route('admin.messages.index')}}?filter=draft" type="button" name="total" class="btn btn-default {{$filter=='draft' ? 'active':''}}">{{trans('strings.backend.draft-messages')}}</a>
                    
                    <a href="{{route('admin.messages.index')}}?filter=sent" type="button" name="total" class="btn btn-default {{$filter=='sent' ? 'active':''}}">{{trans('strings.backend.sent-messages')}}</a>
                </div>
            </div><!--box-tools pull-right-->
            
            <div class="pull-right mb-10">
                <div class="btn-group">
                    <a href="{{route('admin.messages.create')}}" class="btn btn-primary btn-md">{{trans('strings.backend.create-new')}}</a>
                </div>
            </div><!--pull right-->
            <div class="clearfix"></div>
        </div><!-- /.box-header -->
        
        <div class="box-body">
            <div class="table-responsive">
                <table id="courses-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{trans('strings.backend.id')}}</th>
                            <th>{{trans('strings.backend.subject')}}</th>
                            <th>{{trans('strings.backend.body')}}</th>
                            <th>{{trans('strings.backend.status')}}</th>
                            <th>{{trans('strings.backend.created-on')}}</th>
                            <th>{{trans('strings.backend.sent-on')}}</th>
                            <th>{{trans('strings.backend.recipients')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{!! str_limit($message->body, 150)!!}</td>
                                <td>{{ $message->sent ? 'Sent':'Draft' }}</td>
                                <td>{{ $message->created_at }}</td>
                                <td>{{ $message->sent ? $message->updated_at : null }}</td>
                                <td>{{ $message->recipient_group }}</td>
                                
                                <td>
                                    {!! Form::open(['route' => ['admin.messages.destroy', $message->id], 'method'=>'POST', 'class' => 'form-horizontal delete-message-form']) !!} 
                                        <a href="{{ route('admin.messages.edit', $message->id) }}" class="btn btn-xs btn-success edit">
                                            {{$message->sent ? trans('strings.backend.view'):trans('strings.backend.edit')}}
                                        </a>
                                        
                                        @if(!$message->sent)
                                            <a href="{{ route('admin.messages.send', $message->id) }}" class="btn btn-xs btn-success edit">{{trans('strings.backend.send')}}</a>
                                        @endif
                                        
                                        <button {{ $message->sent ? 'disabled':''}} class="btn btn-xs btn-danger delete">{{trans('strings.backend.delete')}}</button>
                                       
                                        
                                        {{ METHOD_FIELD('DELETE') }}
                                        
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
        
    </div><!--box-->

@endsection


@section('after-scripts')
    <script>
        //confirm delete
        $('button.delete').on('click', function(e){
            e.preventDefault();
            
            swal({   
                title: "{{trans('strings.backend.are-you-sure')}}",
                text: "{{trans('strings.backend.unable-to-recover')}}",
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{trans('strings.backend.yes-delete')}}", 
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true
            }, 
            
            function(isConfirmed){   
                if(isConfirmed){
                    setTimeout(function(){
                        swal("{{trans('strings.backend.deleted')}}", "", "success");
                        $(".delete-message-form").submit();
                    }, 2000);
                } else {
                       swal("{{trans('strings.backend.cancelled')}}", "", "error"); 
                }
              
            });
        });
    </script>

@endsection