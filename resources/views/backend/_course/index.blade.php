@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.courses.course-management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.courses.course-management') }}
        <small>{{ trans('labels.backend.courses.course-management-small') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="pull-right">
                
                <div class="pull-right mb-10">
                    <div class="btn-group">
                        @if($filter == 'approved')
                            <button type="button" class="btn btn-success btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{trans('labels.backend.courses.approved')}}
                                <span class="caret"></span>
                            </button>
                        @elseif($filter == 'pending_approval')
                            <button type="button" class="btn btn-warning btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{trans('labels.backend.courses.pending-approval')}}
                                <span class="caret"></span>
                            </button>
                        @elseif($filter == 'unpublished')
                             <button type="button" class="btn btn-danger btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{trans('labels.backend.courses.unpublished')}}
                                <span class="caret"></span>
                            </button>
                        @elseif($filter == 'draft')
                            <button type="button" class="btn btn-info btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{trans('labels.backend.courses.draft')}}
                                <span class="caret"></span>
                            </button>
                        @else 
                            <button type="button" class="btn btn-primary btn-md dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                {{trans('labels.backend.courses.all-courses')}}
                                <span class="caret"></span>
                            </button>
                        @endif
                            

                        <ul class="dropdown-menu" role="menu">
                            <li>{{ link_to_route('admin.courses.index', trans('labels.backend.courses.all-courses'), ['filter'=>'all']) }}</li>
                            <li>{{ link_to_route('admin.courses.index', trans('labels.backend.courses.approved'), ['filter'=>'approved']) }}</li>
                            <li>{{ link_to_route('admin.courses.index', trans('labels.backend.courses.pending-approval'), ['filter'=>'pending_approval']) }}</li>
                            <li>{{ link_to_route('admin.courses.index', trans('labels.backend.courses.unpublished'), ['filter'=>'unpublished']) }}</li>
                            <li>{{ link_to_route('admin.courses.index', trans('labels.backend.courses.draft'), ['filter'=>'draft']) }}</li>
                        </ul>
                    </div><!--btn group-->
                </div><!--pull right-->
                
                <div class="clearfix"></div>
                
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="courses-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                            <th>{{ trans('labels.backend.courses.title') }}</th>
                            <th>{{ trans('labels.backend.courses.author') }}</th>
                            <th>{{ trans('labels.backend.courses.category') }}</th>
                            <th>{{ trans('labels.backend.courses.price') }}</th>
                            <th>{{ trans('labels.backend.courses.language') }}</th>
                            <th>{{ trans('labels.backend.courses.published') }}</th>
                            <th>{{ trans('labels.backend.courses.approved') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}

    <script>
        $(function () {
            $('#courses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.courses.get") }}?filter={{$filter}}',
                    type: 'post'
                    //data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'title'},
                    {data: 'author.name', name: 'author.name'},
                    {data: 'category.name', name: 'category.name'},
                    {data: 'price', name: 'price'},
                    {data: 'language', name: 'language'},
                    {data: 'published', name: 'published'},
                    {data: 'approved', name: 'approved'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
            
            
        });
        
        
    </script>
@endsection
