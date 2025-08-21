{{-- Footer Component --}}
<footer class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            {{-- Company Info --}}
            <div class="lg:col-span-2">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold">FinanceTracker</span>
                </div>
                <p class="text-gray-300 mb-6 max-w-md">
                    Platform manajemen keuangan terdepan yang membantu Anda mengontrol, merencanakan, dan mengoptimalkan keuangan personal maupun bisnis dengan mudah dan aman.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            {{-- Quick Links --}}
            <div>
                <h3 class="text-lg font-semibold mb-6">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="#home" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#about" class="text-gray-300 hover:text-white transition-colors">Tentang</a></li>
                    <li><a href="#features" class="text-gray-300 hover:text-white transition-colors">Fitur</a></li>
                    <li><a href="#testimonials" class="text-gray-300 hover:text-white transition-colors">Testimoni</a></li>
                    <li><a href="#contact" class="text-gray-300 hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>
            
            {{-- Support --}}
            <div>
                <h3 class="text-lg font-semibold mb-6">Dukungan</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Pusat Bantuan</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Hubungi Kami</a></li>
                </ul>
            </div>
        </div>
        
        {{-- Contact Info --}}
        <div class="border-t border-gray-800 pt-8 mb-8">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-envelope text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Email</h4>
                        <p class="text-gray-300">support@financetracker.com</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Telepon</h4>
                        <p class="text-gray-300">+62 21 1234 5678</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold">Alamat</h4>
                        <p class="text-gray-300">Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Newsletter --}}
        <div class="bg-gray-800 rounded-xl p-8 mb-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">Dapatkan Update Terbaru</h3>
                <p class="text-gray-300 mb-6">Berlangganan newsletter kami untuk mendapatkan tips keuangan dan update fitur terbaru.</p>
                <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-4 py-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 border border-gray-600 focus:border-purple-500 focus:outline-none">
                    <button class="px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                        Berlangganan
                    </button>
                </div>
            </div>
        </div>
        
        {{-- Copyright --}}
        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-gray-400">
                &copy; {{ date('Y') }} FinanceTracker. Semua hak cipta dilindungi. 
                <span class="text-purple-400">Dibuat dengan ❤️ untuk masa depan keuangan yang lebih baik.</span>
            </p>
        </div>
    </div>
</footer>

{{-- Back to Top Button --}}
<button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 opacity-0 invisible z-50">
    <i class="fas fa-arrow-up"></i>
</button>

{{-- Back to Top Script --}}
<script>
    // Back to top functionality
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible');
            backToTopButton.classList.remove('opacity-100', 'visible');
        }
    });
    
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>