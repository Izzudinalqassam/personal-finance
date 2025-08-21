{{-- Navigation Component for Landing Page --}}
<nav class="glass-effect fixed top-0 w-full z-50 transition-all duration-300" id="navbar">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 gradient-bg rounded-lg flex items-center justify-center glow">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <span class="text-2xl font-bold gradient-text">FinanceTracker</span>
            </div>
            
            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Beranda</a>
                <a href="#about" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Tentang</a>
                <a href="#services" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Layanan</a>
                <a href="#portfolio" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Portfolio</a>
                <a href="#testimonials" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Testimoni</a>
                <a href="#contact" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Kontak</a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-medium transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="gradient-bg text-white px-6 py-2 rounded-full hover:shadow-lg transition-all duration-300">
                        Daftar Gratis
                    </a>
                </div>
            </div>
            
            {{-- Mobile Menu Button --}}
            <button class="md:hidden text-gray-700" id="mobile-menu-btn">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        {{-- Mobile Menu --}}
        <div class="md:hidden mt-4 hidden" id="mobile-menu">
            <div class="flex flex-col space-y-4 glass-effect rounded-lg p-6">
                <a href="#home" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Beranda</a>
                <a href="#about" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Tentang</a>
                <a href="#services" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Layanan</a>
                <a href="#portfolio" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Portfolio</a>
                <a href="#testimonials" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Testimoni</a>
                <a href="#contact" class="text-gray-700 hover:text-purple-600 transition-colors font-medium">Kontak</a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-medium transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="gradient-bg text-white px-6 py-2 rounded-full hover:shadow-lg transition-all duration-300">
                        Daftar Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>