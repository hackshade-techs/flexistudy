@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.manage-blog'))

@section('after-styles')
    <style type="text/css">
      .badge {
        padding: 1px 8px 1px;
        background-color: #aaa !important;
      }
    </style>
@endsection

@section('page-header')
    <h1>{{trans('strings.backend.manage-blog')}}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            
            <div class="pull-left">
                <div id="tri" class="btn-group btn-group-sm">
                    <a href="{{route('admin.pages.index')}}?filter=all" type="button" name="total" class="btn btn-default {{$filter=='all' ? 'active':''}}">{{trans('strings.backend.all')}}
                    </a>
                    <a href="{{route('admin.pages.index')}}?filter=pages" type="button" name="total" class="btn btn-default {{$filter=='pages' ? 'active':''}}">{{trans('strings.backend.site-pages')}}
                    </a>
                    
                    <a href="{{route('admin.pages.index')}}?filter=posts" type="button" name="total" class="btn btn-default {{$filter=='posts' ? 'active':''}}">{{trans('strings.backend.blog-posts')}}
                    </a>
                </div>
            </div><!--box-tools pull-right-->
            
            <div class="pull-right">
                <div class="pull-right mb-10">
                    <div class="btn-group">
                        <a href="{{route('admin.pages.create')}}" class="btn btn-primary btn-md">{{trans('strings.backend.create-new')}}</a>
                    </div>
                </div><!--pull right-->
                <div class="clearfix"></div>
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="courses-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{trans('strings.backend.id')}}</th>
                            <th>{{trans('strings.backend.title')}}</th>
                            <th>{{trans('strings.backend.type')}}</th>
                            <th style="text-align:center;">{{trans('strings.backend.featured-frontend')}}</th>
                            <th>{{trans('strings.backend.permalink')}}</th>
                            <th>{{trans('strings.backend.language')}}</th>
                            <th>{{trans('strings.backend.category')}}</th>
                            <th>{{trans('strings.backend.status')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td><span class="label label-{{$post->type == 'page' ? 'success' : 'info'}}">{{strToUpper($post->type)}}</span></td>
                                <td style="text-align:center;">{!! $post->featured_frontend ? '<i class="fa fa-check text-success"></i>' : '' !!}</td>
                                <td>{{ $post->slug }}</td>
                                <td><img src="/images/flags/{{$post->lang}}.svg" style="width:16px;" /> {{ strToUpper($post->lang) }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->published ? 'Published':'Draft' }}</td>
                                <td>
                                    <a href="{{ route('admin.pages.edit', [$post->slug, $post->lang]) }}" class="btn btn-xs btn-success edit">Edit</a>
                                        
                                    <a href="javascript:;" class="btn btn-xs btn-danger delete-btn tn-circle dark btn-sm black" 
                                        data-slug="{{$post->slug}}" data-lang="{{$post->lang}}">
                                        <i class="fa fa-trash"></i> {{ trans('buttons.general.crud.delete') }}
                                    </a>
                                    
                                    {!! Form::open(['route' => ['admin.pages.destroy', 'post' => $post->slug, 'locale' => $post->lang], 'method'=>'POST', 'class' => 'form-horizontal delete-category-form']) !!} 
                                        <a href="{{ route('admin.pages.edit', [$post->slug, $post->lang]) }}" class="btn btn-xs btn-success edit">Edit</a>
                                        
                                        <button class="btn btn-xs btn-danger delete">Delete</button>
                                       
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
        $(".delete-btn").click(function () {
            var slug = $(this).attr('data-slug');
            var lang = $(this).attr('data-lang');
            swal({
                title: "{{trans('strings.backend.are-you-sure')}}",
                text: "{{trans('strings.backend.unable-to-recover')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{trans('strings.backend.yes-delete')}}",
                cancelButtonText: "{{trans('strings.backend.cancel')}}",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: "/admin/pages/"+slug+"/"+lang+"/delete",
                        data:{
                            slug:slug,
                            lang:lang,
                            '_token': '{{csrf_token()}}'
                        },
                        success: function (data) {
                            location.reload();
                        }
                    })
                } else {
                    swal("{{trans('strings.backend.cancelled')}}", "", "error"); 
                }
            });
        });
        
        /*
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
                        $(".delete-category-form").submit();
                    }, 2000);
                } else {
                       swal("{{trans('strings.backend.cancelled')}}", "", "error"); 
                }
              
            });
        });
        */
        
    </script>
    
    
    
@endsection
