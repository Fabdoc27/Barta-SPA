<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Post')]
class PostEdit extends Component
{
    use WithFileUploads;

    public Post $post;

    #[Validate('nullable|string|required_without:image')]
    public $content;

    #[Validate('nullable|max:2048|mimetypes:image/jpeg,image/png,image/jpg|required_without:content')]
    public $image;

    public $removeExistingImage;

    public function mount($post)
    {
        $this->post = $post;
        $this->content = $post->content;
        $this->removeExistingImage = false;
    }

    public function save()
    {
        $this->authorize('update', $this->post);

        $validated = $this->validate();

        // image removal
        if ($this->removeExistingImage === true) {
            $this->deleteImage($this->post->image);
            $validated['image'] = null;
        } else if ($this->image) {
            // new image
            $this->deleteImage($this->post->image);
            $validated['image'] = $this->image->storePublicly('post_images', ['disk' => 'public']);
        } else {
            // retain old image
            $validated['image'] = $this->post->image;
        }

        $this->post->update($validated);

        session()->flash('message', 'Post updated');

        return $this->redirectRoute('posts.edit', ['post' => $this->post], navigate: true);
    }

    private function deleteImage($path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    public function render()
    {
        return view('livewire.post.post-edit');
    }
}