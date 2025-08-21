<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'FinanceTracker') }} - Platform Manajemen Keuangan Terdepan</title>
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="FinanceTracker adalah platform manajemen keuangan terdepan yang membantu Anda mengontrol, merencanakan, dan mengoptimalkan keuangan personal maupun bisnis dengan mudah dan aman.">
    <meta name="keywords" content="manajemen keuangan, budgeting, financial planning, expense tracking, personal finance">
    <meta name="author" content="FinanceTracker">
    
    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="FinanceTracker - Platform Manajemen Keuangan Terdepan">
    <meta property="og:description" content="Kelola keuangan Anda dengan mudah dan aman bersama FinanceTracker">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    {{-- AOS Animation Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])
    
    {{-- Custom Landing CSS --}}
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    
    {{-- Additional Styles --}}
    @stack('styles')
</head>
<body class="font-inter antialiased">
    {{-- Page Content --}}
    @yield('content')
    
    {{-- Vite Scripts --}}
    @vite(['resources/js/app.js'])
    
    {{-- AOS Animation Library --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    {{-- Initialize AOS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    </script>
    
    {{-- Additional Scripts --}}
    @stack('scripts')
</body>
</html>