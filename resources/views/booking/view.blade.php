@extends('layouts.master')

@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Booking Details</h1>
        <ul>
            <li>View</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <h5>Tour Information</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tour Name:</strong> {{ $booking->tour?->title ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Thumbnail:</strong><br>
                            @if($booking->tour?->thumbnail_url)
                                <img src="{{ $booking->tour->thumbnail_url }}" alt="Thumbnail" height="100">
                            @else
                                N/A
                            @endif
                        </div>
                    </div>

                    <h5>Customer Information</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong> {{ $booking->user?->name ?? 'N/A' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Email:</strong> {{ $booking->user?->email ?? 'N/A' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Phone:</strong> {{ $booking->user?->phone ?? 'N/A' }}
                        </div>
                    </div>

                    <h5>Booking Summary</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Booking Date:</strong> {{ $booking->booking_date }}</div>
                        <div class="col-md-4"><strong>Adults:</strong> {{ $booking->adults }}</div>
                        <div class="col-md-4"><strong>Children:</strong> {{ $booking->children }}</div>
                        <div class="col-md-4"><strong>Total Participants:</strong> {{ $booking->total_participants }}</div>
                        <div class="col-md-4"><strong>Sub Total:</strong> {{ $booking->sub_total }}</div>
                        <div class="col-md-4"><strong>Tax (%):</strong> {{ $booking->tax_percent }}%</div>
                        <div class="col-md-4"><strong>Tax Amount:</strong> {{ $booking->tax_amount }}</div>
                        <div class="col-md-4"><strong>Discount:</strong> {{ $booking->discount }}</div>
                        <div class="col-md-4"><strong>Total:</strong> {{ $booking->total }}</div>
                        <div class="col-md-4"><strong>Payment Method:</strong> {{ ucfirst($booking->payment_method) }}</div>
                        <div class="col-md-4"><strong>Status:</strong> {{ ucfirst($booking->status) }}</div>
                    </div>

                    <h5>Billing Address</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>First Name:</strong> {{ $booking->first_name }}</div>
                        <div class="col-md-4"><strong>Last Name:</strong> {{ $booking->last_name }}</div>
                        <div class="col-md-4"><strong>Email:</strong> {{ $booking->email }}</div>
                        <div class="col-md-4"><strong>Phone:</strong> {{ $booking->phone }}</div>
                        <div class="col-md-4"><strong>Country:</strong> {{ $booking->country }}</div>
                        <div class="col-md-4"><strong>Zipcode:</strong> {{ $booking->zipcode }}</div>
                        <div class="col-md-12"><strong>Address:</strong> {{ $booking->address }}</div>
                    </div>

                    <h5 class="mt-4">Participant Details</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Type</th>
                                <th>Date of Birth</th>
                                <th>Weight</th>
                                <th>Weight Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($booking->booking_detail as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->first_name }}</td>
                                    <td>{{ $detail->last_name }}</td>
                                    <td>{{ ucfirst($detail->type) }}</td>
                                    <td>{{ $detail->dob }}</td>
                                    <td>{{ $detail->weight }}</td>
                                    <td>{{ $detail->weight_unit }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No booking participants found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="card-footer">
                    <a href="{{ url('booking') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
