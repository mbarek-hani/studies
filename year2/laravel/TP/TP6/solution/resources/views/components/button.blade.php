@props(['disabled' => false])
@if($href)
    <a href="{{ $href }}"
    class="btn btn-{{ $type }} {{ $disabled ? 'disabled' : '' }}"
    style="padding:10px 20px; background:{{ $type === 'danger' ? 'red' : 'blue' }};
    color:white; text-decoration:none; border-radius:5px; display:inline-block;"
    {{ $attributes }}>
    {{ $slot }}
    </a>
@else
    <button type="submit"
    class="btn btn-{{ $type }} {{ $disabled ? 'disabled' : '' }}"
    style="padding:10px 20px; background:{{ $type === 'danger' ? 'red' : 'blue'
    }}; color:white; border:none; border-radius:5px;"
    {{ $attributes->except('disabled') }}
    @disabled($disabled)>
    {{ $slot }}
    </button>
@endif
