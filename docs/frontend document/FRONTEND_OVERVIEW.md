## 1. Struktur Direktori & File View

Seluruh visualisasi antarmuka aplikasi terletak di dalam direktori `app/Views/` dan diorganisasikan berdasarkan modul-modul berikut:

```text
app/Views/
├── account/
│   └── index.php           <- Pengaturan profil user & password
├── auth/
│   ├── login.php           <- Halaman masuk akun (login)
│   └── register.php        <- Halaman pendaftaran akun (register)
├── comments/
│   └── edit.php            <- Halaman edit komentar tugas
├── dashboard/
│   └── index.php           <- Dashboard utama (statistik & ringkasan)
├── errors/                 <- Halaman penanganan error (default framework)
├── landingpage/
│   └── landing.php         <- Halaman utama guest (landing page)
├── layouts/
│   └── dashboard.php       <- Master layout/wrapper dashboard
├── notifications/
│   └── index.php           <- Halaman pusat notifikasi (alert center)
├── projects/
│   ├── index.php           <- Daftar semua proyek aktif/arsip
│   ├── show.php            <- Detail proyek, anggota, task, & komentar
│   ├── create.php          <- Form pembuatan proyek baru
│   └── edit.php            <- Form pengeditan data proyek
├── search/
│   └── index.php           <- Halaman hasil pencarian proyek & task
├── tasks/
│   ├── create.php          <- Form pembuatan task baru
│   └── edit.php            <- Form pengeditan data task
└── timeline/
    └── index.php           <- Halaman dual-view timeline & log aktivitas
```

Setiap view (kecuali `landing.php`, `login.php`, dan `register.php`) memuat master layout `layouts/dashboard.php` menggunakan instruksi:
```php
<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>
<!-- Konten halaman ditulis di sini -->
<?= $this->endSection() ?>
```

---

## 2. Analisis Layout Utama (`app/Views/layouts/dashboard.php`)
Layout ini bertindak sebagai kerangka struktural utama yang menyatukan navigasi, pencarian global, informasi profil, dan responsivitas mobile.

### A. Pembagian Area Visual (Desktop Grid)
*   **Sidebar Kiri (`aside`):** Lebar tetap `w-64`, warna background `#EEF2FF`, border kanan `border-indigo-100`.
*   **Area Konten Utama (`div`):** Menggunakan kelas `flex-1 flex flex-col min-h-screen overflow-x-hidden`.
*   **Top Navbar (`header`):** Tinggi tetap `h-20` dengan background transparan, efek blur (`backdrop-blur-sm`), dan posisi tetap (`sticky top-0 z-30`).

### B. Header Logo & Branding
Terdiri dari kontainer flexbox yang menyusun logo visual dan teks nama aplikasi:
*   **Icon Centang (SVG Logo):** Menggunakan wadah ukuran `h-9 w-9` berlatar belakang indigo (`bg-[#4F46E5]`), ber sudut melingkar (`rounded-xl`), dengan ikon checkmark putih (`text-white`) dengan ketebalan stroke `stroke-width="3.5"`.
*   **Judul:** Teks bold `TaskTracker` (`text-xl font-bold text-slate-900 tracking-tight`).

### C. Sidebar Navigasi Links
Navigasi dikelola secara dinamis dengan mengecek URI aktif melalui objek `current_url(true)->getPath()`. Kode ini mendeteksi segmen URL aktif untuk menerapkan kelas aktif:
*   **State Aktif:** Menggunakan latar belakang `bg-[#E0E7FF]` dan teks berwarna indigo `text-[#4F46E5]` untuk membedakan halaman mana yang sedang diakses.
*   **State Hover:** Jika tidak aktif, menggunakan `text-slate-600 hover:bg-[#E0E7FF]/40 hover:text-slate-900`.
*   **Navigasi Tersedia:**
    *   **Dashboard**: Ikon layout grid.
    *   **Projects**: Ikon folder proyek.
    *   **Timeline**: Ikon kalender aktivitas.

### D. Panel Bawah Sidebar (Footer Sidebar)
*   **Tombol Proyek Baru (Khusus Admin):** Tombol gradient indigo-to-violet (`bg-gradient-to-r from-indigo-600 to-violet-600`) dengan efek transisi pengecilan ukuran saat ditekan (`active:scale-95`). Hanya dirender jika peran pengguna pada session adalah `admin`.
*   **Tombol Logout:** Mengarah ke route `/logout` dengan warna teks netral `text-slate-700 hover:text-slate-950` dan ikon SVG pintu keluar.

### E. Top Navbar Utilities
*   **Hamburger Button (`#sidebar-toggle`):** Tombol bulat untuk membuka sidebar kiri saat diakses melalui resolusi mobile.
*   **Global Search Form:** Form pencarian dengan input bulat (`rounded-full`) dan padding kiri lebar (`pl-12`) untuk menaruh ikon kaca pembesar. Menggunakan autofocus ring `focus:ring-indigo-400 focus:border-indigo-400`.
*   **Notification Icon:** Tombol bell dengan indikator absolut titik bulat kecil berwarna merah (`bg-rose-500 rounded-full w-2.5 h-2.5`) yang menunjukkan adanya notifikasi masuk.
*   **Settings Icon:** Tombol gerigi gigi (`svg`) yang mengarahkan pengguna ke halaman pengaturan profil `/settings`.
*   **Profile Avatar initials:** Menampilkan nama pengguna dan role (Lead Designer/Admin, Member, Client) di sisi kanan. Avatar profil menampilkan inisial 2 huruf nama pertama dengan warna acak dari palette kelas Tailwind (`bg-indigo-100 text-indigo-700`).

---

## 3. Rincian Detail Halaman & Variabel Dinamis (Views)
### A. Landing Page (`landingpage/landing.php`)
Dirancang sebagai gerbang masuk pertama untuk pengguna anonim.
*   **Navbar Menu:** Terdapat logo checkmark, menu tautan minimalis (Features, FAQ), tombol masuk sekunder ("Log In") dengan warna teks indigo dan border transparan, serta tombol daftar utama ("Sign Up") dengan warna latar indigo.
*   **Hero Grid:** Susunan dua kolom di layar desktop:
    *   Kolom Kiri: Headline besar ("Modern Project Management Platform"), deskripsi sistem TaskTracker dalam Bahasa Inggris, dan tombol utama "Get Started" yang menghubungkan ke halaman register.
    *   Kolom Kanan: Ilustrasi visual atau ornamen grafis premium berlatar belakang gradasi warna pastel.
*   **Fitur Teaser Cards:** Menggunakan susunan grid (`grid grid-cols-1 md:grid-cols-3 gap-8`) dengan 3 kartu:
    1.  *Structured Projects*: Menampilkan ikon folder SVG.
    2.  *Live Notifications*: Menampilkan ikon bell/lonceng SVG.
    3.  *Structured Workspaces*: Menampilkan ikon checkmark/checklist SVG.
    *   Setiap kartu memiliki border halus `border-slate-100` dan bayangan lembut `shadow-xl shadow-slate-100/50`.

### B. Halaman Login (`auth/login.php`)
*   **Layout Wrapper:** Kontainer flex dengan tinggi layar penuh (`min-h-screen`) dengan background gradien linear dari biru muda ke indigo muda.
*   **Card Container:** Card putih ditengah (`bg-white rounded-3xl shadow-xl border border-indigo-50/50`).
*   **Input Fields:** Input email dan password dengan ikon placeholder.
*   **Password Toggle:** Menggunakan tombol ikon mata (`#password-toggle`) di sisi kanan dalam input password untuk mengubah visibilitas teks sandi.
*   **Feedback Error:** Jika flashdata session `error` terisi, di bagian atas form akan dirender kotak alert berwarna merah (`bg-rose-50 text-rose-600 border border-rose-200 rounded-xl`).

### C. Halaman Register (`auth/register.php`)
*   Memiliki struktur visual yang identik dengan login.
*   **Role Selector Dropdown:** Menu dropdown untuk memilih peran keanggotaan pengguna baru (`member` atau `klien`).
*   **Tautan Login:** Tautan di bagian bawah form *"Already have an account? Login"* merujuk ke route `/login` secara langsung untuk memastikan navigasi alur masuk yang benar.

### D. Halaman Dashboard (`dashboard/index.php`)
*   **Stats Grid Cards:** 4 kartu ringkasan di bagian paling atas (`grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6`):
    1.  *Total Projects*: Menampilkan angka proyek aktif (Border kiri indigo-500).
    2.  *Active Tasks*: Jumlah pekerjaan saat ini (Border kiri amber-500).
    3.  *Tasks Due Today*: Pekerjaan jatuh tempo hari ini (Border kiri rose-500).
    4.  *Overdue Tasks*: Pekerjaan yang telah melebihi batas waktu (Border kiri red-600 dengan animasi teks merah).
*   **Recent Projects Slider/Grid:** Menampilkan daftar proyek terbaru dengan progress bar visual (`div class="w-full bg-slate-100 rounded-full h-2"` yang diisi oleh `$project['progress']` dalam bentuk persentase lebar inline `style="width: ...%"`).
*   **My Tasks Feed:** Daftar ringkasan tugas-tugas yang di-assign langsung ke user aktif saat ini.
*   **Upcoming Deadlines Feed:** Panel samping kanan yang berisi jadwal tenggat waktu terdekat dengan badge tanggal yang menonjol.
*   **Recent Activity Logs:** Catatan aktivitas terbaru tim dalam proyek-proyek terkait.

### E. Daftar Proyek (`projects/index.php`)
*   Menampilkan seluruh daftar proyek dengan badge status:
    *   `Active`: Badge biru/indigo (`bg-indigo-50 text-indigo-700`).
    *   `Completed`: Badge hijau/emerald (`bg-emerald-50 text-emerald-700`).
*   Setiap kartu proyek memuat judul proyek, nama manajer/admin proyek, progres proyek (dalam persentase), jumlah tugas, dan daftar inisial anggota yang tergabung.

### F. Detail Proyek (`projects/show.php`)
Ini adalah halaman paling kompleks di aplikasi yang membagi antarmuka menjadi beberapa panel fungsional:
*   **Header Proyek:** Menampilkan nama proyek, status, deskripsi singkat, serta aksi manipulasi (Edit, Tandai Selesai, Arsipkan) yang hanya muncul untuk admin proyek.
*   **Members Sidebar Panel:** Menampilkan daftar anggota proyek dan peran mereka (Admin, Member, Klien). Di bagian atasnya terdapat form input untuk menambahkan anggota baru ke dalam proyek.
*   **Tasks Board/Grid:**
    *   Menampilkan semua tugas dalam proyek dikelompokkan berdasarkan statusnya (`todo`, `in_progress`, `done`).
    *   Setiap kartu tugas menampilkan judul tugas, badge tingkat prioritas (High, Medium, Low), assignee (penerima tugas), deadline tanggal, dan indikator jumlah komentar.
*   **Activity Logs & Comments Thread:** Menampilkan riwayat aksi yang terjadi pada proyek bersangkutan.

### G. Halaman Timeline & Pusat Deadline (`timeline/index.php`)
*   **Tabs Navigasi:** Switcher bar yang menggunakan JavaScript untuk menyembunyikan dan menampilkan dua panel visual:
    1.  *Timeline Track Panel*: Menampilkan daftar tugas dengan status pengerjaan dan waktu tenggat. Tugas yang terlambat (*overdue*) ditandai dengan warna merah menyala, ikon peringatan (`svg`), serta efek animasi pulsing pada indikator dot bulatan.
    2.  *Activity Stream Panel*: Menampilkan riwayat log log aktivitas yang dikelompokkan dengan ikon penanda spesifik.

### H. Halaman Edit Komentar (`comments/edit.php`)
*   Menyediakan form edit mandiri yang diletakkan di dalam layout dashboard.
*   **Task Context Alert:** Kotak info biru di atas textarea yang menampilkan judul task asli dari komentar tersebut agar user selalu memiliki konteks saat mengedit teks komentar.

---

## 4. Sistem Desain CSS & Tailwind Tokens

Untuk mematangkan konsistensi visual di seluruh halaman, TaskTracker memanfaatkan utilitas class Tailwind CSS yang didefinisikan secara khusus:

### A. Badge Prioritas Tugas (Task Priority)
*   🔴 **High Priority:** Kelas `bg-rose-50 text-rose-700 border border-rose-100 rounded-md text-xs px-2 py-0.5 font-semibold`.
*   🟡 **Medium Priority:** Kelas `bg-amber-50 text-amber-700 border border-amber-100 rounded-md text-xs px-2 py-0.5 font-semibold`.
*   🔵 **Low Priority:** Kelas `bg-indigo-50 text-indigo-700 border border-indigo-100 rounded-md text-xs px-2 py-0.5 font-semibold`.

### B. Badge Status Proyek (Project Status)
*   `Active`: `bg-indigo-50 text-indigo-700 border border-indigo-100 px-3 py-1 rounded-full text-xs font-bold`.
*   `Completed`: `bg-emerald-50 text-emerald-700 border border-emerald-100 px-3 py-1 rounded-full text-xs font-bold`.

### C. Efek Pulsing Overdue (Tenggat Terlewati)
Tugas yang terlambat (*overdue*) menggunakan perpaduan kelas animasi:
*   `relative flex h-3.5 w-3.5`: Wadah relatif pembungkus dot indikator.
*   `animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75`: Lapisan luar dot merah yang memancarkan denyut radar berulang.
*   `relative inline-flex rounded-full h-3.5 w-3.5 bg-red-600`: Bulatan dot merah solid di tengah.

---

## 5. Skrip Interaksi Frontend (Vanilla JS)

TaskTracker tidak bergantung pada pustaka eksternal seperti jQuery, melainkan menggunakan kode JavaScript asli agar performa loading halaman optimal. Berikut rincian fungsi JS yang digunakan:

### A. Sidebar Toggle (Responsif Mobile)
Script ini berada di bagian penutup `app/Views/layouts/dashboard.php`. Mengontrol interaksi sidebar kiri pada resolusi layar ponsel.
```javascript
const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebarClose = document.getElementById('sidebar-close');
const backdrop = document.getElementById('sidebar-backdrop');

function openSidebar() {
    sidebar.classList.remove('-translate-x-full');
    backdrop.classList.remove('hidden');
    setTimeout(() => {
        backdrop.classList.add('opacity-100');
    }, 50);
}

function closeSidebar() {
    sidebar.classList.add('-translate-x-full');
    backdrop.classList.remove('opacity-100');
    setTimeout(() => {
        backdrop.classList.add('hidden');
    }, 300);
}

if(sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
if(sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
if(backdrop) backdrop.addEventListener('click', closeSidebar);
```

### B. Password Visibility Toggle (Show / Hide Password)
Diterapkan pada halaman login dan register untuk memudahkan pengguna memeriksa kebenaran password yang diketikkan secara interaktif menggunakan penambahan dan penghapusan class `hidden` pada elemen SVG mata.

**Pada Login (`app/Views/auth/login.php`):**
```javascript
function togglePassword() {
    const input = document.getElementById('password');
    const eyeShow = document.getElementById('eye-show');
    const eyeHide = document.getElementById('eye-hide');
    
    if (input.type === 'password') {
        input.type = 'text';
        eyeShow.classList.add('hidden');
        eyeHide.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeShow.classList.remove('hidden');
        eyeHide.classList.add('hidden');
    }
}
```

**Pada Register (`app/Views/auth/register.php`):**
```javascript
function togglePassword(inputId, eyeShowId, eyeHideId) {
    const input = document.getElementById(inputId);
    const eyeShow = document.getElementById(eyeShowId);
    const eyeHide = document.getElementById(eyeHideId);
    
    if (input.type === 'password') {
        input.type = 'text';
        eyeShow.classList.add('hidden');
        eyeHide.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeShow.classList.remove('hidden');
        eyeHide.classList.add('hidden');
    }
}
```


### C. Live Image Upload Preview (Account Settings)
Digunakan pada halaman `/settings` saat pengguna memilih file gambar baru untuk diunggah sebagai avatar. Preview gambar langsung ditampilkan di halaman tanpa perlu submit form terlebih dahulu.
```javascript
const avatarInput = document.getElementById('avatar-input');
const avatarPreview = document.getElementById('avatar-preview');

if (avatarInput && avatarPreview) {
    avatarInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                avatarPreview.setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}
```

### D. Switcher Tab Timeline (Halaman Timeline)
Digunakan di halaman `/timeline` untuk berganti tampilan secara interaktif antara panel daftar waktu deadline tugas dan log aktivitas proyek.
```javascript
const tabDeadlines = document.getElementById('tab-deadlines');
const tabActivity = document.getElementById('tab-activity');
const panelDeadlines = document.getElementById('panel-deadlines');
const panelActivity = document.getElementById('panel-activity');

if (tabDeadlines && tabActivity && panelDeadlines && panelActivity) {
    tabDeadlines.addEventListener('click', function () {
        // Switch tab classes
        tabDeadlines.classList.add('bg-white', 'text-indigo-600', 'shadow-sm');
        tabDeadlines.classList.remove('text-slate-600', 'hover:text-slate-900');
        tabActivity.classList.remove('bg-white', 'text-indigo-600', 'shadow-sm');
        tabActivity.classList.add('text-slate-600', 'hover:text-slate-900');
        
        // Show/Hide panels
        panelDeadlines.classList.remove('hidden');
        panelActivity.classList.add('hidden');
    });

    tabActivity.addEventListener('click', function () {
        // Switch tab classes
        tabActivity.classList.add('bg-white', 'text-indigo-600', 'shadow-sm');
        tabActivity.classList.remove('text-slate-600', 'hover:text-slate-900');
        tabDeadlines.classList.remove('bg-white', 'text-indigo-600', 'shadow-sm');
        tabDeadlines.classList.add('text-slate-600', 'hover:text-slate-900');
        
        // Show/Hide panels
        panelActivity.classList.remove('hidden');
        panelDeadlines.classList.add('hidden');
    });
}
```
