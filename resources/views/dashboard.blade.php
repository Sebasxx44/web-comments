<x-app-layout>
    <x-container>

    <form action="{{ route('posts.store') }}" class='px-4 mb-8' method='POST'>
        @csrf
        <textarea 
        name="body" 
        id="" 
        rows='2' 
        class='w-full mb-2 p-0 text-white bg-transparent border-0 border-b-2 border-slate-800 focus:border-b-slate-700 focus:ring-0 resize-none overflow-hidden'
        placeholder='Your Comment...'
        ></textarea>

        <x-submit-button>Send Post</x-submit-button>
    </form>

    @foreach($posts as $post)

    <a href="{{route('profile.show', $post->user) }}" class="px-6 mb-2 flex items-center gap-2 font-medium text-slate-100">
    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
    </svg>

        {{ $post->user->name }}
    </a>

    <x-card class="mb-4">
        {{ $post->body }}

        <div class="text-sm text-gray-400">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </x-card>

    @endforeach

    </x-container> 

</x-app-layout>
