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
            <div>
                <x-load-more-button wire:click="loadPosts">Load More</x-load-more-button>
            </div>
        @endif
    </div>
</div>
