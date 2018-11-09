@if($content->heading)
    <{{$content->heading_element}}>
    {!! $content->heading !!}
    </{{$content->heading_element}}>
@endif