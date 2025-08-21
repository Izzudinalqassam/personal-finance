# Context Proyek: Laravel + Livewire Starter Kit

## 1. Tujuan Proyek

Proyek ini adalah **Laravel + Livewire Starter Kit** yang menyediakan titik awal yang robust dan modern untuk membangun aplikasi Laravel dengan frontend Livewire. Tujuan utama proyek ini adalah:

- Menyediakan starter kit resmi Laravel dengan integrasi Livewire 3
- Memberikan alternatif yang lebih sederhana dibandingkan framework SPA berbasis JavaScript seperti React dan Vue
- Memungkinkan pengembangan UI yang dinamis dan reaktif menggunakan PHP
- Menyediakan foundation yang solid untuk tim yang menggunakan Blade templates

## 2. Lingkup Proyek

### Fitur Utama:
- **Sistem Autentikasi Lengkap**: Login, register, forgot password, reset password, email verification
- **Dashboard User**: Halaman dashboard untuk user yang sudah login
- **Pengaturan User**: Profile management, password change, appearance settings
- **UI Components**: Menggunakan Flux UI component library
- **Responsive Design**: Dengan Tailwind CSS
- **Modern Frontend Tooling**: Vite untuk build process

### Batasan:
- Fokus pada Livewire sebagai frontend framework
- Menggunakan SQLite sebagai database default
- Tidak termasuk fitur e-commerce atau CMS yang kompleks
- Starter kit dasar yang perlu dikembangkan lebih lanjut sesuai kebutuhan

## 3. Teknologi yang Digunakan

### Backend:
- **PHP**: ^8.2
- **Laravel Framework**: ^12.0
- **Livewire**: ^3.x (untuk reactive components)
- **Laravel Volt**: ^1.7.0 (untuk single-file Livewire components)
- **SQLite**: Database default

### Frontend:
- **Livewire Flux**: ^2.1.1 (UI component library)
- **Tailwind CSS**: ^4.0.7 (utility-first CSS framework)
- **Vite**: ^7.0.4 (build tool)
- **Axios**: ^1.7.4 (HTTP client)
- **TypeScript**: Support untuk type safety

### Development Tools:
- **Pest**: ^3.8 (testing framework)
- **Laravel Pint**: ^1.18 (code style fixer)
- **Laravel Sail**: ^1.41 (Docker development environment)
- **Faker**: ^1.23 (data generation untuk testing)

## 4. Arsitektur

### Struktur Aplikasi:
```
app/
├── Http/Controllers/     # Traditional controllers
├── Livewire/Actions/     # Livewire action classes
├── Models/               # Eloquent models
└── Providers/            # Service providers

resources/views/
├── components/           # Blade components
├── livewire/            # Livewire/Volt components
├── flux/                # Flux UI customizations
└── partials/            # Reusable view partials

routes/
├── web.php              # Web routes
└── auth.php             # Authentication routes
```

### Komponen Utama:
- **Livewire Components**: Untuk interaktivitas frontend
- **Volt Components**: Single-file Livewire components
- **Flux UI**: Pre-built UI components
- **Blade Templates**: Untuk layout dan struktur HTML
- **Eloquent Models**: Untuk data management

### Pola Arsitektur:
- **MVC Pattern**: Model-View-Controller dengan Livewire enhancement
- **Component-Based**: Menggunakan Livewire components untuk UI interaktif
- **Single-File Components**: Dengan Laravel Volt

## 5. Dependensi

### Dependensi Utama:
- **Laravel Framework**: Core framework
- **Livewire**: Untuk reactive components
- **Livewire Flux**: UI component library
- **Laravel Volt**: Single-file Livewire components
- **Tailwind CSS**: Styling framework

### Dependensi Development:
- **Pest**: Testing framework
- **Laravel Sail**: Docker environment
- **Laravel Pint**: Code formatting
- **Vite**: Asset bundling

### Layanan Eksternal:
- **Email Service**: Konfigurasi untuk email notifications (default: log)
- **Cache**: Database-based caching
- **Session**: Database-based sessions
- **Queue**: Database-based job queues

## 6. Instruksi Setup/Running (Tingkat Tinggi)

### Prerequisites:
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan npm
- SQLite (atau database lain sesuai konfigurasi)

### Langkah Setup:
1. **Clone dan Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**:
   ```bash
   php artisan migrate
   ```

4. **Build Assets**:
   ```bash
   npm run build    # untuk production
   npm run dev      # untuk development
   ```

5. **Run Application**:
   ```bash
   php artisan serve
   ```

### Development Workflow:
- Gunakan `npm run dev` untuk hot reloading selama development
- Gunakan `php artisan serve` untuk menjalankan server development
- Gunakan `php artisan test` atau `vendor/bin/pest` untuk menjalankan tests

## 7. Catatan Penting Lainnya

### Asumsi:
- Developer familiar dengan Laravel ecosystem
- Menggunakan Livewire sebagai primary frontend technology
- SQLite sebagai database default (dapat diubah ke MySQL/PostgreSQL)

### Batasan:
- Starter kit ini adalah foundation dasar yang perlu dikustomisasi
- Tidak termasuk advanced features seperti API, multi-tenancy, atau complex business logic
- UI components terbatas pada yang disediakan Flux UI

### Area yang Perlu Diperhatikan:
- **Security**: Pastikan konfigurasi production security yang proper
- **Performance**: Optimasi untuk production environment
- **Scalability**: Pertimbangkan database dan caching strategy untuk aplikasi besar
- **Testing**: Tambahkan test coverage untuk fitur custom yang dikembangkan

### Konfigurasi Khusus:
- **Database**: Menggunakan SQLite untuk development, pertimbangkan PostgreSQL/MySQL untuk production
- **Mail**: Default menggunakan log driver, konfigurasi SMTP untuk production
- **Cache**: Menggunakan database cache, pertimbangkan Redis untuk performance yang lebih baik

### Dokumentasi Tambahan:
- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com)
- [Flux UI Documentation](https://fluxui.dev)
- [Tailwind CSS Documentation](https://tailwindcss.com)