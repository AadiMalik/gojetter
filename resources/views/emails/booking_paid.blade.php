<!DOCTYPE html>
<html>

<head>
    <title>Booking Payment Confirmation</title>
</head>

<body>
    <h2>Thank you for your payment, {{ $booking->first_name }}!</h2>

    <p>Your booking (ID: {{ $booking->id }}) has been successfully paid.</p>

    <h4>Booking Details:</h4>
    <ul>
        <li><strong>Tour ID:</strong> {{ $booking->tour_id }}</li>
        <li><strong>Name:</strong> {{ $booking->first_name }} {{ $booking->last_name }}</li>
        <li><strong>Email:</strong> {{ $booking->email }}</li>
        <li><strong>Booking Date:</strong> {{ $booking->booking_date }}</li>
        <li><strong>Total Participants:</strong> {{ $booking->total_participants }}</li>
        @php
            $symbol = $booking->currency->symbol ?? '';
        @endphp

        <li><strong>Subtotal:</strong> {{ $symbol }}{{ number_format($booking->sub_total, 2) }}</li>
        <li><strong>Tax:</strong> {{ $symbol }}{{ number_format($booking->tax_amount, 2) }}</li>
        <li><strong>Discount:</strong> {{ $symbol }}{{ number_format($booking->discount, 2) }}</li>
        <li><strong>Total:</strong> {{ $symbol }}{{ number_format($booking->total, 2) }}</li>
        <li><strong>Status:</strong> {{ ucfirst($booking->status) }}</li>
    </ul>

    <p>We look forward to serving you!</p>

    <p>Regards,<br>GoJetter Team</p>
</body>

</html>
