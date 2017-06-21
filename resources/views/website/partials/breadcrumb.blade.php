@if(isset($breadcrumb))

    {{-- hide on home page --}}
    @if($selectedNavigation->id != 1)
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {!! $selectedNavigation->title !!}
                </h1>
                <ol class="breadcrumb">
                    {!! $breadcrumb !!}
                </ol>
            </div>
        </div>
    @endif
@endif