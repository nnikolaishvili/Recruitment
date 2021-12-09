<input
    {{ $attributes->merge(['class' => 'mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm rounded-md']) }}
    type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value ?? '' }}">
