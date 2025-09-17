<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @isset($company)
                    Employees of {{ $company->name }}
                @else
                    All Employees
                @endisset
            </h2>
            <a href="{{ isset($company) ? route('employee.create', ['company_id' => $company->id]) : route('employee.create') }}" 
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Employee
            </a>
        </div>
    </x-slot>

    <div class="py-8 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($employees as $employee)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col">
                        <div class="flex items-center space-x-6 mb-4">
                            {{-- Logo employee --}}
                            <img src="{{ $employee->logo ? asset('storage/' . $employee->logo) : asset('images/default-logo.png') }}" 
                                 alt="logo" class="h-16 w-16 object-cover rounded-md border">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $employee->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $employee->email }}</p>
                                <p class="text-sm text-gray-500">{{ $employee->phone }}</p>
                            </div>
                        </div>

                        <div class="mt-auto flex space-x-2">
                            <a href="{{ route('employee.edit', $employee) }}" 
                               class="flex-1 text-center px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-sm">
                                Edit
                            </a>
                            <form action="{{ route('employee.destroy', $employee) }}" 
                                method="POST" class="flex-1"
                                onsubmit="return confirm('Delete This Employee?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="company_id" value="{{ isset($company) ? $company->id : '' }}">
                                <button type="submit" 
                                        class="w-full px-3 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200 text-sm">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
