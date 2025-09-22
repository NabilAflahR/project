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
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="companies_id" value="{{ request('company_id') }}">
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Telepon</label>
                        <input type="text" name="phone" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium">Logo</label>
                        <input type="file" name="logo" class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

</body>
</html>