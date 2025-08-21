@extends('layouts.master')

@section('content')
<div class="main-content pt-4">
    <div class="breadcrumb">
        <h1>Order Details</h1>
        <ul>
            <li>View</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">

                    <h5>Basic Information</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Order ID:</strong> {{ $order->id ?? 'N/A' }}
                        </div>
                    </div>

                    <h5>Customer Information</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong> {{ $order->user?->name ?? 'N/A' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Email:</strong> {{ $order->user?->email ?? 'N/A' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Phone:</strong> {{ $order->user?->phone ?? 'N/A' }}
                        </div>
                    </div>

                    <h5>Order Summary</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Order Date:</strong> {{ $order->order_date }}</div>
                        <div class="col-md-4"><strong>Quantity:</strong> {{ $order->quantity }}</div>
                        <div class="col-md-4"><strong>Sub Total:</strong> {{ $order->currency->symbol }} {{ $order->sub_total }}</div>
                        <div class="col-md-4"><strong>Tax (%):</strong> {{ $order->currency->symbol }} {{ $order->tax_percent }}%</div>
                        <div class="col-md-4"><strong>Tax Amount:</strong> {{ $order->currency->symbol }} {{ $order->tax_amount }}</div>
                        <div class="col-md-4"><strong>Discount:</strong> {{ $order->currency->symbol }} {{ $order->discount }}</div>
                        <div class="col-md-4"><strong>Total:</strong> {{ $order->currency->symbol }} {{ $order->total }}</div>
                        <div class="col-md-4"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</div>
                        <div class="col-md-4"><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
                    </div>

                    <h5>Billing Address</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>First Name:</strong> {{ $order->first_name }}</div>
                        <div class="col-md-4"><strong>Last Name:</strong> {{ $order->last_name }}</div>
                        <div class="col-md-4"><strong>Email:</strong> {{ $order->email }}</div>
                        <div class="col-md-4"><strong>Phone:</strong> {{ $order->phone }}</div>
                        <div class="col-md-4"><strong>Country:</strong> {{ $order->country }}</div>
                        <div class="col-md-4"><strong>Zipcode:</strong> {{ $order->zipcode }}</div>
                        <div class="col-md-12"><strong>Address:</strong> {{ $order->address }}</div>
                    </div>

                    <h5 class="mt-4">Order Details</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Activity</th>
                                <th>Activity Date</th>
                                <th>Activity Time Slot</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->orderDetail as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->activity->title??'' }}</td>
                                    <td>{{ $detail->activity_date->date??'' }}</td>
                                    <td>{{ $detail->activity_time_slot->start_time}} - {{$detail->activity_time_slot->end_time }}</td>
                                    <td>{{ $order->currency->symbol }} {{ $detail->price }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $order->currency->symbol }} {{ $detail->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No booking detail found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <div class="card-footer">
                    <a href="{{ url('order') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
