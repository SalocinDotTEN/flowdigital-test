<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPosts;

class BlogEntries extends Component
{
    public $blogPosts, $post_date, $title, $meta, $content, $slug, $image, $published;
    public $isModalOpen = 0;
    public function render()
    {
        $this->blogPosts = BlogPosts::all();
        return view('livewire.blog-entries');
    }
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm()
    {
        $this->post_date = '';
        $this->title = '';
        $this->meta = '';
        $this->content = '';
        $this->slug = '';
        $this->image = '';
        $this->published = '';
    }

    public function store()
    {
        $this->validate([
            'post_date' => ['required'],
            'title' => ['required'],
            'meta' => ['nullable'],
            'content' => ['required'],
            'slug' => ['required', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'image' => ['nullable'],
            'published' => ['required'],
        ]);

        BlogPosts::updateOrCreate([
            'user_id' => auth()->id(),
            'post_date' => $this->post_date,
            'title' => $this->title,
            'meta' => $this->meta,
            'content' => $this->content,
            'slug' => $this->slug,
            'image' => $this->image,
            'published' => $this->published,
        ]);

        session()->flash('message', $this->slug ? 'Blog Entry Updated Successfully.' : 'Blog Entry Created Successfully.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $blogPosts = BlogPosts::findOrFail($id);
        // $this->id = $id;
        $this->post_date = $blogPosts->post_date;
        $this->title = $blogPosts->title;
        $this->meta = $blogPosts->meta;
        $this->content = $blogPosts->content;
        $this->slug = $blogPosts->slug;
        $this->image = $blogPosts->image;
        $this->published = $blogPosts->published;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        BlogPosts::find($id)->delete();
        session()->flash('message', 'Blog Entry Deleted Successfully.');
    }
}
