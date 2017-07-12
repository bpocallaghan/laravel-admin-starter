@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Articles - {{ $item->title }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ $item->title }}" readonly>
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group">
                                        <label>Slug</label>
                                        <input type="text" class="form-control" value="{{ $item->slug }}" readonly>
                                    </section>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Summary</label>
                                <input type="text" class="form-control" value="{{ $item->summary }}" readonly>
                            </div>

                            <div class="row">
                                <div class="col col-4">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="text" class="form-control" value="{{ $item->category->name }}" readonly>
                                    </div>
                                </div>

                                <div class="col col-4">
                                    <div class="form-group">
                                        <label>Active From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->active_from }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-4">
                                    <div class="form-group">
                                        <label>Active To</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->active_to }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <div class="well well-sm">
                                    {!! $item->content !!}
                                </div>
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer', ['submit' => false])

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection