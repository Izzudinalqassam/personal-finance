@extends('layouts.landing')

@section('content')
    {{-- Navigation Component --}}
    <x-landing.navigation />
    
    {{-- Hero Section Component --}}
    <x-landing.hero />
    
    {{-- About Section Component --}}
    <x-landing.about />
    
    {{-- Features Section Component --}}
    <x-landing.features />
    
    {{-- Testimonials Section Component --}}
    <x-landing.testimonials />
    
    {{-- Footer Component --}}
    <x-landing.footer />
@endsection