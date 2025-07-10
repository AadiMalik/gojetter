<div class="sidebar-panel bg-white">
    <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img
            class="pl-3" src="{{ asset('public/dist-assets/images/logo.png') }}" alt="alt" />
        <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
        <div class="sidebar-compact-switch ml-auto"><span></span></div>
    </div>
    <!--  user -->
    <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
        <div class="side-nav">
            <div class="main-menu">
                <ul class="metismenu" id="menu">
                    <li class="Ul_li--hover"><a href="{{ url('home') }}"><i
                                class="fa fa-dashboard text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Dashboard</span></a></li>
                    {{-- @can('user_management_access') --}}
                    <li
                        class="Ul_li--hover {{ Request::is('permissions*') || Request::is('roles*') || Request::is('users*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-users text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">User
                                Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('permissions_access') --}}
                            <li class="item-name"><a class="{{ Request::is('permissions*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('permissions') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Permissions</span></a></li>
                            {{-- @endcan --}}

                            {{-- @can('roles_access') --}}
                            <li class="item-name"><a class="{{ Request::is('roles*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('roles') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Roles</span></a></li>
                            {{-- @endcan --}}

                            {{-- @can('users_access') --}}
                            <li class="item-name"><a class="{{ Request::is('users*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('users') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Users</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('product_management') --}}
                    <li class="Ul_li--hover {{ Request::is('tours*') ? 'mm-active' : '' }}"><a class="has-arrow"
                            href="#"><i class="fa fa-plane text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Product Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('tours_access') --}}
                            <li class="item-name"><a class="{{ Request::is('tours*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('tours') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Tours</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('common_access') --}}
                    <li
                        class="Ul_li--hover {{ Request::is('currency*') || Request::is('social-media*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-box text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Common</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('currency_access') --}}
                            <li class="item-name"><a class="{{ Request::is('currency*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('currency') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Currency</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('social_media_access') --}}
                            <li class="item-name"><a class="{{ Request::is('social-media*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('social-media') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Social Media</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('content_management_access') --}}
                    <li
                        class="Ul_li--hover {{ Request::is('about-us*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-plug text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Content Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('about_us_access') --}}
                            <li class="item-name"><a class="{{ Request::is('about-us*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('about-us') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">About Us</span></a></li>
                            {{-- @endcan --}}
                            
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('legel_access') --}}
                    <li
                        class="Ul_li--hover {{ Request::is('faqs*') || Request::is('terms*') || Request::is('policy*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-gavel text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Legel</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('faq_access') --}}
                            <li class="item-name"><a class="{{ Request::is('faqs*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('faqs') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">FAQs</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('term_and_condition_access') --}}
                            <li class="item-name"><a class="{{ Request::is('terms*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('terms') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Terms & Conditions</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('private_policy_access') --}}
                            <li class="item-name"><a class="{{ Request::is('policy*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('policy') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Private Policy</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                </ul>
            </div>
        </div>
    </div>
    <!--  side-nav-close -->
</div>
