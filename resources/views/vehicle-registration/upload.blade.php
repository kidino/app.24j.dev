<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Vehicle Registrations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">

                    @if (session('success'))
                        <div class="p-4 mb-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('vehicle-registrations.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="csv_file" :value="__('CSV File')" />
                            <input type="file" 
                                   id="csv_file"
                                   name="csv_file"
                                   class="mt-1 block w-full border-gray-600 rounded-md shadow-sm p-2" required />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Upload') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>