# CampRent DevOps Learning Path — Project-Based Learning (PBL)

Dokumen ini berisi rencana pembelajaran DevOps untuk project CampRent menggunakan pendekatan Project-Based Learning (PBL). Setiap modul dibangun secara bertahap dengan format: Problem → Concept → Architecture → Hands-on Lab → Challenge → Evaluation → Portfolio Evidence.

---

## 1. Audit Kondisi Saat Ini

Berdasarkan pemeriksaan menyeluruh terhadap source code, konfigurasi, dan struktur project:

| Aspek | Kondisi Saat Ini | Status |
|-------|-----------------|--------|
| Framework | Laravel 13.40.0, PHP 8.5.12 | ✅ |
| Database | MySQL, migration + seeder tersedia | ✅ |
| Auth | Laravel Breeze, role-based (admin/pelanggan) | ✅ |
| Frontend | Blade, Tailwind, Vite, Alpine.js | ✅ |
| Testing | Pest PHP, test untuk Category, Product, Profile, Auth | ✅ |
| Cache | Konfigurasi tersedia, driver: database | ⚠️ Belum optimal |
| Queue | Konfigurasi tersedia, driver: database | ⚠️ Belum digunakan |
| Redis | Terkonfigurasi, belum aktif | ❌ |
| Docker | Tidak ada Dockerfile, docker-compose | ❌ |
| Nginx | Tidak ada konfigurasi | ❌ |
| CI/CD | Tidak ada GitHub Actions | ❌ |
| Monitoring | Tidak ada health check, logging terstruktur | ❌ |
| Backup | Tidak ada database backup | ❌ |
| Environment | `.env` dengan `APP_DEBUG=true` | ⚠️ Risiko keamanan |

---

## 2. Gap Analysis: Saat Ini vs Target Akhir

| Target Akhir | Kondisi Saat Ini | Gap yang Harus Ditutup |
|--------------|-----------------|----------------------|
| Bisa dijalankan via Docker Compose | Hanya Laragon Windows | Dockerfile, docker-compose.yml, container networking |
| Web server + reverse proxy | Tidak ada Nginx | Nginx config, PHP-FPM, reverse proxy |
| Redis + Queue | Driver database, belum aktif | Redis container, queue worker, background jobs |
| Automated testing + CI/CD | Test ada, tapi tidak otomatis | GitHub Actions, test di CI pipeline |
| Deployment ke Linux server | Tidak ada server | Linux server, deployment script, env production |
| Database backup + restore | Tidak ada | Cron job, mysqldump, restore procedure |
| Monitoring + logging | Tidak ada | Health check, logging, Prometheus/Grafana (opsional) |
| Dokumentasi arsitektur | Tidak ada | Diagram, dokumentasi deployment |

---

## 3. Roadmap Pembelajaran (Urutan Logis)

Berdasarkan dependency antar-teknologi, urutan modul yang paling masuk akal:

### FASE 1: Fondasi (Minggu 1–3)

| Modul | Topik | Dependency | Estimasi |
|-------|-------|------------|----------|
| **Modul 1** | Linux Fundamentals & Docker Basics | — | 3–5 sesi |
| **Modul 2** | Dockerfile & Docker Compose untuk CampRent | Modul 1 | 3–4 sesi |
| **Modul 3** | Nginx + PHP-FPM Reverse Proxy | Modul 2 | 3–4 sesi |

### FASE 2: Infrastruktur Aplikasi (Minggu 4–6)

| Modul | Topik | Dependency | Estimasi |
|-------|-------|------------|----------|
| **Modul 4** | Redis Caching | Modul 3 | 2–3 sesi |
| **Modul 5** | Laravel Queue & Background Jobs | Modul 4 | 3–4 sesi |

### FASE 3: Automasi & Observability (Minggu 7–9)

| Modul | Topik | Dependency | Estimasi |
|-------|-------|------------|----------|
| **Modul 6** | CI/CD dengan GitHub Actions | Modul 3, 5 | 4–5 sesi |
| **Modul 7** | Database Backup & Restore | Modul 3 | 2–3 sesi |
| **Modul 8** | Health Check & Monitoring Dasar | Modul 3 | 2–3 sesi |

### FASE 4: Advanced (Opsional, Minggu 10+)

| Modul | Topik | Dependency | Estimasi |
|-------|-------|------------|----------|
| **Modul 9** | Load Balancing & Horizontal Scaling | Modul 3, 6 | 4–5 sesi |
| **Modul 10** | Kubernetes / IaC (Terraform/Ansible) | Semua di atas | 5–7 sesi |

**Total estimasi Fase 1–3:** 8–9 minggu, 1 jam per hari

---

## 4. Format Setiap Modul

Setiap modul akan disajikan dengan format PBL berikut:

### A. Problem
Masalah nyata yang ingin diselesaikan di CampRent.

### B. Learning Objectives
Apa yang harus dipahami setelah menyelesaikan modul.

### C. Theory
Jelaskan konsep dan alasan teknologi digunakan.

### D. Architecture
Gambar alur kerja dan hubungan antar-komponen.

### E. Hands-on Lab
Praktik langsung di CampRent secara bertahap.

### F. Challenge
Tugas kecil untuk menguji pemahaman.

### G. Evaluation
Evaluasi apakah pemahaman konsep dan implementasi benar.

### H. Portfolio Evidence
File, konfigurasi, diagram, screenshot, dokumentasi untuk portfolio.

---

## 5. Rekomendasi Modul Pertama

### Modul 1: Linux Fundamentals & Docker Basics

**Masalah:** CampRent hanya bisa dijalankan di Laragon (Windows). Jika dipindahkan ke komputer lain atau server Linux, perlu instalasi PHP, Composer, MySQL secara manual. Hal ini menyulitkan konsistensi dan deployment.

**Konsep yang akan dipelajari:**
- Linux command line dasar (navigasi, file, permission)
- Docker container vs virtual machine
- Image dan container
- Docker Hub dan image repository
- Volume untuk persistensi data

**Alasan modul pertama:** Docker adalah fondasi untuk semua modul selanjutnya (Nginx, PHP-FPM, Redis, CI/CD). Tanpa memahami container dan volume, modul berikutnya akan sulit diterapkan.

---

## 6. Aturan Kerja Pembelajaran

1. **Satu modul dalam satu waktu** — Jangan memberikan seluruh materi sekaligus.
2. **Tunggu persetujuan** sebelum melanjutkan ke modul berikutnya.
3. **Satu tugas praktik kecil per sesi** — Jangan memberikan terlalu banyak command sekaligus.
4. **Jelaskan mengapa sebelum memberikan perintah.**
5. **Jika ada error, bantu debugging dan memahami penyebabnya.**
6. **Jangan mengubah project tanpa persetujuan.**
7. **Pertahankan agar CampRent tetap bisa dijalankan melalui Laragon.**
8. **Gunakan Git untuk menjaga setiap perubahan.**
9. **Pisahkan konfigurasi development dan production.**
10. **Setiap teknologi baru harus memiliki alasan penggunaan yang jelas.**

---

## 7. Target Akhir

Setelah menyelesaikan semua modul, CampRent harus:

1. ✅ Bisa dijalankan secara konsisten menggunakan Docker Compose.
2. ✅ Memiliki web server dan reverse proxy yang benar (Nginx + PHP-FPM).
3. ✅ Memanfaatkan Redis dan Laravel Queue jika relevan.
4. ✅ Memiliki automated testing dan CI/CD (GitHub Actions).
5. ✅ Memiliki deployment ke Linux server.
6. ✅ Memiliki database backup dan restore.
7. ✅ Memiliki monitoring dan logging (health check minimal).
8. ✅ Memiliki dokumentasi arsitektur dan deployment.

Project ini harus bisa menjadi portfolio yang menunjukkan pemahaman tentang membangun, menjalankan, melakukan deployment, memelihara, dan memonitor sebuah aplikasi.

---

## 8. Langkah Selanjutnya
b
Saya **belum membuat atau mengubah file apa pun** sesuai aturan. Dokumen ini hanya berupa rencana pembelajaran.

**Pertanyaan untuk Anda:**

Apakah Anda setuju dengan:
1. Urutan modul di atas (dimulai dari Linux & Docker fundamentals)?
2. Modul 1 sebagai titik awal?
3. Pacing 1 jam per hari, 3–5 sesi untuk Modul 1?

Jika setuju, silakan beri tahu dan saya akan memulai **Modul 1: Linux Fundamentals & Docker Basics** dengan format PBL lengkap.

Jika ada urutan yang ingin diubah atau prioritas yang berbeda, silakan sampaikan sebelum kita memulai.
