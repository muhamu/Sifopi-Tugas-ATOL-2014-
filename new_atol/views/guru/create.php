<?php $pageTitle = 'Tambah Guru Baru'; $activePage = 'guru'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Pendaftaran Tenaga Pengajar</h1>
        <p class="g-form-subtitle">Buat profil baru untuk guru atau staf pengajar ke dalam sistem SIFOPI.</p>
    </div>

    <form action="/guru/store" method="POST" id="form-tambah-guru">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <input type="text" id="nip" name="nip" class="g-input" placeholder=" " data-validate="required,number">
                <label for="nip" class="g-label">NIP / NIK Guru</label>
            </div>

            <div class="g-form-group">
                <input type="text" id="nama" name="nama" class="g-input" placeholder=" " data-validate="required">
                <label for="nama" class="g-label">Nama Lengkap (beserta gelar)</label>
            </div>

            <div class="g-form-group">
                <select id="jk" name="jk" class="g-input" data-validate="required" required>
                    <option value="" disabled selected></option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <label for="jk" class="g-label">Jenis Kelamin</label>
            </div>

            <div class="g-form-group">
                <input type="tel" id="no_telepon" name="no_telepon" class="g-input" placeholder=" " data-validate="required,phone">
                <label for="no_telepon" class="g-label">Nomor Telepon / WhatsApp</label>
            </div>
            
            <div class="g-form-group full-width">
                <input type="email" id="email" name="email" class="g-input" placeholder=" " data-validate="email">
                <label for="email" class="g-label">Alamat Email (Opsional)</label>
            </div>

            <div class="g-form-group full-width">
                <input type="text" id="bidang_studi" name="bidang_studi" class="g-input" placeholder=" ">
                <label for="bidang_studi" class="g-label">Bidang Studi / Keahlian Utama</label>
            </div>
        </div>

        <div class="g-form-actions">
            <a href="/guru" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Tambahkan Guru</button>
        </div>
    </form>
</div>