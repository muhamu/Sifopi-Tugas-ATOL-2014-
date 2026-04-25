<?php $pageTitle = 'Tambah Siswa Baru'; $activePage = 'siswa'; ?>

<div class="g-form-card">
    <div class="g-form-header">
        <h1 class="g-form-title">Pendaftaran Siswa Baru</h1>
        <p class="g-form-subtitle">Masukkan informasi profil siswa untuk didaftarkan ke pangkalan data akademik sekolah.</p>
    </div>

    <form action="/siswa/store" method="POST" id="form-tambah-siswa">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="g-form-grid">
            <div class="g-form-group">
                <!-- Perhatikan: placeholder=" " krusial agar floating label JS-less berfungsi! -->
                <input type="text" id="nis" name="nis" class="g-input" placeholder=" " data-validate="required,number,minLength:8,maxLength:10">
                <label for="nis" class="g-label">Nomor Induk Siswa (NIS)</label>
            </div>
            
            <div class="g-form-group">
                <input type="text" id="nisn" name="nisn" class="g-input" placeholder=" " data-validate="number,minLength:10,maxLength:10">
                <label for="nisn" class="g-label">NISN (Opsional)</label>
            </div>

            <div class="g-form-group full-width">
                <input type="text" id="nama" name="nama" class="g-input" placeholder=" " data-validate="required,minLength:3">
                <label for="nama" class="g-label">Nama Lengkap Siswa</label>
            </div>

            <div class="g-form-group">
                <!-- Select memanfaatkan :valid, jadi pastikan option pertama disabled & required -->
                <select id="jk" name="jk" class="g-input" data-validate="required" required>
                    <option value="" disabled selected></option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <label for="jk" class="g-label">Jenis Kelamin</label>
            </div>

            <div class="g-form-group full-width">
                <textarea id="alamat" name="alamat" class="g-input" placeholder=" " style="height: 120px; resize: none;" data-validate="required"></textarea>
                <label for="alamat" class="g-label">Alamat Lengkap</label>
            </div>
        </div>

        <!-- Kita pinjam tombol g1-btn dari styling Dashboard Google One sebelumnya -->
        <div class="g-form-actions">
            <a href="/siswa" class="g1-btn g1-btn-outline">Batal</a>
            <button type="submit" class="g1-btn g1-btn-primary">Simpan Siswa</button>
        </div>
    </form>
</div>