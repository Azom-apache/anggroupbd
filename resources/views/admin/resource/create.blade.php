<x-admin-app-layout :title="$title = __(
    $heading['create'] ??
        'Create ' .
            Str::of($name)
                ->title()
                ->replace(['_', '-'], ' '),
)">
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ $title }}</div>
            @if (Route::has($name . '.index'))
                <div>
                    <a href="{{ route($name . '.index') }}"
                        class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded">{{ __($heading['index'] ??(string) Str::of($name)->title()->replace(['_', '-'], ' ')->plural()) }}</a>
                </div>
            @endif
        </div>
    </x-slot>


    <div class="w-full mt-4 p-4">
        <form action="{{ route($name . '.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap justify-center w-full bg-white p-4">
                @php
                    $fieldCount = count($fields);
                    if ($fieldCount === 1) {
                        $inputClass = 'w-full p-1';
                    } elseif ($fieldCount < 9) {
                        $inputClass = 'w-full p-1 md:w-1/2';
                    } else {
                        $inputClass = 'w-full p-1 md:w-1/2 lg:w-1/3';
                    }
                @endphp
                @foreach ($fields as $field)
                    @if ($field->type === 'select')
                        <x-labeled-select :name="$field->name" :label="$field->label" :required="$field->required" :class="$inputClass . ' ' . $field->class"
                            :extra-attributes="$field->extraAttributes">
                            @foreach ($field->options as $value => $label)
                                <option @if (old($field->name, $field->value) == $value) selected @endif value="{{ $value }}"
                                    @if ($label instanceof \App\Lib\Option) data-parent="{{ $label->parent }}" @endif>
                                    {{ $label instanceof \App\Lib\Option ? $label->label : $label }}</option>
                            @endforeach
                        </x-labeled-select>
                    @elseif($field->type === 'textarea')
                        <x-labeled-textarea :type="$field->type" :value="$field->value" :name="$field->name" :label="$field->label ?? $field->name"
                            :required="$field->required" :class="'w-full p-1 ' . $field->class" :extra-attributes="$field->extraAttributes" />
                    @elseif($field->type === 'tags')
                        <x-labeled-select-tags :name="$field->name" :label="$field->label ?? $field->name" :required="$field->required"
                            :class="$inputClass . ' ' . $field->class" :extra-attributes="$field->extraAttributes">
                            @foreach ($field->options as $value => $label)
                                <option @if (old($field->name, $field->value) == $value) selected @endif value="{{ $value }}"
                                    @if ($label instanceof \App\Lib\Resource\Option) data-parent="{{ $label->parent }}" @endif>
                                    {{ $label instanceof \App\Lib\Resource\Option ? $label->label : $label }}</option>
                            @endforeach
                        </x-labeled-select-tags>
                    @else
                        <x-labeled-input :type="$field->type" :value="$field->value" :name="$field->name" :label="$field->label"
                            :required="$field->required" :class="$inputClass . ' ' . $field->class" :extra-attributes="$field->extraAttributes" />
                    @endif
                @endforeach
                <div class="w-full pt-8 py-4 flex justify-center">
                    <x-button>{{ __('Create') }}</x-button>
                </div>
            </div>
        </form>
    </div>
    {{-- <script type="text/javascript" src="{{ mix('js/depend-on.js') }}"></script> --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selectMultiple', (elSelectId) => ({

                elSelect: document.getElementById(elSelectId),
                isOpen: false,
                term: '',

                selected: [],
                dropdown: [],

                // in the <select> element, set the attributes :
                //  "multiple" to avoid to Always set "selected" to the first item
                //  class="hidden" (better than hide it with javascript which has a slow reaction)
                init() {
                    for (var index = 0; index < this.elSelect.options.length; index++) {
                        if (this.elSelect.options[index].selected)
                            this.selected.push(this.elSelect.options[index]);
                        else
                            this.dropdown.push(this.elSelect.options[index]);
                    }
                },

                toggle(option) {
                    var property1 = (option.selected == true) ? 'dropdown' : 'selected';
                    var property2 = (option.selected == true) ? 'selected' : 'dropdown';

                    option.selected = !option.selected;

                    // add
                    this[property1].push(option);

                    // remove
                    this[property2] = this[property2].filter((opt, index) => {
                        return opt.value != option.value;
                    });

                    // reorder this.dropdown to their original select.options indexes
                    if (property1 == 'dropdown')
                        this.dropdown.sort((opt1, opt2) => (opt1.index > opt2.index) ? 1 : -1)

                    // after adding, re-focus the input
                    if (option.selected)
                        this.$refs.input.focus();
                },
            }))
        });
    </script>
    </x-app-layout>
