<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('employee.update', ['employeeId' => $employee->id]) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Penting untuk update -->

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('name', $employee->name) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('email', $employee->email) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Telepon</label>
                        <input type="text" name="phone" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('phone', $employee->phone) }}">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-black rounded hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
