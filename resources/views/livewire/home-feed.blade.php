<div class="space-y-8">
    @if (auth()->check())
        <livewire:post.post-create-form />
    @endif

    <div class="space-y-8">
        @foreach ($posts as $post)
            <article class="px-4 py-5 mx-auto bg-white border-2 border-black rounded-lg shadow max-w-none sm:px-6">
                <livewire:post.single-post :$post :key="$post->id" />
            </article>
        @endforeach

        @if ($loadMore)
            <button wire:click="loadPosts"
                class="text-gray-900 hover:text-white border-2 border-gray-800 hover:bg-gray-900 focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block">
                Load More
            </button>
        @endif
    </div>
</div>
