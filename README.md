# Personal Finance Management System

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
  <img src="https://img.shields.io/badge/Filament-4.0-F59E0B?style=for-the-badge&logo=filament&logoColor=white" alt="Filament 4.0">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
  <img src="https://img.shields.io/badge/Livewire-4A5568?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
</div>

## 📋 Deskripsi Proyek

**Personal Finance Management System** adalah aplikasi web modern yang dibangun menggunakan Laravel 11 dan Filament Admin Panel untuk membantu pengguna mengelola keuangan pribadi mereka secara efektif. Sistem ini menyediakan antarmuka yang intuitif untuk melacak pendapatan, pengeluaran, anggaran, dan memberikan wawasan mendalam tentang kebiasaan keuangan.

Aplikasi ini dirancang dengan arsitektur yang bersih, mengikuti prinsip-prinsip SOLID, dan menerapkan best practices dalam pengembangan web modern. Dengan menggunakan teknologi terdepan seperti Laravel 11, Filament v4, dan Livewire, sistem ini memberikan pengalaman pengguna yang responsif dan real-time.

## ✨ Fitur Utama

### 🏦 Manajemen Akun Keuangan
- **Multi-Account Support**: Kelola berbagai jenis akun (checking, savings, credit card, cash, investment, loan)
- **Real-time Balance Tracking**: Pantau saldo akun secara real-time
- **Account Status Management**: Aktifkan/nonaktifkan akun sesuai kebutuhan
- **Currency Support**: Dukungan multi-mata uang

### 📊 Kategori Transaksi
- **Flexible Categorization**: Buat kategori kustom untuk income, expense, dan transfer
- **Visual Icons & Colors**: Personalisasi kategori dengan ikon dan warna
- **Category Analytics**: Analisis pengeluaran berdasarkan kategori

### 💰 Manajemen Transaksi
- **Comprehensive Transaction Types**: Income, expense, dan transfer antar akun
- **Advanced Filtering**: Filter berdasarkan tanggal, kategori, akun, dan jumlah
- **Transaction History**: Riwayat transaksi lengkap dengan pencarian
- **Reference Numbers**: Sistem referensi untuk tracking transaksi
- **Notes & Descriptions**: Catatan detail untuk setiap transaksi

### 📈 Sistem Anggaran (Budget)
- **Flexible Budget Periods**: Daily, weekly, monthly, quarterly, yearly
- **Category-based Budgets**: Anggaran berdasarkan kategori pengeluaran
- **Real-time Monitoring**: Pantau penggunaan anggaran secara real-time
- **Alert System**: Notifikasi ketika mendekati atau melebihi anggaran
- **Progress Tracking**: Visualisasi progress penggunaan anggaran
- **Over-budget Detection**: Deteksi otomatis anggaran yang terlampaui

### 📊 Dashboard & Analytics
- **Financial Overview**: Ringkasan keuangan komprehensif
- **Interactive Charts**: Visualisasi data dengan Chart.js/ApexCharts
- **Key Performance Indicators**: Metrik keuangan penting
- **Trend Analysis**: Analisis tren pengeluaran dan pendapatan
- **Monthly Reports**: Laporan bulanan otomatis
- **Category Breakdown**: Breakdown pengeluaran per kategori

### 🔐 Keamanan & Autentikasi
- **Secure Authentication**: Sistem login yang aman dengan Laravel Sanctum
- **User Management**: Manajemen pengguna dengan role-based access
- **Session Management**: Pengelolaan sesi yang aman
- **CSRF Protection**: Perlindungan terhadap serangan CSRF
- **Data Validation**: Validasi data yang ketat

### 🎨 User Experience
- **Modern UI/UX**: Antarmuka modern dengan Filament v4
- **Responsive Design**: Desain responsif untuk semua perangkat
- **Dark/Light Theme**: Dukungan tema gelap dan terang
- **Real-time Updates**: Update real-time dengan Livewire
- **Intuitive Navigation**: Navigasi yang mudah dipahami

## 🛠️ Teknologi yang Digunakan

- **Backend Framework**: Laravel 11
- **Admin Panel**: Filament v4.0
- **Frontend**: Livewire 3, Alpine.js
- **Database**: SQLite (development), MySQL/PostgreSQL (production)
- **Styling**: Tailwind CSS
- **Charts**: Chart.js / ApexCharts
- **Authentication**: Laravel Sanctum
- **Testing**: PHPUnit, Pest
- **Code Quality**: PHP CS Fixer, PHPStan

## 📦 Persyaratan Sistem

- **PHP**: 8.2 atau lebih tinggi
- **Composer**: 2.0 atau lebih tinggi
- **Node.js**: 18.0 atau lebih tinggi
- **NPM**: 8.0 atau lebih tinggi
- **Database**: SQLite, MySQL 8.0+, atau PostgreSQL 13+
- **Web Server**: Apache 2.4+ atau Nginx 1.18+

## 🚀 Panduan Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Izzudinalqassam/personal-finance.git
cd personal-finance
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Run database migrations
php artisan migrate

# Seed database with sample data (optional)
php artisan db:seed
```

### 5. Build Assets

```bash
# Build frontend assets
npm run build

# Or for development
npm run dev
```

### 6. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite dev server (for development)
npm run dev
```

Aplikasi akan tersedia di `http://localhost:8000`

## 🔧 Konfigurasi

### Database Configuration

Edit file `.env` untuk konfigurasi database:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

# Atau untuk MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=personal_finance
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Mail Configuration

Untuk fitur notifikasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourapp.com
MAIL_FROM_NAME="Personal Finance"
```

## 📖 Petunjuk Penggunaan

### 1. Akses Admin Panel

1. Buka browser dan navigasi ke `http://localhost:8000/admin`
2. Login menggunakan kredensial default:
   - **Email**: `test@example.com`
   - **Password**: `password`

### 2. Setup Akun Keuangan

1. Navigasi ke **Accounts** di sidebar
2. Klik **New Account** untuk membuat akun baru
3. Isi informasi akun:
   - Nama akun (contoh: "Bank BCA", "Dompet", "Kartu Kredit")
   - Tipe akun (checking, savings, credit_card, cash, investment, loan)
   - Saldo awal
   - Mata uang
   - Deskripsi (opsional)

### 3. Buat Kategori Transaksi

1. Navigasi ke **Categories**
2. Klik **New Category**
3. Tentukan:
   - Nama kategori (contoh: "Makanan", "Transport", "Gaji")
   - Tipe (income, expense, transfer)
   - Warna dan ikon untuk identifikasi visual

### 4. Catat Transaksi

1. Navigasi ke **Transactions**
2. Klik **New Transaction**
3. Pilih tipe transaksi:
   - **Income**: Pendapatan (gaji, bonus, dll)
   - **Expense**: Pengeluaran (makanan, transport, dll)
   - **Transfer**: Transfer antar akun
4. Isi detail transaksi dan simpan

### 5. Setup Anggaran

1. Navigasi ke **Budgets**
2. Klik **New Budget**
3. Konfigurasi anggaran:
   - Nama anggaran
   - Kategori yang akan dianggarkan
   - Jumlah anggaran
   - Periode (bulanan, mingguan, dll)
   - Threshold alert (opsional)

### 6. Monitor Dashboard

1. Kembali ke **Dashboard** untuk melihat:
   - Ringkasan keuangan
   - Chart tren pengeluaran
   - Status anggaran
   - Transaksi terbaru

## 🧪 Testing

### Menjalankan Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run tests with coverage
php artisan test --coverage
```

### Test Database

Untuk testing, aplikasi menggunakan database in-memory SQLite:

```bash
# Setup test database
php artisan migrate --env=testing
```

## 🔍 Code Quality

### PHP CS Fixer

```bash
# Check code style
vendor/bin/php-cs-fixer fix --dry-run --diff

# Fix code style
vendor/bin/php-cs-fixer fix
```

### PHPStan

```bash
# Run static analysis
vendor/bin/phpstan analyse
```

## 🚀 Deployment

### Production Setup

1. **Server Requirements**:
   - PHP 8.2+ dengan ekstensi yang diperlukan
   - Composer
   - Web server (Apache/Nginx)
   - Database server (MySQL/PostgreSQL)

2. **Environment Configuration**:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

3. **Optimization Commands**:
   ```bash
   # Cache configuration
   php artisan config:cache
   
   # Cache routes
   php artisan route:cache
   
   # Cache views
   php artisan view:cache
   
   # Optimize autoloader
   composer install --optimize-autoloader --no-dev
   ```

### Docker Deployment

Proyek ini juga dapat di-deploy menggunakan Docker:

```bash
# Build Docker image
docker build -t personal-finance .

# Run container
docker run -p 8000:8000 personal-finance
```

## 🤝 Kontribusi

Kami menyambut kontribusi dari komunitas! Berikut cara berkontribusi:

### 1. Fork Repository

1. Fork repository ini ke akun GitHub Anda
2. Clone fork ke lokal:
   ```bash
   git clone https://github.com/your-username/personal-finance.git
   ```

### 2. Setup Development Environment

1. Ikuti panduan instalasi di atas
2. Buat branch baru untuk fitur/perbaikan:
   ```bash
   git checkout -b feature/nama-fitur
   ```

### 3. Development Guidelines

- **Code Style**: Ikuti PSR-12 coding standards
- **Testing**: Tulis tests untuk fitur baru
- **Documentation**: Update dokumentasi jika diperlukan
- **Commit Messages**: Gunakan conventional commits:
  ```
  feat: add budget alert notifications
  fix: resolve transaction validation issue
  docs: update installation guide
  ```

### 4. Pull Request Process

1. Pastikan semua tests passing:
   ```bash
   php artisan test
   ```

2. Check code quality:
   ```bash
   vendor/bin/php-cs-fixer fix
   vendor/bin/phpstan analyse
   ```

3. Commit dan push changes:
   ```bash
   git add .
   git commit -m "feat: add new feature"
   git push origin feature/nama-fitur
   ```

4. Buat Pull Request dengan deskripsi yang jelas

### 5. Areas for Contribution

- 🐛 **Bug Fixes**: Perbaikan bug yang ditemukan
- ✨ **New Features**: Fitur baru seperti:
  - Export data ke Excel/PDF
  - Integrasi dengan bank APIs
  - Mobile app dengan API
  - Advanced reporting
  - Multi-currency support
- 📚 **Documentation**: Perbaikan dan penambahan dokumentasi
- 🧪 **Testing**: Penambahan test coverage
- 🎨 **UI/UX**: Perbaikan antarmuka pengguna
- 🔧 **Performance**: Optimisasi performa

### 6. Code Review Process

Semua Pull Request akan melalui code review untuk memastikan:
- Kualitas kode sesuai standar
- Tidak ada breaking changes
- Tests adequate dan passing
- Dokumentasi up-to-date

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE). Anda bebas untuk menggunakan, memodifikasi, dan mendistribusikan kode ini sesuai dengan ketentuan lisensi.

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP Framework for Web Artisans
- [Filament](https://filamentphp.com/) - Beautiful admin panels for Laravel
- [Livewire](https://livewire.laravel.com/) - Full-stack framework for Laravel
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Alpine.js](https://alpinejs.dev/) - Lightweight JavaScript framework

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

1. **Issues**: Buat issue di [GitHub Issues](https://github.com/Izzudinalqassam/personal-finance/issues)
2. **Discussions**: Gunakan [GitHub Discussions](https://github.com/Izzudinalqassam/personal-finance/discussions) untuk pertanyaan umum
3. **Email**: Hubungi maintainer di email yang tercantum di profil GitHub

---

<div align="center">
  <p>Dibuat dengan ❤️ menggunakan Laravel dan Filament</p>
  <p>© 2024 Personal Finance Management System</p>
</div>
