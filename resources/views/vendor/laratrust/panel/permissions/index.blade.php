@extends('laratrust::panel.layout')

@section('title', 'Permissions')

@section('content')
  <div class="flex flex-col">
    @if (config('laratrust.panel.create_permissions'))
    <a
      href="{{route('laratrust.permissions.create')}}"
      class="self-end bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
    >
      + New Permission
    </a>
    @endif
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="mt-4 align-middle inline-block min-w-full bg-white shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
          <thead>
            <tr>
              <th class="th p-2 border text-left">Id</th>
              <th class="th p-2 border text-left">Name/Code</th>
              <th class="th p-2 border text-left">Display Name</th>
              <th class="th p-2 border text-left">Description</th>
              <th class="th p-2 border text-left"></th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($permissions as $permission)
            <tr class="border">
              <td class="td text-sm leading-5 text-gray-900 p-2">
                {{$permission->getKey()}}
              </td>
              <td class="td text-sm leading-5 text-gray-900 p-2">
                {{$permission->name}}
              </td>
              <td class="td text-sm leading-5 text-gray-900 p-2">
                {{$permission->display_name}}
              </td>
              <td class="td text-sm leading-5 text-gray-900 p-2">
                {{$permission->description}}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                <a href="{{route('laratrust.permissions.edit', $permission->getKey())}}" class="text-blue-600 hover:text-blue-900">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  {{ $permissions->links('laratrust::panel.pagination') }}
@endsection
