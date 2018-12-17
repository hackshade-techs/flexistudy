@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.coupons'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('strings.backend.coupons') }}
        <small>{{ trans('strings.backend.coupons-small') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="pull-right">
                
                <div class="pull-right mb-10">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#create-coupon">{{trans('strings.backend.create-new')}}</button>
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
                            <th>{{trans('strings.backend.code')}}</th>
                            <th>{{trans('strings.backend.percent-off')}}</th>
                            <th>{{trans('strings.backend.quantity')}}</th>
                            <th>{{trans('strings.backend.redeemed')}}</th>
                            <th>{{trans('strings.backend.expires')}}</th>
                            <th>{{trans('strings.backend.status')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->percent }}</td>
                                <td>{{ $coupon->quantity }}</td>
                                <td>{{ $coupon->redeemed }}</td>
                                <td>{{ $coupon->expires }}</td>
                                <td>{!! $coupon->active ? '<span class="label label-success">'.trans('strings.backend.active').'</span>':'<span class="label label-warning">'.trans('strings.backend.inactive').'</span>' !!}</td>
                                <td>
                                    {!! Form::open(['route' => ['admin.coupons.destroy', $coupon->id], 'method'=>'POST', 'class' => 'form-horizontal delete-coupon-form']) !!} 
                                        {{ METHOD_FIELD('DELETE') }}
                                        @if($coupon->active)
                                            <a href="{{route('admin.coupons.activation', $coupon->id)}}" class="btn btn-xs btn-warning">{{trans('strings.backend.deactivate')}}</a>
                                        @else
                                            <a href="{{route('admin.coupons.activation', $coupon->id)}}" class="btn btn-xs btn-success">{{trans('strings.backend.activate')}}</a>
                                            @if($coupon->redeemed == 0)
                                                <button class="btn btn-xs btn-danger delete">{{trans('strings.backend.delete')}}</button>
                                            @endif
                                        @endif
                                    
                                        
                                    {!! Form::close() !!}
                                    
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
    
    <!-- MODALS: Create category -->
            
    <div class="modal fade" id="create-coupon" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="panel-body">
                        {!! Form::open(['route' => ['admin.coupons.store'], 'method'=>'POST', 'class' => 'form-horizontal create-coupon-form']) !!}    
                	        
                            <div class="form-group">
                                {!! Form::label("code", trans('strings.backend.code')) !!}
                                {!! Form::text("code", null, ['class'=>'form-control', 'required']) !!}
                                 @if ($errors->has('code'))
                                    <div class="text-danger"><small>{{ $errors->first('code') }}</small></div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label("quantity", trans('strings.backend.quantity')) !!}
                                {!! Form::number("quantity", null, ['class'=>'form-control', 'required']) !!}
                                 @if ($errors->has('quantity'))
                                    <div class="text-danger"><small>{{ $errors->first('quantity') }}</small></div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label("percent", trans('strings.backend.percent-off')) !!}
                                {!! Form::number("percent", null, ['class'=>'form-control', 'required']) !!}
                                 @if ($errors->has('percent'))
                                    <div class="text-danger"><small>{{ $errors->first('percent') }}</small></div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label("expires", trans('strings.backend.expires')) !!}
                                {!! Form::date("expires", null, ['class'=>'form-control expires', 'required']) !!}
                                <span class="err text-danger"></span>
                                 @if ($errors->has('expires'))
                                    <div class="text-danger"><small>{{ $errors->first('expires') }}</small></div>
                                @endif
                            </div>
                            
                	        {{ csrf_field() }}
                	        
                	    {!! Form::close() !!}  
                        
                    </div>
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('strings.backend.close')}}</button>
                	<button type="button" class="btn btn-info" id="create-coupon-submit">{{trans('strings.backend.add')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('after-scripts')
    <script>
        $(document).ready(function($){
            var CurrentDate = new Date();
            $('.expires').on('change', function(){
                
            })
            
			// create category
    		$('#create-coupon-submit').click(function(e){
    		    e.preventDefault();
    		    var expireDateStr = $('.expires').val();
                var expireDateArr = expireDateStr.split("-");
                console.log(expireDateArr)
                var expireDate = new Date(expireDateArr[0], expireDateArr[1], expireDateArr[2]);
                var todayDate = new Date();
                if (todayDate > expireDate) {
                    $('.err').html('Expiry day cannot be in the past');
                } else {
                    $('.err').html('');
                    $('.create-coupon-form').submit();
                };
    		});
	
        });
        
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
                        $(".delete-coupon-form").submit();
                    }, 2000);
                } else {
                       swal("{{trans('strings.backend.cancelled')}}", "", "error"); 
                }
              
            });
        });
        
        
    </script>
    
    
    
@endsection
