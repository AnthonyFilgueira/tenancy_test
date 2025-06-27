@props(['for'])

<label for="{{ $for }}" class="block font-semibold mb-1">
    {{ $slot }}
</label>
