<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>_(( app_name() ))</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  << css_source('font-awesome/fontawesome.min') >>
  << css_source('font-awesome/solid.min') >>
  <!-- Theme style -->
  << css_source('adminlte.min') >>
</head>
<body class="hold-transition login-page bg-primary">
<div class="login-box">
  <div class="login-logo">
    <a class="text-white"><b>Lab Booking</b></a>
    <div class="text-sm">Management</div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Masukan Data Anda</p>

      <form action="_(( site('login/forgot_auth') ))" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nama Pengguna" name="NamaP">
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
        <div class="input-group mb-1">
            <input type="text" class="form-control" placeholder="Tempat Lahir" name="TmpLahir">
        </div>
        <div class="input-group mb-1">
            <input type="date" class="form-control" placeholder="Tanggal Lahir" name="Tgllahir">
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary btn-block">Kirimkan</button>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <a href="_(( site('login') ))" class="btn btn-default btn-block">Kembali Ke Login</a>
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

</body>
</html>
