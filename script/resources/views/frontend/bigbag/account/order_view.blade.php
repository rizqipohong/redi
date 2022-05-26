@extends('frontend.bigbag.account.layout.app')
@section('user_content')
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title d-flex justify-content-between align-items-center">
                                <h2>{{ __('Order Information') }}</h2>
                                <div class="invoice-number"><strong>{{ __('Order Id') }}:</strong> {{ $info->order_no }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                @if($info->order_type == 1)
                                    <div class="col-md-6">

                                        <address>
                                            <strong>{{ __('Shipped To') }}:</strong><br>
                                            {{ $order_content->address ?? '' }}<br>
                                            {{ __('City') }}: {{ $info->shipping_info->city->name ?? '' }}
                                            <br>
                                            {{ __('Postal Code') }}: {{ $order_content->zip_code ?? '' }}
                                            <br>
                                            {{ __('Address') }}: {{ $order_content->address ?? '' }}
                                        </address>

                                    </div>
                                @endif
                                @if($info->order_type == 1)
                                    <div class="col-md-6 text-md-right">
                                        @else
                                            <div class="col-md-12 text-md-right">
                                                @endif
                                                <address>
                                                    <strong>Order Status:</strong><br>
                                                    @if($info->status=='pending')
                                                        <span
                                                            class="badge badge-warning ">{{ __('Awaiting processing') }}</span>

                                                    @elseif($info->status=='processing')
                                                        <span class="badge badge-primary ">{{ __('Processing') }}</span>

                                                    @elseif($info->status=='ready-for-pickup')
                                                        <span
                                                            class="badge badge-info ">{{ __('Ready for pickup') }}</span>

                                                    @elseif($info->status=='completed')
                                                        <span class="badge badge-success ">{{ __('Completed') }}</span>

                                                    @elseif($info->status=='archived')
                                                        <span class="badge badge-danger ">{{ __('Archived') }}</span>
                                                    @elseif($info->status=='canceled')
                                                        <span class="badge badge-danger ">{{ __('Canceled') }}</span>

                                                    @else
                                                        <span class="badge badge-primary ">{{ $info->status }}</span>

                                                    @endif
                                                </address>
                                                <br>
                                                <address>
                                                    <strong>{{ __('Payment Status') }}:</strong><br>


                                                    @if($info->payment_status==2)
                                                        <span class="badge badge-warning ">{{ __('Pending') }}</span>

                                                    @elseif($info->payment_status==1)
                                                        <span class="badge badge-success ">{{ __('Paid') }}</span>

                                                    @elseif($info->payment_status==0)
                                                        <span class="badge badge-danger ">{{ __('Cancel') }}</span>
                                                    @elseif($info->payment_status==3)
                                                        <span class="badge badge-danger ">{{ __('Incomplete') }}</span>

                                                    @endif
                                                </address>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>{{ __('Payment Info') }}:</strong><br>

                                                <p>{{ __('Payment Method') }} : <b>{{ $info->getway->name ?? '' }}</b>
                                                </p>
                                                <p>{{ __('Transaction Id') }} : <b>{{ $info->transaction_id }}</b></p>

                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>

                                                <strong>{{ __('Order Date') }}:</strong><br>

                                                {{ $info->created_at->format('d-F-Y') }}<br><br>

                                            </address>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">{{ __('Order Summary') }}</div>
                                <br>
                                @if($info->return_time >= now())
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Hai Customer!</strong> {{ __('Silahkan ajukan komplain sebelum tanggal') }} {{Carbon\Carbon::createFromFormat('Y-m-d', $info->return_time ?? '')->format('j F Y ') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover table-md">
                                        <tbody>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th class="text-center">{{ __('Amount') }}</th>
                                            <th class="text-right">{{ __('Total') }}</th>
                                            @if($info->status=='completed' && $info->return_time >= now())
                                                <th class="text-right">{{ __('Action') }}</th>
                                            @endif

                                        </tr>
                                        @foreach($info->order_item as $row)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/product/'.$row->term->title.'/'.$row->term->id) }}">{{ Str::limit($row->term->title,50) ?? '' }}</a>
                                                    <br>
                                                    @php
                                                        $variations=json_decode($row->info);
                                                    @endphp
                                                    @foreach ($variations->attribute ?? [] as $item)

                                                        <span></span> <small>{{ $item->attribute->name ?? '' }}
                                                            - {{ $item->variation->name ?? '' }}</small>,
                                                    @endforeach

                                                    @foreach ($variations->options ?? [] as $option)
                                                        <span>{{ __('Option') }} :</span>
                                                        <small>{{ $option->name ?? '' }}</small>,
                                                    @endforeach
                                                    @if($info->status == 'completed' && $info->payment_status == 1)
                                                        <br>
                                                        @foreach ($row->file ?? [] as $file)
                                                            <a href="{{ url($file->url) }}"
                                                               target="_blank">{{ __('Download') }}</a>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ amount_format($row->amount) }}
                                                    × {{ $row->qty }}</td>

                                                <td class="text-right">{{  amount_format($row->amount*$row->qty) }}</td>
                                                @if($info->status=='completed' && $info->return_time >= now())
                                                    <td class="text-right">
                                                        <button data-toggle="modal" data-target="#return"
                                                                class="btn btn-danger"> {{ __('Return Product') }} </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade bd-example-modal-lg" id="return"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalCenterTitle"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content ">
                                                                    <nav>
                                                                        <div class="nav nav-tabs" id="nav-tab"
                                                                             role="tablist">
                                                                            <a class="nav-item nav-link active"
                                                                               id="nav-home-tab" data-toggle="tab"
                                                                               href="#nav-home" role="tab"
                                                                               aria-controls="nav-home"
                                                                               aria-selected="true">Reason</a>
                                                                            <a class="nav-item nav-link"
                                                                               id="nav-profile-tab" data-toggle="tab"
                                                                               href="#nav-profile" role="tab"
                                                                               aria-controls="nav-profile"
                                                                               aria-selected="false">Proof File</a>
                                                                            <a class="nav-item nav-link"
                                                                               id="nav-contact-tab" data-toggle="tab"
                                                                               href="#nav-contact" role="tab"
                                                                               aria-controls="nav-contact"
                                                                               aria-selected="false">Chat Seller</a>
                                                                        </div>
                                                                    </nav>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active"
                                                                             id="nav-home" role="tabpanel"
                                                                             aria-labelledby="nav-home-tab">
                                                                            <form action="{{ url('user/order/return_item') }}" method="post">
                                                                                @csrf
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLongTitle">
                                                                                        The reason for wanting to return
                                                                                        the item</h5>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                        <textarea class="form-control" name="info"
                                                                                  placeholder="Reason" id="" cols="30"
                                                                                  rows="10">

                                                                        </textarea>
                                                                                    <input type="hidden" value="{{$info->id}}" name="order_id">
                                                                                    <input type="hidden" value="{{$row->term->id}}" name="term_id">
                                                                                    <input type="hidden" value="{{$row->amount}}" name="amount">
                                                                                    <input type="hidden" value="{{$row->qty}}" name="qty">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Close
                                                                                    </button>
                                                                                    <button type="submit"
                                                                                            class="btn btn-primary">
                                                                                        Submit
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="nav-profile"
                                                                             role="tabpanel"
                                                                             aria-labelledby="nav-profile-tab">
                                                                            <form action="{{ url('user/order/return_proof_item') }}" method="post"
                                                                                  enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLongTitle">
                                                                                        Strong evidence for the reason
                                                                                        of return</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" value="{{$info->id}}" name="order_id">
                                                                                    <input style="float: left;"
                                                                                           type="file" name="image"
                                                                                           placeholder="Proof file">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">Close
                                                                                    </button>
                                                                                    <button type="submit"
                                                                                            class="btn btn-primary">
                                                                                        Submit
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="nav-contact"
                                                                             role="tabpanel"
                                                                             aria-labelledby="nav-contact-tab">
                                                                            <div class="container ">
                                                                                <div class="row scroll">
                                                                                    <div class="col-12 px-0">
                                                                                        <div
                                                                                            class="px-4 py-5 chat-box bg-white">
                                                                                        @foreach($chat_customer as $ami)
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
                                                                                                                {{$ami->created_at}}</p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                            @else
                                                                                                <!-- Reciever Message-->
                                                                                                    <div
                                                                                                        class="media w-50 ml-auto mb-3">
                                                                                                        <div
                                                                                                            class="media-body">
                                                                                                            <div
                                                                                                                class="bg-primary rounded py-2 px-3 mb-2">
                                                                                                                <p class="text-small mb-0 text-white">
                                                                                                                    {{$ami->comment}}</p>
                                                                                                            </div>
                                                                                                            <p class="small text-muted">
                                                                                                                {{$ami->created_at}}</p>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif

                                                                                            @endforeach
                                                                                        </div>
                                                                                        <!-- Typing area -->
                                                                                        <form
                                                                                            action="{{ url('user/chat/seller/send') }}"
                                                                                            method="post">
                                                                                            @csrf
                                                                                            <input type="hidden"
                                                                                                   value="{{ $info->user_id }}"
                                                                                                   name="seller_id">
                                                                                            <div class="input-group">
                                                                                                <input type="text"
                                                                                                       required
                                                                                                       placeholder="Type a message"
                                                                                                       name="comment"
                                                                                                       aria-describedby="button-addon2"
                                                                                                       class="form-control rounded-0 border-0 py-4 bg-light">
                                                                                                <select
                                                                                                    class="form-select"
                                                                                                    name="term_id"
                                                                                                    aria-label="Default select example"
                                                                                                    required>
                                                                                                    @foreach($products as $teling)
                                                                                                        <option
                                                                                                            value="{{$teling->id}}">{{$teling->title}}</option>
                                                                                                    @endforeach
                                                                                                </select>
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
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                        @if($info->status == 'ready-for-pickup' or $info->status == 'completed')
                                            <form action="{{ route('user.order_completed') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" id="order_id"
                                                       value="{{$info->id}}">
                                                @if($info->status == 'completed')
                                                    <button class="btn btn-success btn-sm" name="archive" type="submit"
                                                            onclick="archiveFunction()">
                                                        <i class="fa fa-check"></i>
                                                        Accept Order
                                                    </button>
                                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                                            data-target="#collapseExample" aria-expanded="false"
                                                            aria-controls="collapseExample">
                                                        Make Review
                                                    </button>
                                                @else
                                                    <button class="btn btn-success btn-sm" name="archive" type="submit"
                                                            onclick="archiveFunction()">
                                                        <i class="fa fa-check"></i>
                                                        Accept Order
                                                    </button>
                                                @endif
                                            </form>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name"><strong>{{ __('Subtotal') }}
                                                    :</strong>{{ amount_format($order_content->sub_total + $order_content->coupon_discount) }}
                                            </div>
                                        </div>
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name"><strong>{{ __('Discount') }}
                                                    :</strong>{{ amount_format($order_content->coupon_discount) }}</div>
                                        </div>

                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name"><strong>{{ __('Tax') }}
                                                    :</strong> {{ amount_format($info->tax) }}</div>
                                        </div>
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name"><strong>{{ __('Shipping') }}
                                                    :</strong> {{ amount_format($info->shipping) }}</div>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">{{ __('Total') }}</div>
                                            <div
                                                class="invoice-detail-value invoice-detail-value-lg">{{ amount_format($info->total) }}</div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="collapse col-lg-12" id="collapseExample">
                                        <div class="card card-body">
                                            <form method="post"
                                                  action="{{ url('/make-review/store_order',$row->term->id) }}">
                                                @csrf
                                                @foreach($info->order_item as $row)
                                                    @foreach($reviews as $review)
                                                        @if(isset($review->term_id) && $row->term->id == $review->term_id)
                                                            <div class="row-input">
                                                                <div class="theme-review" id="comment_156466">
                                                                    <div class="theme_review_item">
                                                                        <div class="theme-review__heading">
                                                                        </div>
                                                                        <div class="theme-review__body">
                                                                            <div class="main_reply_form">
                                                                                <div class="media-body">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="form-group col-md-8 mb-3">
                                                                                            <label
                                                                                                class="col-form-label"
                                                                                                for="reviewTitle">Customer</label>
                                                                                            <p>{{$review->name}}</p>
                                                                                            <p>{{$review->created_at}}</p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-group col-md-4 mb-3">
                                                                                            <label
                                                                                                class="col-form-label"
                                                                                                for="reviewScore">Review</label><br>
                                                                                            @if($review->rating == 5)
                                                                                                ★★★★★ (5/5)
                                                                                            @elseif($review->rating == 4)
                                                                                                ★★★★☆ (4/5)
                                                                                            @elseif($review->rating == 3)
                                                                                                ★★★☆☆ (3/5)
                                                                                            @elseif($review->rating == 2)
                                                                                                ★★☆☆☆ (2/5)
                                                                                            @else
                                                                                                ★☆☆☆☆ (1/5)
                                                                                            @endif

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <h3>{{ __('Leave Your Review') }}</h3>

                                                                <div class="row-input">
                                                                    <img src=""
                                                                         alt="{{ Str::limit($row->term->title,50) ?? '' }}">
                                                                </div>
                                                                <div class="row-input">
                                                                <textarea placeholder="Your quote" name="comment"
                                                                          height="50px"></textarea>
                                                                </div>
                                                                <div class="star-rating">
                                                                    <input type="checkbox" value="5" name="rating"
                                                                           id="star1"><label
                                                                        for="star1"></label>
                                                                    <input type="checkbox" value="4" name="rating"
                                                                           id="star2"><label
                                                                        for="star2"></label>
                                                                    <input type="checkbox" value="3" name="rating"
                                                                           id="star3"><label
                                                                        for="star3"></label>
                                                                    <input type="checkbox" value="2" name="rating"
                                                                           id="star4"><label
                                                                        for="star4"></label>
                                                                    <input type="checkbox" value="1" name="rating"
                                                                           id="star5"><label
                                                                        for="star5"></label>
                                                                </div>

                                                                <input type="hidden" value="{{$info->id}}"
                                                                       name="id_order">
                                                                <button type="submit" class="btn btn-outline ">
                                                                    <i class="fas fapaper-plane"></i>
                                                                    {{ __('Send Review') }}
                                                                </button>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script src="{{ asset('frontend/bigbag/js/product/details.js')}}"></script>
@endpush

