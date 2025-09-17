<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Companies') }}
            </h2>
            <a href="{{ route('company.create') }}" 
               class="px-4 py-2 text-indigo-600 rounded-lg shadow ">
                + Add Company
            </a>
        </div>
    </x-slot>

    <div class="py-8 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6"></h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($companies as $company)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col">
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="{{ asset('storage/' . $company->logo) }}" 
                                 alt="logo" class="h-16 w-16 object-cover">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    <a href="{{ route('employee.index', ['company_id' => $company->id]) }}" 
                                       class="hover:underline text-indigo-600">
                                        {{ $company->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500">{{ $company->email }}</p>
                            </div>
                        </div>

                        <p class="text-gray-700 flex-1">{{ Str::limit($company->description, 80) }}</p>

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('company.edit', $company->id) }}" 
                               class="flex-1 text-center px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-sm">
                                Edit
                            </a>
                            <form action="{{ route('company.destroy', $company->id) }}" 
                                  method="POST" 
                                  class="flex-1"
                                  onsubmit="return confirm('Delete This Company?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full px-3 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
