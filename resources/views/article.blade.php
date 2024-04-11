@extends('layouts.app')

@section('title', $post->title)

<x-slot name="content">
    <h1>{{ $post->title }}</h1>
    <div>
        {{ $post->content }}
    </div>
</x-slot>
