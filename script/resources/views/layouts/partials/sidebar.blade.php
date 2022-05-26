<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{ env('APP_NAME') }}</a>

        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{ Str::limit(env('APP_NAME'), $limit = 1) }}</a>
        </div>
        <ul class="sidebar-menu">
            @if(Auth::user()->role_id==1)
                @can('dashboard')
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="flaticon-dashboard"></i> <span>{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                @endcan

                @can('order.list')
                    <li class="{{ Request::is('admin/order*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.order.index') }}">
                            <i class="flaticon-note"></i> <span>{{ __('Subscription') }}</span>
                        </a>
                    </li>
                @endcan

                @php
                    $plan=false;
                @endphp
                @can('plan.create')
                    @php
                        $plan=true;
                    @endphp
                @endcan
                @can('plan.list')
                    @php
                        $plan=true;
                    @endphp
                @endcan
                @if($plan == true)
                    <li class="dropdown {{ Request::is('admin/plan*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-pricing"></i> <span>{{ __('Plans') }}</span></a>
                        <ul class="dropdown-menu">
                            @can('plan.create')
                                <li><a class="nav-link {{ Request::is('admin/plan/create') ? 'active' : '' }}"
                                       href="{{ route('admin.plan.create') }}">{{ __('Create') }}</a></li>
                            @endcan
                            @can('plan.list')
                                <li><a class="nav-link {{ Request::is('admin/plan') ? 'active' : '' }}"
                                       href="{{ route('admin.plan.index') }}">{{ __('All Plans') }}</a></li>
                            @endcan
                        </ul>
                    </li>

                @endif
                @can('report.view')
                    <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.report') }}">
                            <i class="flaticon-dashboard-1"></i> <span>{{ __('Reports') }}</span>
                        </a>
                    </li>
                @endcan

                @can('customer.create','customer.list','customer.request','customer.list')
                    <li class="dropdown {{ Request::is('admin/customer*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-customer"></i> <span>{{ __('Sellers') }}</span></a>
                        <ul class="dropdown-menu">
                            @can('customer.create')
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.create') }}">{{ __('Create Seller') }}</a></li>
                            @endcan
                            @can('customer.list')
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.index') }}">{{ __('All Sellers') }}</a></li>
                            @endcan
                            @can('customer.request')
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.index','type=3') }}">{{ __('Seller Request') }}</a>
                                </li>
                            @endcan
                            @can('customer.list')
                                <li><a class="nav-link"
                                       href="{{ route('admin.customer.index','type=2') }}">{{ __('Suspended Sellers') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('domain.create','domain.list')
                    <li class="dropdown {{ Request::is('admin/domain*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-www"></i>
                            <span>{{ __('Domains') }}</span></a>
                        <ul class="dropdown-menu">
                            @can('domain.create')
                                <li><a class="nav-link {{ Request::is('admin/domain/create') ? 'active' : '' }}"
                                       href="{{ route('admin.domain.create') }}">{{ __('Create Domain') }}</a></li>
                            @endcan
                            @can('domain.list')
                                <li><a class="nav-link {{ Request::is('admin/domain') ? 'active' : '' }}"
                                       href="{{ route('admin.domain.index') }}">{{ __('All Domains') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('cron_job')
                    <li class="{{ Request::is('admin/cron') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.cron.index') }}">
                            <i class="flaticon-task"></i> <span>{{ __('Cron Jobs') }}</span>
                        </a>
                    </li>
                @endcan
                @can('payment_gateway.config')
                    <li class="{{ Request::is('admin/payment-geteway*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.payment-geteway.index') }}">
                            <i class="flaticon-credit-card"></i> <span>{{ __('Payment Gateways') }}</span>
                        </a>
                    </li>
                @endcan
                @can('template.list')
                    <li class="{{ Request::is('admin/template') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.template.index') }}">
                            <i class="flaticon-template"></i> <span>{{ __('Templates') }}</span>
                        </a>
                    </li>
                @endcan
                @can('page.create','page.list')
                    <li class="dropdown {{ Request::is('admin/page*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-document"></i> <span>{{ __('Pages') }}</span></a>
                        <ul class="dropdown-menu">
                            @can('page.create')
                                <li><a class="nav-link"
                                       href="{{ route('admin.page.create') }}">{{ __('Create Pages') }}</a></li>
                            @endcan
                            @can('page.list')
                                <li><a class="nav-link" href="{{ route('admin.page.index') }}">{{ __('All Pages') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('language_edit')
                    <li class="dropdown {{ Request::is('admin/language*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-translation"></i> <span>{{ __('Language') }}</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link"
                                   href="{{ route('admin.language.create') }}">{{ __('Create language') }}</a></li>
                            <li><a class="nav-link"
                                   href="{{ route('admin.language.index') }}">{{ __('Manage language') }}</a></li>
                        </ul>
                    </li>
                @endcan
                @can('site.settings')
                    <li class="dropdown {{ Request::is('admin/appearance*') ? 'active' : '' }}  {{ Request::is('admin/gallery*') ? 'active' : '' }} {{ Request::is('admin/menu*') ? 'active' : '' }} {{ Request::is('admin/seo*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-settings"></i> <span>{{ __('Appearance') }}</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link"
                                   href="{{ route('admin.appearance.show','header') }}">{{ __('Frontend Settings') }}</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('admin.gallery.index') }}">{{ __('Gallery') }}</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('admin.menu.index') }}">{{ __('Menu') }}</a></li>
                            <li><a class="nav-link" href="{{ route('admin.seo.index') }}">{{ __('SEO') }}</a></li>
                        </ul>
                    </li>
                @endcan
                <li class="dropdown {{ Request::is('admin/customize*') ? 'active' : '' }}  {{ Request::is('admin/customize/tutorial*') ? 'active' : '' }} {{ Request::is('admin/customize/promo*') ? 'active' : '' }} {{ Request::is('admin/customize/video*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="flaticon-template"></i> <span>{{ __('Customize') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link"
                               href="{{ route('admin.customize.tutorial') }}">{{ __('Master Tutorial') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.customize.promo') }}">{{ __('Master Promo') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('admin.customize.video') }}">{{ __('Master Video') }}</a>
                        </li>
                        {{--                            <li><a class="nav-link" href="{{ route('admin.seo.index') }}">{{ __('SEO') }}</a></li>--}}
                    </ul>
                </li>
                @can('marketing.tools')
                    <li class="{{ Request::is('admin/marketing') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.marketing.index') }}">
                            <i class="flaticon-megaphone"></i> <span>{{ __('Marketing Tools') }}</span>
                        </a>
                    </li>
                @endcan

                @can('site.settings','environment.settings')
                    <li class="dropdown {{ Request::is('admin/site-settings*') ? 'active' : '' }} {{ Request::is('admin/system-environment*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="flaticon-settings"></i> <span>{{ __('Settings') }}</span></a>
                        <ul class="dropdown-menu">
                            @can('site.settings')
                                <li><a class="nav-link"
                                       href="{{ route('admin.site.settings') }}">{{ __('Site Settings') }}</a></li>
                            @endcan
                            @can('environment.settings')
                                <li><a class="nav-link"
                                       href="{{ route('admin.site.environment') }}">{{ __('System Environment') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                @can('admin.list','role.list')
                    <li class="dropdown {{ Request::is('admin/role*') ? 'active' : '' }} {{ Request::is('admin/users*') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-member"></i>
                            <span>{{ __('Admins & Roles') }}</span></a>
                        <ul class="dropdown-menu">
                            @can('role.list')
                                <li><a class="nav-link" href="{{ route('admin.role.index') }}">{{ __('Roles') }}</a>
                                </li>
                            @endcan
                            @can('admin.list')
                                <li><a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('Admins') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="{{ Request::is('admin/affiliate') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.affiliate.index') }}">
                        <i class="flaticon-megaphone"></i> <span>{{ __('Affliate') }}</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role_id==3)
                <div class=" p-3 hide-sidebar-mini">
                    <a href="{{ domain_info('full_domain') }}" target="_blank"
                       class="btn btn-primary btn-lg btn-block btn-icon-split">
                        <i class="fas fa-external-link-alt"></i>{{ __('Your Website') }}
                    </a>
                </div>
                <div style="margin-top: -25px;" class=" p-3 hide-sidebar-mini">
                    <a href="{{ route('seller.how_to_be_seller') }}"
                       class="btn btn-success btn-lg btn-block btn-icon-split">
                        <i class="fas fa-external-link-alt"></i>{{ __('How To Be Seller') }}
                    </a>
                </div>
                <li class="{{ Request::is('seller/dashboard*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.dashboard') }}">
                        <i class="flaticon-dashboard"></i> <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="dropdown {{ Request::is('seller/order*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-note"></i>
                        <span>{{ __('Orders') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ url('/seller/orders/all') }}">{{ __('All Orders') }}</a></li>
                        <li><a class="nav-link" href="{{ url('/seller/orders/canceled') }}">{{ __('Canceled') }}</a>
                        </li>

                    </ul>
                </li>

                <li class="dropdown {{ Request::is('seller/product*') ? 'active' : '' }} {{ Request::is('seller/inventory*') ? 'active' : '' }} {{ Request::is('seller/category*') ? 'active' : '' }} {{ Request::is('seller/attribute*') ? 'active' : '' }} {{ Request::is('seller/brand*') ? 'active' : '' }} {{ Request::is('seller/coupon*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-box"></i>
                        <span>{{ __('Products') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('seller.category.index') }}">{{ __('Categories') }}</a>
                        </li>
                        {{--                        <li><a class="nav-link" href="{{ route('seller.brand.index') }}">{{ __('Brands') }}</a></li>--}}
                        <li><a class="nav-link"
                               href="{{ route('seller.product.create') }}">{{ __('Create Product') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.product.index') }}">{{ __('All Products') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.inventory.index') }}">{{ __('Inventory') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.attribute.index') }}">{{ __('Attributes') }}</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('seller.coupon.index') }}">{{ __('Coupons') }}</a></li>
                    </ul>
                </li>
                @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                    <li class="{{ Request::is('seller/customer*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('seller.customer.index') }}">
                            <i class="flaticon-customer"></i> <span>{{ __('Customers') }}</span>
                        </a>
                    </li>
                @endif

                <li class="{{ Request::is('seller/transection*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.transection.index') }}">
                        <i class="flaticon-credit-card"></i> <span>{{ __('Transactions') }}</span>
                    </a>
                </li>

                <li class="{{ Request::is('seller/report*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.report.index') }}">
                        <i class="flaticon-dashboard-1"></i> <span>{{ __('Reports') }}</span>
                    </a>
                </li>
                <li class="{{ Request::is('seller/review*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.review.index') }}">
                        <i class="flaticon-dashboard-1"></i> <span>{{ __('Review & Ratings') }}</span>
                    </a>
                </li>




                {{--        <li class="dropdown {{ Request::is('seller/location*') ? 'active' : '' }} {{ Request::is('seller/shipping*') ? 'active' : '' }}">--}}
                {{--          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-delivery"></i> <span>{{ __('Shipping') }}</span></a>--}}
                {{--          <ul class="dropdown-menu">--}}
                {{--            <li><a class="nav-link" href="{{ route('seller.location.index') }}">{{ __('locations') }}</a></li>--}}
                {{--            <li><a class="nav-link" href="{{ route('seller.shipping.index') }}">{{ __('Shipping Price') }}</a></li>--}}
                {{--          </ul>--}}
                {{--        </li>--}}

                <li class="dropdown {{ Request::is('seller/ads*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-megaphone"></i>
                        <span>{{ __('Offer & Ads') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('seller.ads.index') }}">{{ __('Bump Ads') }}</a></li>
                        <li><a class="nav-link"
                               href="{{ route('seller.ads.show','banner') }}">{{ __('Banner Ads') }}</a></li>
                    </ul>
                </li>

                <li class="dropdown {{ Request::is('seller/settings*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-settings"></i>
                        <span>{{ __('Settings') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link"
                               href="{{ route('seller.settings.show','shop-settings') }}">{{ __('Shop Settings') }}</a>
                        </li>
                    <!-- <li><a class="nav-link" href="{{ route('seller.settings.show','payment') }}">{{ __('Payment Options') }}</a></li> -->
                        <li><a class="nav-link"
                               href="{{ route('seller.settings.show','plan') }}">{{ __('Subscriptions') }}</a></li>

                    </ul>
                </li>
                <li class="dropdown {{ Request::is('seller/marketing*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="flaticon-megaphone"></i>
                        <span>{{ __('Marketing Tools') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','google-analytics') }}">{{ __('Google Analytics') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','tag-manager') }}">{{ __('Google Tag Manager') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','facebook-pixel') }}">{{ __('Facebook Pixel') }}</a>
                        </li>
                        <li><a class="nav-link"
                               href="{{ route('seller.marketing.show','whatsapp') }}">{{ __('Whatsapp Api') }}</a></li>

                    </ul>
                </li>

                <li class="{{ Request::is('seller/seller*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.seller.index') }}">
                        <i class="flaticon-customer"></i> <span>{{ __('All Staff') }}</span>
                    </a>
                </li>


                <li class="menu-header">{{ __('SALES CHANNELS') }}</li>
                <li class="dropdown {{ Request::is('seller/setting*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="flaticon-shop"></i>
                        <span>{{ __('Online store') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('seller.theme.index') }}">{{ __('Themes') }}</a></li>
                        <li><a href="{{ route('seller.menu.index') }}">{{ __('Menus') }}</a></li>
                        <li><a href="{{ route('seller.page.index') }}">{{ __('Pages') }}</a></li>
                        <li><a href="{{ route('seller.slider.index') }}">{{ __('Sliders') }}</a></li>
                        <li><a href="{{ route('seller.seo.index') }}">{{ __('Seo') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('seller/customers*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i>
                        <span>{{ __('Customers') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('seller.customer.index') }}">{{ __('Customer Lists') }}</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('seller/affiliate*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="flaticon-shop"></i>
                        <span>{{ __('Affiliate') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('seller.affiliate') }}">{{ __('Affiliate Product') }}</a></li>
                        <li><a href="{{ route('seller.affiliate.membership') }}">{{ __('Affiliate Membership') }}</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ Request::is('seller/statistic*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('seller.statistic') }}">
                        <i class="fas fa-chart-bar"></i> <span>{{ __('Statistic') }}</span>
                    </a>
                </li>

        @endif
    </aside>
</div>
