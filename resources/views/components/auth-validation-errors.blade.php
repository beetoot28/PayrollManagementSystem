@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">
            {{-- {{ __('Whoops! Something went wrong.') }} --}}
            {{ __('Whoops! Please fill up all required fields.') }}
        </div>

        {{-- <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
    </div>
@endif
