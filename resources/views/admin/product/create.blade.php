<x-admin-app-layout>

    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ __('Product Create ') }}</div>

            <div>
                <a href="{{ route('admin.product.index') }}"
                    class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded">{{ __('Products') }}</a>
            </div>

        </div>


    </x-slot>


    <div class="w-full mt-4 p-4" x-data="{ elements: [0], elemen: [0] }">
        <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap justify-center w-full bg-white p-4">
                <x-labeled-input type="text" required class="w-full  md:w-1/2 lg:w-1/3   p-1"
                    label="{{ __('Product Name English') }}" name="name_en" />
                <x-labeled-input type="text" class="w-full  md:w-1/2 lg:w-1/3   p-1"
                    label="{{ __('Product Name Bangla') }}" name="name_bn" />
                <x-labeled-select name="category_id" label="Category"
                    class="w-full  md:w-1/2 lg:w-1/3 flex flex-wrap my-3 md:mt-0 md:p-1">
                    @foreach (\App\Models\Category::get() as $card)
                        <option value="{{ $card->id }}">{{ $card->name ?? '' }}</option>
                    @endforeach
                </x-labeled-select>
                <x-labeled-select name="subcategory_id" label="Sub Category"
                    class="w-full  md:w-1/2 lg:w-1/3 flex flex-wrap my-3 md:mt-0 md:p-1">
                    @foreach (\App\Models\Subcategory::get() as $card)
                        <option value="{{ $card->id }}">{{ $card->name ?? '' }}</option>
                    @endforeach
                </x-labeled-select>
                <x-labeled-select name="brand_id" label="Brand"
                    class="w-full  md:w-1/2 lg:w-1/3 flex flex-wrap my-3 md:mt-0 md:p-1">
                    @foreach (\App\Models\Brand::get() as $card)
                        <option value="{{ $card->id }}">{{ $card->name ?? '' }}</option>
                    @endforeach
                </x-labeled-select>
                <x-labeled-select name="unit_id" label="Unit"
                    class="w-full  md:w-1/2 lg:w-1/3 flex flex-wrap my-3 md:mt-0 md:p-1">
                    @foreach (\App\Models\Unit::get() as $card)
                        <option value="{{ $card->id }}">{{ $card->name ?? '' }}</option>
                    @endforeach
                </x-labeled-select>
                <x-labeled-select name="sister_id" label="Sister Consern"
                    class="w-full  md:w-1/2 lg:w-1/3 flex flex-wrap my-3 md:mt-0 md:p-1">
                    @foreach (\App\Models\Client::get() as $card)
                        <option value="{{ $card->id }}">{{ $card->name ?? '' }}</option>
                    @endforeach
                </x-labeled-select>
                <x-labeled-input type="file" required class="w-full md:w-1/2 lg:w-1/3   p-1" label="Image"
                    name="image" />
                <x-labeled-textarea class="w-full   p-1" label="Short Text" name="short_text"> </x-labeled-textarea>
                <x-labeled-input type="number" value="0" class="w-full md:w-1/2 lg:w-1/3   p-1" label="Buy price"
                    name="buy_price" />
                <x-labeled-input type="number" value="0" class="w-full md:w-1/2 lg:w-1/3   p-1" label="Sale price"
                    name="sale_price" />
                <x-labeled-select name="discount_type" label="Available/Upcoming" class="w-full md:w-1/2 lg:w-1/3 p-1">

                    @foreach (\App\Enum\DiscountStatus::asSelectArray() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-labeled-select>
                <x-labeled-input type="number" value="0" class="w-full md:w-1/2 lg:w-1/3   p-1"
                    label="Discount price" name="discount_price" />
                <x-labeled-input type="number" class="w-full md:w-1/2 lg:w-1/3   p-1" label="Min purchase quantity"
                    value="0" name="min_purchase_quantity" />
                <x-labeled-input type="number" value="0" class="w-full md:w-1/2 lg:w-1/3   p-1 "
                    label="Stock quantity" name="stock_quantity" />
                <x-labeled-input type="number" value="0" class="w-full md:w-1/2 lg:w-1/3   p-1 "
                    label="Aleart quantity" name="stock_quantity" />
                <x-labeled-input type="number" value="0" class="w-full md:w-1/2 lg:w-1/3   p-1 " label="Point"
                    name="point" />
                <x-labeled-input type="text" class="w-full md:w-1/2 lg:w-1/3   p-1 " label="Product Code"
                    name="code" />
                <div class="w-full">
                    <label for="" class="block"> Description En</label>
                    <textarea class="w-full " name="description_en" id="editor1"></textarea>
                </div>
                <div class="w-full">
                    <label for="" class="block">Description Bn</label>
                    <textarea class="w-full" name="description_bn" id="editor2"></textarea>
                </div>
                <div class="w-full">
                    <template x-for="element in elements">
                        <div class="w-full ">
                            <div class="w-full flex   justify-end">
                                <svg x-on:click="elements.splice(element,1)" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </div>
                            <div class="w-full flex flex-wrap">
                                <x-labeled-select name="attribute_id[]" label="Attribute" required
                                    class="w-full  md:w-1/2 lg:w-1/2 flex flex-wrap my-3 md:mt-0 md:p-1">
                                    @foreach (\App\Models\Attribute::get() as $card)
                                        <option value="{{ $card->id }}">{{ $card->name ?? '' }}</option>
                                    @endforeach
                                </x-labeled-select>
                                <x-labeled-input type="text" class="w-full md:w-1/2  p-1" label="Value"
                                    name="attribute_value[]" value="0" />

                            </div>
                            <div class="p-1 text-center bg-green-500">
                            </div>
                        </div>
                    </template>
                    <div class="w-full">
                        <button type="button" x-on:click="elements.push(elements.length +Math.random())"
                            class="px-4 py-2 hover:bg-blue-500 hover:duration-700 hover:text-white cursor-pointer border rounded-md ">Add</button>
                    </div>
                </div>
                <div class="w-full">
                    <template x-for="elemen in elemen">
                        <div class="w-full ">
                            <div class="w-full flex   justify-end">
                                <svg x-on:click="elemen.splice(elemen,1)" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </div>
                            <div class="w-full flex flex-wrap">

                                <x-labeled-input type="file" class="w-full  p-1" label="Image"
                                    name="images[]" />
                            </div>
                        </div>
                    </template>
                    <div class="w-full">
                        <button type="button" x-on:click="elemen.push(elemen.length +Math.random())"
                            class="px-4 py-2 hover:bg-blue-500 hover:duration-700 hover:text-white cursor-pointer border rounded-md ">Add</button>
                    </div>
                </div>
                <div class="w-full flex justify-center py-4">
                    <x-button type="submit">Submit</x-button>
                </div>
            </div>
        </form>
    </div>


</x-admin-app-layout>
