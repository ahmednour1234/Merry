<h1>{{ $title }}</h1>

@if(!empty($body))
<p>{!! nl2br(e($body)) !!}</p>
@endif

@if(!empty($data) && is_array($data))
<ul>
@foreach($data as $key => $value)
    <li><strong>{{ $key }}:</strong> {{ is_scalar($value) ? $value : json_encode($value) }}</li>
@endforeach
</ul>
@endif


