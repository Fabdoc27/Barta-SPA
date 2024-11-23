<div>
    <article class="px-4 py-5 mx-auto bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
        <header>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    {{-- User Avatar --}}
                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="{{ $post->user->get_avatar }}" alt="{{ $post->user->name }}" />
                    </div>

                    {{-- User Info --}}
                    <div class="flex flex-col flex-1 min-w-0 text-gray-900">
                        <p class="font-semibold hover:underline line-clamp-1">
                            {{ $post->user->name }}
                        </p>

                        <a href="{{ route('profile.index', $post->user->username) }}" wire:navigate class="text-sm text-gray-500 hover:underline line-clamp-1">
                            {{ '@' . $post->user->username }}
                        </a>
                    </div>
                </div>

                {{-- Card Action Dropdown --}}
                @canany(['update', 'delete'], $post)
                    <div class="flex self-center flex-shrink-0" x-data="{ open: false }">
                        <div class="relative inline-block text-left">
                            <div>
                                <button @click="open = !open" type="button" class="flex items-center p-2 -m-2 text-gray-400 rounded-full hover:text-gray-600" id="menu-0-button">
                                    <span class="sr-only">Open options</span>
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Dropdown Menu  --}}
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                {{-- Edit Post --}}
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post->id) }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Edit
                                    </a>
                                @endcan

                                {{-- Delete Post --}}
                                @can('delete', $post)
                                    <button wire:click="delete({{ $post->id }})" wire:confirm="Are you sure to delete this post?"
                                        class="block w-full px-4 py-2 text-sm text-gray-700 text-start hover:bg-gray-100">
                                        Delete
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endcanany
            </div>
        </header>

        {{-- Image Preview --}}
        @if ($post->image)
            <div class="my-4">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="object-cover w-full h-auto rounded-lg max-h-64">
            </div>
        @endif

        {{-- Content --}}
        <div class="py-4 font-normal text-gray-700">
            <p class="mb-2">
                {{ $post->content }}
            </p>
        </div>

        {{-- Post Details --}}
        <div class="flex items-center gap-2 mb-2 text-xs text-gray-500">
            <span>{{ $post->created_at->diffForHumans() }}</span>
            <span>•</span>
            <span>{{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}</span>
            {{-- <span >•</span>
        <span>450 views</span> --}}
        </div>

        <hr class="my-6" />

        <livewire:comment.comment-create :post="$post" />
    </article>

    <livewire:comment.comment-list :post="$post" />
</div>
