{{-- Features Section Component --}}
<section id="portfolio" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="section-title text-4xl md:text-5xl font-bold gradient-text mb-6">Fitur Unggulan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kelola keuangan Anda dengan fitur-fitur canggih yang dirancang untuk kemudahan dan efisiensi.
            </p>
        </div>
        
        {{-- Filter Buttons --}}
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up" data-aos-delay="200">
            <button class="portfolio-filter px-6 py-3 rounded-full bg-purple-600 text-white font-medium transition-all duration-300 hover:bg-purple-700" data-filter="all">
                Semua Fitur
            </button>
            <button class="portfolio-filter px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-purple-600 hover:text-white" data-filter="tracking">
                Pelacakan
            </button>
            <button class="portfolio-filter px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-purple-600 hover:text-white" data-filter="budget">
                Anggaran
            </button>
            <button class="portfolio-filter px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-medium transition-all duration-300 hover:bg-purple-600 hover:text-white" data-filter="reports">
                Laporan
            </button>
        </div>
        
        {{-- Features Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-animation">
            {{-- Feature 1: Expense Tracking --}}
            <div class="portfolio-item bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-category="tracking" data-aos="fade-up">
                <div class="p-8">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-receipt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pelacakan Pengeluaran</h3>
                    <p class="text-gray-600 mb-6">Monitor setiap transaksi harian Anda dengan kategorisasi otomatis dan analisis pola pengeluaran.</p>
                    <div class="flex items-center text-purple-600 font-medium">
                        <span>Pelajari Lebih Lanjut</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
            
            {{-- Feature 2: Budget Planning --}}
            <div class="portfolio-item bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-category="budget" data-aos="fade-up" data-aos-delay="100">
                <div class="p-8">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-calculator text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Perencanaan Anggaran</h3>
                    <p class="text-gray-600 mb-6">Buat dan kelola anggaran bulanan dengan target yang realistis dan notifikasi otomatis.</p>
                    <div class="flex items-center text-purple-600 font-medium">
                        <span>Pelajari Lebih Lanjut</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
            
            {{-- Feature 3: Financial Reports --}}
            <div class="portfolio-item bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-category="reports" data-aos="fade-up" data-aos-delay="200">
                <div class="p-8">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Laporan Keuangan</h3>
                    <p class="text-gray-600 mb-6">Dapatkan laporan komprehensif dengan visualisasi data yang mudah dipahami.</p>
                    <div class="flex items-center text-purple-600 font-medium">
                        <span>Pelajari Lebih Lanjut</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
            
            {{-- Feature 4: Multi Account --}}
            <div class="portfolio-item bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-category="tracking" data-aos="fade-up" data-aos-delay="300">
                <div class="p-8">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-university text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Multi-Akun</h3>
                    <p class="text-gray-600 mb-6">Kelola berbagai rekening bank, e-wallet, dan investasi dalam satu platform terpadu.</p>
                    <div class="flex items-center text-purple-600 font-medium">
                        <span>Pelajari Lebih Lanjut</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
            
            {{-- Feature 5: Financial Goals --}}
            <div class="portfolio-item bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-category="budget" data-aos="fade-up" data-aos-delay="400">
                <div class="p-8">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Target Keuangan</h3>
                    <p class="text-gray-600 mb-6">Tetapkan dan capai tujuan finansial dengan tracking progress dan rekomendasi cerdas.</p>
                    <div class="flex items-center text-purple-600 font-medium">
                        <span>Pelajari Lebih Lanjut</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
            
            {{-- Feature 6: Smart Notifications --}}
            <div class="portfolio-item bg-white rounded-xl shadow-lg overflow-hidden hover-scale" data-category="tracking" data-aos="fade-up" data-aos-delay="500">
                <div class="p-8">
                    <div class="w-16 h-16 gradient-bg rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Notifikasi Cerdas</h3>
                    <p class="text-gray-600 mb-6">Dapatkan pengingat otomatis untuk tagihan, batas anggaran, dan peluang penghematan.</p>
                    <div class="flex items-center text-purple-600 font-medium">
                        <span>Pelajari Lebih Lanjut</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>