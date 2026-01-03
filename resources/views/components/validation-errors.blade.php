@props(['field', 'label' => null])

@error($field)
    <span {{ $attributes->merge(['class' => 'text-red-500 text-sm mt-1 block']) }}>
        @if($label){{ $label }}: @endif{{ $message }}
    </span>
@enderror

@foreach($errors->get($field . '.*') as $messages)
    @foreach($messages as $message)
        <span {{ $attributes->merge(['class' => 'text-red-500 text-sm mt-1 block']) }}>
            {{ $message }}
        </span>
    @endforeach
@endforeach