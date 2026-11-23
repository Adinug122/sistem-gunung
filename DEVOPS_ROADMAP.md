# CampRent DevOps Learning Roadmap

Dokumen ini berisi rencana pengembangan CampRent dari aplikasi Laravel sederhana menjadi DevOps Learning Lab yang layak ditampilkan sebagai portfolio Full-Stack Developer dengan kemampuan DevOps dasar hingga menengah.

---

## Status Saat Ini (Audit)

CampRent adalah aplikasi rental peralatan outdoor dengan:
- Laravel 13, PHP 8.3+, MySQL
- Blade + Tailwind CSS + Vite
- Auth (Laravel Breeze) + Role-based access (admin/pelanggan)
- CRUD produk, kategori, sewa, pembayaran
- Pest PHP untuk testing
- **Belum ada:** Docker, Nginx, CI/CD, Redis (aktif), Queue (aktif), backup, monitoring

---

## Roadmap Tingkat Pembelajaran

### Fase 1: Fundamental (Minggu 1–3)

Tujuan: Membangun fondasi infrastruktur yang dapat dijalankan ulang di manapun.

| No | Topik | Tujuan | Teknologi | Kriteria Keberhasilan | Bukti Portfolio |
|----|-------|--------|-----------|----------------------|-----------------|
| 1.1 | Linux Server Basics | Memahami perintah dasar Linux, file permission, user management | Ubuntu/Debian, Bash | Bisa navigasi terminal, mengatur permission file, mengelola user | Screenshot terminal, catatan perintah Linux |
| 1.2 | Docker & Docker Compose | Containerisasi CampRent agar bisa jalan tanpa instalasi PHP/MySQL manual | Docker, Docker Compose | `docker-compose up` menjalankan Laravel + MySQL + Redis sekaligus | Dockerfile, docker-compose.yml, dokumentasi cara run |
| 1.3 | Environment Configuration | Memisahkan konfigurasi development dan production | .env, .env.example | Ada `.env` untuk lokal dan `.env.production` untuk server | File .env.example, .env.production, dokumentasi env var |
| 1.4 | Nginx Reverse Proxy | Menjadikan Nginx sebagai web server production (bukan `php artisan serve`) | Nginx, PHP-FPM | Nginx bisa serve Laravel, static asset via Nginx | Konfigurasi Nginx, dokumentasi deployment |
| 1.5 | Manual Deployment | Deploy CampRent ke server Linux secara manual | SSH, Linux server | Aplikasi accessible via domain/IP production | Dokumentasi langkah-langkah deploy manual |

---

### Fase 2: Intermediate (Minggu 4–8)

Tujuan: Menambahkan fitur DevOps yang membuat aplikasi lebih stabil, scalable, dan mudah dipelihara.

| No | Topik | Tujuan | Teknologi | Kriteria Keberhasilan | Bukti Portfolio |
|----|-------|--------|-----------|----------------------|-----------------|
| 2.1 | Redis Caching | Mengganti database cache dengan Redis untuk kecepatan | Redis, Laravel Cache | `CACHE_STORE=redis`, halaman produk lebih cepat | Konfigurasi Redis, pengukuran performa before/after |
| 2.2 | Laravel Queue | Memproses tugas berat di background (email, notifikasi) | Laravel Queue, Redis/Database | Minimal 1 job berjalan di background, queue worker aktif | Job class, queue worker running, dokumentasi alur |
| 2.3 | CI/CD GitHub Actions | Mengotomatisasi testing saat push ke repository | GitHub Actions | Setiap push menjalankan `php artisan test`, gagal = tidak bisa merge | `.github/workflows/`, screenshot status check di PR |
| 2.4 | Automated Testing | Menambah test coverage untuk semua resource | Pest PHP | Test untuk Rental, Payment, RentalDetails, RentalReturn | Test files, laporan coverage, CI passing |
| 2.5 | Database Backup | Backup database secara otomatis untuk perlindungan data | mysqldump, Cron, Bash | Backup harian otomatis, uji coba restore berhasil | Backup script, cron config, dokumentasi restore |
| 2.6 | Health Check Endpoint | Memantau apakah aplikasi masih berjalan | Laravel route, controller | Endpoint `/health` mengembalikan JSON status + cek database | Health check endpoint, dokumentasi monitoring |

---

### Fase 3: Advanced (Minggu 9–12, Opsional)

Tujuan: Meningkatkan keahlian ke level profesional (hanya jika Fase 1 dan 2 sudah selesai).

| No | Topik | Tujuan | Teknologi | Kriteria Keberhasilan | Bukti Portfolio |
|----|-------|--------|-----------|----------------------|-----------------|
| 3.1 | Load Balancing | Membagi trafik ke banyak server | Nginx, HAProxy | 2+ server menangani trafik bersama | Konfigurasi load balancer |
| 3.2 | Horizontal Scaling | Menambah server berdasarkan beban | Docker Swarm / K8s | Auto-scale berdasarkan CPU/memory | Dokumentasi scaling |
| 3.3 | Kubernetes | Orchestrasi container tingkat lanjut | Kubernetes (K8s) | CampRent berjalan di K8s cluster | K8s manifest files |
| 3.4 | Centralized Logging | Mengumpulkan log dari banyak sumber | ELK Stack (Elasticsearch, Logstash, Kibana) | Log terpusat, bisa dicari dan divisualisasikan | Konfigurasi ELK, dashboard log |
| 3.5 | Infrastructure as Code | Mengelola infrastruktur sebagai kode | Terraform / Ansible | Infrastruktur dapat dibuat ulang dengan satu perintah | Terraform/Ansible files |
| 3.6 | Rolling / Blue-Green Deployment | Deployment tanpa downtime | CI/CD, Load Balancer | Deploy baru tanpa gangguan pengguna | Dokumentasi strategi deploy |

---

## Prioritas Disarankan untuk Satu Orang

Karena project ini dikelola oleh satu orang, **fokus pada Fase 1 dan Fase 2 dulu**. Fase 3 terlalu kompleks dan tidak relevan untuk project skala CampRent.

**Urutan yang disarankan:**

1. **Docker & Docker Compose** — Fondasi semua hal lain
2. **Nginx Reverse Proxy** — Web server production
3. **Environment Configuration** — Dev vs Production
4. **CI/CD GitHub Actions** — Otomatisasi testing
5. **Automated Testing** — Kualitas kode
6. **Redis Caching** — Performa
7. **Laravel Queue** — Background processing
8. **Database Backup** — Keamanan data
9. **Health Check** — Monitoring dasar

---

## Estimasi Waktu

| Fase | Durasi | Jam per Minggu | Total Jam |
|------|--------|----------------|-----------|
| Fase 1 (Fundamental) | 3 minggu | 5–8 jam | 15–24 jam |
| Fase 2 (Intermediate) | 5 minggu | 5–8 jam | 25–40 jam |
| Fase 3 (Advanced, opsional) | 4 minggu | 5–8 jam | 20–32 jam |
| **Total (Fase 1 + 2)** | **8 minggu** | **5–8 jam** | **40–64 jam** |

---

## Format Laporan Setiap Tugas Praktik

Setiap kali menyelesaikan satu topik, buat dokumentasi sederhana dengan format berikut:

```markdown
## [Nama Topik]

### Tujuan
Singkat jelaskan apa yang ingin dicapai.

### Konsep yang Dipahami
Daftar konsep teknis yang dipelajari.

### Alur Kerja
Langkah-langkah implementasi dari awal hingga akhir.

### Implementasi di CampRent
Bagaimana teknologi ini terhubung dengan project CampRent.

### Bukti
- File yang dibuat/dimodifikasi
- Screenshot hasil running
- Link ke commit/PR (jika ada)

### Kendala dan Solusi
Error yang ditemukan dan bagaimana cara mengatasinya.

### Evaluasi
Apakah kriteria keberhasilan tercapai?
```

---

## Checklist Keberhasilan Akhir

Sebelum CampRent dikatakan siap sebagai portfolio DevOps, pastikan:

- [ ] Dockerfile dan docker-compose.yml tersedia dan berfungsi
- [ ] Nginx konfigurasi production tersedia
- [ ] `.env.production` tersedia dengan APP_DEBUG=false
- [ ] GitHub Actions CI menjalankan test otomatis
- [ ] Minimal 80% test coverage untuk fitur inti
- [ ] Redis digunakan untuk cache (bukan database)
- [ ] Minimal 1 background job berjalan
- [ ] Database backup otomatis terkonfigurasi
- [ ] Health check endpoint `/health` berfungsi
- [ ] Dokumentasi lengkap cara menjalankan dan deploy

---

## Catatan Penting

- Jangan langsung mengimplementasikan semua sekaligus. Satu tahap demi satu tahap.
- Setiap tahap harus diuji dan berfungsi sebelum melanjutkan ke tahap berikutnya.
- Dokumentasikan setiap langkah untuk bahan portfolio.
- Jika menemukan error, coba debug sendiri terlebih dahulu sebelum meminta bantuan.
