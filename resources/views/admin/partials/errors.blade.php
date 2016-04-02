@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong>
        <ul style="list-style: outside none none; padding: 0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif