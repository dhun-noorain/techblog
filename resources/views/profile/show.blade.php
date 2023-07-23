<x-app-layout>
  <x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __($user->name) }}
    </h1>
  </x-slot>
  <div class="px-6 py-4">
    <x-button-link class="d-block float-right" href="{{ route('home') }}">
      Back to Post
    </x-button-link>
  </div>
  <section class="pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]">
    <div class="container mx-auto">
      <div class="flex flex-wrap items-center justify-around">
        <div class="w-full px-4 lg:w-6/12">
          <div class="-mx-3 flex items-center sm:-mx-4">
            <div class="w-full px-3 sm:px-4 xl:w-3/4">
              <div class="relative z-10 my-4">
                <img
                  src="{{ asset('storage/userImg/' . $user->picture) }}"
                  alt="Admin Image"
                  class="w-full rounded-2xl"
                />
                <span class="absolute -right-7 -bottom-7 z-[-1]">
                  <x-svg.profile-circle></x-svg.profile-circle>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full px-4 lg:w-1/2 xl:w-5/12">
          <div class="mt-10 lg:mt-0">
            <span class="mb-2 block text-lg font-semibold text-primary">
              Hi there,
            </span>
            <h2 class="mb-8 text-3xl font-bold text-dark sm:text-4xl">
              I am {{ $user->name }}
            </h2>
            <p class="mb-8 text-base text-body-color">
              {{ $user->bio }}
            </p>
            <section>
              Follow me on social media...
              here
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>