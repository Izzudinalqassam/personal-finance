{{-- Hero Section Component --}}
<section id="home" class="min-h-screen flex items-center gradient-bg relative overflow-hidden above-fold gpu-accelerated">
    {{-- Background Elements --}}
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl floating"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl floating" style="animation-delay: -1s;"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            {{-- Content --}}
            <div class="text-white contain-layout" data-aos="fade-right">
                <h1 class="hero-title text-5xl md:text-6xl font-bold mb-6 leading-tight font-display-swap">
                    Kelola Keuangan
                    <span class="block text-yellow-300">Lebih Mudah</span>
                    dan Terpercaya
                </h1>
                <p class="hero-subtitle text-xl mb-8 text-gray-200 leading-relaxed font-display-swap">
                    Platform manajemen keuangan yang membantu Anda mengatur anggaran, melacak pengeluaran, 
                    dan mencapai tujuan finansial dengan mudah dan aman.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 hover-scale pulse inline-block">
                        <i class="fas fa-chart-line mr-2"></i>
                        Mulai Gratis
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition-all duration-300 inline-block">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk Akun
                    </a>
                </div>
            </div>
            
            {{-- Hero Image/Animation --}}
            <div class="relative" data-aos="fade-left">
                <div class="relative z-10">
                    <div class="glass-effect w-full h-96 rounded-3xl backdrop-blur-2xl border border-white/20 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-laptop-code text-8xl mb-4 floating"></i>
                            <h3 class="text-2xl font-semibold">Teknologi Modern</h3>
                            <p class="text-gray-200 mt-2">Solusi Inovatif untuk Masa Depan</p>
                             {{-- Floating Elements --}}
                            <div class="absolute -top-6 -right-6 w-24 h-24 bg-yellow-300 rounded-full flex items-center justify-center floating">
                                <i class="fas fa-star text-purple-600 text-2xl"></i>
                            </div>
                            <div class="absolute -bottom-6 -left-10 w-32 h-32 bg-white bg-opacity-20 rounded-full flex items-center justify-center floating" style="animation-delay: -2s;">
                                <i class="fas fa-cog text-purple-600 text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <i class="fas fa-chevron-down text-2xl"></i>
    </div>
</section>