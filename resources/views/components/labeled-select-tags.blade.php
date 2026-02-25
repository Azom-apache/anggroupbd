@props(['name', 'label' => null, 'required' => false, 'disabled' => false, 'extraAttributes' => []])

<div class="{{ $attributes['class'] }}">
    <label class="block font-medium text-sm text-gray-700 font-semibold py-2"
        for="{{ $name }}">{{ __($label ?:Str::of($name)->replace(['_', '-'], ' ')->title() . '') }}@if ($required)
            <span class="ml-2 text-red-500">*</span>
        @endif
    </label>
    <select id="select2-{{ $name }}" name="{{ $name }}[]" class="hidden" multiple>
        {{ $slot }}
    </select>

    <div class="relative flex" x-data="{ ...selectMultiple('select2-{{ $name }}') }">

        <!-- Selected -->
        <div class="flex flex-wrap w-full" @click="isOpen = true;"
            @keydown.arrow-down.prevent="if(dropdown.length > 0) document.getElementById(elSelect.id+'_'+dropdown[0].index).focus();">

            <template x-for="(option,index) in selected;" :key="option.value">
                <p class="m-1 self-center p-2 text-xs whitespace-nowrap rounded-3xl bg-teal-200 cursor-pointer hover:bg-red-300"
                    x-text="option.text" @click="toggle(option)">
                </p>
            </template>

            <input type="text" placeholder="Filter options"
                class="pl-2 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full p-2 border-2 border-gray-400"
                x-model="term" x-ref="input" />
        </div>

        <!-- Dropdown -->
        <div class="absolute mt-12 z-10 w-full max-h-72 overflow-y-auto rounded-xl bg-teal-100 " x-show="isOpen"
            @mousedown.away="isOpen = false">

            <template x-for="(option,index) in dropdown" :key="option.value">
                <div class="cursor-pointer hover:bg-teal-200 focus:bg-teal-300 focus:outline-none"
                    :class="(term.length > 0 && !option.text.toLowerCase().includes(term.toLowerCase())) && 'hidden';"
                    x-init="$el.id = elSelect.id + '_' + option.index;
                    $el.tabIndex = option.index;" @click="toggle(option)" @keydown.enter.prevent="toggle(option);"
                    @keydown.arrow-up.prevent="if ($el.previousElementSibling != null) $el.previousElementSibling.focus();"
                    @keydown.arrow-down.prevent="if ($el.nextElementSibling != null) $el.nextElementSibling.focus();">

                    <p class="p-2" x-text="option.text"></p>
                </div>
            </template>
        </div>
    </div>
    @error($name)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
