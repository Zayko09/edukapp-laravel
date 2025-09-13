<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        :root {
            --color-primary: #ef3b2d;
            --color-link: #e57373;
            --bg-light: #f5f5f5;
            --bg-dark: #2d3748;
            --text-light: #4a5568;
            --text-dark: #a0aec0;
            --border-light: #e2e8f0;
            --border-dark: #4a5568;
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(255, 255, 255, 0.1);
        }
        
        @media (prefers-color-scheme: dark) {
            .dark {
                background-color: var(--bg-dark);
                color: var(--text-dark);
            }
            .dark a {
                color: var(--color-link);
            }
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="antialiased">
    <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline dark:text-gray-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <img src="{{ asset('img/laravel-logo.svg') }}" alt="Laravel Logo" class="h-16">
            </div>
    
            <div class="mt-8 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13.5m0-13.5c-4.145 0-7.5 3.178-7.5 7.051 0 4.286 4.608 7.75 7.5 7.75 2.892 0 7.5-3.464 7.5-7.75 0-3.873-3.355-7.051-7.5-7.051z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience, we recommend reading all of the documentation from beginning to end.
                            </div>
                        </div>
                    </div>
    
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M15 10l4.72-4.72a.75.75 0 011.06 1.06L18 12l2.78 2.78a.75.75 0 01-1.06 1.06l-4.72-4.72z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out for a fun and engaging way to learn the framework and its ecosystem.
                            </div>
                        </div>
                    </div>
    
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel News is a community driven portal that aggregates all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                            </div>
                        </div>
                    </div>
    
                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M7 12a2 2 0 11-4 0 2 2 0 014 0zm0 6a2 2 0 11-4 0 2 2 0 014 0zm0-12a2 2 0 11-4 0 2 2 0 014 0zm10 6a2 2 0 11-4 0 2 2 0 014 0zm0 6a2 2 0 11-4 0 2 2 0 014 0zM17 12a2 2 0 11-4 0 2 2 0 014 0zm-10 0a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://cashier.laravel.com" class="underline">Cashier</a>, <a href="https://dusk.laravel.com" class="underline">Dusk</a>, <a href="https://echo.laravel.com" class="underline">Echo</a>, <a href="https://horizon.laravel.com" class="underline">Horizon</a>, <a href="https://sanctum.laravel.com" class="underline">Sanctum</a>, <a href="https://telescope.laravel.com" class="underline">Telescope</a>, and more.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-gray-500 sm:text-left">
                    <div class="flex items-center">
                        <a href="https://shop.laravel.com" class="ml-1 underline">
                            Shop
                        </a>
                        <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                            Sponsor
                        </a>
                    </div>
                </div>
    
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</body>
</html>