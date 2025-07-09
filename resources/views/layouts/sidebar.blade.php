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
                                Management</span></a>
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
                    <li class="Ul_li--hover {{ Request::is('tours*') ? 'mm-active' : '' }}"><a class="has-arrow" href="#"><i
                                class="fa fa-plane text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Product Management</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('tours_access') --}}
                            <li class="item-name"><a class="{{ Request::is('tours*') ? 'sidebar_active' : '' }}" href="{{ url('tours') }}"><i
                                        class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Tours</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('common_access') --}}
                    <li class="Ul_li--hover {{ Request::is('currency*') ? 'mm-active' : '' }}"><a class="has-arrow" href="#"><i
                                class="fa fa-box text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Common</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('currency_access') --}}
                            <li class="item-name"><a class="{{ Request::is('currency*') ? 'sidebar_active' : '' }}" href="{{ url('currency') }}"><i
                                        class="fa fa-circle mr-2 text-muted"></i><span
                                        class="text-muted">Currency</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('legel_access') --}}
                    <li class="Ul_li--hover {{ Request::is('faqs*') || Request::is('terms*') || Request::is('policy*') ? 'mm-active' : '' }}"><a class="has-arrow" href="#"><i
                                class="i-Library text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Legel</span></a>
                        <ul class="mm-collapse">
                            {{-- @can('faq_access') --}}
                            <li class="item-name"><a class="{{ Request::is('faqs*') ? 'sidebar_active' : '' }}" href="{{ url('faqs') }}"><i
                                        class="nav-icon fa fa-circle"></i><span class="item-name">FAQs</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('term_and_condition_access') --}}
                            <li class="item-name"><a class="{{ Request::is('terms*') ? 'sidebar_active' : '' }}" href="{{ url('terms') }}"><i
                                        class="nav-icon fa fa-circle"></i><span class="item-name">Terms & Conditions</span></a></li>
                            {{-- @endcan --}}
                            {{-- @can('private_policy_access') --}}
                            <li class="item-name"><a class="{{ Request::is('policy*') ? 'sidebar_active' : '' }}" href="{{ url('policy') }}"><i
                                        class="nav-icon fa fa-circle"></i><span class="item-name">Private Policy</span></a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i
                                class="i-Suitcase text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Extra Kits</span></a>
                        <ul class="mm-collapse">
                            <li class="item-name"><a href="image.cropper.html"><i class="nav-icon i-Crop-2"></i><span
                                        class="item-name">Image Cropper</span></a></li>
                            <li class="item-name"><a href="loaders.html"><i class="nav-icon i-Loading-3"></i><span
                                        class="item-name">Loaders</span></a></li>
                            <li class="item-name"><a href="ladda.button.html"><i class="nav-icon i-Loading-2"></i><span
                                        class="item-name">Ladda
                                        Buttons</span></a></li>
                            <li class="item-name"><a href="toastr.html"><i class="nav-icon i-Bell"></i><span
                                        class="item-name">Toastr</span></a></li>
                            <li class="item-name"><a href="sweet.alerts.html"><i
                                        class="nav-icon i-Approved-Window"></i><span class="item-name">Sweet
                                        Alerts</span></a></li>
                            <li class="item-name"><a href="tour.html"><i class="nav-icon i-Plane"></i><span
                                        class="item-name">User Tour</span></a></li>
                            <li class="item-name"><a href="upload.html"><i class="nav-icon i-Data-Upload"></i><span
                                        class="item-name">Upload</span></a></li>
                        </ul>
                    </li>
                    <li class="Ul_li--hover"><a class="has-arrow" href="#"><i
                                class="i-Computer-Secure text-20 mr-2 text-muted"></i><span
                                class="item-name text-15 text-muted">Apps</span></a>
                        <ul class="mm-collapse">
                            <li class="item-name"><a href="contact-list-table.html"><i
                                        class="nav-icon i-Business-Mens"></i><span class="item-name">contact
                                        List</span></a></li>
                            <li class="item-name"><a href="invoice.html"><i class="nav-icon i-Add-File"></i><span
                                        class="item-name">Invoice</span></a></li>
                            <li class="item-name"><a href="inbox.html"><i class="nav-icon i-Email"></i><span
                                        class="item-name">Inbox</span></a></li>
                            <li class="item-name"><a href="chat.html"><i class="nav-icon i-Speach-Bubble-3"></i><span
                                        class="item-name">Chat</span></a></li>
                            <li class="item-name"><a class="has-arrow cursor-pointer"><i
                                        class="nav-icon i-Receipt"></i><span class="item-name">Task Manager
                                    </span></a>
                                <ul class="mm-collapse">
                                    <li class="item-name"><a href="todo-list.html"><i
                                                class="nav-icon i-Receipt"></i><span class="item-name">Todo
                                                List</span></a></li>
                                    <li class="item-name"><a href="task-manager.html"><i
                                                class="nav-icon i-Receipt"></i><span class="item-name">Task
                                                manager</span></a></li>
                                    <li class="item-name"><a href="task-manager-list.html"><i
                                                class="nav-icon i-Receipt-4"></i><span class="item-name">Task manager
                                                list</span></a></li>
                                    <li class="item-name"><a href="toDo.html"><i
                                                class="nav-icon i-Receipt-4"></i><span class="item-name">Minimal
                                                ToDo</span></a></li>
                                </ul>
                            </li>
                            <li class="item-name"><a class="has-arrow cursor-pointer"><i
                                        class="nav-icon i-Cash-Register"></i><span class="item-name">Ecommerce
                                    </span></a>
                                <ul class="mm-collapse">
                                    <li class="item-name"><a href="product.html"><i
                                                class="nav-icon i-Shop-2"></i><span
                                                class="item-name">Products</span></a></li>
                                    <li class="item-name"><a href="product-details.html"><i
                                                class="nav-icon i-Tag-2"></i><span class="item-name">Product
                                                Details</span></a></li>
                                    <li class="item-name"><a href="cart.html"><i
                                                class="nav-icon i-Add-Cart"></i><span
                                                class="item-name">Cart</span></a></li>
                                    <li class="item-name"><a href="checkout.html"><i
                                                class="nav-icon i-Cash-register-2"></i><span
                                                class="item-name">Checkout</span></a></li>
                                </ul>
                            </li>
                            <li class="item-name"><a class="has-arrow cursor-pointer"><i
                                        class="nav-icon i-Business-ManWoman"></i><span class="item-name">Contact
                                    </span></a>
                                <ul class="mm-collapse">
                                    <li class="item-name"><a href="contact-list.html"><i
                                                class="nav-icon i-Business-Mens"></i><span class="item-name">Contact
                                                Lists</span></a></li>
                                    <li class="item-name"><a href="contact-page.html"><i
                                                class="nav-icon i-Conference"></i><span class="item-name">Contact
                                                Grid</span></a></li>
                                    <li class="item-name"><a href="contact-detail.html"><i
                                                class="nav-icon i-Find-User"></i><span class="item-name">Contact
                                                Details</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--  side-nav-close -->
</div>