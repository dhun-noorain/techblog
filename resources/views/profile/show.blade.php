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
  <section class="overflow-hidden pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]">
    <div class="container mx-auto">
      <div class="-mx-4 flex flex-wrap items-center justify-between">
        <div class="w-full px-4 lg:w-6/12">
          <div class="-mx-3 flex items-center sm:-mx-4">
            <div class="w-full px-3 sm:px-4 xl:w-3/4">
              <div class="relative z-10 my-4">
                <img
                  src="assets/images/about/image-3.jpg"
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
              It is a long established fact that a reader will be distracted
              by the readable content of a page when looking at its layout.
              The point of using Lorem Ipsum is that it has a more-or-less.
            </p>
            <p class="mb-12 text-base text-body-color">
              A domain name is one of the first steps to establishing your
              brand. Secure a consistent brand image with a domain name that
              matches your business.
            </p>
            <a
              href="javascript:void(0)"
              class="inline-flex items-center justify-center rounded-lg bg-primary py-4 px-10 text-center text-base font-normal text-white hover:bg-opacity-90 lg:px-8 xl:px-10"
            >
              Get Started
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>