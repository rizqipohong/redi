@extends('frontend.bigbag.account.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/order.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@endpush
@section('user_content')
    <form action="{{ url('/user/auto_order_completed/'. $orders->id. ' ') }}" id="est"></form>
    <div class="container">
        <article class="card">
            <header class="card-header"> My Orders / Tracking</header>
            @if(isset($orders))
                <div class="card-body">
                    <h6>Order ID: {{ $orders->order_no ?? '' }}</h6>
                    <hr>
                    <article class="card">
                        <div class="card-body row">
                            <div class="col"><strong>Estimated Delivery Time: {{ $order_content->estimation ?? '' }}
                                    Days</strong> <br></div>
                            <div class="col"><strong>Shipping BY:</strong> <br> JNE
                                - {{ $order_content->service ?? '' }}, |
                                <i class="fa fa-phone"></i></div>
                            <div class="col"><strong>Status:</strong> <br> {{ $orders->status ?? '' }} </div>
                            <div class="col"><strong>Tracking #:</strong> <br> {{ $orders->order_content->awb ?? '' }}
                            </div>
                        </div>
                    </article>
                    <div class="track">
                        @if($orders->status  == 'pending')
                            <div class="step active"><span class="icon"> <i class="fa fa-spinner fa-spin"></i> </span>
                                <span
                                    class="text">Awaiting Process</span></div>
                            <div class="step"><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                    class="text">Order confirmed</span></div>
                            <div class="step"><span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                    class="text">  Ready Pickup </span>
                            </div>
                            <div class="step"><span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Completed</span>
                            </div>
                        @elseif($orders->status == 'processing')
                            <div class="step active"><span class="icon"> <i class="fa fa-spinner fa-spin"></i> </span>
                                <span
                                    class="text">Awaiting Process</span></div>
                            <div class="step active"><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                    class="text">Order confirmed</span></div>
                            <div class="step"><span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                    class="text">  Ready Pickup </span>
                            </div>
                            <div class="step"><span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Completed</span>
                            </div>
                        @elseif($orders->status  == 'ready-for-pickup')
                            <div class="step active"><span class="icon"> <i class="fa fa-spinner fa-spin"></i> </span>
                                <span
                                    class="text">Awaiting Process</span></div>
                            <div class="step active"><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                    class="text">Order confirmed</span></div>

                            <div class="step active"><span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                    class="text">  Ready Pickup</span>
                            </div>

                            <div class="step"><span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Completed</span>
                            </div>
                        @elseif($orders->status  == 'completed')
                            <div class="step active"><span class="icon"> <i class="fa fa-spinner fa-spin"></i> </span>
                                <span
                                    class="text">Awaiting Process</span></div>
                            <div class="step active"><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                    class="text">Order confirmed</span></div>

                            <div class="step active"><span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                    class="text">  <a href="https://cekresi.com/?noresi={{ $orders->order_content->awb ?? '' }}" target="_blank">Ready Pickup  </a></span>
                            </div>

                            <div class="step active"><span class="icon"> <i class="fa fa-box"></i> </span> <span
                                    class="text">Completed</span>
                            </div>
                        @elseif($orders->status  == 'canceled')
                            <div class="step "><span class="icon"> <i class="fa fa-spinner"></i> </span> <span
                                    class="text">Awaiting Process</span></div>
                            <div class="step "><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                    class="text">Order confirmed</span></div>
                            <div class="step active"><span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                    class="text">  <a href="https://cekresi.com/?noresi={{ $orders->order_content->awb ?? '' }}" target="_blank">Ready Pickup  </a></span>
                            </div>
                            <div class="step "><span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Completed</span>
                            </div>
                            <div style=" color: red;" class="step cancel"><span class="icon"> <i
                                        class="fa fa-times"></i> </span> <span class="text">Canceled</span>
                            </div>
                        @endif
                    </div>
                    <hr>
                    @if($orders->status == 'ready-for-pickup' or $orders->status == 'completed')
                        <form action="{{ route('user.order_completed') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="{{$orders->id}}">
                            <a href="{{ url('/') }}" class="btn step" data-abc="true"> <i
                                    class="fa fa-chevron-left"></i> Back
                                to
                                shop</a>
                            @if($orders->status == 'completed')
                                <button style="float: right;" class="btn btn-success" name="archive" type="submit"
                                        onclick="archiveFunction()">
                                    <i class="fa fa-check"></i>
                                    Accept Order
                                </button>
                            @else
                                <button style="float: right;" class="btn btn-success" name="archive" type="submit"
                                        onclick="archiveFunction()">
                                    <i class="fa fa-check"></i>
                                    Accept Order
                                </button>
                            @endif
                        </form>
                    @elseif($orders->status == 'pending' or $orders->status == 'processing')
                        <form action="{{ route('user.order_cancel') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="{{$orders->id}}">
                            <a href="{{ url('/') }}" class="btn step" data-abc="true"> <i
                                    class="fa fa-chevron-left"></i> Back
                                to
                                shop</a>
                            <button style="float: right;" class="btn btn-danger" name="archive" type="submit"
                                    onclick="cancelOrder()">
                                <i class="fa fa-code"></i>
                                Cancel Order
                            </button>
                        </form>
                    @endif
                </div>
            @else
            @endif
        </article>
    </div>
    <br>
    {{--    batch action canceled--}}
    @if($orders->status  == 'canceled')
    <div class="container">
        <article class="card">
            <header class="card-header"> Process Refund Tracking</header>
            @if(isset($orders))
                <div class="card-body">
                    <h6>Order ID: {{ $orders->order_no ?? '' }}</h6>
                    <hr>
                    @if($refund_status->status == 'pending')
                    <div class="track">
                        <div style=" color: red;" class="step cancel"><span class="icon"> <i
                                    class="fa fa-times"></i> </span> <span class="text">Canceled</span>
                        </div>
                        <div class="step active"><span class="icon"> <i class="fa fa-spinner fa-spin"></i> </span>
                            <span
                                class="text">Awaiting Process</span></div>
                        <div class="step "><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Refund Success</span></div>
                    </div>
                    @else
                        <div class="track">
                            <div style=" color: red;" class="step cancel"><span class="icon"> <i
                                        class="fa fa-times"></i> </span> <span class="text">Canceled</span>
                            </div>
                            <div class="step active"><span class="icon"> <i class="fa fa-spinner fa-spin"></i> </span>
                                <span
                                    class="text">Awaiting Process</span></div>
                            <div class="step active"><span class="icon"> <i class="fa fa-check"></i> </span> <span
                                    class="text">Refund Success</span></div>
                        </div>
                        @endif

                    <hr>
                    @if($orders->status == 'ready-for-pickup' or $orders->status == 'completed')
                        <form action="{{ route('user.order_completed') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="{{$orders->id}}">
                            <a href="{{ url('/') }}" class="btn step" data-abc="true"> <i
                                    class="fa fa-chevron-left"></i> Back
                                to
                                shop</a>
                            @if($orders->status == 'completed')
                                <button style="float: right;" class="btn btn-success" name="archive" type="submit"
                                        onclick="archiveFunction()">
                                    <i class="fa fa-check"></i>
                                    Accept Order
                                </button>
                            @else
                                <button style="float: right;" class="btn btn-success" name="archive" type="submit"
                                        onclick="archiveFunction()">
                                    <i class="fa fa-check"></i>
                                    Accept Order
                                </button>
                            @endif
                        </form>
                    @elseif($orders->status == 'pending' or $orders->status == 'processing')
                        <form action="{{ route('user.order_cancel') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="{{$orders->id}}">
                            <a href="{{ url('/') }}" class="btn step" data-abc="true"> <i
                                    class="fa fa-chevron-left"></i> Back
                                to
                                shop</a>
                            <button style="float: right;" class="btn btn-danger" name="archive" type="submit"
                                    onclick="cancelOrder()">
                                <i class="fa fa-code"></i>
                                Cancel Order
                            </button>
                        </form>
                    @endif
                </div>
            @else
            @endif
        </article>
    </div>
    @endif
    {{--    batch action return item--}}


@endsection


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        var interval = "{{$lastChar ?? ''}}";
        if (interval > 0) {
            setInterval(function () {
                document.getElementById("est").submit();
            }, interval);
        }

        function archiveFunction() {
            event.preventDefault();
            var form = event.target.form;
            swal({
                    title: "Are you sure?",
                    text: "Do you want to complete this transaction?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, do it!",
                    cancelButtonText: "Tidak, Batal! please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        form.submit();
                    } else {
                        swal("Cancelled", "Your transaction is in progress :)", "error");
                    }
                });
        }

        //    cancel a product
        function cancelOrder() {
            event.preventDefault();
            var form = event.target.form;
            swal({
                    title: "Are you sure?",
                    text: "Do you want to cancel this transaction?, This action cannot be undone!! ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, do it!",
                    cancelButtonText: "Tidak, Batal! please!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        form.submit();
                    } else {
                        swal("Cancelled", "Your transaction is in progress :)", "error");
                    }
                });
        }
    </script>
@endpush
