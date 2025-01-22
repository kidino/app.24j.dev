<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                {{ __('Notes') }}
            </h2>
            <a href="{{ route('note.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            {{ __('Create Note') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    
                    @if(session('success'))
                        <div class="p-4 mb-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($notes->isEmpty())
                        <div class="text-center py-12">
                            <div class="mb-4">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">No notes found</h3>
                            <p class="mt-1 text-gray-500 dark:text-gray-400">Get started by creating a new note.</p>
                            <div class="mt-6">
                                <a href="{{ route('note.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    {{ __('Create Note') }}
                                </a>
                            </div>
                        </div>
                    @else

                        @php $isAdmin = Auth::user()->hasRole('Admin'); @endphp

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="p-4 text-left">Title</th>
                                        <th class="p-4 text-left">Content</th>
                                        @if($isAdmin)
                                            <th class="p-4 text-left">User</th>
                                        @endif
                                        <th class="p-4 text-left">Created</th>
                                        <th class="p-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($notes as $note)
                                        <tr>
                                            <td class="p-4">{{ $note->title }}</td>
                                            <td class="p-4">{{ Str::words(strip_tags($note->content), 10, '...') ?? '-' }}</td>
                                            @if ($isAdmin)<td class="p-4">{{ $note->user->name }}</td>@endif
                                            <td class="p-4">{{ $note->created_at->diffForHumans() }}</td>
                                            <td class="p-4 text-right">
                                                <a href="{{ route('note.edit', $note) }}" 
                                                   class="text-blue-500 hover:text-blue-700">Edit</a>
                                                
                                                <form action="{{ route('note.destroy', $note) }}" 
                                                      method="POST" 
                                                      class="inline ml-3"
                                                      onsubmit="return confirm('Delete this note?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-500 hover:text-red-700">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $notes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
