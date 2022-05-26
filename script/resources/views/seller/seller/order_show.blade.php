@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Order No: '.$info->order_no])
@endsection
@push('style')
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}">
    <style>
        .ami {

            width: auto;
            height: 520px;
            overflow-x: hidden;
            overflow-y: auto;
            text-align: justify;
        }
    </style>
@endpush
@section('content')
    <div class="row" id="order">
        <div class="col-12 col-lg-8">
            @if($info->status=='pending')
                <div class="card card-warning">

                    @elseif($info->status=='processing')
                        <div class="card card-primary">

                            @elseif($info->status=='ready-for-pickup')
                                <div class="card card-info">

                                    @elseif($info->status=='completed')
                                        <div class="card card-success">

                                            @elseif($info->status=='archived')
                                                <div class="card card-danger">
                                                    @elseif($info->status=='canceled')
                                                        <div class="card card-danger">

                                                            @else
                                                                <div class="card card-primary">

                                                                    @endif

                                                                    <div class="card-body">
                                                                        <ul class="list-group list-group-lg list-group-flush list">
                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">
                                                                                    <div class="col-6">
                                                                                        <strong>{{ __('Product') }}</strong>
                                                                                    </div>
                                                                                    <div class="col-3 text-right">
                                                                                        <strong>{{ __('Amount') }}</strong>
                                                                                    </div>
                                                                                    <div class="col-3 text-right">
                                                                                        <strong>{{ __('Total') }}</strong>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            @foreach($info->order_item as $row)
                                                                                <li class="list-group-item">
                                                                                    <div class="row align-items-center">
                                                                                        <div class="col-6">
                                                                                            {{ $row->term->title ?? '' }}
                                                                                            <br>

                                                                                            @php
                                                                                                $variations=json_decode($row->info);

                                                                                            @endphp
                                                                                            @foreach ($variations->attribute ?? [] as $item)

                                                                                                <span>{{ __('Variation') }} :</span>
                                                                                                <small>{{ $item->attribute->name ?? '' }}
                                                                                                    - {{ $item->variation->name ?? '' }}</small>
                                                                                            @endforeach
                                                                                            <br>
                                                                                            @foreach ($variations->options ?? [] as $option)
                                                                                                <span>{{ __('Options') }} :</span>
                                                                                                <small>{{ $option->name ?? '' }}</small>
                                                                                            @endforeach

                                                                                        </div>
                                                                                        <div class="col-3 text-right">
                                                                                            {{ $row->amount }}
                                                                                            × {{ $row->qty }}
                                                                                        </div>
                                                                                        <div class="col-3 text-right">
                                                                                            {{  amount_format($row->amount*$row->qty) }}
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach

                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">


                                                                                    <div class="col-6">
                                                                                        {{ $order_content->disctrict ?? '' }}
                                                                                        , {{ $order_content->city ?? '' }}
                                                                                        , {{ $order_content->province ?? '' }}
                                                                                    </div>
                                                                                    <div class="col-3 text-right">
                                                                                        {{ __('Shipping Fee') }}
                                                                                    </div>
                                                                                    <div class="col-3 text-right">
                                                                                        {{ amount_format($info->shipping) }}
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">
                                                                                    <div
                                                                                        class="col-9 text-right">{{ __('Tax') }}</div>
                                                                                    <div
                                                                                        class="col-3 text-right"> {{ amount_format($info->tax) }} </div>
                                                                                </div>
                                                                            </li>


                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">
                                                                                    <div
                                                                                        class="col-9 text-right">{{ __('Discount') }}</div>
                                                                                    <div
                                                                                        class="col-3 text-right"> {{ amount_format($order_content->coupon_discount) }} </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">
                                                                                    <div
                                                                                        class="col-9 text-right">{{ __('Subtotal') }}</div>
                                                                                    <div
                                                                                        class="col-3 text-right"> {{ amount_format($order_content->sub_total) }} </div>
                                                                                </div>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">

                                                                                    <div
                                                                                        class="col-9 text-right">{{ __('Total') }}</div>
                                                                                    <div
                                                                                        class="col-3 text-right">{{ amount_format($info->total) }}</div>
                                                                                    @if($info->status=='canceled')
                                                                                     <button data-toggle="modal" data-target="#refund" class="btn btn-primary">{{ __('Refund') }}</button>
                                                                                        <!-- Modal -->
                                                                                        <div class="modal fade" id="refund" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Refund Process') }}</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <form action="{{ route('admin.customer.orders.refund') }}" enctype="multipart/form-data" method="post" class="dropzone" id="mydropzone">
                                                                                                            @csrf
                                                                                                            <input type="hidden" name="term" value="{{ $info->id }}">
                                                                                                        </form>
                                                                                                        <div class="modal-footer">
                                                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                                                            <button form="mydropzone" type="submit" class="btn btn-primary">Save changes</button>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                    <div class="card-footer">


                                                                    </div>

                                                                </div>
                                                                <div class="card card-primary">
                                                                    <div class="card-body">
                                                                        <ul class="list-group list-group-lg list-group-flush list">
                                                                            <li class="list-group-item">
                                                                                <div class="row align-items-center">
                                                                                    <div class="col-6">
                                                                                        <strong>{{ __('Discuss Seller & Customer') }}</strong>
                                                                                    </div>
                                                                                    <div class="container ">
                                                                                        <div class="row ami">
                                                                                            <div class="col-12 px-0">
                                                                                                <div
                                                                                                    class="px-4 py-5 chat-box bg-white">
                                                                                                @foreach($chat as $ami)
                                                                                                    @if($ami->role == 'seller')
                                                                                                        <!-- Sender Message-->
                                                                                                            <div
                                                                                                                class="media w-50 mb-3">
                                                                                                                <img
                                                                                                                    src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                                                                                                    alt="user"
                                                                                                                    width="50"
                                                                                                                    class="rounded-circle">
                                                                                                                <div
                                                                                                                    class="media-body ml-3">
                                                                                                                    <div
                                                                                                                        class="bg-light rounded py-2 px-3 mb-2">
                                                                                                                        <p class="text-small mb-0 text-muted">
                                                                                                                            {{$ami->comment}}</p>
                                                                                                                    </div>
                                                                                                                    <p class="small text-muted">
                                                                                                                        Seller,
                                                                                                                        {{$ami->created_at}}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                    @elseif($ami->role == 'customer')
                                                                                                        <!-- Reciever Message-->

                                                                                                            <div
                                                                                                                class="media w-50 ml-auto mb-3">
                                                                                                                <img
                                                                                                                    src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                                                                                                    alt="user"
                                                                                                                    width="50"
                                                                                                                    class="rounded-circle">
                                                                                                                &nbsp;
                                                                                                                &nbsp;
                                                                                                                <div
                                                                                                                    class="media-body">
                                                                                                                    <div
                                                                                                                        class="bg-primary rounded py-2 px-3 mb-2">
                                                                                                                        <p class="text-small mb-0 text-white">
                                                                                                                            {{$ami->comment}}</p>
                                                                                                                    </div>
                                                                                                                    <p class="small text-muted">
                                                                                                                        Customer,
                                                                                                                        {{$ami->created_at}}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div
                                                                                                                class="media w-50 ml-auto mb-3">
                                                                                                                <img
                                                                                                                    src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                                                                                                    alt="user"
                                                                                                                    width="50"
                                                                                                                    class="rounded-circle">
                                                                                                                &nbsp;
                                                                                                                &nbsp;
                                                                                                                <div
                                                                                                                    class="media-body">
                                                                                                                    <div
                                                                                                                        class="bg-danger rounded py-2 px-3 mb-2">
                                                                                                                        <p class="text-small mb-0 text-white">
                                                                                                                            {{$ami->comment}}</p>
                                                                                                                    </div>
                                                                                                                    <p class="small text-muted">
                                                                                                                        Admin,
                                                                                                                        {{$ami->created_at}}</p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </div>
                                                                                                <!-- Typing area -->


                                                                                            </div>

                                                                                        </div>
                                                                                        <br><br>
                                                                                        <form
                                                                                            action="{{ url('admin/customer/orders/customer/chat') }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <input type="hidden"
                                                                                                   name="order_id"
                                                                                                   value="{{$info->id}}">
                                                                                            <input type="hidden"
                                                                                                   name="customer_id"
                                                                                                   value="{{$term->customer_id}}">
                                                                                            <input type="hidden"
                                                                                                   name="seller_id"
                                                                                                   value="{{$term->seller_id}}">
                                                                                            <input type="hidden"
                                                                                                   name="term_id"
                                                                                                   value="{{$term->term_id}}">
                                                                                            <div
                                                                                                class="input-group">
                                                                                                <input
                                                                                                    type="text"
                                                                                                    required
                                                                                                    placeholder="Type a message"
                                                                                                    name="comment"
                                                                                                    aria-describedby="button-addon2"
                                                                                                    class="form-control rounded-0 border-0 py-4 bg-light">

                                                                                                <div
                                                                                                    class="input-group-append">
                                                                                                    <button
                                                                                                        type="submit"
                                                                                                        class="btn btn-link">
                                                                                                        <i
                                                                                                            class="fa fa-paper-plane"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                        <div class="col-12 col-lg-4">
                                                            <div class="card-grouping">
                                                                <div class="card">
                                                                    {{--                                                                    <div class="card-header">--}}
                                                                    {{--                                                                        <h4>{{ __('Tracking') }}</h4>--}}

                                                                    {{--                                                                    </div>--}}

                                                                    {{--                                                                    <div class="card-body">--}}
                                                                    {{--                                                                        <p>{{ __('Input AWB') }}--}}
                                                                    {{--                                                                        <form--}}
                                                                    {{--                                                                            action="{{ route('seller.awb.store', $info->id) }}"--}}
                                                                    {{--                                                                            method="post">--}}
                                                                    {{--                                                                            @csrf--}}
                                                                    {{--                                                                            <input name="awb"--}}
                                                                    {{--                                                                                   value="{{ $order_shipping  ?? ''}}"--}}
                                                                    {{--                                                                                   type="text" class="form-control">--}}
                                                                    {{--                                                                            <br>--}}
                                                                    {{--                                                                            <button type="submit"--}}
                                                                    {{--                                                                                    class="btn btn-primary">Saved--}}
                                                                    {{--                                                                            </button>--}}
                                                                    {{--                                                                        </form>--}}
                                                                    {{--                                                                    </div>--}}
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4>{{ __('Status') }}</h4>

                                                                        </div>

                                                                        <div class="card-body">

                                                                            <p>{{ __('Payment Status') }}
                                                                                @if($info->payment_status==2)
                                                                                    <span
                                                                                        class="badge badge-warning float-right">{{ __('Pending') }}</span>

                                                                                @elseif($info->payment_status==1)
                                                                                    <span
                                                                                        class="badge badge-success float-right">{{ __('Paid') }}</span>

                                                                                @elseif($info->payment_status==0)
                                                                                    <span
                                                                                        class="badge badge-danger float-right">{{ __('Cancel') }}</span>
                                                                                @elseif($info->payment_status==3)
                                                                                    <span
                                                                                        class="badge badge-danger float-right">{{ __('Incomplete') }}</span>

                                                                                @endif</p>


                                                                            <p>{{ __('Order Status') }} @if($info->status=='pending')
                                                                                    <span
                                                                                        class="badge badge-warning float-right">{{ __('Awaiting processing') }}</span>

                                                                                @elseif($info->status=='processing')
                                                                                    <span
                                                                                        class="badge badge-primary float-right">{{ __('Processing') }}</span>

                                                                                @elseif($info->status=='ready-for-pickup')
                                                                                    <span
                                                                                        class="badge badge-info float-right">{{ __('Ready for pickup') }}</span>

                                                                                @elseif($info->status=='completed')
                                                                                    <span
                                                                                        class="badge badge-success float-right">{{ __('Completed') }}</span>

                                                                                @elseif($info->status=='archived')
                                                                                    <span
                                                                                        class="badge badge-danger float-right">{{ __('Archived') }}</span>
                                                                                @elseif($info->status=='canceled')
                                                                                    <span
                                                                                        class="badge badge-danger float-right">{{ __('Canceled') }}</span>

                                                                                @else
                                                                                    <span
                                                                                        class="badge badge-primary float-right">{{ $info->status }}</span>

                                                                                @endif</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4>{{ __('Payment Mode') }}</h4>

                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if($info->category_id  != null)
                                                                                <p>{{ __('Transaction Method') }} <span
                                                                                        class="badge  badge-success  float-right">{{ $info->getway->name ?? '' }} </span>
                                                                                </p>
                                                                                <p>{{ __('Transaction Id') }} <span
                                                                                        class="float-right">{{ $info->transaction_id ?? '' }}</span>
                                                                                </p>
                                                                            @else
                                                                                <p>{{ __('Incomplete Payment') }}</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="card-header-title">{{ __('Note') }}</h4>

                                                                        </div>
                                                                        <div class="card-body">
                                                                            <p class="mb-0">{{ $order_content->comment }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="card-header-title">{{ __('Customer') }}</h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if($info->customer != null)
                                                                                <a href="{{ route('seller.customer.show',$info->customer->id) }}">{{ $info->customer->name }}
                                                                                    (#{{ $info->customer->id }})</a>
                                                                            @else
                                                                                {{ __('Guest Customer') }}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="card-header-title">{{ __('Shipping details') }}</h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <p class="mb-0">{{ __('Customer Name') }}
                                                                                : {{ $order_content->name ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Customer Email') }}
                                                                                : {{ $order_content->email ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Customer Phone') }}
                                                                                : {{ $order_content->phone ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Location') }}
                                                                                : {{ $info->shipping_info->city->name ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Zip Code') }}
                                                                                : {{ $order_content->zip_code ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Address') }}
                                                                                : {{ $order_content->address ?? '' }}</p>

                                                                            <p class="mb-0">{{ __('Shipping Method') }}:
                                                                                JNE
                                                                                - {{ $order_content->service ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Destination') }}
                                                                                : {{ $order_content->disctrict ?? '' }}</p>
                                                                            <p class="mb-0">{{ __('Estimation') }}
                                                                                : {{ $order_content->estimation ?? '' }} {{ __('days') }}</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>
                                                </div>
                                                @endsection
                                                @push('js')
                                                    <script src="{{ asset('assets/js/form.js') }}"></script>
                                                    <script type="text/javascript" src="{{ asset('assets/js/dropzone.js') }}"></script>
                                                    <script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
                                                    <script src="{{ asset('assets/seller/product/images.js') }}"></script>
                                                    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
                                                    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    @endpush
