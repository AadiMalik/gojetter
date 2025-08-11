<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Customer Report</title>
    <link rel="stylesheet" href="{{ asset('public/dist-assets/css/report-view.css') }}">
</head>

<div class="font-color-black">

    <center style="float:none;">
        <h4><b>Customer Report</b></h4>
    </center>
    <div>
        <div style="float:left;">
            <b>Date: </b>{{ $parms->start_date ?? '' }} - {{ $parms->end_date ?? '' }} <br>
            <b>Date Created: </b>{{ date('Y-m-d') }}
        </div>
    </div>
    <br><br><br><br>

    <div class="tableFixHead font-color-black">

        <table class="font-x-medium" style="border: 0.5px solid black;" width="100%">

            <thead>
                <tr class="border-black">
                    <th class="text-center">Sr.</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone#</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">City</th>
                    <th class="text-center">State</th>
                    <th class="text-center">Country</th>
                    <th class="text-center">Zipcode</th>
                </tr>
            </thead>
            <tbody>
                @if(count($parms->data)>0)
                @foreach ($parms->data as $index=>$item)

                <tr>
                    <td class="text-left">{{ $index+1 }}</td>
                    <td class="text-left">{{$item->username??''}}</td>
                    <td class="text-left">{{ ucwords($item->name ?? '')}}</td>
                    <td class="text-left">{{ ucwords($item->email ?? '') }}</td>
                    <td class="text-left">{{$item->phone??''}}</td>
                    <td class="text-left">{{$item->gender??''}}</td>
                    <td class="text-left">{{$item->city??''}}</td>
                    <td class="text-left">{{$item->state??''}}</td>
                    <td class="text-left">{{$item->country->name??''}}</td>
                    <td class="text-left">{{$item->zip_code??''}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="10" class="text-center">Data Not Found!</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>

</html>
