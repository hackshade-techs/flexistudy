@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.withdrawal.withdrawal-management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.withdrawal.withdrawal-management') }}
        <small>{{ trans('labels.backend.withdrawal.withdrawal-management-small') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border clearfix">
            
            <div class="pull-left">
                <div id="tri" class="btn-group btn-group-sm">
                    <a href="{{route('admin.withdrawals.index')}}?filter=" type="button" name="total" class="btn btn-default {{is_null($filter) ? 'active':''}}">
                        {{trans('labels.backend.withdrawal.all-requests')}}
                    </a>
                    <a href="{{route('admin.withdrawals.index')}}?filter=submitted" type="button" name="total" class="btn btn-default {{$filter=='submitted' ? 'active':''}}">
                        {{trans('labels.backend.withdrawal.submitted')}}
                    </a>
                    <a href="{{route('admin.withdrawals.index')}}?filter=processing" type="button" name="total" class="btn btn-default {{$filter=='processing' ? 'active':''}}">
                        {{trans('labels.backend.withdrawal.processing')}}
                    </a>
                    <a href="{{route('admin.withdrawals.index')}}?filter=processed" type="button" name="total" class="btn btn-default {{$filter=='processed' ? 'active':''}}">
                        {{trans('labels.backend.withdrawal.processed')}}
                    </a>
                </div>
            </div><!--box-tools pull-left-->
        </div><!-- /.box-header -->

        <div class="box-body clearfix">
            <div class="table-responsive">
                <table id="withdrawal-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.user') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.paypal-email') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.amount') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.user-account-balance') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.status') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.date') }}</th>
                            <th>{{ trans('labels.backend.withdrawal.comment') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
        
        <!--------------------- modal for sending messages --------------------->
        <div class="modal fade" id="updateWithdrawal" role="dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                
                <div class="modal-body clearfix">
                    <form action="{{route('admin.withdrawals.update')}}" method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" id="withdrawal_id" name="withdrawal_id"/>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status" id="withdrawal_status" >
                                <option value="submitted">{{trans('strings.backend.submitted')}}</option>
                                <option value="processing">{{trans('strings.backend.processing')}}</option>
                                <option value="processed">{{trans('strings.backend.processed')}}</option>
                            </select> 
                        </div>
                        <div class="form-group">
                            <textarea name="comment" class="form-control" id="withdrawal_comment" placeholder="{{trans('strings.backend.any-comment')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-success">{{trans('strings.backend.update')}}</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer clearfix">
                  <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('strings.backend.close')}}</button>
                </div>
              </div>
            </div>
          </div>
        <!--------------------- //modal for sending message --------------------->
        
        
    </div><!--box-->

@endsection

@section('after-scripts')
    {{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
    
    <script type="text/javascript">

        $(document).on("click", ".updateWithdrawal", function () {
            var withdrawal_id = $(this).data('id');
            var withdrawal_status = $(this).data('status');
            var withdrawal_comment = $(this).data('comment');
             
            $(".modal-body #withdrawal_id").val(withdrawal_id);
            $(".modal-body #withdrawal_status").val(withdrawal_status);
            $(".modal-body #withdrawal_comment").val(withdrawal_comment);
        });
    </script>
    
    <script>
        $(function () {
            $('#withdrawal-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.withdrawals.get") }}?filter={{$filter}}',
                    type: 'post'
                    //data: {status: 1, trashed: false}
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.name', name: 'user.name'},
                    {data: 'paypal_email', name: 'paypal_email'},
                    {data: 'amount', name: 'amount'},
                    {data: 'account_balance', name: 'account_balance'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'comment', name: 'comment'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
