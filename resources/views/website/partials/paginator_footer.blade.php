@if($paginator->total() > 0)
    <div class="row paginator-footer">
        <div class="col-md-12 col-lg-6 text-center text-lg-left text-xl-left align-self-center">
            <p class="info-display mb-lg-0 mb-2">
                Showing
                <strong>{{ (($paginator->currentPage() - 1) * $paginator->perPage()) + 1 }}</strong>
                to
                <strong>{{ $paginator->perPage() * $paginator->currentPage() > $paginator->total()? $paginator->total() : $paginator->perPage() * $paginator->currentPage() }}</strong>
                of
                <strong><span class="text-primary">{{ $paginator->total() }}</span></strong>
                entries
                @if(isset($paginator->originalEntries) && $paginator->originalEntries != $paginator->total())
                    <span class="text-muted">
                        (filtered from
                        <strong>{{ $paginator->originalEntries }}</strong>
                        total entries)
                    </span>
                @endif
            </p>
        </div>

        <div class="col-md-12 col-lg-6 d-flex justify-content-center justify-content-lg-end">
            {{ $paginator->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endif