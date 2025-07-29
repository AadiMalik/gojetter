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
                    <li
                        class="Ul_li--hover {{ Request::is('tours*') || Request::is('tour-category*') || Request::is('tour-review*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-plane text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Product Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('tour_category_access') --}}
                            <li class="item-name"><a
                                    class="{{ Request::is('tour-category*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('tour-category') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Tour Category</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('tours_access') --}}
                            <li class="item-name"><a class="{{ Request::is('tours*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('tours') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Tours</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('tour_review_access') --}}
                            <li class="item-name"><a class="{{ Request::is('tour-review*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('tour-review') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Tour Reviews</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('booking_access') --}}
                    <li class="Ul_li--hover {{ Request::is('booking*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-bus text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Booking Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('booking_access') --}}
                            <li class="item-name"><a class="{{ Request::is('booking*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('booking') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Bookings</span></a></li>
                            {{-- @endcan --}}

                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('blog_management_access') --}}
                    <li class="Ul_li--hover {{ Request::is('blog-category*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-rss text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Blog Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('blog_category_access') --}}
                            <li class="item-name"><a
                                    class="{{ Request::is('blog-category*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('blog-category') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Blog Category</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('blog_access') --}}
                            <li class="item-name"><a
                                    class="{{ Request::is('blogs*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('blogs') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Blogs</span></a></li>
                            {{-- @endcan --}}

                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('service_management_access') --}}
                    <li class="Ul_li--hover {{ Request::is('services*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-ship text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Service Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('service_access') --}}
                            <li class="item-name"><a class="{{ Request::is('services*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('services') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Services</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('sub_service_access') --}}
                            <li class="item-name"><a class="{{ Request::is('sub-services*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('sub-services') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Sub Services</span></a></li>
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
                                        class="text-muted">Currencies</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('country_access') --}}
                            <li class="item-name"><a class="{{ Request::is('country*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('country') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Countries</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('social_media_access') --}}
                            <li class="item-name"><a
                                    class="{{ Request::is('social-media*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('social-media') }}"><i
                                        class="fa fa-circle mr-2 text-muted"></i><span class="text-muted">Social
                                        Media</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('content_management_access') --}}
                    <li
                        class="Ul_li--hover {{ Request::is('about-us*') | Request::is('gallery*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i class="fa fa-plug text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Content Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('about_us_access') --}}
                            <li class="item-name"><a class="{{ Request::is('about-us*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('about-us') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">About Us</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('gallery_access') --}}
                            <li class="item-name"><a class="{{ Request::is('gallery*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('gallery') }}"><i class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Gallery</span></a></li>
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

                    {{-- @can('contact_us_message_access') --}}
                    <li class="Ul_li--hover {{ Request::is('contact-us-message*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i
                                class="fa fa-envelope text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Contact Us</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('contact_us_message_access') --}}
                            <li class="item-name"><a
                                    class="{{ Request::is('contact-us-message*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('contact-us-message') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Messages</span></a></li>
                            {{-- @endcan --}}

                        </ul>
                    </li>
                    {{-- @endcan --}}

                    {{-- @can('coupon_access') --}}
                    <li class="Ul_li--hover {{ Request::is('coupon*') ? 'mm-active' : '' }}">
                        <a class="has-arrow" href="#"><i
                                class="fa fa-envelope text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Coupon Manage..</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('coupon_access') --}}
                            <li class="item-name"><a class="{{ Request::is('coupon*') ? 'sidebar_active' : '' }}"
                                    href="{{ url('coupon') }}"><i class="nav-icon fa fa-circle"></i><span
                                        class="item-name">Coupons</span></a></li>
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
