<form class="form-horizontal" action="_(( site('admin/form_anggota/'.$data['NRA']) ))" method="POST">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Nama Lengkap" name="NamaA" value="_(( $data['NamaA'] ))">
            <input type="hidden" value="_(( $data['NUP'] ))" name="NUP">
        </div>
        @!isempty($data['TglReg'])
        <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
        <div class="col-sm-4">
            <span class="form-control">
                _(( date('d M Y h:i', strtotime($data['TglReg'])) ))
            </span>
        </div>
        @endisempty
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">NIDN/NPM/NIK</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="NIDN/NPM/NIK" name="NIK" value="_(( $data['NIK'] ))">
        </div>
        <label class="col-sm-2 col-form-label">Gender</label>
        <div class="col-sm-2">
            <label class="form-check">
                <input type="radio" class="form-check-input" name="Gender" value="L" _(( $data['Gender'] == 'L' ? 'checked' : '' ))> Laki Laki
            </label>
        </div>
        <div class="col-sm-2">
            <label class="form-check">
                <input type="radio" class="form-check-input" name="Gender" value="P" _(( $data['Gender'] == 'P' ? 'checked' : '' ))> Perempuan
            </label>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tempat Lahir</label>
        <div class="col-sm-4">
            <input type="text" class="form-control"  placeholder="Tempat" name="TmpLahir" value="_(( $data['TmpLahir'] ))">
        </div>
        <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
        <div class="col-sm-4">
            <input type="date" class="form-control"  placeholder="Tanggal Lahir" name="TglLahir" value="_(( $data['TglLahir'] ))">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-4">
            <textarea rows="3" class="form-control" placeholder="Alamat" name="Alamat">_(( $data['Alamat'] ))</textarea>
        </div>
        <label class="col-sm-2 col-form-label">No. Telpon</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" placeholder="Nomor Telpon" name="Telp" value="_(( $data['Telp'] ))">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Pengguna</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="inputPassword3" placeholder="Nama Pengguna" name="NamaP" value="_(( $data['NamaP'] ))">
        </div>
        <div class="col-sm-2">
            <select name="LevelP" class="form-control">
                <option value="anggota" _(( $data['LevelP'] == 'anggota' ? 'selected' : '' ))>Anggota</option>
                <option value="pengelola" _(( $data['LevelP'] == 'pengelola' ? 'selected' : '' ))>Pengelola</option>
                <option value="admin" _(( $data['LevelP'] == 'admin' ? 'selected' : '' ))>Administrator</option>
            </select>
        </div>
        <label for="inputPassword3" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" placeholder="Kata Sandi Baru" name="KtSandi">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <a href="_(( site('admin/anggota') ))" class="btn btn-link"><i class="fas fa-arrow-left"></i> Kembali</a>
            @!isempty($data['NRA'])
                <a href="_(( site('admin/delete_anggota/'.$data['NRA']) ))" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Anggota</a>
            @endisempty
            <button type="submit" class="btn btn-success">Simpan Anggota</button>
        </div>
    </div>
<!-- /.card-footer -->
</form>