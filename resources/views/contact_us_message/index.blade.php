@extends('layouts.master')
@section('style')
    <style>
        .mail-item.unread {
            background-color: #f0f8ff;
            font-weight: bold;
        }

        .mail-item.read {
            background-color: #fff;
        }
    </style>
@endsection
@section('content')
    <div class="main-content pt-4">
        <!-- MAIN SIDEBAR CONTAINER-->
        <div class="inbox-main-sidebar-container" style="padding:0px;" data-sidebar-container="main">
            <div class="inbox-main-content" data-sidebar-content="main">
                <!-- SECONDARY SIDEBAR CONTAINER-->
                <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">
                    <div data-sidebar-content="secondary">
                        <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                            <div class="inbox-topbar box-shadow-1 perfect-scrollbar rtl-ps-none pl-3"
                                data-suppress-scroll-y="true">
                                <!-- <span class="d-sm-none">Test</span>--><a class="link-icon d-md-none"
                                    data-sidebar-toggle="main"><i class="icon-regular i-Arrow-Turn-Left"></i></a><a
                                    class="link-icon mr-3 d-md-none" data-sidebar-toggle="secondary"><i
                                        class="icon-regular mr-1 i-Left-3"></i> Inbox</a>
                                <div class="d-flex"><a class="link-icon mr-3" href=""><i
                                            class="icon-regular i-Mail-Reply"></i> Reply</a><a class="link-icon mr-3"
                                        href=""><i class="icon-regular i-Mail-Reply-All"></i> Forward</a><a
                                        class="link-icon mr-3" href=""><i class="icon-regular i-Mail-Reply-All"></i>
                                        Delete</a></div>
                            </div>
                            <!-- EMAIL DETAILS-->
                            <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                                <div class="row no-gutters">
                                    <div class="mr-2" style="width: 36px"><img class="rounded-circle"
                                            src="{{ asset('public/dist-assets/images/faces/1.jpg') }}" alt="" />
                                    </div>
                                    <div class="col-xs-12">
                                        <p class="m-0">Jhon Doe</p>
                                        <p class="text-12 text-muted">20 Dec, 2018</p>
                                    </div>
                                </div>
                                <h4 class="mb-3">Confirm your email</h4>
                                <div>
                                    <p>Natus consequuntur perspiciatis esse beatae illo quos eaque.</p>
                                    <p>
                                        Earum, quisquam, fugit? Numquam dolor magni nisi? Suscipit odit, ipsam iusto enim
                                        culpa, temporibus vero possimus error voluptates sequi. Iusto ipsam, nihil? Eveniet
                                        modi maxime animi excepturi a dignissimos doloribus,
                                        inventore sed ratione, ducimus atque earum maiores tenetur officia commodi dicta
                                        tempora consequatur non nesciunt ipsam, consequuntur quia fuga aspernatur impedit
                                        et? Natus, earum.
                                    </p>
                                    <blockquote class="blockquote">Earum, quisquam, fugit? Numquam dolor magni nisi?
                                        Suscipit odit, ipsam iusto enim culpa, temporibus vero possimus error voluptates
                                        sequi.</blockquote>
                                    <p>
                                        Earum, quisquam, fugit? Numquam dolor magni nisi? Suscipit odit, ipsam iusto enim
                                        culpa, temporibus vero possimus error voluptates sequi. Iusto ipsam, nihil? Eveniet
                                        modi maxime animi excepturi a dignissimos doloribus,
                                        inventore sed ratione, ducimus atque earum maiores tenetur officia commodi dicta
                                        tempora consequatur non nesciunt ipsam, consequuntur quia fuga aspernatur impedit
                                        et? Natus, earum.
                                    </p><br /> Thanks<br /> Jhone
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Secondary Inbox sidebar-->
                    <div class="inbox-secondary-sidebar perfect-scrollbar rtl-ps-none" style="width:275px;"
                        data-sidebar="secondary"><i class="sidebar-close i-Close" data-sidebar-toggle="secondary"></i>
                        @foreach ($messages as $message)
                            <div class="mail-item message-item {{ $message->is_read ? 'read' : 'unread' }}"
                                data-id="{{ $message->id }}">
                                <div class="avatar"><img src="{{ asset('public/dist-assets/images/faces/1.jpg') }}"
                                        alt="" /></div>
                                <div class="col-xs-6 details">
                                    <span class="name text-muted">{{ $message->name ?? '' }}</span>
                                    <p class="m-0">{{ $message->subject ?? '' }}</p>
                                </div>
                                <div class="col-xs-3 date"><span
                                        class="text-muted">{{ $message->created_at->format('d M Y') }}</span></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- MAIN INBOX SIDEBAR-->
            {{-- <div class="inbox-main-sidebar" data-sidebar="main" data-sidebar-position="left">
            <div class="pt-3 pr-3 pb-3"><i class="sidebar-close i-Close" data-sidebar-toggle="main"></i>
                <button class="btn btn-rounded btn-primary btn-block mb-4">Compose</button>
                <div class="pl-3">
                    <p class="text-muted mb-2">Browse</p>
                    <ul class="inbox-main-nav">
                        <li><a class="active" href=""><i class="icon-regular i-Mail-2"></i> Inbox (2)</a></li>
                        <li><a href=""><i class="icon-regular i-Mail-Outbox"></i> Sent</a></li>
                        <li><a href=""><i class="icon-regular i-Mail-Favorite"></i> Starred</a></li>
                        <li><a href=""><i class="icon-regular i-Folder-Trash"></i> Trash</a></li>
                        <li><a href=""><i class="icon-regular i-Spam-Mail"></i> Spam</a></li>
                    </ul>
                </div>
            </div>
        </div> --}}
        </div>
        <!-- end of main-content -->
    </div><!-- Footer Start -->
@endsection
@section('js')
    <script>
        $(document).on('click', '.message-item', function() {
            const messageId = $(this).data('id');
            const $item = $(this);

            $.ajax({
                url: "{{ asset('contact-us-message/show') }}/" + messageId,
                method: 'GET',
                success: function(res) {
                    // Render detail
                    let repliesHtml = '';
                    res.replies.forEach(reply => {
                        repliesHtml +=
                            `<div class="mb-2"><strong>${reply.sender_name}:</strong> ${reply.body}</div>`;
                    });

                    $('#message-detail').html(`
                    <div class="row no-gutters mb-2">
                        <div class="mr-2" style="width: 36px"><img class="rounded-circle" src="${res.avatar}" alt="" /></div>
                        <div class="col-xs-12">
                            <p class="m-0">${res.sender_name}</p>
                            <p class="text-12 text-muted">${res.date}</p>
                        </div>
                    </div>
                    <h4>${res.subject}</h4>
                    <p>${res.body}</p>
                    <hr>
                    <h6>Replies</h6>
                    ${repliesHtml}
                `);

                    // Show and attach reply form
                    $('#reply-form').show();
                    $('#reply-message-id').val(messageId);

                    // Update is_read status visually
                    $item.removeClass('unread').addClass('read');

                    // Send update to backend
                    $.ajax({
                        url: "{{ asset('contact-us-message/mark-read') }}/" + messageId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    });
                }
            });
        });

        $('#reply-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ asset('contact-us-message/reply') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    alert('Reply sent!');
                    $('#reply-text').val('');
                    $('.message-item[data-id="' + res.message_id + '"]')
                        .click(); // Refresh message detail
                }
            });
        });

        $("body").on("click", "#deleteTour", function() {
            var tour_id = $(this).data("id");
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type: "get",
                            url: "{{ asset('contact-us-message/reply') }}/" + tour_id,
                        })
                        .done(function(data) {
                            if (data.Success) {
                                successMessage(data.Message);
                                initDataTabletour_table();
                            } else {
                                errorMessage(data.Message);
                            }
                        })
                        .catch(function(err) {
                            errorMessage(err.Message);
                        });
                }
            });
        });
    </script>
@endsection
