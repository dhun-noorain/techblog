<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="px-6 py-4">
        <x-button-link class="d-block float-right" href="{{ route('posts.create') }}">Create Post</x-button-link>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <!-- post form -->
                <form method="POST" action="{{ route('posts.store') }}" class="px-4">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="my-2" />
                    </div>

                    <!-- summary -->
                    <div class="mt-4">
                        <x-input-label for="summary" :value="__('Summary')" />

                        <x-text-area name="summary" id="summary">{{ old('summary') }}</x-text-area>

                        <x-input-error :messages="$errors->get('summary')" class="my-2" />
                    </div>

                    <!-- body -->
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Body')" />

                        <x-text-area name="body" id="body">{{ old('body') }}</x-text-area>

                        <x-input-error :messages="$errors->get('body')" class="my-2" />
                    </div>

                    <!-- tags -->
                    <div>
                        <x-input-label for="tags" :value="__('Tags')" />
                        <x-text-input id="tags" class="block mt-1 w-full" type="text" name="tags"
                            :value="old('tags')" required autofocus />
                        <x-input-error :messages="$errors->get('tags')" class="my-2" />
                    </div>

                    <x-primary-button class="my-4">Post</x-primary-button>
                </form>
                <!-- end form -->
            </div>
        </div>
    </div>
</x-app-layout>
<x-head.tinymce-config></x-head.tinymce-config>
