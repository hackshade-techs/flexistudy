@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.coupons')}}
@stop
@section('content')
    @include('frontend.author.course._top')
    
    <section id="create-course-section" class="create-course-section">
        <div class="container">
            <div class="row">
            	<div class="col-md-3">
    				@include('frontend.author.course._sidebar')
    			</div>
    			<div class="col-md-9">
    			    <div class="tab-content">
        			    <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h5>{{trans('strings.frontend.coupons')}}</h5>
                            </div>
                            <div class="panel-body">
    				            <coupons :course_id="{{$course->id}}" inline-template>
    				                <div>
        				                <div v-cloak class="loader">
        				                    <center>
        				                        <grid-loader loading="loading" color="#5dc596" size="15px"></grid-loader>
        				                    </center>
    				                    </div>
    				                
        				                <div v-cloak>
        				                    
                                            <span class="text-success pull-right">
                                                @{{ saveStatus }}
                                            </span>
                                            <form class="form-horizontal" @submit.prevent="updatePrice">
                                                <div class="form-group">
                                                    <label class="col-lg-3 label-right">{{trans('strings.frontend.course-price')}}: </label>
                                                    <div class="col-lg-3">
                                                        <select class="form-control" v-model="course.price">
                                                            <option value="0">{{trans('strings.frontend.free')}}</option>
                                                            @foreach($prices as $k => $v)
                                                                <option value="{{$v}}">{{ Helper::currency($v) }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-3">
                                                        @if(config('demo.demo_mode') && $course->id < 10)
                                                            <button type="button" disabled class="btn btn-success">Not allowed in demo mode</button>
                                                        @else
                                                            <button type="submit" class="btn btn-success">{{trans('strings.frontend.save')}}</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                            <hr />
                                            <div class="col-md-4" v-if="!showCreateForm">
                                                <button class="btn btn-success" :disabled="savedCoursePrice > 0 && course.approved==1 && course.published==1 ? null:'disabled'" @click.prevent="showCreateForm=true">
                                                    {{trans('strings.frontend.create-new-coupon')}}
                                                </button>
                                            </div>
                                            <form @submit.prevent="createCoupon()" class="form-horizontal" v-if="showCreateForm">
                                                
                                                <div class="form-group">
                                                    <label class="col-lg-2 label-right">{{trans('strings.frontend.code')}}:</label>
                                                    <div class="col-lg-10">
                                                        <input v-validate="'required|alpha_dash'" name="code" class="form-control" v-model="code" />
                                                        <small class="text-danger" v-show="errors.has('code')">@{{ errors.first('code') }}</small>
                                                        <small class="text-danger" v-if="err.code">@{{ err.code[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 label-right">{{trans('strings.frontend.discount-percentage')}}:</label>
                                                    <div class="col-lg-10">
                                                        <vue-slider ref="slider" 
                                                            :max=100 
                                                            v-model="percent"
                                                            tooltip="hover"
                                                            height=20
                                                            :interval=5
                                                            :formatter="percent+'% OFF'">
                                                        </vue-slider>
                                                        {{trans('strings.frontend.new-price')}}: <b>$@{{(course.price - (course.price * (percent/100))).toFixed(2) }}</b>
                                                        <small class="text-danger" v-if="err.percent">@{{ err.percent[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 label-right">{{trans('strings.frontend.number-of-coupons')}}</label>
                                                    <div class="col-lg-10">
                                                        <input type="number" v-validate="'required|numeric|min:1'" name="quantity" class="form-control" v-model="quantity" />
                                                        <small class="text-danger" v-show="errors.has('quantity')">@{{ errors.first('quantity') }}</small>
                                                        <small class="text-danger" v-if="err.quantity">@{{ err.quantity[0] }}</small>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 label-right">{{trans('strings.frontend.expiry-date')}}:</label>
                                                    <div class="col-lg-10">
                                                        <datepicker v-model="expires" 
                                                            placeholder="{{trans('strings.frontend.optional')}}" 
                                                            input-class="form-control"
                                                            format="yyyy-MM-dd">
                                                        </datepicker>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="pull-right">
                                                            <a href="#" @click.prevent="showCreateForm=false">{{trans('strings.frontend.cancel')}}</a>
                                                            <button type="submit" class="btn btn-success">{{trans('strings.frontend.create-coupon')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <br />
                                            <hr />
                                            
                                            <div class="col-md-12">
                                                <div class="table-responsive" v-if="savedCoursePrice > 0 && course.approved==1 && course.published==1">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>{{trans('strings.frontend.code')}}</th>
                                                            <th>{{trans('strings.frontend.link')}}</th>
                                                            <th>{{trans('strings.frontend.percent-off')}}</th>
                                                            <th>{{trans('strings.frontend.final-price')}}</th>
                                                            <th>{{trans('strings.frontend.quantity')}}</th>
                                                            <th>{{trans('strings.frontend.remaining')}}</th>
                                                            <th>{{trans('strings.frontend.expires')}}</th>
                                                            <th>{{trans('strings.frontend.status')}}</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="coupon in coupons">
                                                                <td>@{{coupon.code}}</td>
                                                                <td><button @click.prevent="getLink(coupon.link)" :disabled="coupon.exhausted ? 'disabled':null" class="btn btn-success btn-xs">
                                                                    {{trans('strings.frontend.get-link')}}
                                                                </button></td>
                                                                <td>@{{coupon.percent}}%</td>
                                                                <td>$@{{coupon.finalPrice}}</td>
                                                                <td>@{{coupon.quantity}}</td>
                                                                <td>@{{coupon.quantity - coupon.totalUsed}}</td>
                                                                <td>@{{coupon.expires}}</td>
                                                                <td>
                                                                    
                                                                    <button :class="coupon.active ? 'btn btn-xs btn-success':'btn btn-xs btn-danger'" @click.prevent="toggleActive(coupon.id, coupon.active)">
                                                                        @{{ coupon.active ? trans('strings.frontend.active'):trans('strings.frontend.inactive') }}
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div>
                                                
                                            <vodal :show="showModal" 
                                                animation="fade" 
                                                @hide="showModal=false"
                                                :width="800"
                                                :height="150"
                                                :close-button=false
                                                :duration="301">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading header">
                                                        {{trans('strings.frontend.your-coupon-link')}}
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                              <input type="text" class="form-control" id="couponLink" :value="couponLink">
                                                              <span class="input-group-addon">
                                                                  <a href="#" @click.prevent="copyToClipboard()">
                                                                      <i class="fa fa-clipboard"></i>
                                                                  </a>
                                                              </span>
                                                            </div>
                                                            <small class="text-success">@{{copyStatus}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer clearfix">
                                                        <button class="btn btn-danger btn-xs pull-right" @click="showModal = false">{{trans('strings.frontend.close')}}</button>
                                                    </div>
                                                    
                                                </div>
                                            </vodal>
                                        </div>
    				                
    				                </div>
    				            </coupons>
    				        </div>
    			        </div>
			        </div>
    			</div>
    		</div>
    	</div>
    </section>

@endsection