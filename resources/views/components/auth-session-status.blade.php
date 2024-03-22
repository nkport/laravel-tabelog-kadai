@props(['status'])

@if ($status)
    <div {{ $attributes->merge() }}>
        <strong>{{ $status }}</strong>
    </div>
@endif
