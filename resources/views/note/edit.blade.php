<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                {{ __('Edit Note') }}
            </h2>
            <a href="{{ route('note.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                {{ __('Back to Notes') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <form action="{{ route('note.update', $note) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" 
                                         name="title" 
                                         type="text"
                                         class="mt-1 block w-full" 
                                         :value="old('title', $note->title)"
                                         required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea name="content" 
                                      id="content" 
                                      rows="6"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                      required>{{ old('content', $note->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('note.index') }}" 
                               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                {{ __('Update Note') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
