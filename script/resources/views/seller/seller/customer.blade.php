@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Customer Info'])
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">

                    <h5></h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Name') }}: <b>{{ $info->name }}</b>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Email') }}: <b>{{ $info->email }}</b>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Registered At') }}: <b>{{ $info->created_at->diffForHumans() }}</b>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Registration Date') }}: <b>{{ $info->created_at->format('d-F-Y') }}</b>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Total Orders') }}
                            <span class="badge badge-info badge-pill">{{ $info->orders_count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Total Processing Orders') }}
                            <span class="badge badge-warning badge-pill">{{ $info->orders_processing_count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Total Complete Orders') }}
                            <span class="badge badge-success badge-pill">{{ $info->orders_complete_count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('Total Spend Of Amount') }}
                            <span class="badge badge-primary badge-pill">{{ amount_format($earnings) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Order History') }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tbody><tr>
                                <th>{{ __('Invoice ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Items') }}</th>

                                <th>{{ __('Payment Metho') }}d</th>
                                <th>{{ __('Payment Status') }}</th>
                                <th>{{ __('Order Statu') }}s</th>
                                <th>{{ __('Due Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            @foreach($orders as $row)
                                <tr>
                                    <td><a href="{{ route('seller.invoice',$row->id) }}">{{ $row->order_no }}</a></td>
                                    <td class="font-weight-600">{{ amount_format($row->total) }}</td>
                                    <td class="font-weight-600">{{ $row->order_item_count }}</td>
                                    <td>
                                        {{ $row->payment_method->method->name ?? '' }}
                                    </td>
                                    <td>
                                        @if($row->payment_status==2)
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>

                                        @elseif($row->payment_status==1)
                                            <span class="badge badge-success">{{ __('Complete') }}</span>

                                        @elseif($row->payment_status==0)
                                            <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                        @elseif($row->payment_status==3)
                                            <span class="badge badge-danger">{{ __('Incomplete') }}</span>

                                        @endif

                                    </td>
                                    <td>

                                        @if($row->status=='pending')
                                            <span class="badge badge-warning">{{ __('Awaiting processing') }}</span>

                                        @elseif($row->status=='processing')
                                            <span class="badge badge-primary">{{ __('Processing') }}</span>

                                        @elseif($row->status=='ready-for-pickup')
                                            <span class="badge badge-info">{{ __('Ready for pickup') }}</span>

                                        @elseif($row->status=='completed')
                                            <span class="badge badge-success">{{ __('Completed') }}</span>

                                        @elseif($row->status=='archived')
                                            <span class="badge badge-warning">{{ __('Archived') }}</span>
                                        @elseif($row->status=='canceled')
                                            <span class="badge badge-danger">{{ __('Canceled') }}</span>

                                        @else
                                            <span class="badge badge-info">{{ $row->status }}</span>

                                        @endif

                                    </td>
                                    <td>{{ $row->created_at->format('d-F-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.customer.orders.show',$row->id) }}" class="btn btn-primary">{{ __('Detail') }}</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $orders->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __(' Return History') }}</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>{{ __('Invoice ID') }}</th>
                                <th>{{ __('Items') }}</th>
                                <th>{{ __('Qty') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th class="text-center">{{ __('Action') }}</th>
                            </tr>
                            @foreach($returm_item as $row)
                                <tr>
                                    <td><a href="{{ route('seller.invoice',$row->order_id) }}">{{ $row->order_no }}</a></td>
                                    <td class="font-weight-600">{{ $row->title }}</td>
                                    <td class="font-weight-600">{{ $row->qty }}</td>
                                    <td class="font-weight-600">{{ amount_format($row->amount) }}</td>
                                    <td>{{ $row->created_at}}</td>
                                    <td class="text-center">
                                        <button data-toggle="modal" data-target="#return" class="btn btn-success">Proof</button>

                                    </td>
                                </tr>
                                <!-- Modal Proof -->
                                <div class="modal fade" id="return" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Reason & Proof File</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img style="border-radius: 50%;" src="{{ URL::to('/') }}/images/{{  $row->proof }}" alt="...">
                                                <br>
                                                <textarea class="form-control" name="" id="" readonly >
                                                    {{  $row->info }}
                                                </textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                {{--                                                <button type="button" class="btn btn-primary">Save changes</button>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            </tbody>
                        </table>

                        {{ $orders->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
