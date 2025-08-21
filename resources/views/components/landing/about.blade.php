{{-- About Section Component --}}
<section id="about" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="section-title text-4xl md:text-5xl font-bold gradient-text mb-6">Tentang FinanceTracker</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Platform manajemen keuangan yang dirancang untuk membantu individu dan bisnis 
                mengelola keuangan dengan lebih efektif dan aman.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12 items-center">
            {{-- Content --}}
            <div data-aos="fade-right">
                <h3 class="text-3xl font-bold text-gray-800 mb-6">Mengapa Memilih FinanceTracker?</h3>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center flex-shrink-0 rotate-on-hover">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Analisis Keuangan Mendalam</h4>
                            <p class="text-gray-600">Dapatkan insight mendalam tentang pola pengeluaran dan pemasukan Anda dengan visualisasi yang mudah dipahami.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Keamanan Data Terjamin</h4>
                            <p class="text-gray-600">Data keuangan Anda dilindungi dengan enkripsi tingkat bank dan sistem keamanan berlapis.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-mobile-alt text-white"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Akses Multi-Platform</h4>
                            <p class="text-gray-600">Akses aplikasi dari mana saja melalui web, mobile, atau desktop dengan sinkronisasi real-time.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Statistics --}}
            <div data-aos="fade-left">
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center p-6 bg-white rounded-xl shadow-lg hover-scale">
                        <div class="text-4xl font-bold gradient-text mb-2">15K+</div>
                        <div class="text-gray-600">Pengguna Aktif</div>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-lg hover-scale">
                        <div class="text-4xl font-bold gradient-text mb-2">2M+</div>
                        <div class="text-gray-600">Transaksi Tercatat</div>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-lg hover-scale">
                        <div class="text-4xl font-bold gradient-text mb-2">99.9%</div>
                        <div class="text-gray-600">Uptime</div>
                    </div>
                    <div class="text-center p-6 bg-white rounded-xl shadow-lg hover-scale">
                        <div class="text-4xl font-bold gradient-text mb-2">4.9/5</div>
                        <div class="text-gray-600">Rating Pengguna</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>