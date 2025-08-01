@extends('layouts.master')
@section('style')
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
                            <div class="d-flex"><a class="link-icon mr-3">
                                    <a class="link-icon mr-3 d-none" id="replyContactUsMessage" style="cursor: pointer;" data-id="">
                                        <i class="icon-regular i-Mail-Reply"></i> Reply
                                    </a>
                                    <a id="deleteContactUsMessage" class="link-icon mr-3 d-none" style="cursor: pointer;" data-id="">
                                        <i class="icon-regular i-Mail-Reply-All"></i> Delete
                                    </a>
                            </div>
                        </div>
                        <!-- EMAIL DETAILS-->
                        <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                            <div id="message-detail">
                                <div class="text-center py-5 text-muted">Select a message to view details</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Secondary Inbox sidebar-->
                <div class="inbox-secondary-sidebar perfect-scrollbar rtl-ps-none" style="width:275px;"
                    data-sidebar="secondary">
                    <i class="sidebar-close i-Close" data-sidebar-toggle="secondary"></i>

                    @forelse ($messages as $message)
                    <div class="mail-item message-item"
                        @if($message->is_read == 0) style="background: #ddd4e5 !important;" @endif
                        data-id="{{ $message->id }}">
                        <div class="avatar">
                            <img src="{{ asset('public/dist-assets/images/faces/1.jpg') }}" alt="" />
                        </div>
                        <div class="col-xs-6 details ml-2">
                            <span class="name text-muted">{{ $message->name ?? '' }}</span>
                            <p class="m-0">{{ $message->subject ?? '' }}</p>
                        </div>
                        <div class="col-xs-3 date">
                            <span class="text-muted">{{ isset($message->created_at)?$message->created_at->format('d M Y'):'' }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center p-4 text-muted">No messages found.</div>
                    @endforelse
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
@include('contact_us_message/Modal/reply_form')
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function errorMessage(message) {

        toastr.error(message, "Error", {
            showMethod: "slideDown",
            hideMethod: "slideUp",
            timeOut: 2e3,
        });

    }

    function successMessage(message) {

        toastr.success(message, "Success", {
            showMethod: "slideDown",
            hideMethod: "slideUp",
            timeOut: 2e3,
        });

    }

    $(document).on('click', '.message-item', function() {
        const messageId = $(this).data('id');
        const $item = $(this);

        $.ajax({
            url: "{{ url('contact-us-message/show') }}/" + messageId,
            method: 'GET',
            success: function(res) {
                var res = res.Data;
                // Render detail
                let repliesHtml = '';
                if ((res.replies || []).length > 0) {
                    res.replies.forEach(reply => {
                        repliesHtml += `<div class="mb-2"><strong>${reply.sender_name}:</strong> ${reply.body}</div>`;
                    });
                } else {
                    repliesHtml = `<div class="text-muted">No reply yet.</div>`;
                }

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
                    <h4><b>Replies</b></h4>
                    ${repliesHtml}
                `);
                $('#deleteContactUsMessage')
                    .removeClass('d-none')
                    .attr('data-id', messageId);
                $('#replyContactUsMessage')
                    .removeClass('d-none')
                    .attr('data-id', messageId);
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
    $("#replyContactUsMessage").click(function() {
        const messageId = $(this).data('id');
        $("#parent_id").val(messageId);
        $("#replyForm").trigger("reset");
        $("#modelHeading").html("Reply");
        $("#ajaxModel").modal("show");
    });
    $("#replyForm").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ url('contact-us-message/reply') }}",
            method: 'POST',
            data: $("#replyForm").serialize(),
            success: function(res) {
                successMessage(res.Message);
                $("#ajaxModel").modal("hide");
                $('.message-item[data-id="' + res.message_id + '"]').click();
            }
        });
    });
    $("body").on("click", "#deleteContactUsMessage", function() {
        var contact_us_message_id = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "This message will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                        type: "GET",
                        url: "{{ url('contact-us-message/destroy') }}/" + contact_us_message_id,
                    })
                    .done(function(data) {
                        if (data.Success) {
                            successMessage(data.Message);

                            // Remove the message from the list
                            $('.message-item[data-id="' + contact_us_message_id + '"]').remove();

                            // Clear the detail view
                            $('#message-detail').html('<div class="text-center py-5 text-muted">Select a message to view details</div>');

                            // Hide delete button again
                            $('#deleteContactUsMessage').addClass('d-none').attr('data-id', '');
                            $('#replyContactUsMessage').addClass('d-none').attr('data-id', '');
                        } else {
                            errorMessage(data.Message);
                        }
                    })
                    .fail(function(err) {
                        errorMessage("Something went wrong while deleting.");
                    });
            }
        });
    });
</script>
@endsection