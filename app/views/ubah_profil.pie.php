<form class="form-horizontal" action="_(( site('main/form_profile') ))" method="POST">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Anggota</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Nama Lengkap" name="NamaA" value="_(( $data['NamaA'] ))">
            <input type="hidden" name="NRA" value="_(( $data['NRA'] ))">
        </div>
        <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
        <div class="col-sm-4">
            <span class="form-control">_(( date('d M Y h:i', strtotime($data['TglReg'])) ))</span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">NIK</label>
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
        <div class="col-sm-4">
            <input type="text" class="form-control" id="inputPassword3" placeholder="Nama Pengguna" name="NamaP" value="_(( $data['NamaP'] ))">
        </div>
        <label for="inputPassword3" class="col-sm-2 col-form-label">Kata Sandi Baru</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" placeholder="Kata Sandi Baru" name="KtSandi" id="password1">
            <input type="password" class="form-control" placeholder="Kata Sandi Baru" id="password2" onkeyup="checkPassword(this.value);">
            <input type="checkbox" class="float-right" onclick="changePassword(this)">
            <label class="float-right" style="font-size:0.7em"> Tampilkan kata sandi</label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <a href="_(( site('main/profil_saya') ))" class="btn btn-link"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-success" id="btnSubmit">Simpan Profil</button>
        </div>
    </div>
<!-- /.card-footer -->
</form>
<script>

function checkPassword(val){
  let pass1 = $('#password1').val();
  let btnSubmit = $('#btnSubmit');
  if(pass1 !== val){
    btnSubmit.attr('disabled', 'true');
  }else{
    btnSubmit.removeAttr('disabled');
  }
}

function changePassword(chk){
  let pass1 = $('#password1');
  let pass2 = $('#password2');
  let type = chk.checked ? 'text' : 'password';
  pass1.attr('type', type);
  pass2.attr('type', type);
}
</script>