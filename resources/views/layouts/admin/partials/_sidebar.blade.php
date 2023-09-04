<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    <!-- Logo -->

                    @php($restaurant_logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                    <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="Front">
                        <img class="navbar-brand-logo"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/logo.jpeg')}}'"
                             src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}"
                             alt="Logo">
                        <img class="navbar-brand-logo-mini"
                             onerror="this.src='{{asset('public/assets/admin/img/160x160/logo.jpeg')}}'"
                             src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}" alt="Logo">
                    </a>

                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">

                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="{{route('admin.dashboard')}}" title="{{translate('Dashboards')}}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{translate('dashboard')}}
                                    </span>
                            </a>
                        </li>
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/user/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.user.list')}}" title="{{translate('user')}}">
                                    <i class="tio-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('user')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/withdrawal/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.withdrawal.list')}}" title="{{translate('withdrawal')}}">
                                    <i class="tio-money nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('withdrawal')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/app_update/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.app_update.list')}}" title="{{translate('app_update')}}">
                                    <i class="tio-settings nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('app_update')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/notification/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.notification.list')}}" title="{{translate('notification')}}">
                                    <i class="tio-notifications  nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('notification')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/transaction/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.transaction.list')}}" title="{{translate('transaction')}}">
                                    <i class="tio-credit-card  nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('transaction')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/ads/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.ads.list')}}" title="{{translate('ads')}}">
                                    <i class="tio-star nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('ads')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/ads_trans/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.ads_trans.list')}}" title="{{translate('ads_trans')}}">
                                    <i class="tio-star nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('ads trans')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/branches/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.branches.list')}}" title="{{translate('branches')}}">
                                    <i class="fas fa-building nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('branches')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                        @if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management']))
                          <!-- Pages -->
                          
                          <li class="navbar-vertical-aside-has-menu {{Request::is('admin/staffs/list')?'active':''}}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="{{route('admin.staffs.list')}}" title="{{translate('staffs')}}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            {{translate('staffs')}}
                                        </span>
                                </a>
                            </li>
                          <!-- End Pages -->
                        @endif
                          <!-- Pages -->
                          
                        
                          <!-- End Pages -->
                        
                  
            </div>
        </div>
    </aside>
</div>

<div id="sidebarCompact" class="d-none">

</div>


{{--<script>
    $(document).ready(function () {
        $('.navbar-vertical-content').animate({
            scrollTop: $('#scroll-here').offset().top
        }, 'slow');
    });
</script>--}}
