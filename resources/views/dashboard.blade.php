<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Grid Card Statistik + Manage -->
            <div class="flex flex-wrap gap-6">
                <!-- Total Companies -->
                <div class="bg-white rounded-xl shadow p-6 flex-1 min-w-[300px]">
                    <h3 class="text-sm font-medium text-gray-500">Total Companies</h3>
                    <p class="mt-4 text-3xl font-extrabold text-indigo-600">
                        {{ $totalCompanies }}
                    </p>
                </div>

                <!-- Total Employees -->
                <div class="bg-white rounded-xl shadow p-6 flex-1 min-w-[300px]">
                    <h3 class="text-sm font-medium text-gray-500">Total Employees</h3>
                    <p class="mt-4 text-3xl font-extrabold text-green-600">
                        {{ $totalEmployees }}
                    </p>
                </div>

                <!-- Manage Companies -->
                <a href="{{ route('company.index') }}" class="rounded-xl  text-indigo-600 shadow hover:shadow-md transition block p-6 flex-1 min-w-[300px]">
                    <h3 class="text-lg font-bold text-gray-700">Manage Companies</h3> Click Here To Manage Company
                </a>
            </div>


            <!-- Data Terbaru Companies -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">5 Perusahaan Terbaru</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach($latestCompanies as $c)
                            <li class="py-2 flex justify-between">
                                <span>{{ $c->name }}</span>
                                <span class="text-xs text-gray-500">
                                    {{ $c->created_at?->diffForHumans() }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Data Terbaru Employees -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">5 Employee Terbaru</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach($latestEmployees as $e)
                            <li class="py-2 flex justify-between">
                                <span>{{ $e->name }}</span>
                                <span class="text-xs text-gray-500">
                                    {{ $e->created_at?->diffForHumans() }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
