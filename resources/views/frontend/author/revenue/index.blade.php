@extends('frontend.layouts.app')
@section('title')
    {{ trans('navs.frontend.instructor_dashboard') }} - {{trans('strings.frontend.revenue-report')}}
@stop
@section('content')
    
    @include('frontend.author.course._dashboard_top')
    
    <!-- CATEGORIES CONTENT -->
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-md-push-0">
                    <div class="content list">
                        <div class="row">
                            
                            <div class="panel-group">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="font-size: 18px;" href="#course-sales">
                                          {{trans('strings.frontend.course-sales-revenue')}}
                                          <span class="pull-right">
                                              {{trans('strings.frontend.lifetime')}}:
                                              <span class="label label-success">
                                                  {{Helper::currency(Auth::user()->total_earnings())}}  
                                              </span>
                                          </span>
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="course-sales" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <h5>{{trans('strings.frontend.purchase-details')}}</h5>
                                        <table class="table table-striped">
                                            <thead>
                                                <th>{{trans('strings.frontend.date')}}</th>
                                                <th>{{trans('strings.frontend.purchased-by')}}</th>
                                                <th>{{trans('strings.frontend.course')}}</th>
                                                <th>{{trans('strings.frontend.coupon-code')}}</th>
                                                <th>{{trans('strings.frontend.sales-channel')}}</th>
                                                <th>{{trans('strings.frontend.amount')}}</th>
                                                <th>{{trans('strings.frontend.your-earning')}}</th>
                                            </thead>
                                            <tbody>
                                                @foreach($all_user_earnings as $earning)
                                                 <tr>
                                                    <td>{{ date('F d, Y', strtotime($earning->created_at))}}</td>
                                                    <td>{{$earning->user->name}}</td>
                                                    <td>{{$earning->course->title}}</td>
                                                    <td>{{$earning->coupon ? $earning->coupon->code : null}}</td>
                                                    <td>
                                                        {{$earning->channel}}
                                                    </td>
                                                    <td>{{Helper::currency($earning->amount)}}</td>
                                                    <td>{{Helper::currency($earning->author_earning) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                    <div class="panel-footer clearfix">
                                        <span class="pull-right">
                                            {!! $all_user_earnings->links() !!}
                                        </span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            
                            <div class="panel-group">
                                <div class="panel panel-default">
                                  <div class="panel-heading clearfix">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="font-size: 18px;" href="#affiliate-earnings">
                                          {{trans('strings.frontend.affiliate-earnings')}}
                                          <span class="pull-right">
                                              {{trans('strings.frontend.lifetime')}}:
                                              <span class="label label-primary">
                                                {{Helper::currency(Auth::user()->total_affiliate_earnings())}}  
                                              </span>
                                          </span>
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="affiliate-earnings" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        
                                        <table class="table table-striped">
                                            <thead>
                                                <th>{{trans('strings.frontend.date')}}</th>
                                                <th>{{trans('strings.frontend.purchased-by')}}</th>
                                                <th>{{trans('strings.frontend.course')}}</th>
                                                <th>{{trans('strings.frontend.amount')}}</th>
                                                <th>{{trans('strings.frontend.your-earning')}}</th>
                                            </thead>
                                            <tbody>
                                                @foreach($affiliate_earnings as $earning)
                                                 <tr>
                                                    <td>{{ date('F d, Y', strtotime($earning->created_at))}}</td>
                                                    <td>{{$earning->user->name}}</td>
                                                    <td>{{$earning->course->title}}</td>
                                                    <td>{{Helper::currency($earning->amount)}}</td>
                                                    <td>{{Helper::currency($earning->affiliate_earning) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                    <div class="panel-footer clearfix">
                                        <span class="pull-right">
                                            {!! $affiliate_earnings->links() !!}
                                        </span>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            
                            <div class="panel-group">
                                <div class="panel panel-default">
                                  <div class="panel-heading clearfix">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" style="font-size: 18px;" href="#withdrawals">
                                        {{trans('strings.frontend.withdrawals')}}
                                        <span class="pull-right">
                                            {{trans('strings.frontend.lifetime')}}:
                                            <span class="label label-danger">
                                                - {{Helper::currency(Auth::user()->total_withdrawals())}}
                                            </span>
                                        </span>
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="withdrawals" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <h5>{{trans('strings.frontend.withdrawals-payouts')}}</h5>
                                        <div class="well clearfix">
                                            <p>
                                                {{trans('strings.frontend.submit-withdrawal-request')}}.
                                                {{trans('strings.frontend.min-payout-amount')}} <b>{{Helper::currency(config('settings.minimumPayoutAmount'))}}</b>.
                                                {{trans('strings.frontend.cannot-request-less-than-minimum')}}
                                            </p>
                                            <form action="{{route('frontend.author.withdrawals')}}" class="form-inline">
                                                <input type="number" name="amount" placeholder="{{trans('strings.frontend.amount')}}" class="form-control"/>
                                                <input type="email" name="paypal_email" placeholder="{{trans('strings.frontend.paypal-email')}}"  class="form-control"/>
                                                <input type="{{trans('strings.frontend.submit')}}" {{Auth::user()->account_balance() < config('settings.minimumPayoutAmount') ? 'disabled':''}} value="{{trans('strings.frontend.submit')}}" class="btn btn-primary"/><br/>
                                                @if ($errors->has('amount'))
                						            <span class="text-danger">
                						                {{ $errors->first('amount') }}
                						            </span>
                						        @endif
                						        @if ($errors->has('paypal_email'))
                						            <span class="text-danger">
                						                {{ $errors->first('paypal_email') }}
                						            </span>
                						        @endif
                						        
                                            </form>    
                                        </div>
                                        @if($withdrawals->count())
                                            <table class="table table-striped">
                                                <thead>
                                                    <th>{{trans('strings.frontend.date-submitted')}}</th>
                                                    <th>{{trans('strings.frontend.date-updated')}}</th>
                                                    <th>{{trans('strings.frontend.amount')}}</th>
                                                    <th>{{trans('strings.frontend.paypal-email')}}</th>
                                                    <th>{{trans('strings.frontend.status')}}</th>
                                                    <th>{{trans('strings.frontend.comment')}}</th>
                                                </thead>
                                                <tbody>
                                                    @foreach($withdrawals as $withdrawal)
                                                    <tr>
                                                        <td>{{ date('F d, Y', strtotime($withdrawal->created_at))}}</td>
                                                        <td>{{ date('F d, Y', strtotime($withdrawal->updated_at))}}</td>
                                                        <td>{{ Helper::currency($withdrawal->amount) }}</td>
                                                        <td>{{ $withdrawal->paypal_email }}</td>
                                                        <td>
                                                            {!! $withdrawal->status == 'processed' ? '<span class="text-success">'.strToUpper($withdrawal->status).'</span>' : '<span class="text-warning">'.strToUpper($withdrawal->status).'</span>' !!}
                                                        </td>
                                                        <td>{{ $withdrawal->comment }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif    
                                    </div>
                                    <div class="panel-footer clearfix">
                                        {!! $withdrawals->links() !!}
                                    </div>
                                  </div>
                                </div>
                            </div>
                            
                        </div><!-- end row -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
    
@endsection
