<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="px-6 py-4">
        <x-button-link class="d-block float-right" href="{{ route('posts.index') }}">Back to Posts</x-button-link>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- post form -->
                <form method="POST" action="{{route('posts.update', $post['id'])}}" class="px-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            value="{{ $post['title'] }}" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="my-2" />
                    </div>

                    <!-- summary -->
                    <div class="mt-4">
                        <x-input-label for="summary" :value="__('Summary')" />

                        <x-text-area name="summary" id="summary">{{ $post['summary'] }}</x-text-area>

                        <x-input-error :messages="$errors->get('summary')" class="my-2" />
                    </div>

                    <!-- body -->
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Body')" />

                        <x-text-area name="body" id="body">{{ $post['body'] }}</x-text-area>
                        <x-input-error :messages="$errors->get('body')" class="my-2" />
                    </div>

                    <!-- tags -->
                    <div>
                        <x-input-label for="tags" :value="__('Tags')" />
                        <x-text-input id="tags" class="block mt-1 w-full" type="text" name="tags"
                            value="{{ $post['tags'] }}" required autofocus />
                        <x-input-error :messages="$errors->get('tags')" class="my-2" />
                    </div>

                    <div class="flex justify-between my-6">
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
                <!-- end form -->
            </div>
        </div>
    </div>
</x-app-layout>
<x-head.tinymce-config></x-head.tinymce-config>
