<!DOCTYPE html>
<html>

<head>
    <title>Order Payment Confirmation</title>
</head>

<body>
    <h2>Thank you for your payment, {{ $order->first_name }}!</h2>

    <p>Your order (ID: {{ $order->id }}) has been successfully paid.</p>

    <h4>Order Details:</h4>
    <ul>
        <li><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</li>
        <li><strong>Email:</strong> {{ $order->email }}</li>
        <li><strong>Order Date:</strong> {{ $order->order_date }}</li>
        <li><strong>Total Quantity:</strong> {{ $order->quantity }}</li>
        <li><strong>Payment Method:</strong> {{ $order->payment_method }}</li>
        @php
            $symbol = $order->currency->symbol ?? '';
        @endphp

        <li><strong>Subtotal:</strong> {{ $symbol }}{{ number_format($order->sub_total, 2) }}</li>
        <li><strong>Tax:</strong> {{ $symbol }}{{ number_format($order->tax_amount, 2) }}</li>
        <li><strong>Discount:</strong> {{ $symbol }}{{ number_format($order->discount, 2) }}</li>
        <li><strong>Total:</strong> {{ $symbol }}{{ number_format($order->total, 2) }}</li>
        <li><strong>Status:</strong> {{ ucfirst($order->status) }}</li>
    </ul>

    <p>We look forward to serving you!</p>

    <p>Regards,<br>GoJetter Team</p>
</body>

</html>
