@extends('layouts.app')
@section('content')

    @if(Auth::user()->status == 2 || Auth::user()->status == 3)
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p>
                            {{ __('Dear,') }} <b>{{ Auth::user()->name }}</b>{{ __(' Your Account Currently') }} <b
                                class="text-danger"> @if(Auth::user()->status == 2) {{ __('Suspened') }} @elseif(Auth::user()->status == 3) {{ __('Pending') }} @endif </b> {{ __('Mode And Also Disabled All Functionality If You Are Not Complete Your Payment Please Complete Your Payment From') }}
                            <a href="{{ route('merchant.plan') }}">{{ __('Here') }}</a> {{ __('Or Also Contact With Support Team') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 >{{ __('Paketmu saat ini') }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/seller/settings/plan') }}"
                           class="text-right btn btn-sm btn-primary">{{ $plan->plan_metas->name ?? '' }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-danger">
                    <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Kadaluarsa pada') }}</h4>
                    </div>
                    <div class="card-body">
                       <h6 style="color: #fc544b; font-size: 14px;"> {{ $plan->will_expired ?? '' }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Hari Tersisa') }}</h4>
                    </div>
                    <div class="card-body">
                        <div  style="color: #ffa426; font-size: 14px;" data-countdown="{{ $plan->will_expired ?? '' }}"></div>
{{--                        <h6 style="color: #ffa426;"> {{ $plan->will_expired ?? '' }}</h6>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-secondary bg-secondary">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 >{{ __('Share Link Register Affiliate') }}</h4>
                    </div>
                    <div class="card-body">
                        <p style="display: none;" id="text">{{ env('APP_URL') }}/merchant/register/4/{{auth()->user()->id}}</p>
                        <a href="#" onclick="copyToClipboard('#text')"
                           class="text-right btn btn-sm btn-secondary">{{ __('Copy This Link') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @php
                $data = App\Models\Promo::with('user')->get();
            @endphp
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($data as $row)
                        <div class="carousel-item {{ $row->name=='perdana' ? 'active' : '' }}">
                            <img src="{{ asset($row->link) }}" width="100%" height="500px">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Edit Your Website') }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('seller.theme.index') }}"
                           class="text-right btn btn-sm btn-primary">{{ __('Edit Now ') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-video"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('How To Be Seller') }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('seller.how_to_be_seller') }}"
                           class="text-right btn btn-sm btn-primary">{{ __('Read More') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Import Your Product') }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('seller.product.index') }}"
                           class="text-right btn btn-sm btn-primary">{{ __('CSV/Excel ') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">{{ __('Order Statistics') }} -
                        <div class="dropdown d-inline">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month"
                               id="orders-month">{{ Date('F') }}</a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li class="dropdown-title">{{ __('Select Month') }}</li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='January') active @endif"
                                       data-month="January">{{ __('January') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='February') active @endif"
                                       data-month="February">{{ __('February') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='March') active @endif"
                                       data-month="March">{{ __('March') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='April') active @endif"
                                       data-month="April">{{ __('April') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='May') active @endif"
                                       data-month="May">{{ __('May') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='June') active @endif"
                                       data-month="June">{{ __('June') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='July') active @endif"
                                       data-month="July">{{ __('July') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='August') active @endif"
                                       data-month="August">{{ __('August') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='September') active @endif"
                                       data-month="September">{{ __('September') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='October') active @endif"
                                       data-month="October">{{ __('October') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='November') active @endif"
                                       data-month="November">{{ __('November') }}</a></li>
                                <li><a href="#" class="dropdown-item month @if(Date('F')=='December') active @endif"
                                       data-month="December">{{ __('December') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="pending_order"></div>
                            <div class="card-stats-item-label">{{ __('Pending') }}</div>
                        </div>

                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="completed_order"></div>
                            <div class="card-stats-item-label">{{ __('Completed') }}</div>
                        </div>

                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="shipping_order"></div>
                            <div class="card-stats-item-label">{{ __('Processing') }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Orders') }}</h4>
                    </div>
                    <div class="card-body" id="total_order">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="sales_of_earnings_chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Sales Of Earnings') }} - {{ date('Y') }}</h4>
                    </div>
                    <div class="card-body" id="sales_of_earnings">
                        <img src="{{ asset('uploads/loader.gif') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="total-sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>{{ __('Total Sales') }} - {{ date('Y') }}</h4>
                    </div>
                    <div class="card-body" id="total_sales">
                        <img src="{{ asset('uploads/loader.gif') }}" class="loads">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-9">

            <div class="row">
                <div class="col-12">

                    <div class="card mt-4">
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Earnings performance') }} <img
                                    src="{{ asset('uploads/loader.gif') }}" height="20" id="earning_performance"></h4>
                            <div class="card-header-action">

                                <select class="form-control" id="perfomace">
                                    <option value="7">{{ __('Last 7 Days') }}</option>
                                    <option value="15">{{ __('Last 15 Days') }}</option>
                                    <option value="30">{{ __('Last 30 Days') }}</option>
                                    <option value="365">{{ __('Last 365 Days') }}</option>
                                </select>

                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Today\'s Total Sales') }}</h6>

                                    <span class="h2 mb-0" id="today_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Today\'s Orders') }}</h6>

                                    <span class="h2 mb-0" id="today_order"><img src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Yesterday') }}</h6>

                                    <span class="h2 mb-0" id="yesterday_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('7 days') }}</h6>

                                    <span class="h2 mb-0" id="last_seven_days_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('This Month') }}</h6>

                                    <span class="h2 mb-0" id="monthly_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="text-uppercase text-muted mb-2">{{ __('Last Month') }}</h6>

                                    <span class="h2 mb-0" id="last_month_total_sales"><img
                                            src="{{ asset('uploads/loader.gif') }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-3">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header">

                            <h4 class="card-header-title plan_name"></h4>

                            <span class="badge badge-soft-secondary plan_expire"></span>
                            <img src="{{ asset('uploads/loader.gif') }}" class="plan_load">
                        </div>
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Storage usage') }}</h4>

                            <span class="badge badge-soft-secondary" id="storage_used"><img
                                    src="{{ asset('uploads/loader.gif') }}" class="storrage_used"></span>
                        </div>
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Products') }}</h4>

                            <span class="badge badge-soft-secondary posts_used"><img
                                    src="{{ asset('uploads/loader.gif') }}" class="product_used"></span>
                        </div>
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Pages') }}</h4>

                            <span class="badge badge-soft-secondary pages"> <img src="{{ asset('uploads/loader.gif') }}"
                                                                                 class="product_used"></span>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Products Limit') }} <span><span
                                        class="text-danger posts_created"></span>/<span
                                        class="product_capacity"> </span></span></h4>
                        </div>
                        <div class="card-body">

                            <div class="sparkline-pie-product d-inline"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-header-title">{{ __('Storage Uses') }} <span><span
                                        class="text-danger storage_used"></span>/<span class="storage_capacity"> </span></span>
                            </h4>
                        </div>
                        <div class="card-body">

                            <div class="sparkline-pie-storage d-inline"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Site Analytics') }}</h4>
                    <div class="card-header-action">
                        <select class="form-control" id="days">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="15">{{ __('Last 15 Days') }}</option>
                            <option value="30">{{ __('Last 30 Days') }}</option>
                            <option value="180">{{ __('Last 180 Days') }}</option>
                            <option value="365">{{ __('Last 365 Days') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="google_analytics" height="80"></canvas>
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">

                            <div class="detail-value" id="total_visitors"></div>
                            <div class="detail-name">{{ __('Total Vistors') }}</div>
                        </div>
                        <div class="statistic-details-item">

                            <div class="detail-value" id="total_page_views"></div>
                            <div class="detail-name">{{ __('Total Page Views') }}</div>
                        </div>

                        <div class="statistic-details-item">

                            <div class="detail-value" id="new_vistors"></div>
                            <div class="detail-name">{{ __('New Visitor') }}</div>
                        </div>

                        <div class="statistic-details-item">

                            <div class="detail-value" id="returning_visitor"></div>
                            <div class="detail-name">{{ __('Returning Visitor') }}</div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Referral URL') }}</h4>
                        </div>
                        <div class="card-body refs" id="refs">


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Browser') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" id="browsers"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Top Most Visit Pages') }}</h4>
                        </div>
                        <div class="card-body tmvp" id="table-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <input type="hidden" id="site_url" value="{{ url('/') }}">
    <input type="hidden" id="dashboard_static" value="{{ route('seller.dashboard.static') }}">
    <input type="hidden" id="dashboard_perfomance" value="{{ url('/seller/dashboard/perfomance') }}">
    <input type="hidden" id="dashboard_order_statics" value="{{ url('/seller/dashboard/order_statics') }}">
    <input type="hidden" id="gif_url" value="{{ asset('uploads/loader.gif') }}">
    <input type="hidden" id="month" value="{{ date('F') }}">
    <div class="modal fade" id="myTutorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tutorial Become Seller</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $data = App\Models\Tutorial::with('user')->get();
                    @endphp
                    <div id="modalCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($data as $row)
                                <div class="carousel-item {{ $row->name=='Instalasi' ? 'active' : '' }}">
                                    <iframe width="100%" height="450"
                                            src="{{ $row->link ?? '' }}">
                                    </iframe>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-3 hide-sidebar-mini">
                            <a href="{{ route('seller.how_to_be_seller') }}"
                               class="btn btn-success btn-lg btn-block btn-icon-split">
                                <i class="fas fa-external-link-alt"></i>{{ __('How To Be Seller') }}
                            </a>
                        </div>
                        <a class="carousel-control-prev" href="#modalCarousel" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#modalCarousel" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/seller/dashboard.js') }}"></script>
    <script src="{{ asset('assets/countdown/jquery.countdown.js') }}"></script>
    <script type="text/javascript">
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert('Link Affiliate has been copied');
        }
        $(window).on('load', function () {
            $('#myTutorial').modal('show');
        });
        $("#myTutorial").on('hidden.bs.modal', function (e) {
            $("#myTutorial iframe").attr("src", $("#myTutorial iframe").attr("src"));
        });
        $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D hari lagi'));
            });
        });
    </script>
@endpush