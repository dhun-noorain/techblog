<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @auth
            <a href="{{ route('posts.index') }}"> {{ __('Posts') }} </a>
            @else
            <a href="{{ route('home') }}"> {{ __('Posts') }} </a>
            @endauth 
        </h2>
    </x-slot>

    @auth
    <div class="px-6 py-4 my-4">
        <x-button-link class="d-block float-right" href="{{ route('posts.create') }}">Create Post</x-button-link>
    </div>
    @endauth

    <section class="bg-white dark:bg-gray-900 my-8">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            @forelse($posts as $post)
            @if($post->user->is(auth()->user()) || auth()->guest())
            <article 
                class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 my-8">
                <div class="flex justify-between items-center flex-col sm:flex-row mb-5 text-gray-500">
                    <div class="flex items-center space-x-4 flex-col sm:flex-row">
                        <img class="w-7 h-7 rounded-full my-2 sm:my-0"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                            alt="Bonnie Green avatar" />
                        <span class="font-medium dark:text-white flex justify-between items-center my-2 sm:my-0">
                            {{ $post->user->name }}
                            <x-svg.pen></x-pen>
                        </span>
                    </div>
                    <span class="text-sm">{{ $post['created_at'] }}</span>
                </div>
                @auth
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <a href="{{ route('posts.edit', $post['id']) }}">{{ $post['title'] }}</a>
                </h2>
                @else
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <a href="{{ route('posts.show', $post['id']) }}">{{ $post['title'] }}</a>
                </h2>
                @endauth
                <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                    {{ $post['summary'] }}
                </p>
                <div class="flex justify-between items-center sm:flex-row flex-col">
                    <div class="my-2 sm:my-0">
                        @php
                        $tags = explode(',', $post['tags']);
                        $tags = array_filter($tags, fn($value) => !is_null($value) && $value != '');
                        @endphp
                        @foreach($tags as $tag)
                        <a href="{{ route('search', trim($tag)) }}"
                            class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800 text-transform:capitalize">
                            <x-svg.tag></x-tag>
                            {{ $tag }}
                        </a>
                        @endforeach
                    </div>
                    @auth
                    <!-- ====== Modal Section Start -->
                    <section x-data="{modalOpen: false}" id="modal" class="my-2 sm:my-0">
                        <x-secondary-button @click="modalOpen = true" data-toggle="modal">Delete</x-primary-button>
                            <div x-show="modalOpen" x-transition
                                class="fixed top-0 left-0 flex h-full min-h-screen w-full items-center justify-center bg-black bg-opacity-90 px-4 py-5">
                                <div @click.outside="modalOpen = false"
                                    class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px]">
                                    <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl">
                                        Are you sure you want to delete this post?
                                    </h3>
                                    <div class="-mx-3 flex flex-wrap">
                                        <div class="w-1/2 px-3">
                                            <button @click="modalOpen = false"
                                                class="text-dark block w-full rounded-lg border border-[#E9EDF9] p-3 text-center text-base font-medium transition hover:border-green-600 hover:bg-green-600 hover:text-white">
                                                Cancel
                                            </button>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <form action="{{ route('posts.destroy', $post
                                                ['id']) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 border-red-600 block w-full rounded-lg border p-3 text-center text-base font-medium text-white transition hover:bg-opacity-90">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    @else
                    <a href="{{ route('posts.show', $post['id']) }}"
                        class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline my-2 sm:my-0">
                        Read more
                        <x-svg.right-arrow></x-right-arrow>
                    </a>
                    <!-- ====== Modal Section End -->
                    @endauth
                </div>
            </article>
            @endif
            @empty
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-[80vw] mx-auto p-6">
                <p class="text-blue-400">
                    <strong>Oops!</strong> No post available.
                </p>
            </div>
            @endforelse
            <!-- display pagination links -->
            {{ $posts->links() }}
        </div>
    </section>
</x-app-layout>
