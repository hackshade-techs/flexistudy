@extends('frontend.layouts.app')

@section('content')

    @include('frontend.user.course._top')
        
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-md-push-0x">
                    <div class="content list">
                        <div class="row">
                            <div class="panel panel-default">
                            
                                
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <th></th>
                                            <th>{{trans('strings.frontend.date')}}</th>
                                            <th>{{trans('strings.frontend.coupon-code')}}</th>
                                            <th>{{trans('strings.frontend.amount-paid')}}</th>
                                            <th>{{trans('strings.frontend.payment-type')}}</th>
                                        </thead>
                                        <tbody>
                                            @foreach($purchases as $purchase)
                                             <tr>
                                                <td>
                                                    <a href="{{ route('frontend.course.show', $purchase->course) }}">
                                                        <img src="{{$purchase->course->coverImage}}" style="width: 140px; float: left; padding-right: 20px;" />
                                                        {{$purchase->course->title}}
                                                    </a>
                                                </td>
                                                <td>{{ date('F d, Y', strtotime($purchase->created_at))}}</td>
                                                <td>{{strToUpper($purchase->coupon ? $purchase->coupon->code : '')}}</td>
                                                <td>${{$purchase->amount}}</td>
                                                <td>{{$purchase->payment_method=='stripe' ? trans('strings.frontend.credit-card') : strToUpper($purchase->payment_method)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                       
                                    </table>
                                    <span class="pull-right">{!! $purchases->links() !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
@endsection