<?php

namespace App\Livewire\Post;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreateForm extends Component
{
    use WithFileUploads;

    #[Validate('nullable|string|required_without:image')]
    public $content;
    #[Validate('nullable|max:2048|mimetypes:image/jpeg,image/png,image/jpg|required_without:content')]
    public $image;
    public $removeImage = false;

    public function clearImage()
    {
        $this->removeImage = true;
        $this->image = null;
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->image && ! $this->removeImage) {
            $validated['image'] = $this->image->storePublicly('post_images', ['disk' => 'public']);
        }

        auth()->user()->posts()->create($validated);

        session()->flash('message', 'Post created');

        $this->redirectRoute('home', navigate: true);
    }

    public function render()
    {
        return view('livewire.post.post-create-form');
    }
}