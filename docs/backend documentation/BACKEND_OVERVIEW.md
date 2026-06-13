# Backend Notes

## Routes yang sudah dibuat

```php
$routes->get('/', 'AuthController::login', ['filter' => 'guest']);
$routes->post('/login', 'AuthController::attemptLogin', ['filter' => 'guest']);
$routes->get('/logout', 'AuthController::logout', ['filter' => 'auth']);

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);
$routes->get('/projects', 'ProjectController::index', ['filter' => 'auth']);

$routes->get('/projects/create', 'ProjectController::create', ['filter' => 'auth']);
$routes->post('/projects/store', 'ProjectController::store', ['filter' => 'auth']);

$routes->post('/projects/(:num)/complete', 'ProjectController::complete/$1', ['filter' => 'auth']);
$routes->post('/projects/(:num)/reopen', 'ProjectController::reopen/$1', ['filter' => 'auth']);
$routes->post('/projects/(:num)/archive', 'ProjectController::archive/$1', ['filter' => 'auth']);
$routes->get('/projects/(:num)/edit', 'ProjectController::edit/$1', ['filter' => 'auth']);
$routes->post('/projects/(:num)/update', 'ProjectController::update/$1', ['filter' => 'auth']);

$routes->get('/projects/(:num)', 'ProjectController::show/$1', ['filter' => 'auth']);
$routes->post('/projects/(:num)/members', 'ProjectMemberController::store/$1', ['filter' => 'auth']);
$routes->post('/projects/(:num)/members/(:num)/remove', 'ProjectMemberController::remove/$1/$2', ['filter' => 'auth']);

$routes->get('/projects/(:num)/tasks/create', 'TaskController::create/$1', ['filter' => 'auth']);
$routes->post('/projects/(:num)/tasks/store', 'TaskController::store/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)/status', 'TaskController::updateStatus/$1', ['filter' => 'auth']);
$routes->get('/tasks/(:num)/edit', 'TaskController::edit/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)/update', 'TaskController::update/$1', ['filter' => 'auth']);
$routes->post('/tasks/(:num)/archive', 'TaskController::archive/$1', ['filter' => 'auth']);

$routes->post('/tasks/(:num)/comments', 'CommentController::store/$1', ['filter' => 'auth']);
$routes->get('/comments/(:num)/edit', 'CommentController::edit/$1', ['filter' => 'auth']);
$routes->post('/comments/(:num)/update', 'CommentController::update/$1', ['filter' => 'auth']);
$routes->post('/comments/(:num)/delete', 'CommentController::delete/$1', ['filter' => 'auth']);
```

* Route GET `/` digunakan untuk menampilkan halaman login, menggunakan GuestFilter agar user yang sudah login diarahkan ke dashboard.
* Route POST `/login` digunakan untuk memproses percobaan login, menggunakan GuestFilter agar user yang sudah login tidak memproses login ulang.
* Route GET `/logout` digunakan untuk keluar dari akun.
* Route GET `/dashboard` digunakan untuk menampilkan halaman dashboard.
* Route GET `/projects` digunakan untuk menampilkan daftar project.
* Route GET `/projects/create` digunakan untuk menampilkan form tambah project.
* Route POST `/projects/store` digunakan untuk menyimpan data project baru.
* Route POST `/projects/(:num)/complete` digunakan untuk menandai project sebagai selesai (completed) berdasarkan ID project.
* Route POST `/projects/(:num)/reopen` digunakan untuk membuka kembali project yang telah selesai (completed) menjadi aktif (active) berdasarkan ID project.
* Route POST `/projects/(:num)/archive` digunakan untuk mengarsipkan project berdasarkan ID.
* Route GET `/projects/(:num)/edit` digunakan untuk menampilkan form edit project berdasarkan ID project.
* Route POST `/projects/(:num)/update` digunakan untuk menyimpan perubahan data project berdasarkan ID project.
* Route GET `/projects/(:num)` digunakan untuk menampilkan detail project berdasarkan ID.
* Route POST `/projects/(:num)/members` digunakan untuk menambahkan member ke project berdasarkan ID project.
* Route POST `/projects/(:num)/members/(:num)/remove` digunakan untuk menghapus member dari project berdasarkan ID project dan ID member.
* Route GET `/projects/(:num)/tasks/create` digunakan untuk menampilkan form tambah task berdasarkan ID project.
* Route POST `/projects/(:num)/tasks/store` digunakan untuk menyimpan data task baru berdasarkan ID project.
* Route POST `/tasks/(:num)/status` digunakan untuk memperbarui status task berdasarkan ID task.
* Route GET `/tasks/(:num)/edit` digunakan untuk menampilkan form edit task berdasarkan ID task.
* Route POST `/tasks/(:num)/update` digunakan untuk menyimpan perubahan data task berdasarkan ID task.
* Route POST `/tasks/(:num)/archive` digunakan untuk mengarsipkan task berdasarkan ID task dengan mengisi nilai `archived_at`, sehingga task tidak lagi ditampilkan pada daftar task aktif.
* Route POST `/tasks/(:num)/comments` digunakan untuk menyimpan komentar baru pada task berdasarkan ID task.
* Route GET `/comments/(:num)/edit` digunakan untuk menampilkan form edit komentar berdasarkan ID komentar.
* Route POST `/comments/(:num)/update` digunakan untuk menyimpan perubahan komentar berdasarkan ID komentar.
* Route POST `/comments/(:num)/delete` digunakan untuk menghapus komentar berdasarkan ID komentar.

## Controller yang sudah dibuat

### BaseController

Fungsi:

* Menyediakan fungsi dasar yang dipakai oleh controller lain.
* Mengecek akses user ke project melalui `getProjectAccess($projectId)`.
* Memastikan project ada, belum diarsipkan, dan user memiliki akses sebagai admin atau member.
* Mengembalikan data project, role user, dan status admin.
* Menolak akses dengan halaman 404 jika project tidak ditemukan atau user tidak memiliki akses.
* Mencatat aktivitas project melalui `logActivity()`.
* Memformat waktu dan pesan activity log agar siap ditampilkan di view.

Method:

```text
getProjectAccess($projectId)
logActivity($projectId, $entityType, $entityId, $action, $detail = null)
formatDateTime($dateTime)
formatActivityMessage(array $log)
formatActivityLogs(array $logs)
```

### AuthController

Fungsi:

* Menampilkan halaman login
* Memproses login
* Mengecek email dan password
* Menyimpan data user ke session
* Logout dan menghapus session

Method:

```text
login()
attemptLogin()
logout()
```

### DashboardController

Fungsi:

* Menampilkan halaman dashboard setelah login
* Mengambil nama dan role user dari session
* Menampilkan halaman dashboard setelah login.
* Menampilkan statistik project dan task.
* Menghitung jumlah project aktif yang dapat diakses user.
* Menghitung jumlah task aktif, task jatuh tempo hari ini, dan task terlambat.
* Menampilkan project terbaru beserta progress penyelesaiannya.
* Menampilkan task yang ditugaskan kepada user.
* Menampilkan deadline task yang akan datang.
* Menampilkan activity log terbaru dari project yang dapat diakses user.
* Mengambil nama dan role user dari session.

Method:

```text
index()
```

### ProjectController

Fungsi:

* Menampilkan daftar project aktif yang dapat diakses user.
* Menampilkan detail project berdasarkan ID melalui `getProjectAccess($id)`.
* Mengambil data member, task, komentar, dan activity log untuk halaman detail project.
* Menentukan hak kelola project melalui `canManage`.
* Membatasi pembuatan, edit, archive, complete, dan reopen project hanya untuk admin project.
* Melakukan validasi input saat membuat dan mengedit project.
* Mengarsipkan project dengan mengisi nilai `archived_at`.
* Mengubah status project menjadi `completed` atau kembali menjadi `active`.
* Mencegah perubahan project jika status sudah `completed`.
* Mengirim data pendukung ke view seperti `tasks`, `commentsByTask`, `activityLogs`, dan `projectRole`.
* Mencatat activity log saat project dibuat, diperbarui, diarsipkan, diselesaikan, atau dibuka kembali.

Method:

```text
index()
show($id)
create()
store()
edit($id)
update($id)
archive($id)
complete($id)
reopen($id)
```

### TaskController

Fungsi:

* Menampilkan form tambah dan edit task berdasarkan project atau task ID.
* Membatasi pembuatan, edit, dan archive task hanya untuk admin project.
* Mengambil dan memvalidasi assignee yang valid dalam project.
* Melakukan validasi input task seperti title, priority, deadline, assignee, dan status.
* Menyimpan task baru, memperbarui task, dan mengarsipkan task dengan `archived_at`.
* Menyembunyikan task yang sudah diarsipkan dari daftar task aktif.
* Mengizinkan admin project atau assignee untuk mengubah status task.
* Membatasi status task hanya `todo`, `in_progress`, atau `done`.
* Mencegah pembuatan, edit, archive, dan perubahan status task jika project sudah `completed`.
* Mencatat activity log saat task dibuat, diperbarui, diarsipkan, atau statusnya diubah.

Method:

```text
create($projectId)
store($projectId)
edit($taskId)
update($taskId)
archive($taskId)
getAssignableUsers($projectId, $adminId)
isAssignableUser($projectId, $adminId, $userId)
updateStatus($taskId)
```

### ProjectMemberController

Fungsi:

* Menambahkan user sebagai member project.
* Menghapus member dari project.
* Mencatat activity log saat member ditambahkan.
* Mencatat activity log saat member dihapus.
* Memastikan hanya admin project yang dapat mengelola member.
* Melakukan validasi input `user_id` dan `role`.
* Mengecek akses project melalui `getProjectAccess($projectId)`.
* Mencegah user yang sama ditambahkan dua kali ke project yang sama.
* Menyimpan role member sebagai `member` atau `klien`.
* Menyimpan waktu bergabung member melalui `joined_at`.
* Memastikan member yang akan dihapus benar-benar berada pada project tersebut.
* Menampilkan pesan error jika user tidak memiliki akses atau member tidak ditemukan.
* Mencegah penambahan member jika project berstatus completed.
* Mencegah penghapusan member jika project berstatus completed.

Method:

```text
store($projectId)
remove($projectId, $memberId)
```

### CommentController

Fungsi:

* Menambahkan, mengedit, dan menghapus komentar berdasarkan task atau comment ID.
* Mengecek akses user ke project melalui `getProjectAccess($projectId)`.
* Membatasi tambah komentar hanya untuk admin project atau member project.
* Membatasi edit komentar hanya untuk pemilik komentar.
* Membatasi hapus komentar hanya untuk pemilik komentar atau admin project.
* Mencegah user dengan role `klien` untuk menambahkan atau mengedit komentar.
* Melakukan validasi field `body` dengan batas maksimal 1000 karakter.
* Mencegah tambah, edit, dan hapus komentar jika project sudah `completed`.
* Mengarahkan kembali ke detail project setelah komentar berhasil dibuat, diperbarui, atau dihapus.
* Mencatat activity log saat komentar dibuat, diperbarui, atau dihapus.

Method:

```text
store($taskId) 
edit($commentId) 
update($commentId) 
delete($commentId)
```

## Model yang sudah dibuat

```text
UserModel
ProjectModel
ProjectMemberModel
TaskModel
CommentModel
ActivityLogModel
```

Fungsi model:

* Menghubungkan controller dengan tabel database
* Menentukan nama tabel
* Menentukan kolom yang boleh diisi
* Mempermudah query database lewat CI4 Model

## Filter yang sudah dibuat

### AuthFilter

Fungsi:

* Mengecek apakah user sudah login melalui session.
* Melindungi route yang hanya boleh diakses oleh user yang sudah login.
* Jika user belum login, user diarahkan kembali ke halaman login.
* Jika user sudah login, request boleh dilanjutkan ke controller tujuan.
* Digunakan untuk mencegah akses langsung ke dashboard, project, task, member, komentar, dan logout tanpa proses login.

Route yang sudah memakai AuthFilter:

```text
/projects/(:num)
/projects/(:num)/complete
/projects/(:num)/reopen
/projects/(:num)/archive
/projects/(:num)/edit
/projects/(:num)/update
/projects/(:num)/members
/projects/(:num)/members/(:num)/remove
/projects/(:num)/tasks/create
/projects/(:num)/tasks/store
/tasks/(:num)/archive
/tasks/(:num)/status
/tasks/(:num)/edit
/tasks/(:num)/update
/tasks/(:num)/comments
/comments/(:num)/edit 
/comments/(:num)/update 
/comments/(:num)/delete
```

### GuestFilter

Fungsi:

* Mengecek apakah user sudah login.
* Jika user sudah login, user diarahkan ke halaman dashboard.
* Jika user belum login, user boleh mengakses halaman login.
* Mencegah user yang sudah login membuka halaman login kembali.
* Digunakan untuk route login dan proses login.

Route yang sudah memakai GuestFilter:

```text
/
/login
```

## View yang sudah dibuat   

```text
auth/login.php
dashboard/index.php
projects/index.php
projects/show.php
projects/create.php
projects/edit.php
tasks/create.php
tasks/edit.php
comments/edit.php digunakan untuk menampilkan form edit komentar yang sudah ada.
```

Fungsi view:

* auth/login.php digunakan untuk menampilkan halaman login.
* dashboard/index.php digunakan untuk menampilkan halaman dashboard setelah user berhasil login, termasuk ringkasan project, task, dan aktivitas terbaru.
* projects/index.php digunakan untuk menampilkan daftar project yang dapat diakses oleh user berdasarkan role sebagai admin atau member.
* projects/show.php digunakan untuk menampilkan detail project, daftar task, komentar, team members, form tambah member, tombol edit/archive project, dan activity log.
* projects/create.php digunakan untuk menampilkan form pembuatan project baru.
* projects/edit.php digunakan untuk menampilkan form edit project yang sudah ada.
* tasks/create.php digunakan untuk menampilkan form pembuatan task baru pada project tertentu.
* tasks/edit.php digunakan untuk menampilkan form edit task yang sudah ada, seperti title, description, priority, deadline, dan assignee pada project tertentu.
* comments/edit.php digunakan untuk menampilkan form edit komentar yang sudah ada.

## Fitur yang sudah berjalan

```text
Login, logout, session login, dan protected route Dashboard setelah login
Menampilkan daftar project berdasarkan akses user sebagai admin atau member
Menampilkan detail project beserta member, task, komentar, dan activity log
Membuat project, mengedit, mengarsip dengan batasan hanya untuk user role admin
Mencatat activity log saat project dibuat
Mencatat activity log saat project diarsipkan
Menambah dan menghapus member dengan batasan hanya untuk admin project
Membuat task baru berdasarkan project dengan batasan hanya untuk admin project
Mencatat activity log saat task dibuat
Menambahkan assignee ke task dari admin atau member project
Memvalidasi input project, member, task, status task, dan komentar
Menampilkan task beserta status, priority, deadline, assignee, dan pembuat task
Mengubah status task dengan batasan hanya untuk admin project atau assignee
Mencatat activity log saat status task diperbarui
Menampilkan komentar pada setiap task
Menambahkan komentar hanya untuk admin project dan member project
Menyembunyikan form komentar untuk user dengan role klien
Mencatat activity log saat komentar ditambahkan
Mengedit komentar berdasarkan ID komentar. 
Menghapus komentar berdasarkan ID komentar. 
Menampilkan tombol edit komentar hanya untuk pemilik komentar. 
Menampilkan tombol delete komentar hanya untuk pemilik komentar atau admin project. 
Mencegah user dengan role klien untuk menambahkan dan mengedit komentar. 
Mencegah edit dan hapus komentar pada project yang telah completed. 
Memvalidasi input komentar saat komentar dibuat dan diperbarui. 
Mencatat activity log saat komentar diperbarui. 
Mencatat activity log saat komentar dihapus.
Menampilkan riwayat activity log berdasarkan aktivitas terbaru
Menyembunyikan tombol aksi berdasarkan hak akses user
Koneksi database melalui model dan query builder
Mencegah user yang sudah login mengakses halaman login kembali menggunakan GuestFilter
User yang sudah login otomatis diarahkan ke dashboard jika membuka halaman login
Membuat dan mengedit task berdasarkan project dengan batasan hanya untuk admin project
Mencatat activity log saat task dibuat dan diperbarui
Menampilkan tombol edit task hanya untuk admin project
Mengarsipkan task tanpa menghapus data dari database (soft archive)
Mencatat activity log saat task diarsipkan
Menyembunyikan task yang telah diarsipkan dari daftar task aktif, progress project, dashboard, dan statistik
Menampilkan daftar member project pada halaman daftar project
Mengubah status project menjadi completed dan membukanya kembali menjadi active
Mencegah perubahan data project yang sudah berstatus completed
Mencegah penambahan member, penghapusan member, pembuatan task, edit task, perubahan status task, pengarsipan task, dan penambahan komentar pada project yang telah completed
Mencatat activity log saat project diselesaikan (completed) dan saat project dibuka kembali (reopen)

```

### Activity Log

Fungsi:

* Mencatat aktivitas user yang terjadi di dalam project.
* Menyimpan riwayat aktivitas agar perubahan pada project dapat dilihat kembali.
* Menampilkan daftar aktivitas pada halaman detail project.
* Mengambil data activity log berdasarkan project_id.
* Menghubungkan activity log dengan tabel users untuk menampilkan nama user yang melakukan aktivitas.
* Mengurutkan activity log berdasarkan waktu terbaru menggunakan created_at DESC.

#### Data yang dicatat:

```text
user_id yaitu ID user yang melakukan aktivitas.
project_id yaitu ID project tempat aktivitas terjadi.
entity_type yaitu jenis data yang terkena aktivitas, seperti project, member, task, atau comment.
entity_id yaitu ID dari data yang terkena aktivitas.
action yaitu aksi yang dilakukan, seperti created, archived, atau status_updated.
detail yaitu keterangan tambahan dari aktivitas.
created_at yaitu waktu aktivitas dilakukan.
```

#### Aktivitas yang dicatat:

```text
Project dibuat.
Project diperbarui.
Project diarsipkan.
Project diselesaikan (completed).
Project dibuka kembali (reopen).
Member ditambahkan ke project.
Member dihapus dari project.
Task dibuat.
Task diperbarui.
Task diarsipkan.
Status task diperbarui.
Komentar ditambahkan pada task.
Komentar diperbarui. 
Komentar dihapus.
```

#### Controller yang menggunakan Activity Log:

```text
BaseController menyediakan method logActivity() untuk menyimpan activity log.
ProjectController mencatat aktivitas saat project dibuat, diperbarui, diarsipkan, diselesaikan (completed), dan dibuka kembali (reopen).
TaskController mencatat aktivitas saat task dibuat, diperbarui, diarsipkan, dan status task diperbarui.
CommentController mencatat aktivitas saat komentar ditambahkan, diperbarui, dan dihapus.
```

Method:

```text
logActivity($projectId, $entityType, $entityId, $action, $detail = null)
```

## Catatan sementara

Akun dummy (Admin):

```text
Email: admin@example.com
Password: password
```

Akun dummy (member):

```text
Email: budi@example.com
Password: password
```

Akun dummy (klien):

```text
Email: klien@example.com
Password: password
```

Project yang sudah diarsipkan tidak ditampilkan karena query memakai:

```php
where('archived_at', null)
```
