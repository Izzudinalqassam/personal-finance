<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
              integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" />
        <!-- Landing CSS -->
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    </head>
    <body class="min-h-screen gradient-bg antialiased overflow-hidden">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Main gradient orbs -->
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-blue-400/20 to-purple-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-r from-indigo-400/10 to-purple-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            
            <!-- Additional floating elements -->
            <div class="absolute top-20 left-20 w-32 h-32 bg-gradient-to-br from-yellow-400/15 to-orange-400/15 rounded-full blur-2xl animate-bounce" style="animation-duration: 3s;"></div>
            <div class="absolute bottom-20 right-20 w-24 h-24 bg-gradient-to-br from-green-400/15 to-blue-400/15 rounded-full blur-2xl animate-bounce" style="animation-duration: 4s; animation-delay: 1.5s;"></div>
            
            <!-- Geometric shapes -->
            <div class="absolute top-1/4 right-1/4 w-16 h-16 border border-white/10 rotate-45 animate-spin" style="animation-duration: 20s;"></div>
            <div class="absolute bottom-1/4 left-1/4 w-12 h-12 border border-purple-300/20 rounded-full animate-ping" style="animation-duration: 3s;"></div>
            
            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 opacity-5">
                <div class="w-full h-full" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.3) 1px, transparent 0); background-size: 50px 50px;"></div>
            </div>
        </div>
        
        <div class="relative z-10 flex min-h-screen flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="w-full max-w-md">
                <!-- Logo Section -->
                
                <!-- Auth Form Container -->
                <div class="glass-effect backdrop-blur-2xl border border-white/20 rounded-3xl p-8 shadow-2xl">
                    {{ $slot }}
                </div>
                
                <!-- Back to Home Link -->
                <div class="text-center mt-6">
                    <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition-colors duration-300 text-sm inline-flex items-center gap-2" wire:navigate>
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
