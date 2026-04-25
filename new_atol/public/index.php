<?php
/**
 * SIFOPI - Single Entry Point
 */

if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

session_start();
error_reporting(E_ALL);
ini_set('display_errors', false);
ini_set('log_errors', true);

$configPath = dirname(__DIR__) . '/config';
require_once $configPath . '/constants.php';
require_once $configPath . '/database.php';
require_once $configPath . '/helpers.php';

class Router {
    private string $path;
    private string $method;

    public function __construct() {
        $uri  = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        if (strlen($path) > 1) $path = rtrim($path, '/');
        $this->path   = $path;
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function route(): void {
        try {
            $key = $this->method . ':' . $this->path;
            match ($key) {
                'GET:/'                => $this->home(),
                'GET:/login'           => $this->loginForm(),
                'POST:/login'          => $this->loginPost(),
                'GET:/logout'          => $this->logout(),

                // Dashboard
                'GET:/dashboard'       => $this->dashboard(),

                // Profile
                'GET:/profile'         => $this->profilePage(),

                // Siswa
                'GET:/siswa'           => $this->siswaList(),
                'GET:/siswa/create'    => $this->siswaCreateForm(),
                'POST:/siswa/store'    => $this->siswaCreate(),
                'GET:/siswa/edit'      => $this->siswaEditForm(),
                'POST:/siswa/update'   => $this->siswaEdit(),
                'POST:/siswa/delete'   => $this->siswaDelete(),

                // Guru
                'GET:/guru'            => $this->guruList(),
                'GET:/guru/create'     => $this->guruCreateForm(),
                'POST:/guru/store'     => $this->guruCreate(),
                'GET:/guru/edit'       => $this->guruEditForm(),
                'POST:/guru/update'    => $this->guruEdit(),
                'POST:/guru/delete'    => $this->guruDelete(),

                // Kelas
                'GET:/kelas'           => $this->kelasList(),
                'GET:/kelas/create'    => $this->kelasCreateForm(),
                'POST:/kelas/store'    => $this->kelasCreate(),
                'GET:/kelas/edit'      => $this->kelasEditForm(),
                'POST:/kelas/update'   => $this->kelasEdit(),
                'POST:/kelas/delete'   => $this->kelasDelete(),

                // Mapel
                'GET:/mapel'           => $this->mapelList(),
                'GET:/mapel/create'    => $this->mapelCreateForm(),
                'POST:/mapel/store'    => $this->mapelCreate(),
                'GET:/mapel/edit'      => $this->mapelEditForm(),
                'POST:/mapel/update'   => $this->mapelEdit(),
                'POST:/mapel/delete'   => $this->mapelDelete(),

                // Nilai
                'GET:/nilai'           => $this->nilaiList(),
                'GET:/nilai/create'    => $this->nilaiCreateForm(),
                'POST:/nilai/store'    => $this->nilaiCreate(),
                'GET:/nilai/edit'      => $this->nilaiEditForm(),
                'POST:/nilai/update'   => $this->nilaiEdit(),
                'POST:/nilai/delete'   => $this->nilaiDelete(),

                // Absen
                'GET:/absen'           => $this->absenList(),
                'GET:/absen/create'    => $this->absenCreateForm(),
                'POST:/absen/store'    => $this->absenCreate(),
                'POST:/absen/delete'   => $this->absenDelete(),

                // Jadwal
                'GET:/jadwal'          => $this->jadwalList(),

                // Iuran/SPP
                'GET:/iuran'           => $this->iuranList(),
                'GET:/iuran/create'    => $this->iuranCreateForm(),
                'POST:/iuran/store'    => $this->iuranCreate(),
                'GET:/iuran/edit'      => $this->iuranEditForm(),
                'POST:/iuran/update'   => $this->iuranEdit(),
                'POST:/iuran/delete'   => $this->iuranDelete(),
                'GET:/iuran/pay'       => $this->iuranPayForm(),
                'POST:/iuran/process'  => $this->iuranProcessPay(),
                'GET:/iuran/print'     => $this->iuranPrint(),
                
                // Pembayaran Lain-lain
                'GET:/pembayaran-lain'         => $this->pembayaranLainList(),
                'GET:/pembayaran-lain/create'  => $this->pembayaranLainCreateForm(),
                'POST:/pembayaran-lain/store'  => $this->pembayaranLainCreate(),
                'GET:/pembayaran-lain/edit'    => $this->pembayaranLainEditForm(),
                'POST:/pembayaran-lain/update' => $this->pembayaranLainEdit(),
                'POST:/pembayaran-lain/delete' => $this->pembayaranLainDelete(),

                default => $this->notFound(),
            };
        } catch (\Throwable $e) {
            $this->serverError($e);
        }
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function render(string $viewPath, array $vars = []): void {
        extract($vars);
        $contentFile = dirname(__DIR__) . '/views/' . $viewPath . '.php';
        ob_start();
        include $contentFile;
        $pageContent = ob_get_clean();
        include dirname(__DIR__) . '/views/layout/base.php';
    }

    private function auth(): void {
        if (!isset($_SESSION['user'])) redirect('/login');
        if (time() - ($_SESSION['user']['logged_in_at'] ?? time()) > SESSION_LIFETIME) {
            session_destroy();
            setFlash('Sesi berakhir. Silakan login kembali.', 'warning');
            redirect('/login');
        }
        $_SESSION['user']['logged_in_at'] = time();
    }

    private function role(array $roles): void {
        if (!in_array($_SESSION['user']['role'] ?? '', $roles)) {
            http_response_code(403);
            include dirname(__DIR__) . '/views/error/403.php';
            exit;
        }
    }

    private function db(): Database { return Database::getInstance(); }

    private function id(): int { return (int)($_GET['id'] ?? 0); }

    private function notFound(): void {
        http_response_code(404);
        include dirname(__DIR__) . '/views/error/404.php';
    }

    private function serverError(\Throwable $e): void {
        error_log($e->getMessage());
        http_response_code(500);
        include dirname(__DIR__) . '/views/error/500.php';
    }

    // ─── Auth ─────────────────────────────────────────────────────────────────

    private function home(): void {
        isset($_SESSION['user']) ? redirect('/dashboard') : redirect('/login');
    }

    private function loginForm(): void {
        if (isset($_SESSION['user'])) redirect('/dashboard');
        $flash = getFlash();
        include dirname(__DIR__) . '/views/auth/login.php';
    }

    private function loginPost(): void {
        $username = sanitize($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        if (!$username || !$password) {
            setFlash('Username dan password harus diisi.', 'error');
            redirect('/login');
        }
        $user = $this->db()->query("SELECT * FROM user WHERE username = ? AND is_active = 1", [$username])->fetch();
        if (!$user || !verifyPassword($password, $user['password_hash'])) {
            setFlash('Username atau password salah.', 'error');
            redirect('/login');
        }
        $_SESSION['user'] = [
            'id'           => $user['id'],
            'username'     => $user['username'],
            'fullname'     => $user['fullname'],
            'role'         => $user['role'],
            'email'        => $user['email'] ?? '',
            'logged_in_at' => time(),
        ];
        $this->db()->update('user', ['last_login' => date('Y-m-d H:i:s')], 'id = ' . $user['id']);
        redirect('/dashboard');
    }

    private function logout(): void {
        session_destroy();
        redirect('/login');
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    private function dashboard(): void {
        $this->auth();
        $db   = $this->db();
        $role = $_SESSION['user']['role'];

        $stats = [
            'total_siswa' => $db->count('siswa', 'status = ?', ['AKTIF']),
            'total_guru'  => $db->count('guru', 'status = ?', ['AKTIF']),
            'total_kelas' => $db->count('kelas', 'is_active = 1'),
            'tunggakan'   => $db->count('spp', "status = 'BELUM_LUNAS'"),
        ];

        match ($role) {
            'ADMIN'       => $this->render('dashboard/admin', compact('stats')),
            'GURU'        => $this->render('dashboard/guru', compact('stats')),
            'SISWA'       => $this->render('dashboard/siswa', compact('stats')),
            'TATA_USAHA'  => $this->render('dashboard/tata_usaha', compact('stats')),
            'WALI_SISWA'  => $this->render('dashboard/wali_siswa', compact('stats')),
            default       => $this->render('dashboard/admin', compact('stats')),
        };
    }

    private function profilePage(): void {
        $this->auth();
        $this->render('auth/profile');
    }

    // ─── Siswa ────────────────────────────────────────────────────────────────

    private function siswaList(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU', 'TATA_USAHA']);
        $db     = $this->db();
        $page   = (int)($_GET['page'] ?? 1);
        $search = sanitize($_GET['search'] ?? '');
        $where  = $search ? "(nama LIKE ? OR no_induk LIKE ?)" : '';
        $params = $search ? ["%$search%", "%$search%"] : [];
        $result     = $db->paginate('siswa', $page, ITEMS_PER_PAGE, $where, $params);
        $kelas_list = $db->all('kelas', 'is_active = 1');
        $this->render('siswa/list', compact('result', 'kelas_list', 'search'));
    }

    private function siswaCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $kelas_list   = $this->db()->all('kelas', 'is_active = 1');
        $tahun_list   = $this->db()->all('tahun_ajaran');
        $this->render('siswa/create', compact('kelas_list', 'tahun_list'));
    }

    private function siswaCreate(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $db       = $this->db();
        $noInduk  = sanitize($_POST['no_induk'] ?? '');
        $nama     = sanitize($_POST['nama'] ?? '');
        if (!$noInduk || !$nama) {
            setFlash('No Induk dan Nama wajib diisi.', 'error');
            redirect('/siswa/create');
        }
        if ($db->count('siswa', 'no_induk = ?', [$noInduk]) > 0) {
            setFlash('No Induk sudah terdaftar.', 'error');
            redirect('/siswa/create');
        }
        // Create user account
        $username = $noInduk;
        if ($db->count('user', 'username = ?', [$username]) === 0) {
            $userId = $db->insert('user', [
                'username'      => $username,
                'email'         => sanitize($_POST['email'] ?? '') ?: null,
                'password_hash' => hashPassword('password123'),
                'fullname'      => $nama,
                'role'          => 'SISWA',
                'is_active'     => 1,
            ]);
        } else {
            $u = $db->query("SELECT id FROM user WHERE username = ?", [$username])->fetch();
            $userId = $u['id'];
        }
        $db->insert('siswa', [
            'user_id'        => $userId,
            'no_induk'       => $noInduk,
            'nama'           => $nama,
            'tgl_lahir'      => sanitize($_POST['tgl_lahir'] ?? '') ?: null,
            'jenis_kelamin'  => sanitize($_POST['jenis_kelamin'] ?? '') ?: null,
            'agama'          => sanitize($_POST['agama'] ?? '') ?: null,
            'alamat'         => sanitize($_POST['alamat'] ?? '') ?: null,
            'no_telepon'     => sanitize($_POST['no_telepon'] ?? '') ?: null,
            'email'          => sanitize($_POST['email'] ?? '') ?: null,
            'kelas_id'       => (int)($_POST['kelas_id'] ?? 0) ?: null,
            'tahun_ajaran_id'=> (int)($_POST['tahun_ajaran_id'] ?? 0) ?: null,
            'tanggal_masuk'  => sanitize($_POST['tanggal_masuk'] ?? '') ?: date('Y-m-d'),
            'status'         => 'AKTIF',
        ]);
        setFlash("Siswa $nama berhasil ditambahkan. Login: $username / password123", 'success');
        redirect('/siswa');
    }

    private function siswaEditForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $siswa = $this->db()->find('siswa', $this->id());
        if (!$siswa) { setFlash('Data tidak ditemukan.', 'error'); redirect('/siswa'); }
        $kelas_list = $this->db()->all('kelas', 'is_active = 1');
        $this->render('siswa/edit', compact('siswa', 'kelas_list'));
    }

    private function siswaEdit(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $db  = $this->db();
        $id  = $this->id();
        $siswa = $db->find('siswa', $id);
        if (!$siswa) { setFlash('Data tidak ditemukan.', 'error'); redirect('/siswa'); }
        $db->update('siswa', [
            'nama'          => sanitize($_POST['nama'] ?? $siswa['nama']),
            'tgl_lahir'     => sanitize($_POST['tgl_lahir'] ?? '') ?: null,
            'jenis_kelamin' => sanitize($_POST['jenis_kelamin'] ?? '') ?: null,
            'agama'         => sanitize($_POST['agama'] ?? '') ?: null,
            'alamat'        => sanitize($_POST['alamat'] ?? '') ?: null,
            'no_telepon'    => sanitize($_POST['no_telepon'] ?? '') ?: null,
            'email'         => sanitize($_POST['email'] ?? '') ?: null,
            'kelas_id'      => (int)($_POST['kelas_id'] ?? 0) ?: null,
            'status'        => sanitize($_POST['status'] ?? 'AKTIF'),
        ], "id = $id");
        setFlash('Data siswa berhasil diperbarui.', 'success');
        redirect('/siswa');
    }

    private function siswaDelete(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $id = $this->id();
        $siswa = $this->db()->find('siswa', $id);
        if ($siswa) {
            $this->db()->delete('siswa', "id = $id");
            setFlash('Data siswa berhasil dihapus.', 'success');
        }
        redirect('/siswa');
    }

    // ─── Guru ─────────────────────────────────────────────────────────────────

    private function guruList(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $db     = $this->db();
        $page   = (int)($_GET['page'] ?? 1);
        $search = sanitize($_GET['search'] ?? '');
        $where  = $search ? "(nama LIKE ? OR nip LIKE ?)" : '';
        $params = $search ? ["%$search%", "%$search%"] : [];
        $result = $db->paginate('guru', $page, ITEMS_PER_PAGE, $where, $params);
        $this->render('guru/list', compact('result', 'search'));
    }

    private function guruCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $this->render('guru/create');
    }

    private function guruCreate(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $db  = $this->db();
        $nip = sanitize($_POST['nip'] ?? '');
        $nama = sanitize($_POST['nama'] ?? '');
        if (!$nama) { setFlash('Nama wajib diisi.', 'error'); redirect('/guru/create'); }
        $username = $nip ?: 'guru_' . strtolower(str_replace(' ', '_', $nama));
        if ($db->count('user', 'username = ?', [$username]) === 0) {
            $userId = $db->insert('user', [
                'username'      => $username,
                'email'         => sanitize($_POST['email'] ?? '') ?: null,
                'password_hash' => hashPassword('password123'),
                'fullname'      => $nama,
                'role'          => 'GURU',
                'is_active'     => 1,
            ]);
        } else {
            $u = $db->query("SELECT id FROM user WHERE username = ?", [$username])->fetch();
            $userId = $u['id'];
        }
        $db->insert('guru', [
            'user_id'      => $userId,
            'nip'          => $nip ?: null,
            'nama'         => $nama,
            'tgl_lahir'    => sanitize($_POST['tgl_lahir'] ?? '') ?: null,
            'jenis_kelamin'=> sanitize($_POST['jenis_kelamin'] ?? '') ?: null,
            'agama'        => sanitize($_POST['agama'] ?? '') ?: null,
            'alamat'       => sanitize($_POST['alamat'] ?? '') ?: null,
            'no_telepon'   => sanitize($_POST['no_telepon'] ?? '') ?: null,
            'email'        => sanitize($_POST['email'] ?? '') ?: null,
            'bidang_studi' => sanitize($_POST['bidang_studi'] ?? '') ?: null,
            'tgl_masuk'    => sanitize($_POST['tgl_masuk'] ?? '') ?: date('Y-m-d'),
            'status'       => 'AKTIF',
        ]);
        setFlash("Guru $nama berhasil ditambahkan. Login: $username / password123", 'success');
        redirect('/guru');
    }

    private function guruEditForm(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $guru = $this->db()->find('guru', $this->id());
        if (!$guru) { setFlash('Data tidak ditemukan.', 'error'); redirect('/guru'); }
        $this->render('guru/edit', compact('guru'));
    }

    private function guruEdit(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $db = $this->db();
        $id = $this->id();
        $guru = $db->find('guru', $id);
        if (!$guru) { setFlash('Data tidak ditemukan.', 'error'); redirect('/guru'); }
        $db->update('guru', [
            'nip'          => sanitize($_POST['nip'] ?? '') ?: null,
            'nama'         => sanitize($_POST['nama'] ?? $guru['nama']),
            'tgl_lahir'    => sanitize($_POST['tgl_lahir'] ?? '') ?: null,
            'jenis_kelamin'=> sanitize($_POST['jenis_kelamin'] ?? '') ?: null,
            'agama'        => sanitize($_POST['agama'] ?? '') ?: null,
            'alamat'       => sanitize($_POST['alamat'] ?? '') ?: null,
            'no_telepon'   => sanitize($_POST['no_telepon'] ?? '') ?: null,
            'email'        => sanitize($_POST['email'] ?? '') ?: null,
            'bidang_studi' => sanitize($_POST['bidang_studi'] ?? '') ?: null,
            'status'       => sanitize($_POST['status'] ?? 'AKTIF'),
        ], "id = $id");
        setFlash('Data guru berhasil diperbarui.', 'success');
        redirect('/guru');
    }

    private function guruDelete(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $id = $this->id();
        if ($this->db()->find('guru', $id)) {
            $this->db()->delete('guru', "id = $id");
            setFlash('Data guru berhasil dihapus.', 'success');
        }
        redirect('/guru');
    }

    // ─── Kelas ────────────────────────────────────────────────────────────────

    private function kelasList(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU', 'TATA_USAHA']);
        $result    = $this->db()->all('kelas', 'is_active = 1 ORDER BY nama_kelas');
        $guru_list = $this->db()->all('guru', 'status = ?', ['AKTIF']);
        $this->render('kelas/list', compact('result', 'guru_list'));
    }

    private function kelasCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $guru_list  = $this->db()->all('guru', 'status = ?', ['AKTIF']);
        $tahun_list = $this->db()->all('tahun_ajaran');
        $this->render('kelas/create', compact('guru_list', 'tahun_list'));
    }

    private function kelasCreate(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $namaKelas = sanitize($_POST['nama_kelas'] ?? '');
        if (!$namaKelas) { setFlash('Nama kelas wajib diisi.', 'error'); redirect('/kelas/create'); }
        $this->db()->insert('kelas', [
            'nama_kelas'      => $namaKelas,
            'no_ruangan'      => sanitize($_POST['no_ruangan'] ?? '') ?: null,
            'id_guru_wali'    => (int)($_POST['id_guru_wali'] ?? 0) ?: null,
            'tahun_ajaran_id' => (int)($_POST['tahun_ajaran_id'] ?? 1),
            'kurikulum'       => sanitize($_POST['kurikulum'] ?? '') ?: null,
            'capacity'        => (int)($_POST['capacity'] ?? 40),
            'is_active'       => 1,
        ]);
        setFlash("Kelas $namaKelas berhasil ditambahkan.", 'success');
        redirect('/kelas');
    }

    private function kelasEditForm(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $kelas = $this->db()->find('kelas', $this->id());
        if (!$kelas) { setFlash('Data tidak ditemukan.', 'error'); redirect('/kelas'); }
        $guru_list  = $this->db()->all('guru', 'status = ?', ['AKTIF']);
        $tahun_list = $this->db()->all('tahun_ajaran');
        $this->render('kelas/edit', compact('kelas', 'guru_list', 'tahun_list'));
    }

    private function kelasEdit(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $id    = $this->id();
        $kelas = $this->db()->find('kelas', $id);
        if (!$kelas) { setFlash('Data tidak ditemukan.', 'error'); redirect('/kelas'); }
        $this->db()->update('kelas', [
            'nama_kelas'      => sanitize($_POST['nama_kelas'] ?? $kelas['nama_kelas']),
            'no_ruangan'      => sanitize($_POST['no_ruangan'] ?? '') ?: null,
            'id_guru_wali'    => (int)($_POST['id_guru_wali'] ?? 0) ?: null,
            'kurikulum'       => sanitize($_POST['kurikulum'] ?? '') ?: null,
            'capacity'        => (int)($_POST['capacity'] ?? 40),
            'is_active'       => isset($_POST['is_active']) ? 1 : 0,
        ], "id = $id");
        setFlash('Data kelas berhasil diperbarui.', 'success');
        redirect('/kelas');
    }

    private function kelasDelete(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $id = $this->id();
        if ($this->db()->find('kelas', $id)) {
            $this->db()->update('kelas', ['is_active' => 0], "id = $id");
            setFlash('Kelas berhasil dinonaktifkan.', 'success');
        }
        redirect('/kelas');
    }

    // ─── Mapel ────────────────────────────────────────────────────────────────

    private function mapelList(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU', 'TATA_USAHA']);
        $result = $this->db()->all('mapel', 'is_active = 1 ORDER BY mata_pelajaran');
        $this->render('mapel/list', compact('result'));
    }

    private function mapelCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $this->render('mapel/create');
    }

    private function mapelCreate(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $nama = sanitize($_POST['mata_pelajaran'] ?? '');
        if (!$nama) { setFlash('Nama mata pelajaran wajib diisi.', 'error'); redirect('/mapel/create'); }
        $this->db()->insert('mapel', [
            'kode_mapel'          => sanitize($_POST['kode_mapel'] ?? '') ?: null,
            'mata_pelajaran'      => $nama,
            'kategori_pelajaran'  => sanitize($_POST['kategori_pelajaran'] ?? '') ?: null,
            'jam_pembelajaran'    => (int)($_POST['jam_pembelajaran'] ?? 0) ?: null,
            'kurikulum'           => sanitize($_POST['kurikulum'] ?? '') ?: null,
            'kkm'                 => (int)($_POST['kkm'] ?? 75),
            'kelompok'            => sanitize($_POST['kelompok'] ?? 'Umum'),
            'is_active'           => 1,
        ]);
        setFlash("Mata pelajaran $nama berhasil ditambahkan.", 'success');
        redirect('/mapel');
    }

    private function mapelEditForm(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $mapel = $this->db()->find('mapel', $this->id());
        if (!$mapel) { setFlash('Data tidak ditemukan.', 'error'); redirect('/mapel'); }
        $this->render('mapel/edit', compact('mapel'));
    }

    private function mapelEdit(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $id    = $this->id();
        $mapel = $this->db()->find('mapel', $id);
        if (!$mapel) { setFlash('Data tidak ditemukan.', 'error'); redirect('/mapel'); }
        $this->db()->update('mapel', [
            'kode_mapel'         => sanitize($_POST['kode_mapel'] ?? '') ?: null,
            'mata_pelajaran'     => sanitize($_POST['mata_pelajaran'] ?? $mapel['mata_pelajaran']),
            'kategori_pelajaran' => sanitize($_POST['kategori_pelajaran'] ?? '') ?: null,
            'jam_pembelajaran'   => (int)($_POST['jam_pembelajaran'] ?? 0) ?: null,
            'kurikulum'          => sanitize($_POST['kurikulum'] ?? '') ?: null,
            'kkm'                => (int)($_POST['kkm'] ?? 75),
            'kelompok'           => sanitize($_POST['kelompok'] ?? 'Umum'),
            'is_active'          => isset($_POST['is_active']) ? 1 : 0,
        ], "id = $id");
        setFlash('Mata pelajaran berhasil diperbarui.', 'success');
        redirect('/mapel');
    }

    private function mapelDelete(): void {
        $this->auth();
        $this->role(['ADMIN']);
        $id = $this->id();
        if ($this->db()->find('mapel', $id)) {
            $this->db()->update('mapel', ['is_active' => 0], "id = $id");
            setFlash('Mata pelajaran berhasil dinonaktifkan.', 'success');
        }
        redirect('/mapel');
    }

    // ─── Nilai ────────────────────────────────────────────────────────────────

    private function nilaiList(): void {
        $this->auth();
        $db     = $this->db();
        $page   = (int)($_GET['page'] ?? 1);
        $role   = $_SESSION['user']['role'];

        if ($role === 'SISWA') {
            $siswa = $db->query("SELECT * FROM siswa WHERE user_id = ?", [$_SESSION['user']['id']])->fetch();
            $where  = $siswa ? 'n.siswa_id = ' . $siswa['id'] : '1=0';
        } else {
            $where = '';
        }

        $sql = "SELECT n.*, s.nama as nama_siswa, s.no_induk,
                       pk.mapel_id, m.mata_pelajaran, k.nama_kelas
                FROM nilai n
                JOIN siswa s ON s.id = n.siswa_id
                JOIN pelajaran_kelas pk ON pk.id = n.pelajaran_kelas_id
                JOIN mapel m ON m.id = pk.mapel_id
                JOIN kelas k ON k.id = pk.kelas_id
                " . ($where ? "WHERE $where" : '') . "
                ORDER BY n.id DESC
                LIMIT ? OFFSET ?";
        $perPage = ITEMS_PER_PAGE;
        $offset  = ($page - 1) * $perPage;
        $data    = $db->query($sql, [$perPage, $offset])->fetchAll();

        $countSql = "SELECT COUNT(*) as c FROM nilai n " . ($where ? "WHERE $where" : '');
        $total    = (int)($db->query($countSql)->fetch()['c'] ?? 0);
        $pages    = max(1, (int)ceil($total / $perPage));

        $result = [
            'data' => $data, 'page' => $page, 'pages' => $pages,
            'total' => $total, 'has_prev' => $page > 1, 'has_next' => $page < $pages,
        ];

        $siswa_list = ($role !== 'SISWA') ? $db->all('siswa', 'status = ?', ['AKTIF']) : [];
        $pk_list    = $db->query("SELECT pk.*, m.mata_pelajaran, k.nama_kelas FROM pelajaran_kelas pk JOIN mapel m ON m.id = pk.mapel_id JOIN kelas k ON k.id = pk.kelas_id WHERE pk.is_active = 1")->fetchAll();
        $this->render('nilai/list', compact('result', 'siswa_list', 'pk_list'));
    }

    private function nilaiCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $db         = $this->db();
        $siswa_list = $db->all('siswa', 'status = ?', ['AKTIF']);
        $pk_list    = $db->query("SELECT pk.*, m.mata_pelajaran, k.nama_kelas FROM pelajaran_kelas pk JOIN mapel m ON m.id = pk.mapel_id JOIN kelas k ON k.id = pk.kelas_id WHERE pk.is_active = 1")->fetchAll();
        $tahun_list = $db->all('tahun_ajaran');
        $this->render('nilai/create', compact('siswa_list', 'pk_list', 'tahun_list'));
    }

    private function nilaiCreate(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $tugas = (float)($_POST['tugas'] ?? 0);
        $uts   = (float)($_POST['uts'] ?? 0);
        $uas   = (float)($_POST['uas'] ?? 0);
        $rata  = round(($tugas + $uts + $uas) / 3, 2);
        $grade = $rata >= 90 ? 'A' : ($rata >= 80 ? 'B' : ($rata >= 70 ? 'C' : ($rata >= 60 ? 'D' : 'E')));
        $this->db()->insert('nilai', [
            'siswa_id'          => (int)($_POST['siswa_id'] ?? 0),
            'pelajaran_kelas_id'=> (int)($_POST['pelajaran_kelas_id'] ?? 0),
            'tahun_ajaran_id'   => (int)($_POST['tahun_ajaran_id'] ?? 1),
            'semester'          => (int)($_POST['semester'] ?? 1),
            'tugas'             => $tugas,
            'uts'               => $uts,
            'uas'               => $uas,
            'rata_rata'         => $rata,
            'grade'             => $grade,
        ]);
        setFlash('Nilai berhasil disimpan.', 'success');
        redirect('/nilai');
    }

    private function nilaiEditForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $nilai = $this->db()->find('nilai', $this->id());
        if (!$nilai) { setFlash('Data tidak ditemukan.', 'error'); redirect('/nilai'); }
        $siswa_list = $this->db()->all('siswa', 'status = ?', ['AKTIF']);
        $pk_list    = $this->db()->query("SELECT pk.*, m.mata_pelajaran, k.nama_kelas FROM pelajaran_kelas pk JOIN mapel m ON m.id = pk.mapel_id JOIN kelas k ON k.id = pk.kelas_id WHERE pk.is_active = 1")->fetchAll();
        $this->render('nilai/edit', compact('nilai', 'siswa_list', 'pk_list'));
    }

    private function nilaiEdit(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $id    = $this->id();
        $tugas = (float)($_POST['tugas'] ?? 0);
        $uts   = (float)($_POST['uts'] ?? 0);
        $uas   = (float)($_POST['uas'] ?? 0);
        $rata  = round(($tugas + $uts + $uas) / 3, 2);
        $grade = $rata >= 90 ? 'A' : ($rata >= 80 ? 'B' : ($rata >= 70 ? 'C' : ($rata >= 60 ? 'D' : 'E')));
        $this->db()->update('nilai', [
            'tugas' => $tugas, 'uts' => $uts, 'uas' => $uas,
            'rata_rata' => $rata, 'grade' => $grade,
        ], "id = $id");
        setFlash('Nilai berhasil diperbarui.', 'success');
        redirect('/nilai');
    }

    private function nilaiDelete(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $id = $this->id();
        $this->db()->delete('nilai', "id = $id");
        setFlash('Nilai berhasil dihapus.', 'success');
        redirect('/nilai');
    }

    // ─── Absen ────────────────────────────────────────────────────────────────

    private function absenList(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU', 'TATA_USAHA']);
        $db       = $this->db();
        $page     = (int)($_GET['page'] ?? 1);
        $tanggal  = sanitize($_GET['tanggal'] ?? '');
        $kelas_id = (int)($_GET['kelas_id'] ?? 0);

        $where  = [];
        $params = [];
        if ($tanggal) { $where[] = 'a.tanggal = ?'; $params[] = $tanggal; }
        if ($kelas_id) { $where[] = 'pk.kelas_id = ?'; $params[] = $kelas_id; }
        $whereStr = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        $sql = "SELECT a.*, s.nama as nama_siswa, s.no_induk, k.nama_kelas, m.mata_pelajaran
                FROM absen a
                JOIN siswa s ON s.id = a.siswa_id
                JOIN pelajaran_kelas pk ON pk.id = a.pelajaran_kelas_id
                JOIN kelas k ON k.id = pk.kelas_id
                JOIN mapel m ON m.id = pk.mapel_id
                $whereStr
                ORDER BY a.tanggal DESC, s.nama
                LIMIT ? OFFSET ?";
        $perPage = ITEMS_PER_PAGE;
        $offset  = ($page - 1) * $perPage;
        $data    = $db->query($sql, array_merge($params, [$perPage, $offset]))->fetchAll();

        $countSql = "SELECT COUNT(*) as c FROM absen a JOIN pelajaran_kelas pk ON pk.id = a.pelajaran_kelas_id $whereStr";
        $total    = (int)($db->query($countSql, $params)->fetch()['c'] ?? 0);
        $pages    = max(1, (int)ceil($total / $perPage));

        $result = [
            'data' => $data, 'page' => $page, 'pages' => $pages,
            'total' => $total, 'has_prev' => $page > 1, 'has_next' => $page < $pages,
        ];
        $kelas_list = $db->all('kelas', 'is_active = 1');
        $this->render('absen/list', compact('result', 'kelas_list', 'tanggal', 'kelas_id'));
    }

    private function absenCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $db         = $this->db();
        $kelas_list = $db->all('kelas', 'is_active = 1 ORDER BY nama_kelas');
        $siswa_list = $db->all('siswa', 'status = ?', ['AKTIF']);
        $pk_list    = $db->query("SELECT pk.*, m.mata_pelajaran, k.nama_kelas FROM pelajaran_kelas pk JOIN mapel m ON m.id = pk.mapel_id JOIN kelas k ON k.id = pk.kelas_id WHERE pk.is_active = 1")->fetchAll();
        $this->render('absen/create', compact('kelas_list', 'siswa_list', 'pk_list'));
    }

    private function absenCreate(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $this->db()->insert('absen', [
            'siswa_id'          => (int)($_POST['siswa_id'] ?? 0),
            'pelajaran_kelas_id'=> (int)($_POST['pelajaran_kelas_id'] ?? 0),
            'tanggal'           => sanitize($_POST['tanggal'] ?? date('Y-m-d')),
            'status'            => sanitize($_POST['status'] ?? 'HADIR'),
            'keterangan'        => sanitize($_POST['keterangan'] ?? '') ?: null,
        ]);
        setFlash('Absensi berhasil disimpan.', 'success');
        redirect('/absen');
    }

    private function absenDelete(): void {
        $this->auth();
        $this->role(['ADMIN', 'GURU']);
        $id = $this->id();
        $this->db()->delete('absen', "id = $id");
        setFlash('Data absen berhasil dihapus.', 'success');
        redirect('/absen');
    }

    // ─── Jadwal ───────────────────────────────────────────────────────────────

    private function jadwalList(): void {
        $this->auth();
        $result = $this->db()->query(
            "SELECT j.*, pk.ruangan, m.mata_pelajaran, k.nama_kelas, g.nama as nama_guru
             FROM jadwal j
             JOIN pelajaran_kelas pk ON pk.id = j.pelajaran_kelas_id
             JOIN mapel m ON m.id = pk.mapel_id
             JOIN kelas k ON k.id = pk.kelas_id
             JOIN guru g ON g.id = pk.guru_id
             ORDER BY FIELD(j.hari,'SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU'), j.jam_mulai"
        )->fetchAll();
        $this->render('jadwal/list', compact('result'));
    }

    // ─── Iuran/SPP ────────────────────────────────────────────────────────────

    private function iuranList(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $db       = $this->db();
        $page     = (int)($_GET['page'] ?? 1);
        $search   = sanitize($_GET['search'] ?? '');
        $status   = sanitize($_GET['status'] ?? '');

        $where  = ['1=1'];
        $params = [];
        if ($search) { $where[] = "s.nama LIKE ?"; $params[] = "%$search%"; }
        if ($status) { $where[] = "spp.status = ?"; $params[] = $status; }
        $whereStr = 'WHERE ' . implode(' AND ', $where);

        $sql = "SELECT spp.*, s.nama as nama_siswa, s.no_induk
                FROM spp JOIN siswa s ON s.id = spp.siswa_id
                $whereStr ORDER BY spp.tahun DESC, spp.bulan DESC
                LIMIT ? OFFSET ?";
        $perPage = ITEMS_PER_PAGE;
        $offset  = ($page - 1) * $perPage;
        $data    = $db->query($sql, array_merge($params, [$perPage, $offset]))->fetchAll();

        $countSql = "SELECT COUNT(*) as c FROM spp JOIN siswa s ON s.id = spp.siswa_id $whereStr";
        $total    = (int)($db->query($countSql, $params)->fetch()['c'] ?? 0);
        $pages    = max(1, (int)ceil($total / $perPage));

        $result = [
            'data' => $data, 'page' => $page, 'pages' => $pages,
            'total' => $total, 'has_prev' => $page > 1, 'has_next' => $page < $pages,
        ];
        $this->render('iuran/list', compact('result', 'search', 'status'));
    }

    private function iuranCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $siswa_list = $this->db()->all('siswa', "status = 'AKTIF' ORDER BY nama");
        $this->render('iuran/create', compact('siswa_list'));
    }

    private function iuranCreate(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $siswaId = (int)($_POST['siswa_id'] ?? 0);
        $bulan   = (int)($_POST['bulan'] ?? 0);
        $tahun   = (int)($_POST['tahun'] ?? date('Y'));
        if (!$siswaId || !$bulan) { setFlash('Siswa dan bulan wajib diisi.', 'error'); redirect('/iuran/create'); }
        $this->db()->insert('spp', [
            'siswa_id'     => $siswaId,
            'bulan'        => $bulan,
            'tahun'        => $tahun,
            'nominal'      => (float)($_POST['nominal'] ?? 0),
            'status'       => sanitize($_POST['status'] ?? 'BELUM_LUNAS'),
            'tanggal_bayar'=> sanitize($_POST['tanggal_bayar'] ?? '') ?: null,
            'metode_bayar' => sanitize($_POST['metode_bayar'] ?? '') ?: null,
            'catatan'      => sanitize($_POST['catatan'] ?? '') ?: null,
        ]);
        setFlash('Data SPP berhasil disimpan.', 'success');
        redirect('/iuran');
    }

    private function iuranEditForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $spp        = $this->db()->find('spp', $this->id());
        if (!$spp) { setFlash('Data tidak ditemukan.', 'error'); redirect('/iuran'); }
        $siswa_list = $this->db()->all('siswa', "status = 'AKTIF' ORDER BY nama");
        $this->render('iuran/edit', compact('spp', 'siswa_list'));
    }

    private function iuranEdit(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $id  = $this->id();
        $spp = $this->db()->find('spp', $id);
        if (!$spp) { setFlash('Data tidak ditemukan.', 'error'); redirect('/iuran'); }
        $this->db()->update('spp', [
            'nominal'      => (float)($_POST['nominal'] ?? $spp['nominal']),
            'status'       => sanitize($_POST['status'] ?? $spp['status']),
            'tanggal_bayar'=> sanitize($_POST['tanggal_bayar'] ?? '') ?: null,
            'metode_bayar' => sanitize($_POST['metode_bayar'] ?? '') ?: null,
            'catatan'      => sanitize($_POST['catatan'] ?? '') ?: null,
        ], "id = $id");
        setFlash('Data SPP berhasil diperbarui.', 'success');
        redirect('/iuran');
    }

    private function iuranDelete(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $id = $this->id();
        $this->db()->delete('spp', "id = $id");
        setFlash('Data SPP berhasil dihapus.', 'success');
        redirect('/iuran');
    }

    private function iuranPayForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $spp = $this->db()->query("SELECT spp.*, s.nama as siswa_nama, s.no_induk FROM spp JOIN siswa s ON s.id = spp.siswa_id WHERE spp.id = ?", [$this->id()])->fetch();
        if (!$spp) { setFlash('Data tidak ditemukan.', 'error'); redirect('/iuran'); }
        $this->render('iuran/pay', compact('spp'));
    }

    private function iuranProcessPay(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $id = $this->id();
        $this->db()->update('spp', [
            'status' => 'LUNAS',
            'tanggal_bayar' => date('Y-m-d'),
            'metode_bayar' => sanitize($_POST['metode_bayar'] ?? 'TUNAI')
        ], "id = $id");
        setFlash('Pembayaran berhasil diterima.', 'success');
        redirect('/iuran');
    }

    private function iuranPrint(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $spp = $this->db()->query("SELECT spp.*, s.nama as siswa_nama, s.no_induk FROM spp JOIN siswa s ON s.id = spp.siswa_id WHERE spp.id = ?", [$this->id()])->fetch();
        if (!$spp) die('Data kuitansi tidak ditemukan.');
        include dirname(__DIR__) . '/views/iuran/print.php';
    }

    // ─── Pembayaran Lain-lain ─────────────────────────────────────────────────

    private function pembayaranLainList(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $db     = $this->db();
        $page   = (int)($_GET['page'] ?? 1);
        
        $sql = "SELECT * FROM pembayaran_lain WHERE is_active = 1 ORDER BY id DESC LIMIT ? OFFSET ?";
        
        $perPage = ITEMS_PER_PAGE;
        $offset  = ($page - 1) * $perPage;
        $data    = $db->query($sql, [$perPage, $offset])->fetchAll();

        $total = (int)($db->query("SELECT COUNT(*) as c FROM pembayaran_lain WHERE is_active = 1")->fetch()['c'] ?? 0);
        $pages = max(1, (int)ceil($total / $perPage));

        $result = [
            'data' => $data, 'page' => $page, 'pages' => $pages,
            'total' => $total, 'has_prev' => $page > 1, 'has_next' => $page < $pages,
        ];
        $this->render('pembayaran_lain/list', compact('result'));
    }

    private function pembayaranLainCreateForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $this->render('pembayaran_lain/create');
    }

    private function pembayaranLainCreate(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        
        $this->db()->insert('pembayaran_lain', [
            'nama_pembayaran'  => sanitize($_POST['nama_pembayaran'] ?? ''),
            'deskripsi'        => sanitize($_POST['deskripsi'] ?? '') ?: null,
            'nominal'          => (float)($_POST['nominal'] ?? 0),
            'tanggal_mulai'    => date('Y-m-d'),
            'tanggal_berakhir' => sanitize($_POST['tanggal_berakhir'] ?? '') ?: null,
            'denda_per_hari'   => (float)($_POST['denda_per_hari'] ?? 0),
            'is_active'        => 1,
        ]);
        setFlash('Master pembayaran tambahan berhasil ditambahkan.', 'success');
        redirect('/pembayaran-lain');
    }

    private function pembayaranLainEditForm(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $tagihan = $this->db()->find('pembayaran_lain', $this->id());
        if (!$tagihan) { setFlash('Data tidak ditemukan.', 'error'); redirect('/pembayaran-lain'); }
        $this->render('pembayaran_lain/edit', compact('tagihan'));
    }

    private function pembayaranLainEdit(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $id = $this->id();
        $this->db()->update('pembayaran_lain', [
            'nama_pembayaran'  => sanitize($_POST['nama_pembayaran'] ?? ''),
            'deskripsi'        => sanitize($_POST['deskripsi'] ?? '') ?: null,
            'nominal'          => (float)($_POST['nominal'] ?? 0),
            'tanggal_berakhir' => sanitize($_POST['tanggal_berakhir'] ?? '') ?: null,
            'denda_per_hari'   => (float)($_POST['denda_per_hari'] ?? 0),
        ], "id = $id");
        setFlash('Data pembayaran tambahan berhasil diperbarui.', 'success');
        redirect('/pembayaran-lain');
    }

    private function pembayaranLainDelete(): void {
        $this->auth();
        $this->role(['ADMIN', 'TATA_USAHA']);
        $this->db()->update('pembayaran_lain', ['is_active' => 0], "id = " . $this->id());
        setFlash('Data pembayaran berhasil dinonaktifkan.', 'success');
        redirect('/pembayaran-lain');
    }
}

(new Router())->route();
