<div class="mb-4">
    <label class="block text-gray-700 text-sm mb-2" for="{{ \Illuminate\Support\Str::kebab($label) }}">
        {{ $label }}
    </label>
    <textarea
        class="form-input block w-full pr-12 sm:text-sm sm:leading-5"
        id="{{ \Illuminate\Support\Str::kebab($label) }}"
        placeholder="{{ $placeholder }}"
    ></textarea>
</div>
