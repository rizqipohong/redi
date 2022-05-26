@extends('frontend.arafa-cart.account.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/order.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        .scroll {
            margin: 5px;
            padding: 5px;
            width: 100%;
            height: 700px;
            overflow: auto;
            text-align: justify;
        }
    </style>
@endpush
@section('user_content')
    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
        <div class="dash__table-2-wrap gl-scroll">
            <div class="section-body">
                <div class="container ">
                    <div class="row scroll">
                        <div class="col-12 px-0">
                            <div class="px-4 py-5 chat-box bg-white">
                            @foreach($chat_customer as $ami)
                                @if($ami->role == 'seller')
                                    <!-- Sender Message-->
                                        <div class="media w-50 mb-3"><img
                                                src="https://bootstrapious.com/i/snippets/sn-chat/avatar.svg"
                                                alt="user" width="50"
                                                class="rounded-circle">
                                            <div class="media-body ml-3">
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
                                            <div class="media-body">
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
                            <form action="{{ url('user/chat/seller/send') }}" method="post">
                                @csrf

                                @foreach($info as $ami)
                                    <input type="hidden" value="{{ $ami->user_id }}" name="seller_id">
                                @endforeach
                                <div class="input-group">
                                    <input type="text"
                                           required
                                           placeholder="Type a message"
                                           name="comment"
                                           aria-describedby="button-addon2"
                                           class="form-control rounded-0 border-0 py-4 bg-light">
                                    <select class="form-select" name="term_id" aria-label="Default select example" required>
                                        @foreach($products as $row)
                                            <option value="{{$row->id}}">{{$row->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit"
                                                class="btn btn-link"><i
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
    <div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
@endpush
