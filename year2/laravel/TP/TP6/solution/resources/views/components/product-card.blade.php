<div class="card">
    <img src="{{ $image }}" alt="{{ $name }}" style="width:100%; border-radius:8px;">
    <h3>{{ $name }}</h3>
    <p><strong>{{ $price }} DH</strong></p>
    {{ $slot ?? '' }}
</div>
