<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>_(( app_name() ))</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  << css_source('font-awesome/all.min') >>
  <!-- Theme style -->
  << css_source('adminlte.min') >>
</head>
<body class="hold-transition register-page bg-primary">
<div class="login-box">
  <div class="login-logo">
    <a class="text-white"><b>Lab Booking</b></a>
    <div class="text-sm">Management</div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Daftar Anggota Baru</p>

      <form action="_(( site('login/form_daftar') ))" method="post">
        <div class="input-group mb-1">
          <input type="text" class="form-control" placeholder="Nama Anggota" name="namaA">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-badge"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-1">
          <input type="text" class="form-control" placeholder="NIDN/NPM/NIK" name="NIK">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-badge"></span>
            </div>
          </div>
        </div>
        <div class="input-group">
          <div class="col-md-6">
              <label class="form-check">
                  <input type="radio" class="form-check-input" name="Gender" value="L"> Laki Laki
              </label>
          </div>
          <div class="col-md-6">
              <label class="form-check">
                  <input type="radio" class="form-check-input" name="Gender" value="P"> Perempuan
              </label>
          </div>
        </div>
        <div class="form-input row">
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Tempat Lahir" name="TmpLahir">
          </div>
          <div class="col-md-6">
            <input type="date" class="form-control" placeholder="Tanggal Lahir" name="Tgllahir">
          </div>
        </div>
        <div class="input-group mb-1">
          <input type="text" class="form-control" placeholder="No. Telpon" name="Telp">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-badge"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-1">
          <textarea type="text" class="form-control" placeholder="Alamat" rows="3" name="Alamat"></textarea>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-badge"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-1">
          <input type="text" class="form-control" placeholder="Nama Pengguna" name="NamaP">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-badge"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-1">
          <input type="password" class="form-control" id="password1" placeholder="Kata Sandi" name="KtSandi">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-1">
          <input type="password" class="form-control" id="password2" placeholder="Ulangi Kata Sandi" onkeyup="checkPassword(this.value);">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div><br>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <input type="checkbox" class="float-right" onclick="changePassword(this)">
            <label class="float-right" style="font-size:0.7em"> Tampilkan kata sandi</label>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button id="btnSubmit" type="submit" disabled class="btn btn-success btn-block">Daftarkan</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <a href="_(( site('login') ))" class="btn btn-default btn-block">Kembali</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
      _(( flash('login_response') ))
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<< js_source('jquery/jquery.min') >>
<!-- Bootstrap 4 -->
<< js_source('bootstrap/bootstrap.bundle.min') >>
<!-- AdminLTE App -->
<< js_source('adminlte.min') >>

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

</body>
</html>
