<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('employee.update', ['employeeId' => $employee->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Penting untuk update -->
                    <input type="hidden" name="companies_id" value="{{ request('company_id') }}">
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

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Profile Image</label>
                        <input type="file" name="logo" class="mt-1 block w-full border-gray-300 rounded-md">
                        @if($employee->logo)
                            <img src="{{ asset('storage/'.$employee->logo) }}" class="mt-2 w-16 h-16 object-cover">
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-black rounded hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

</body>
</html>