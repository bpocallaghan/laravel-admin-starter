<div class="well well-sm well-toolbar">
    <a class="btn btn-labeled btn-primary" href="{{ request()->url().'/create' }}">
        <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create {{ ucfirst($resource) }}
    </a>

    @if(isset($order) && $order === true)
        <a class="btn btn-labeled btn-default text-primary" href="{{ request()->url().'/order' }}">
            <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span>{{ ucfirst($resource) }} Order
        </a>
    @endif
</div>