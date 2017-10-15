@if($paginator->total() > 0)
    <div class="row paginator-footer">
        <div class="col-md-6">
            <p class="info-display">
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

        <div class="col-md-6 text-right">
            {{ $paginator->links() }}
        </div>
    </div>
@endif