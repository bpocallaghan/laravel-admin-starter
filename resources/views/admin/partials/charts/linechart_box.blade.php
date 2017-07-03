<div class="box box-success {{ isset($boxClass)? $boxClass:'' }} " id="{{ $id }}">
    <div class="box-header with-border">
        <h3 class="box-title">
            <span><i class="fa fa-{{ isset($icon)? $icon:'line-chart' }}"></i></span>
            <span>{{ isset($title)? $title:'Title' }}</span>
        </h3>

        @include('admin.partials.boxes.toolbar')
        {{-- , ['btnDateClass' => 'btn-default'] --}}
    </div>

    <div class="box-body">
        @include('admin.partials.charts.linechart')
    </div>
</div>

