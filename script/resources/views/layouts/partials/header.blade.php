<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>

        </ul>
    </form>
    @php
        $notif = DB::table('ordernotif')->join('orders', 'ordernotif.order_id', 'orders.id')
        ->where('ordernotif.status', 0)
        ->select('ordernotif.*', 'orders.order_no')
        ->orderBy('ordernotif.created_at', 'desc')
        ->get();
        $chat = DB::table('chats')->where('status', 0)->get();
        $count_chat = DB::table('chats')->where('status', 0)->count();
        $count_notif= DB::table('ordernotif')->join('orders', 'ordernotif.order_id', 'orders.id')->where('ordernotif.status', 0)->count();
    @endphp
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg nav-link-user"> <i
                    class="fas fa-envelope"> {{ $count_chat }}</i>
            </a>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link  nav-link-lg nav-link-user">
                <i class="fa fa-bell" style="font-size: 15px;"> {{ $count_notif }}</i>
            </a>
            <div style="width: 300px; max-height: 280px;  overflow-y: auto;" class="dropdown-menu dropdown-menu-right">

                @if($count_notif >= 5)
                    @foreach($notif as $row)
                        <a href="{{ $row->url }}" pr_id="{{ $row->id }}" onclick="getNotif(this); return true;"
                           class="dropdown-item has-icon">
                            <i class="fa fa-shopping-cart"></i> {{ $row->order_no  }}<br>
                            <span
                                style="float: right;">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('j F, Y g:i A') }} </span>
                        </a><br>
                        <a href=""><p align="center">Show All</p></a>
                    @endforeach
                @else
                    @foreach($notif as $row)
                        <a href="{{ $row->url }}" pr_id="{{ $row->id }}" onclick="getNotif(this); return true;"
                           class="dropdown-item has-icon">
                            <i class="fa fa-shopping-cart"></i> {{ $row->order_no  }}<br>
                            <span
                                style="float: right;">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('j F, Y g:i A') }} </span>
                        </a><br>
                    @endforeach
                @endif
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <i class="fas fa-wallet" style="font-size: 15px;"> Saldo</i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('seller.seller.settings') }}" class="dropdown-item has-icon">
                    <i class="fas fa-history"></i>{{ __('History Withdraw') }}
                </a>
                <a href="{{ route('seller.seller.settings') }}" class="dropdown-item has-icon">
                    <i class="fas fa-chart-bar"></i>{{ __('Statistic Order') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-money-check"></i>Rp. 1.069.000,00
                </a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @if(Auth::user()->role_id == 3)
                    @if(Auth::user()->status == 1)
                        <a href="{{ route('seller.seller.settings') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> {{ __('Profile Settings') }}
                        </a>
                    @else
                        <a href="{{ route('merchant.profile.settings') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> {{ __('Profile Settings') }}
                        </a>
                    @endif
                @else
                    <a href="{{ route('admin.profile.settings') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> {{ __('Profile Settings') }}
                    </a>

                @endif
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
@push('js')
    <script>
        function getNotif(e) {
            var id = e.getAttribute("pr_id");
            $.ajax({
                type: 'GET',
                url: " {{ url('') }}/seller/notif/" + id,
                data: {'id': id},
                success: function () {
                    console.log("Notif Readed");
                }
            });
        }
    </script>
@endpush
