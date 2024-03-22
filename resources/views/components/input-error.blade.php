@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'txt-red txt-bold']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
