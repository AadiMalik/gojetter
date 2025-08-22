<div class="btn-group">
    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Other
    </button>
    <div class="dropdown-menu">
        {{-- @can('activity_date_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-date') }}/{{ $activity->id }}">
            <i class="fa fa-calendar mr-1"></i> Dates
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_inclusion_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-inclusion') }}/{{ $activity->id }}">
            <i class="fa fa-check mr-1"></i> Inclusion
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_exclusion_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-exclusion') }}/{{ $activity->id }}">
            <i class="fa fa-close mr-1"></i> Exclusion
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_expectation_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-expectation') }}/{{ $activity->id }}">
            <i class="fa fa-leaf mr-1"></i> Expectation
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_policy_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-policy') }}/{{ $activity->id }}">
            <i class="fa fa-question-circle mr-1"></i> Policies
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_gallery_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-image') }}/{{ $activity->id }}">
            <i class="fa fa-image mr-1"></i> Gallery
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_support_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-support') }}/{{ $activity->id }}">
            <i class="fa fa-users mr-1"></i> Supports
        </a>
        {{-- @endcan --}}
        {{-- @can('activity_not_suitable_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('activity-not-suitable') }}/{{ $activity->id }}">
            <i class="fa fa-exclamation mr-1"></i> Not Suitable
        </a>
        {{-- @endcan --}}
    </div>
</div>
