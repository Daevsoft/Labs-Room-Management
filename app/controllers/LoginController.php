<?php
/**
 * LoginController
 */
class LoginController extends dsController
{
    public function __construct()
    {
        parent::__construct();
        auth(true);
        $this->add_model('Login', 'login');
        $this->add_model('Admin', 'admin');
    }

    public function index()
    {
        view('login.pie');
    }
    public function forgot()
    {
        view('forgot_password.pie');
    }
    public function forgot_auth()
    {
        // Login auth
        $NIK = Input::post('NIK');
        $TmpLahir = Input::post('TmpLahir');
        $Tgllahir = Input::post('Tgllahir');

        $where = Input::getArray();

        $anggota = $this->admin->getDataById(ANGGOTA, [
            'NIK' => $NIK,
            'TmpLahir' => $TmpLahir,
            'Tgllahir' => $Tgllahir
        ]);

        $username = Input::post('NamaP');
        $pengguna = [
            'NamaP'   => $username,
            'NRA'     => $anggota['NRA']
        ];
        $response = $this->login->auth(PENGGUNA, $pengguna);

        $response = array_merge($response, $anggota);
        if($response){
            set_session('user', $response);
            redirect('main/home');
        }else{
            set_flash('login_response', '<div class="alert alert-danger">Akun tidak ditemukan / password salah.</div>');
            redirect('login/forgot');
        }
    }
    public function auth()
    {
        // Login auth
        $username = Input::post('NamaP');
        $password = Input::post('KtSandi');

        $pengguna = [
            'NamaP'   => $username,
            'KtSandi' => md5($password)
        ];
        $response = $this->login->auth(PENGGUNA, $pengguna);
        $anggota = $this->admin->getDataById(ANGGOTA, ['NRA' => $response['NRA']]);
        $response = array_merge($response, $anggota);
        if($response){
            set_session('user', $response);
            redirect('main/home');
        }else{
            set_flash('login_response', '<div class="alert alert-danger">Akun tidak ditemukan / password salah.</div>');
            redirect('login');
        }

    }
    public function form_daftar()
    {
        $anggota = Input::getArray();
        $anggota['NRA'] = time();

        $pengguna = [
            'NUP' => time(),
            'LevelP' => 'anggota',
            'NRA' => $anggota['NRA'],
            'TglBuat' => date('y-m-d'),
            'NamaP' => $anggota['NamaP'],
            'KtSandi' => md5($anggota['KtSandi'])
        ];
        unset($anggota['NamaP']);
        unset($anggota['KtSandi']);
        $result = $this->admin->saveAnggota($anggota);
        $this->admin->savePengguna($pengguna);

        if($result)
            redirect('login');
        else
            redirect('login/daftar');
    }
    public function daftar()
    {
        view('daftar_baru.pie');
    }
}