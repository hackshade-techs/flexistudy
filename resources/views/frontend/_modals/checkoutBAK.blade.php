<div class="modal fade" id="buy-now" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body" style="padding:10px;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    {{trans('strings.frontend.confirm-purchase')}}: <b>{{ $course->title }}</b> 
                </div>
                
                <div class="panel-body">
                    
                    <div class="col-md-12" style="text-align: center; border-bottom: 1px solid #eee;">
                        <h5>
                        {{trans('strings.frontend.course-price')}}: <b>{{ Helper::getPrice($course) }}</b> | 
                        {{trans('strings.frontend.you-pay')}}: 
                        <span class="price-amount">
                        <span class="you-pay" style="font-weight: bold;">
                            @if(config('settings.currency_symbol_position') == 'front')    
                                {!! config('settings.currency_symbol'). '<span class="price-amount">'.$course->price.'</span>' !!}
                            @else
                                {!! '<span class="price-amount">' . $course->price . '</span>' .config('settings.currency_symbol') !!}
                            @endif
                        </span>
                        </span>
                        </h5>
                        <a href="#" id="redeem-coupon-btn">{{trans('strings.frontend.redeem-coupon')}}</a>
                        <span class="applied-coupon"></span>
                        <a href="#" id="remove-coupon" style="display:none;"><i class="fa fa-remove text-danger"></i> {{trans('strings.frontend.remove-coupon')}}</a>
                        
                        <div class="col-md-12" id="coupon-form"  style="display:none;">
                            <form action="{{route('frontend.course.coupon.apply')}}" method="POST" id="coupon-form">
                                <div class="input-group">
                                    <input type="hidden" id="course" name="course" value="{{$course->id}}">
                                    <input type="hidden" id="amount" name="amount" value="{{$course->price}}">
                                    <input type="text" id="code" name="coupon" value="{{$coupon_code}}" autocomplete="off" placeholder="{{trans('strings.frontend.enter-code')}}" required class="form-control">
                                    <span class="input-group-btn">
                                        <button id="apply-coupon-btn" type="submit" class="btn btn-success">{{trans('strings.frontend.apply-coupon')}}</button>
                                    </span>
                                </div>
                            </form>
                            <span class="text-danger err"></span>
                            <br />
                        </div>
                    </div> <!--/end top col-->
                    
                    
                    <br /><br />
                    <div class="col-md-4" style="text-align: center;">
                        <div class="form-1">
                            <h5 class="fs-title text-capitalize">{{trans('strings.frontend.pay-with-paypal')}}</h5>
                            <form method="POST" id="payment-form" role="form" action="{!! URL::route('frontend.courses.charge.paypal') !!}" >
    	                        {{ csrf_field() }}
    	                        <div class="col-md-6">
                                	<input type="hidden" name="course" value="{{ $course->id }}">
                                	<input type="hidden" id="applied-code" class="applied_code" value="" name="coupon">
    				      			<input type="hidden" id="amount" class="amount" name="amount" value="{{ Helper::getSellingPrice($course) }}">
                                </div>
    	                        <div class="form-group">
    	                            <button type="submit" class="btn btn-info btn-block">
    	                                <i class="fa fa-paypal"></i> {{trans('strings.frontend.go-to-paypal')}}
	                                </button>
    	                        </div>
    	                    </form>
                        </div>
                    </div><!--/end left col-->
                    
                    <div class="col-md-8" style="text-align: center; border-left: 1px solid #eee;background: #eee;">
                        <div class="form-2">
                            <h5 class="fs-title text-capitalize">{{trans('strings.frontend.pay-with-creditcard')}}</h5>
                                
                            <div class="stripe-errors alert alert-danger alert-dismissable fade in hidden">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<span></span>
							</div>
                           
                            <form id="checkout-form" action="{{ route('frontend.courses.charge') }}" method="post">
                                <div class="form-group">
                                    <div class="card-js stripe" data-stripe="true" data-icon-colour="#259d6d"></div>
                                    <input type="hidden" name="course" value="{{ $course->id }}">
                                    <input type="hidden" id="applied-code" class="applied_code" value="" name='coupon'>
                                    <input type="hidden" class="amount" name="amount" value="{{ Helper::getSellingPrice($course) }}">
                                    {{ csrf_field() }}
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="checkout-btn" class="btn btn-primary btn-block">
                                        <i class="fa fa-lock"></i> 
                                        {{trans('strings.frontend.pay')}} 
                                        @if(config('settings.currency_symbol_position') == 'front')    
                                            {!! config('settings.currency_symbol'). '<span class="price-amount">'.$course->price.'</span>' !!}
                                        @else
                                            {!! '<span class="price-amount">' . $course->price . '</span>' .config('settings.currency_symbol') !!}
                                        @endif
                                    </button>
                                </div>
                            </form>
                            @if(config('demo.demo_mode'))
                            <div class="alert alert-warning" style="color:#fff;">
                            	<b>USE THESE CREDIT CARD CREDENTIALS FOR TESTING</b><br />
                            		Number: 4242424242424242<br/>
                            		Expiry: 12/22<br/>
                            		CVV: 123
                            </div>
                            @endif
                        </div>
                    </div><!--/end right col-->
                </div><!--/end body-->
            </div><!--/end panel-->
        </div><!--/end modal body-->
    </div><!--/end modal-content-->
</div><!--/end modal dialog-->
</div>