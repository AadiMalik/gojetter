<div class="row mb-4">
    {{-- <div class="col-md-3 col-lg-3">
        <div class="card mb-4 o-hidden">
            <div class="card-body ul-card__widget-chart">
                <div class="ul-widget__chart-info">
                    <h5 class="heading">Users</h5>
                    <div class="ul-widget__chart-number">
                        <h2 class="t-font-boldest">{{ $initialData['total_users'] ?? 0 }}</h2>
                    </div>
                </div>
                <div id="basicArea-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card mb-4 o-hidden">
            <div class="card-body ul-card__widget-chart">
                <div class="ul-widget__chart-info">
                    <h5 class="heading">Approved Users</h5>
                    <div class="ul-widget__chart-number">
                        <h2 class="t-font-boldest">{{ $initialData['approved_users'] ?? 0 }}</h2>
                    </div>
                </div>
                <div id="basicArea-chart2"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card mb-4 o-hidden">
            <div class="card-body ul-card__widget-chart">
                <div class="ul-widget__chart-info">
                    <h5 class="heading">Tours</h5>
                    <div class="ul-widget__chart-number">
                        <h2 class="t-font-boldest">{{ $initialData['total_tours'] ?? 0 }}</h2>
                    </div>
                </div>
                <div id="basicArea-chart3"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card mb-4 o-hidden">
            <div class="card-body ul-card__widget-chart">
                <div class="ul-widget__chart-info">
                    <h5 class="heading">Bookings</h5>
                    <div class="ul-widget__chart-number">
                        <h2 class="t-font-boldest">{{ $initialData['total_bookings'] ?? 0 }}</h2>
                    </div>
                </div>
                <div id="basicArea-chart4"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        <div class="card mb-4 o-hidden">
            <div class="card-body ul-card__widget-chart">
                <div class="ul-widget__chart-info">
                    <h5 class="heading">Earnings</h5>
                    <div class="ul-widget__chart-number">
                        <h2 class="t-font-boldest">{{ $initialData['total_paid_amount'] ?? '0.00' }}</h2>
                    </div>
                </div>
                <div id="basicArea-chart3"></div>
            </div>
        </div>
    </div> --}}
    <!-- ICON BG-->
    <div class="col-md-3">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Add-User"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Users</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $initialData['total_users'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Add-User"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Verified</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $initialData['approved_users'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Financial"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Tours</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $initialData['total_tours'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Bookings</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $initialData['total_bookings'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center"><i class="i-Money-2"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Earnings</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $initialData['total_paid_amount'] ?? '0.00' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- finance-->
    <div class="col-md-12 col-lg-12 mt-4">
        <div class="card o-hidden h-100">
            <div class="card-header bg-transparent">
                <div class="row" style="align-items: center;">
                    <div class="col-md-6">
                        <div class="ul-card-widget__head-label">
                            <h5 class="text-18 font-weight-700 card-title">Booking Summary</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="height: 400px;">
                    <canvas id="earningLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>



