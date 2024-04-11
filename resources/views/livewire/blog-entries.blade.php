<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Blog Posts') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                            role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <button wire:click="create()"
                        class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                        Create Blog Entry
                    </button>
                    @if ($isModalOpen)
                        @include('livewire.create')
                    @endif
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">Date</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Slug</th>
                                <th class="px-4 py-2">Published</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogPosts as $blogPostIdx => $blogPost)
                                <tr wire:key={{ $blogPostIdx }}>
                                    <td class="border px-4 py-2">{{ $blogPost->post_date->format('m/d/y') }}</td>
                                    <td class="border px-4 py-2">{{ $blogPost->title }}</td>
                                    <td class="border px-4 py-2">{{ $blogPost->slug }}</td>
                                    <td class="border px-4 py-2">{{ $blogPost->published }}</td>
                                    <td class="border px-4 py-2">
                                        <button wire:click="edit({{ $blogPost->id }})"
                                            class="flex px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Edit</button>
                                        <button wire:click="delete({{ $blogPost->id }})"
                                            class="flex px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="border px-4 py-2" colspan="5">No blog posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
