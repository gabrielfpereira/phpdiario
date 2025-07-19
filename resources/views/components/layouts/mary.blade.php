<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased bg-base-200">
 
    {{-- NAVBAR mobile only --}}
    <x-mary-nav sticky class="lg:hidden">
        <x-slot:brand>
            <div class="ml-5 pt-5">App</div>
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-mary-nav>
 
    {{-- MAIN --}}
    <x-mary-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">
 
            {{-- BRAND --}}
            <div class="ml-5 pt-5">PHP DIÁRIO</div>
 
            {{-- MENU --}}
            <x-mary-menu activate-by-route>
 
                {{-- User --}}
                @if($user = auth()->user())
                    <x-mary-menu-separator />
 
                    <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-mary-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-mary-list-item>
 
                    <x-mary-menu-separator />
                @endif
 
                <x-mary-menu-item title="Hello" icon="o-sparkles" link="/" />
                <x-mary-menu-item title="Categories" icon="o-sparkles" link="/dashboard/categories" />
                <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-mary-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-mary-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-mary-menu-sub>
            </x-mary-menu>
        </x-slot:sidebar>
 
        {{-- The `$slot` goes here --}}
        <x-slot:content>
            <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl bg-base-100 p-4">
                {{ $slot }}
            </div>
        </x-slot:content>
    </x-mary-main>
 
    {{-- Toast --}}
    <x-mary-toast />
</body>
</html>
