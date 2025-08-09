<div class="btn-group">
      <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Other
      </button>
      <div class="dropdown-menu">
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-date') }}/{{ $activity->id }}">
                  <i class="fa fa-calendar mr-1"></i> Dates
            </a>
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-inclusion') }}/{{ $activity->id }}">
                  <i class="fa fa-check mr-1"></i> Inclusion
            </a>
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-exclusion') }}/{{ $activity->id }}">
                  <i class="fa fa-close mr-1"></i> Exclusion
            </a>
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-expectation') }}/{{ $activity->id }}">
                  <i class="fa fa-leaf mr-1"></i> Expectation
            </a>
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-policy') }}/{{ $activity->id }}">
                  <i class="fa fa-question-circle mr-1"></i> Policies
            </a>
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-image') }}/{{ $activity->id }}">
                  <i class="fa fa-image mr-1"></i> Gallery
            </a>
            <a class="dropdown-item text-dark" style="padding: 1px 10px;"
                  href="{{ url('activity-support') }}/{{ $activity->id }}">
                  <i class="fa fa-users mr-1"></i> Supports
            </a>
      </div>
</div>