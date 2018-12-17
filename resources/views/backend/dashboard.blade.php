@extends('backend.layouts.app')
@section('title')
  Admin
@stop
@section('content')
    <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('strings.backend.revenue') }}</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                        @if(config('settings.currency_symbol_position') == 'front')
                            <h3><sup style="font-size: 20px">{{config('settings.currency_symbol')}}</sup> {{$lifetime_sales_amount}}</h3>
                        @else
                            <h3>{{$lifetime_sales_amount}}<sup style="font-size: 20px"> {{config('settings.currency_symbol')}}</sup></h3>
                        @endif
                      <p>{{trans('strings.backend.lifetime-sales-amount')}}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i>
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                        <h3> {{$lifetime_sales_count}} <sup style="font-size: 20px">{{ str_plural(trans('strings.backend.sale'), $lifetime_sales_count) }}</sup></h3>
                        <p>{{trans('strings.backend.lifetime-sales-quantity')}}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i>
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                        @if(config('settings.currency_symbol_position') == 'front')
                            <h3><sup style="font-size: 20px">{{config('settings.currency_symbol')}}</sup> {{$sales_this_month_amount}}</h3>
                        @else
                            <h3>{{$sales_this_month_amount}}<sup style="font-size: 20px"> {{config('settings.currency_symbol')}}</sup></h3>
                        @endif
                      <p>{{trans('strings.backend.this-month-sales-amount')}}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-line-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i>
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                        <h3> {{$sales_this_month_count}} <sup style="font-size: 20px">{{ str_plural(trans('strings.backend.sale'), $sales_this_month_count) }}</sup></h3>
                        <p>{{trans('strings.backend.this-month-sales-quantity')}}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-line-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i>
                    </a>
                  </div>
                </div>
                
            </div><!-- /.box-body -->
        </div><!--box box-success-->
    </div>
    <!------- Withdrawals -------->
    
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('strings.backend.withdrawals') }}</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                        @if(config('settings.currency_symbol_position') == 'front')
                            <h3><sup style="font-size: 20px">{{config('settings.currency_symbol')}}</sup> {{$lifetime_withdrawal_amount}}</h3>
                        @else
                            <h3>{{$lifetime_withdrawal_amount}}<sup style="font-size: 20px"> {{config('settings.currency_symbol')}}</sup></h3>
                        @endif
                      <p>{{ trans('strings.backend.lifetime-withdrawal-amount') }}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-angle-double-down"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i> {{ trans('strings.backend.total-withdrawals-processed') }}
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                        <h3> {{$lifetime_withdrawal_count}} <sup style="font-size: 20px">{{ str_plural(trans('strings.backend.withdrawal'), $lifetime_withdrawal_count) }}</sup></h3>
                        <p>{{ trans('strings.backend.lifetime-withdrawal') }}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-angle-double-down"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i> {{ trans('strings.backend.total-withdrawals-processed') }}
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            @if(config('settings.currency_symbol_position') == 'front')
                                <h3><sup style="font-size: 20px">{{config('settings.currency_symbol')}}</sup> {{$withdrawals_this_month_amount}}</h3>
                            @else
                                <h3>{{$withdrawals_this_month_amount}}<sup style="font-size: 20px"> {{config('settings.currency_symbol')}}</sup></h3>
                            @endif
                          <p>{{trans('strings.backend.this-month-withdrawal-amount')}}</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-angle-double-down"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          <i class="fa fa-money"></i> {{ trans('strings.backend.total-withdrawals-processed') }}
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3> {{$withdrawals_this_month_count}} <sup style="font-size: 20px">{{ str_plural(trans('strings.backend.withdrawal'), $withdrawals_this_month_count) }}</sup></h3>
                        <p>{{ trans('strings.backend.this-month-withdrawals') }}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-angle-double-down"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i> {{ trans('strings.backend.total-withdrawals-processed') }}
                    </a>
                  </div>
                </div>
                
                
                
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3> {{$pending_withdrawal_count}} <sup style="font-size: 20px">{{ str_plural(trans('strings.backend.withdrawal'), $pending_withdrawal_count) }}</sup></h3>
                        <p>{{ trans('strings.backend.pending-withdrawals') }}</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-angle-double-down"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      <i class="fa fa-money"></i> {{ trans('strings.backend.total-withdrawals-not-processed') }}
                    </a>
                  </div>
                </div>
                
                
            </div><!-- /.box-body -->
        </div><!--box box-success-->
    </div>
    
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! history()->render() !!}
            </div><!-- /.box-body -->
        </div><!--box box-success-->
    </div>
@endsection