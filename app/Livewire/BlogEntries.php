<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPosts;
use App\Models\Category;
use App\Models\Tag;

class BlogEntries extends Component
{
    public $blogPosts, $post_date, $title, $meta, $content, $slug, $image, $categories, $tags, $published;
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
        $this->slug = '';
        $this->image = '';
        $this->meta = '';
        $this->content = '';
        $this->categories = '';
        $this->tags = '';
        $this->published = '';
    }

    public function store()
    {
        $categoriesArray = explode(',', $this->categories);
        $tagsArray = explode(',', $this->tags);

        $categoryIds = [];
        foreach ($categoriesArray as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $categoryIds[] = $category->id;
        }

        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $this->validate([
            'post_date' => ['required'],
            'title' => ['required'],
            'slug' => ['required', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'image' => ['nullable'],
            'meta' => ['nullable'],
            'content' => ['required'],
            'published' => ['required'],
        ]);

        $article = BlogPosts::updateOrCreate([
            'user_id' => auth()->id(),
            'post_date' => $this->post_date,
            'image' => $this->image,
            'title' => $this->title,
            'slug' => $this->slug,
            'meta' => $this->meta,
            'content' => $this->content,
            'published' => $this->published,
        ]);

        $article->categories()->sync($categoryIds);
        $article->tags()->sync($tagIds);

        session()->flash('message', $this->slug ? 'Blog Entry Updated Successfully.' : 'Blog Entry Created Successfully.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $blogPosts = BlogPosts::with('categories','tags')->findOrFail($id);
        // $this->id = $id;
        $this->post_date = $blogPosts->post_date;
        $this->title = $blogPosts->title;
        $this->slug = $blogPosts->slug;
        $this->image = $blogPosts->image;
        $this->meta = $blogPosts->meta;
        $this->content = $blogPosts->content;
        $this->categories = implode(',', $blogPosts->categories->pluck('name')->toArray());
        $this->tags = implode(',', $blogPosts->tags->pluck('name')->toArray());
        $this->published = $blogPosts->published;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        BlogPosts::find($id)->delete();
        session()->flash('message', 'Blog Entry Deleted Successfully.');
    }
}
