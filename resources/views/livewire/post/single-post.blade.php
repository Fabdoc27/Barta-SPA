<div>
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
                        <div x-show="open" @click.away="open = false" x-cloak
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
            {{ str($post->content)->limit(300) }}
        </p>
        <a href="{{ route('posts.show', $post) }}" wire:navigate class="text-xs text-gray-600 hover:underline">
            View Post
        </a>
    </div>

    {{-- Post Details --}}
    <div class="flex items-center gap-2 mb-2 text-xs text-gray-500">
        <span class="">{{ $post->created_at->diffForHumans() }}</span>
        <span class="">•</span>
        <span>450 views</span>
    </div>

    {{-- Barta Card Bottom --}}
    <footer class="py-2 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex gap-8 text-gray-600">
                {{-- Heart Button --}}
                <livewire:post.post-like :post="$post" />


                {{-- Comment Button --}}
                <button type="button" class="flex items-center gap-2 p-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                    <span class="sr-only">Comment</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>
                    {{-- Comment Count --}}
                    <p>17</p>
                </button>
            </div>

            {{-- Share Button --}}
            <div>
                <button type="button" class="flex items-center gap-2 p-2 text-xs text-gray-600 rounded-full hover:text-gray-800">
                    <span class="sr-only">Share</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                    </svg>
                </button>
            </div>
        </div>
    </footer>
</div>
