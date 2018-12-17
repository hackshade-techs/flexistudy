<div class="modal fade" id="buy-now" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
          
          
        <checkout inline-template amount="{{$course->price}}" course="{{$course->id}}" enable_braintree="{{config('settings.enable_braintree')}}" promocode="{{$coupon_code}}">
            <div>
                <div class="modal-header" style="padding:5px;">
                  <button type="button" @click="resetForm()" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="padding:10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            {{trans('strings.frontend.confirm-purchase')}}: <b>{{ $course->title }}</b> 
                            <span style="font-size:13px;" class="label label-success pull-right">
                                {{ trans('strings.frontend.you-pay') }}: 
                                @if(config('settings.currency_symbol_position') == 'front')
                                    {!! config('settings.currency_symbol') !!}@{{price}}
                                @else 
                                    @{{price}}{!! config('settings.currency_symbol') !!}
                                @endif
                            </span>
                        </div>
                    
                        <div class="panel-body">
                                <form-wizard color="#607d8b">
                                    <small slot="title"></small> 
                                    <tab-content title="{{trans('strings.frontend.coupons')}}" icon="fa fa-tags">
                                
                                        <span class="pull-right" style="font-size:18px;">
                                            {{ trans('strings.frontend.price') }}: 
                                            <span class="label label-success">
                                                @if(config('settings.currency_symbol_position') == 'front')  
                                                    {!! config('settings.currency_symbol') !!}@{{price}}
                                                @else
                                                    @{{price}}{!! config('settings.currency_symbol') !!}
                                                @endif
                                            </span>
                                            <span class="text-info" v-if="oldPrice" style="text-decoration: line-through; margin-left: 10px;">
                                                @if(config('settings.currency_symbol_position') == 'front')  
                                                    {!! config('settings.currency_symbol') !!}@{{oldPrice}}
                                                @else
                                                    @{{oldPrice}}{!! config('settings.currency_symbol') !!}
                                                @endif
                                            </span>
                                        </span>
                                        
                                        <div class="checkbox">
                            		        <label>
                            		          <input type="checkbox" v-model="haveCoupon"> {{ trans('strings.frontend.redeem-coupon') }}
                            		        </label>
                            	        </div>
                            	        
                            	        <div class="col-md-12" v-if="haveCoupon && !appliedCoupon">
                            	            <div class="row">
                            	                <form @submit.prevent="applyCoupon()" class="inline-form">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" v-model="couponCode" required placeholder="{{trans('strings.frontend.enter-code')}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success" type="submit">{{ trans('strings.frontend.apply-coupon') }}</button>
                                                        </span>
                                                    </div><!-- /input-group -->
                                                </form>
                                                <span class="text-danger" v-if="couponStatus">@{{couponStatus}}</span>
                                            </div>
                                        </div>
                                        <div v-if="appliedCoupon">
                                            {{ trans('strings.frontend.applied-coupon') }}:<span class="label label-info">@{{appliedCoupon}}</span>  
                                            <a href="#" @click.prevent="removeCoupon">
                                                <i class="fa fa-times text-danger"></i> 
                                                {{trans('strings.frontend.remove-coupon')}}
                                            </a>
                                        </div>
                                    </tab-content>
                                    
                                    
                                    <tab-content title="{{trans('strings.frontend.pay')}}" icon="fa fa-credit-card">
                                        <div class="col-md-10 col-md-offset-1">
                                            
                                            <div class="well" v-if="price==0">
                                                <a href="{{route('frontend.course.enroll', $course)}}" class="mc-btn btn-style-1 btn btn-block">
                                                    {{trans('strings.frontend.enroll-now')}}
                                                </a>
                                            </div>
                                            
                                            <div v-show="price > 0">
                                                @if(config('settings.enable_omise'))
                                                    <div class="well">
                                                        <!-------- Omise Payment ----------->
                                                        <form action="{{route('frontend.courses.charge.omise')}}" method="post" id="omise-payment">
                                                            <h5 class="fs-title text-capitalize"  style="text-align:center;">{{trans('strings.frontend.pay-with-creditcard')}}</h5>
                                                            <div id="token_errors" class="alert alert-danger alert-dismissable fade in hidden">
                                								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                								<span></span>
                                							</div>
                                                            
                                                             {{csrf_field()}}
                                                            <!-- Keep token from tokenize step here and resend the form again (see more below in javascript section) -->
                                                            <input type="hidden" name="omise_token">
                                                            <input type="hidden" name="course" value="{{ $course->id }}">
                                                            <input type="hidden" id="applied-code" class="applied_code" :value="appliedCoupon" name="coupon">
                            				      			<input type="hidden" id="amount" class="amount" name="amount" :value="price">
                                                            
                                                            <div class="form-group">
                                                                <label for="cardNumber">Card Holder Name</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" data-omise="holder_name" required autofocus />
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-user"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label for="cardNumber">Card Number</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" data-omise="number" placeholder="4242424242424242"
                                                                        required autofocus />
                                                                    <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-7 col-md-7">
                                                                    <div class="form-group" style="margin-bottom:0;">
                                                                        <label>Expiry date</label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                            <input type="text" class="form-control" placeholder="MM" data-omise="expiration_month" required />
                                                                        </div>
                                                                        <div class="col-xs-6 col-lg-6 pl-ziro">
                                                                            <input type="text" class="form-control" placeholder="YYYY" data-omise="expiration_year" required />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-5 col-md-5 pull-right">
                                                                    <div class="form-group">
                                                                        <label for="cvCode">CVV</label>
                                                                        <input type="password" class="form-control" data-omise="security_code" placeholder="CVV" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <button class="btn btn-info btn-block" type="submit" id="create_token">
                                                                {{trans('strings.frontend.pay')}}
                                                            </a>
                                                        </form>
                                                    </div>
                                                @endif
                                                @if(config('settings.enable_stripe'))
                                	                <div class="well">
                                                        <h5 class="fs-title text-capitalize"  style="text-align:center;">{{trans('strings.frontend.pay-with-creditcard')}}</h5>
                                                        <div class="stripe-errors alert alert-danger alert-dismissable fade in hidden">
                            								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            								<span></span>
                            							</div>
                                                        <form id="checkout-form" action="{{ route('frontend.courses.charge') }}" method="post">
                                                            <div class="form-group">
                                                                <div class="card-js stripe" data-stripe="true" data-icon-colour="#259d6d"></div>
                                                                <input type="hidden" name="course" value="{{ $course->id }}">
                                                                <input type="hidden" id="applied-code" class="applied_code" :value="appliedCoupon" name='coupon'>
                                                                <input type="hidden" class="amount" name="amount" :value="price">
                                                                {{ csrf_field() }}
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" id="checkout-btn" class="btn btn-primary btn-block">
                                                                    <i class="fa fa-lock"></i> 
                                                                    {{trans('strings.frontend.pay')}} 
                                                                    @if(config('settings.currency_symbol_position') == 'front')    
                                                                        {!! config('settings.currency_symbol') !!}@{{price}}
                                                                    @else
                                                                        @{{price}}{!! config('settings.currency_symbol') !!} 
                                                                    @endif
                                                                </button>
                                                            </div>
                                                            
                                                            @if(config('demo.demo_mode'))
                                                                <div class="alert alert-warning" style="color:#fff; text-align:center;">
                                                                    For Demo, use the credit card number <b>4242424242424242</b>
                                                                	with any MM/YY and CVV
                                                                </div>
                                                            @endif
                                                        </form>
                                                    </div>
                                                @endif
                                                
                                                @if(config('settings.enable_razorpay'))
                                                    <razorpay-form inline-template :price="price" :applied_coupon="appliedCoupon">
                                                        <div class="well">
                                                            <h5 class="fs-title text-capitalize" style="text-align:center;">
                                                                {{trans('strings.frontend.pay-with-razorpay')}}
                                                            </h5>
                                                            <form method="POST" id="razorpayform" action="{!! URL::route('frontend.courses.charge.razorpay') !!}">
                                                                {{ csrf_field() }}
                                                                <div class="col-md-6">
                                                                    <input type="hidden" name="razorpay_payment_id" value="" id="razorpay_payment_id">
                                                                	<input type="hidden" name="course" value="{{ $course->id }}">
                                                                	<input type="hidden" id="applied-code" class="applied_code" :value="coupon" name="coupon">
                                    				      			<input type="hidden" id="amount" class="amount" name="amount" :value="price">
                                                                </div>
                                                                <div class="form-group">
                                    	                            <button id="razorpay-button" type="submit" class="btn btn-primary btn-block font-weight-bold">
                                    	                                <i class="fa fa-money"></i> {{ __('strings.frontend.go-to-razorpay') }}
                                	                                </button>
                                    	                        </div>
                                                            </form>
                                                            
                                                        </div>
                                                    </razorpay-form>
                                                @endif
                                                
                                                @if(config('settings.enable_paypal'))
                                                    <center><h5>- {{trans('strings.frontend.or')}} -</h5></center>
                                                    
                                                    <div class="well">
                                                        <h5 class="fs-title text-capitalize" style="text-align:center;">{{trans('strings.frontend.pay-with-paypal')}}</h5>
                                                        <form method="POST" id="payment-form" role="form" action="{!! URL::route('frontend.courses.charge.paypal') !!}" >
                                	                        {{ csrf_field() }}
                                	                        <div class="col-md-6">
                                                            	<input type="hidden" name="course" value="{{ $course->id }}">
                                                            	<input type="hidden" id="applied-code" class="applied_code" :value="appliedCoupon" name="coupon">
                                				      			<input type="hidden" id="amount" class="amount" name="amount" :value="price">
                                                            </div>
                                	                        <div class="form-group">
                                	                            <button type="submit" class="btn btn-info btn-block">
                                	                                <i class="fa fa-paypal"></i> {{trans('strings.frontend.go-to-paypal')}}
                            	                                </button>
                                	                        </div>
                                	                    </form>
                                                    </div>
                                                @endif
                                                
                                                @if(config('settings.enable_braintree'))
                                                    <!-- Braintree payment -->
                                                    <div class="wellx">    
                                                        <form action="{{route('frontend.courses.charge.braintree')}}" method="POST">
                                                            <!--<input type="hidden" :value="csrfToken" />-->
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="course" value="{{ $course->id }}">
                                                            <input type="hidden" id="applied-code" class="applied_code" :value="appliedCoupon" name="coupon">
                            				      			<input type="hidden" id="amount" class="amount" name="amount" :value="price">
                                                            <div id="dropin"></div>
                                                            <button type="submit" class="btn btn-info btn-block">
                            	                                <i class="fa fa-braintree"></i> {{trans('strings.frontend.pay')}}
                        	                                </button>
                                                            
                                                        </form>
                                                    </div>
                                                @endif
                                                
                                            </div>
                                            
                                            
                                            

                                        </div>
                                    </tab-content>
                                    
                                    <template slot="footer" scope="props">
                                       <div class=wizard-footer-left>
                                           <wizard-button  v-if="props.activeTabIndex > 0" @click.native="props.prevTab()" :style="props.fillButtonStyle">{{trans('strings.frontend.previous')}}</wizard-button>
                                        </div>
                                        <div class="wizard-footer-right">
                                          <wizard-button v-if="!props.isLastStep"@click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">{{trans('strings.frontend.next')}}</wizard-button>
                                
                                        </div>
                                    </template>
      
                                </form-wizard>
                                
                        </div><!--/end body-->
                    </div><!--/end panel-->
                </div><!--/end modal body-->
            </div>
        </checkout>
                    
                
        
        
        
    </div><!--/end modal-content-->
</div><!--/end modal dialog-->
</div>