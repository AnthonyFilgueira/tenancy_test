@props(['name', 'options' => [], 'selected' => null])

<select name="{{ $name }}" class="w-full p-2 border rounded">
    <option value="">-- Seleccionar --</option>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>

@error($name)
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
