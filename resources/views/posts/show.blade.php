<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($post['title']) }}
        </h1>
    </x-slot>

    <div class="px-6 py-4">
        <x-button-link class="d-block float-right" href="{{ route('home') }}">
					Back to Posts
				</x-button-link>
    </div>

  <article class="w-full md:max-w-[80%] px-6 py-24 mx-auto space-y-16 dark:bg-gray-800 dark:text-gray-50">
		<div class="w-full mx-auto space-y-4">
			<h2 class="text-4xl font-bold leading-none">
				{{ $post->title }}
			</h2>
			<div class="flex flex-wrap space-x-2 text-sm dark:text-gray-400">
				@php
				$tags = explode(',', $post['tags']);
				$tags = array_filter($tags, fn($value) => !is_null($value) && $value != '');
				@endphp
				@foreach($tags as $tag)
				<a href="{{ route('search', trim($tag)) }}" class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 text-transform:capitalize hover:underline">
          <x-svg.tag></x-svg.tag>{{ $tag }}
				</a>
				@endforeach
			</div>
			<p class="text-sm dark:text-gray-400">by
				<a href="{{ route('profile.show', $post->user->id) }}" target="_blank" rel="noopener noreferrer" class="hover:underline dark:text-violet-400">
					<span>{{ $post->user->name }}</span>
				</a>on
				<time datetime="{{ $post->created_at }}">
					{{ $post->created_at->format('d M, Y') }}
					at
					{{ $post->created_at->format('h:ia') }}
				</time>
			</p>
		</div>
		<div class="dark:text-gray-100">
			<p>
				{!! $post->body !!}
			</p>
		</div>
		<div>
			<h3 class="mb-4">Share on:</h3>
			<div class="mb-6 flex items-center justify-start">
				<x-svg.facebook></x-svg.facebook>
				<x-svg.twitter></x-svg.twitter>
				<x-svg.linkedin></x-svg.linkedin>
			</div>
		</div>
	</article>
	<div class="w-full md:max-w-[80%] px-6 py-4 mx-auto space-y-16">
		<div class="space-y-2">
			<h3 class="text-lg font-semibold">Related posts</h3>
			<ul class="ml-4 space-y-1 list-disc">
				@foreach($related as $relPost)
				<li>
					<a href="{{ route('posts.show', $relPost->id) }}" class="hover:underline">
						{{ $relPost->title }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</x-app-layout>
