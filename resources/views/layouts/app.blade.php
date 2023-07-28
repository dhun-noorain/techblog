<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <!-- footer -->
    @guest
    <footer class="relative z-10 bg-white pt-20 pb-10 lg:pt-[120px] lg:pb-20">
      <div class="container mx-auto">
        <div class="-mx-4 flex flex-wrap justify-between items-center text-center md:text-left">
          <div class="w-full px-4 md:w-1/2">
            <div class="mb-10 w-full">
              <a
                href="javascript:void(0)"
                class="mb-6 inline-block max-w-[160px]"
              >
                <img
                  src="assets/images/logo/logo.svg"
                  alt="logo"
                  class="max-w-full"
                />
              </a>
              <p class="mb-7 text-base text-body-color">
                For support and enquiries, contact our admin through.
              </p>
              <p class="flex items-center justify-center md:justify-start text-sm font-medium text-dark">
                <span class="mr-3 text-primary">
                  <x-svg.phone></x-svg.phone>
                </span>
                <span>+012 (345) 678 99</span>
              </p>
            </div>
          </div>
          <div class="w-full px-4 md:w-1/2">
            <div class="mb-10 w-full md:text-right">
              <h4 class="mb-9 text-lg font-semibold text-dark">Follow Us On</h4>
              <div class="mb-6 flex items-center justify-center md:justify-end">
                <x-link>
                  <x-svg.facebook></x-svg.facebook>
                </x-link>
                <x-link>
                  <x-svg.twitter></x-svg.twitter>
                </x-link>
                <x-link>
                  <x-svg.youtube></x-svg.youtube>
                </x-link>
                <x-link>
                  <x-svg.linkedin></x-svg.linkedin>
                </x-link>
              </div>
              <p class="text-base text-body-color">&copy; 2025 TailGrids</p>
            </div>
          </div>
        </div>
      </div>

      <div>
        <span class="absolute left-0 bottom-0 z-[-1]">
          <x-svg.circle></x-svg.circle>
        </span>
      </div>
    </footer>
    @endguest
</html>
