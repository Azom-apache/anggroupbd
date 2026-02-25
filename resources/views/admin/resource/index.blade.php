<x-admin-app-layout :title="$title = __(
    $heading['index'] ??
        (string) \Str::of($name)
            ->title()
            ->replace(['_', '-'], ' ')
            ->plural(),
)">
    @php($routePrefix = $routePrefix ?? $name)
    @php($skipPermission = isset($skipPermission) ?? false)
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">{{ $title }}</div>
            @if ($skipPermission || Auth::user()->hasPermission($name . '-create'))
                <div>
                    @if (Route::has($routePrefix . '.create'))
                        <a href="{{ route($routePrefix . '.create') }}"
                            class="bg-transparent text-sm hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-4 border border-blue-500 hover:border-transparent rounded">
                            +
                            {{ __($heading['create'] ??'Create ' .Str::of($name)->title()->replace(['_', '-'], ' ')) }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </x-slot>
    <div class="w-full mt-4 p-4">
        <table class="w-full " id="index-table">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        @if ($column instanceof \App\Lib\Resource\Column)
                            @continue(!$column->visible)
                            <th>{{ __((string) Str::of($column->label ?? $column->name)->title()->replace(['_', '.'], ' ')) }}
                            </th>
                        @else
                            <th>{{ __((string) Str::of($column)->title()->replace(['_', '.'], ' ')) }}</th>
                        @endif
                    @endforeach
                    @if ($action ?? true)
                        <th>{{ __('Action') }}</th>
                    @endif
                </tr>
            </thead>
        </table>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            window.addEventListener('load', function() {
                $('#index-table').DataTable({
                    serverSide: true,
                    processing: true,
                    dom: "<'w-full flex flex-wrap items-center justify-center lg:justify-between'<'w-full text-center sm:w-1/2 sm:text-left sm:my-1'l><'w-full flex justify-center my-1 sm:justify-end sm:w-1/2'f>>" +
                        "<'flex my-4'<'w-full max-w-[calc(100vw-3rem)] overflow-y-auto lg:max-w-[calc(100vw-19rem)]'tr>>" +
                        "<'flex flex-wrap'<'w-full my-2 sm:w-1/3'i><'w-full sm:w-2/3 text-right'p>>",
                    ajax: {
                        url: '{{ route($routePrefix . '.index', isset($appendParameters) ? request()->only($appendParameters) : []) }}',
                        dataSrc(response) {
                            response.data.map(function(item) {
                                item.action = actionIcons({
                                    @if (Route::has($routePrefix . '.show'))
                                        'show': '{{ route($routePrefix . '.show', '@') }}'
                                            .replace('@', item.id),
                                    @endif
                                    @if (($skipPermission || Auth::user()->hasPermission($name . '-update')) && Route::has($routePrefix . '.edit'))
                                        'edit': '{{ route($routePrefix . '.edit', '@') }}'
                                            .replace('@', item.id),
                                    @endif
                                    @if (($skipPermission || Auth::user()->hasPermission($name . '-approve')) && Route::has($routePrefix . '.update'))
                                        'approve': '{{ route($routePrefix . '.update', '@') }}'
                                            .replace('@', item.id),
                                    @endif
                                    @if (($skipPermission || Auth::user()->hasPermission($name . '-portal')) && Route::has($routePrefix . '.portal'))
                                        'portal': '{{ route($routePrefix . '.portal', '@') }}'
                                            .replace('@', item.id),
                                    @endif
                                    @if (($skipPermission || Auth::user()->hasPermission($name . '-delete')) && Route::has($routePrefix . '.update'))
                                        'delete': '{{ route($routePrefix . '.destroy', '@') }}'
                                            .replace('@', item.id),
                                    @endif
                                });
                                @isset($statusMap)
                                    item.status = @js($statusMap::asSelectArray())[item.status]
                                @endisset
                                if (item.date) {
                                    item.date = new Date(item.date).toDateString()
                                }
                                if (item.created_at) {
                                    item.created_at = new Date(item.created_at).toLocaleString()
                                }
                                if (item.updated_at) {
                                    item.updated_at = new Date(item.updated_at).toLocaleString()
                                }
                                if (item.image) {
                                    item.image =
                                        `<img class="w-8 h-8 object-cover m-auto" src="${item.image}" alt="" />`;
                                }
                                item.id = '{{ $idPrefix ?? '' }}' + item.id;
                                return item;
                            });
                            return response.data;
                        }
                    },
                    columns: [
                        @foreach ($columns as $column)
                            @if ($column instanceof \App\Lib\Resource\Column)
                                @continue(!$column->visible) {
                                    data: '{{ $column }}',
                                    orderable: {{ $column->dataOrder ? 'true' : 'false' }},
                                    searchable: {{ $column->dataSearch ? 'true' : 'false' }}
                                },
                            @else
                                {
                                    data: '{{ $column }}'
                                },
                            @endif
                        @endforeach
                        @if ($action ?? true)
                            {
                                data: 'action',
                                orderable: false,
                                searchable: false
                            },
                        @endif
                    ]
                });
            });
        </script>
    </x-slot>
</x-admin-app-layout>
