<div class="btn-group">
    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Other
    </button>
    <div class="dropdown-menu">
        {{-- @can('tour_date_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-date') }}/{{ $tour->id }}">
            <i class="fa fa-calendar mr-1"></i> Dates
        </a>
        {{-- @endcan --}}
        {{-- @can('tour_itinerary_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-itinerary') }}/{{ $tour->id }}">
            <i class="fa fa-calendar mr-1"></i> Itinerary
        </a>
        {{-- @endcan --}}
        {{-- @can('tour_inclusion_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-inclusion') }}/{{ $tour->id }}">
            <i class="fa fa-check mr-1"></i> Inclusion
        </a>
        {{-- @endcan --}}
        {{-- @can('tour_exclusion_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-exclusion') }}/{{ $tour->id }}">
            <i class="fa fa-close mr-1"></i> Exclusion
        </a>
        {{-- @endcan --}}
        {{-- @can('tour_faq_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-faq') }}/{{ $tour->id }}">
            <i class="fa fa-question-circle mr-1"></i> FAQs
        </a>
        {{-- @endcan --}}
        {{-- @can('tour_gallery_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-image') }}/{{ $tour->id }}">
            <i class="fa fa-image mr-1"></i> Gallery
        </a>
        {{-- @endcan --}}
        {{-- @can('tour_download_access') --}}
        <a class="dropdown-item text-dark" style="padding: 1px 10px;"
            href="{{ url('tour-download') }}/{{ $tour->id }}">
            <i class="fa fa-download mr-1"></i> Downloads
        </a>
        {{-- @endcan --}}
    </div>
</div>