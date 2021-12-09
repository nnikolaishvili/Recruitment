<textarea id="{{ $id }}" name="{{ $name }}" rows="3"
          {{ $attributes->merge(['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1
                block w-full sm:text-sm border rounded-md']) }}
          placeholder="{{ $placeholder }}">{{ $slot }}</textarea>
