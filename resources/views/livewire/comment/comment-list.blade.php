<div class="flex flex-col mt-6 space-y-6">
    {{-- Comments Header --}}
    <h1 class="text-lg font-semibold">
        {{ Str::plural('Comment', count($comments)) }} ({{ count($comments) }})
    </h1>

    {{-- Comments --}}
    @foreach ($comments as $comment)
        <article class="min-w-full px-4 py-2 mx-auto bg-white border-2 border-black divide-y rounded-lg shadow max-w-none sm:px-6">
            <div class="py-4">
                {{-- Header --}}
                <header>
                    <div class="flex items-center justify-between">
                        {{-- Commented User Info --}}
                        <div class="flex items-center space-x-3">
                            {{-- User Avatar --}}
                            <div class="flex-shrink-0">
                                <img class="rounded-full size-10" src="{{ $comment->user->get_avatar }}" alt="{{ $comment->user->name }}" />
                            </div>

                            {{-- User Name and Username --}}
                            <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                                <a href="{{ route('profile.index', $comment->user->username) }}" class="font-semibold hover:underline line-clamp-1">
                                    {{ $comment->user->name }}
                                </a>
                                <a href="{{ route('profile.index', $comment->user->username) }}" class="text-sm text-gray-500 hover:underline line-clamp-1">
                                    {{ '@' . $comment->user->username }}
                                </a>
                            </div>
                        </div>

                        {{-- Dropdown Actions --}}
                        @canany(['update', 'delete'], $comment)
                            <div x-data="{ open: false }" class="flex self-center flex-shrink-0">
                                <div class="relative inline-block text-left">
                                    <button @click="open = !open" type="button" class="flex items-center p-2 -m-2 text-gray-400 rounded-full hover:text-gray-600">
                                        <span class="sr-only">Open options</span>
                                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                        </svg>
                                    </button>

                                    {{-- Dropdown menu --}}
                                    <div x-show="open" @click.away="open = false" x-cloak
                                        class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        {{-- Edit Button --}}
                                        @can('update', $comment)
                                            <button wire:click="commentEditModal({{ $comment->id }}, @js($comment->content))"
                                                class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                                Edit
                                            </button>
                                        @endcan

                                        {{-- Delete Button --}}
                                        @can('delete', $comment)
                                            <button wire:click="deleteComment({{ $comment->id }})" wire:confirm="Are you sure to delete this comment?"
                                                class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                                Delete
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcanany
                    </div>
                </header>

                {{-- Comment Content --}}
                <div class="py-4 font-normal text-gray-700">
                    <p>{{ $comment->content }}</p>
                </div>

                {{-- Comment Metadata --}}
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </article>
    @endforeach

    @if ($loadMore)
        <div>
            <x-load-more-button wire:click="loadComments">Load More</x-load-more-button>
        </div>
    @endif

    <livewire:comment.comment-edit />
</div>
