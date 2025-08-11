<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Booking Detail Report</title>
    <link rel="stylesheet" href="{{ asset('public/dist-assets/css/report-view.css') }}">
</head>

<div class="font-color-black">

    <center style="float:none;">
        <h4><b>Booking Detail Report</b></h4>
    </center>
    <div>
        <div style="float:left;">
            <b>Date: </b>{{ $parms->start_date ?? '' }} - {{ $parms->end_date ?? '' }} <br>
            <b>Date Created: </b>{{ date('Y-m-d') }}
        </div>
        <div style="float: right;">
            <b>Status: </b>{{$parms->status??'All'}}
        </div>
    </div>
    <br><br><br><br>

    <div class="tableFixHead font-color-black">

        <table class="font-x-medium" style="border: 0.5px solid black;" width="100%">

            <thead>
                <tr class="border-black">
                    <th class="text-center">Sr.</th>
                    <th class="text-center">Tour</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Participants</th>
                    <th class="text-center">Method</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_participants=0;
                $total_sub_total=0;
                $total_discount=0;
                $grand_total=0;
                @endphp
                @if(count($parms->data)>0)
                @foreach ($parms->data as $index=>$item)
                @php
                $total_participants= $total_participants+$item->total_participants;
                $total_sub_total=$total_sub_total+$item->sub_total;
                $total_discount=$total_discount+$item->discount;
                $grand_total=$grand_total+$item->total;
                @endphp

                <tr>
                    <td class="text-left">{{ $index+1 }}</td>
                    <td class="text-left">{{ucwords($item->tour->title??'')}}</td>
                    <td class="text-left">{{$item->booking_date??''}}</td>
                    <td class="text-left">
                        {{ ucwords($item->first_name ?? '')}} {{ ucwords($item->last_name ?? '')}} <br>
                        {{ $item->email ?? ''}} <br>
                        {{ $item->phone ?? ''}} <br>
                        {{ $item->address ?? ''}}, {{ $item->country ?? ''}}
                    </td>
                    <td class="text-left">{{ $item->total_participants ?? 0 }}</td>
                    <td class="text-left">{{ucwords($item->payment_method??'')}}</td>
                    <td class="text-left">{{ucwords($item->status??'')}}</td>
                    <td class="text-right">{{$item->currency->symbol??''}}{{$item->sub_total??0}}</td>
                    <td class="text-right">{{$item->currency->symbol??''}}{{$item->discount??0}}</td>
                    <td class="text-right">{{$item->currency->symbol??''}}{{$item->total??0}}</td>
                </tr>
                @if(count($parms->data)>0)

                <tr>
                    <td colspan="10">
                        <table class="font-x-medium" width="100%">
                            <thead>
                                <tr class="border-black">
                                    <th class="text-left" colspan="6">
                                    Participants
                                    </th>
                                </tr>
                                <tr class="border-black">
                                    <th class="text-center">Sr.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Date of Birth</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Weight</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($item->bookingDetail as $value=>$item1)
                                <tr>
                                    <td class="text-left">{{$value+1}}</td>
                                    <td class="text-left">{{$item1->first_name??''}} {{$item1->last_name??''}}</td>
                                    <td class="text-left">{{$item1->type??''}}</td>
                                    <td class="text-left">{{$item1->dob??''}}</td>
                                    <td class="text-left">{{$item1->weight_unit??''}}</td>
                                    <td class="text-right">{{$item1->weight??''}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">Data Not Found!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="10" class="text-center">Data Not Found!</td>
                </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: left; font-weight: bold;" colspan="6">Total</td>
                    <td style="text-align: right; font-weight: bold;">{{number_format($total_participants,2)}}</td>
                    <td style="text-align: right; font-weight: bold;">{{number_format($total_sub_total,2)}}</td>
                    <td style="text-align: right; font-weight: bold;">{{number_format($total_discount,2)}}</td>
                    <td style="text-align: right; font-weight: bold;">{{number_format($grand_total,2)}}</td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

</html>