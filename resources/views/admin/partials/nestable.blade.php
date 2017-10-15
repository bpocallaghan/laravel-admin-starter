@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        function initNestableMenu(maxDepth, path)
        {
            $('#dd-navigation').nestable({
                group: 1,
                maxDepth: maxDepth
            }).on('change', updateList);

            $('#nestable-menu').click(function (e)
            {
                var target = $(e.target), action = target.data('action');

                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }

                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            function updateList(e)
            {
                var list = e.length ? e : $(e.target);
                var nestableString = window.JSON.stringify(list.nestable('serialize'));

                $.post(path, {'list': nestableString}, function (data)
                {
                    if (data && data.result == 'success') {
                        notify('Successfully', 'The Order has been updated', null, null, 5000);
                    }
                    else {
                        notifyError();
                    }
                }, "json");
            }
        }
    </script>
@endsection