@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Statistic'])
@endsection
@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive custom-table">
                            <div class="float-left">
                                <form class="form-inline" action="{{ route('seller.statistic') }}" method="get">
                                    <div class="form-group mx-sm-3">
                                        <input type="text" id="created_at" name="date" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('seller.statistic') }}">
                                        <button class="btn btn-success">Refresh</button>
                                    </a>
                                </form>
                            </div>
                            <div class="float-right">
                                <form>
                                    <div class="input-group mb-2">
                                        <input type="text" id="src" class="form-control" placeholder="Search..."
                                               required="" name="src" autocomplete="off" value="{{ $src ?? '' }}">
                                        <select class="form-control selectric" name="type" id="type">
                                            <option value="title">{{ __('Search By Name') }}</option>
                                            <option value="id">{{ __('Search By High Commission') }}</option>

                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table">
                                <thead>
                                <tr align="center">
                                    <th class="am-select">
                                        #
                                    </th>
                                    <th class="am-title">{{ __('Product Name') }}</th>
                                    <th class="am-title">{{ __('Views') }}</th>
                                    <th class="text-center">{{ __('Share Clicks') }}</th>
                                    <th class="text-center">{{ __('Cart Clicks') }}</th>
                                    <th class="text-center">{{ __('Wishlist Clicks') }}</th>
                                    <th class="text-center">{{ __('Top Sales') }}</th>
                                    <th class="text-center">{{ __('Last Update') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($data as $row)
                                    <tr align="center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->views }}</td>
                                        <td>{{ $row->click_share }}</td>
                                        <td>{{ $row->click_cart }}</td>
                                        <td>{{ $row->click_like }}</td>
                                        <td>{{ $row->total_sales }}</td>
                                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $row->static_date)->format('j F Y') }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        $(document).ready(function () {
            let start = moment().startOf('month')
            let end = moment().endOf('month')
            $('#exportpdf').attr('href', '/administrator/reports/order/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))
            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function (first, last) {
                $('#exportpdf').attr('href', '/administrator/reports/order/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
@endpush
