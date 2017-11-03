<div class="row mt-5">
    <div class="col-sm-{{ isset($column) ? $column : '8' }}">
        <h1 class="page-header">
            {!! isset($pageTitle) ? $pageTitle : $page->title !!}
        </h1>
        <div class="social">
            <a class="link-share text-primary" data-social="facebook">
                <i class="fa fa-facebook"></i>
            </a>
            <a class="link-share text-primary" data-social="twitter">
                <i class="fa fa-twitter"></i>
            </a>
        </div>
    </div>
</div>
