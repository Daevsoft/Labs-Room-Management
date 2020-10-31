<?php
/**
 * MainController
 */
class MainController extends dsController
{
    public function __construct()
    {
        parent::__construct();
        auth();
        $this->add_model('Main', 'c_main');
    }
    public function index()
    {
        $this->home();
    }

    public function home()
    {
        if(getUser('LevelP') == 'admin'){
            $this->add_model('Admin', 'admin');
            $data = [
                'data'  => $this->admin->getDashboardData()
            ];
            page('dashboard.pie', $data, 'Dashboard');
        }else
            $this->laboratorium();
    }
    public function logout()
    {
        logout();
    }
    public function laboratorium()
    {
        $data = $this->c_main->getCurrentJadwal();
        page('laboratorium.pie', $data, 'Laboratorium');
    }
    public function profil_saya()
    {
        $user = getUser();
        $data = [
            'data' => $user
        ];
        page('profil_saya.pie', $data, 'Profil Saya');
    }
    public function histori_saya()
    {
        $user = getUser();
        $data = [
            'jadwal_list' => $this->c_main->getJadwalByAnggota($user['NRA'])
        ];
        page('histori_saya.pie', $data, 'Histori Jadwal Saya');
    }
    public function edit_profile()
    {
        $data['data'] = getUser();
        page('ubah_profil.pie', $data, 'Edit Profil');
    }
    public function form_profile()
    {
        $this->add_model('Admin', 'c_admin');
        $user = getUser('user');

        $data = Input::getArray();

        $pengguna['NamaP'] = $user['NamaP'];
        $pengguna['LevelP'] = $user['NamaP'];
    
        if($data['KtSandi'])
            $pengguna['KtSandi'] = md5($data['KtSandi']);

        unset($data['NamaP']);
        unset($data['KtSandi']);

        $response = $this->c_admin->updateData(ANGGOTA, $data, ['NRA' => $user['NRA']]);
         
        if($response){
            $response = $this->c_admin->updateData(PENGGUNA, $pengguna, ['NUP' => $user['NUP']]);
            if($response){
                
                $data = $this->c_admin->getDataById(ANGGOTA, ['NRA' => $user['NRA']]);
                $data['TglReg'] = $user['TglReg'];
                $data['name'] = $user['NamaP'];

                set_session('user', array_merge($data, $pengguna));
                redirect('main/profil_saya');
            }else{
                set_flash('error', '<div class="alert alert-danger">Terjadi Kesalahan. Mohon periksa kembali</div>');
                redirect('main/edit_profile');
            }
        }
        else{
            set_flash('error', '<div class="alert alert-danger">Terjadi Kesalahan. Mohon periksa kembali</div>');
            redirect('main/edit_profile');
        }
    }
    public function form_req_jadwal($NURP = STRING_EMPTY)
    {
        $data = Input::getArray();
        $alat = NULL;
        if(isset($data['alat'])){
            $alat = $data['alat'];
            unset($data['alat']);
        }
        
        if (string_empty($NURP)) {
            $data['NURP'] = time();
            $data['TglReq'] = date('y-m-d h:i:s');
            $this->c_main->newReqJadwal($data);
            if($alat)
                $this->c_main->newReqAlat($data['NURP'], $alat);
        }else{
            $this->c_main->updateReqJadwal($data, $NURP);
            if($alat)
                $this->c_main->updateReqAlat($NURP, $alat);
        }
        redirect('main/lihat_permintaan');
    }
    public function entry_req_jadwal($NURP = STRING_EMPTY, $title = 'Baru')
    {
        $this->add_model('Admin','admin');
        $data = [
            'data' => $this->c_main->getJadwalByNURP($NURP),
            'inventaris_list' =>  $this->c_main->getAllInventaris(),
            'alat_list' => $this->c_main->getAlatByNURP($NURP),
            'anggota_list' => $this->admin->getAllData(ANGGOTA)
        ];
        page('form_permintaan_jadwal.pie', $data, 'Permintaan Jadwal '. $title);
    }
    public function delete_pengajuan($NURP)
    {
        $this->add_model('Admin', 'admin');
        $response = $this->admin->deleteData(REQ_PEMAKAIAN, ['NURP' => $NURP]);
        if($response)
            set_error();
        redirect('main/lihat_permintaan');
    }
    public function entry_alat($id = STRING_EMPTY)
    {
        $this->add_model('Admin', 'admin');
        $data = [
            'data' => $this->admin->getDataById(INVENTARIS, ['NI' => $id]),
            'asal_list' =>  $this->admin->getAllData(ASAL_BARANG),
            'kategori_list' =>  $this->admin->getAllData(KATEGORI)
        ];

        if(string_empty($id))
            $data['data'] = $this->admin->getEmpty(INVENTARIS);

        page('form_alat.pie', $data, 'Entri Alat');
    }
    public function form_alat($id = STRING_EMPTY)
    {
        $this->add_model('Admin', 'admin');
        $data = Input::getArray();
        if(string_empty($data['KodeAsal'])){
            $asal = $this->admin->getDataById(ASAL_BARANG, ['Deskripsi'=>trim($data['Asal_l'])]);

            if($asal){
                $data['KodeAsal'] = $asal['KodeAsal'];
            }else{
                $data['KodeAsal'] = time();
    
                // Insert new Kategori
                $this->admin->insertData(ASAL_BARANG, [
                    'KodeAsal' => $data['KodeAsal'],
                    'Deskripsi' => $data['Asal_l']
                ]);
            }
        }
        if(string_empty($data['KodeKategori'])){
            $kategori = $this->admin->getDataById(KATEGORI, ['Deskripsi'=>trim($data['Kategori_l'])]);
            if($kategori){
                $data['KodeKategori'] = $kategori['KodeKategori'];
            }else{
                $data['KodeKategori'] = time();
                // Insert new Kategori
                $this->admin->insertData(KATEGORI, [
                    'KodeKategori' => $data['KodeKategori'],
                    'Deskripsi' => $data['Kategori_l']
                ]);
            }
        }
        unset($data['Asal_l']);
        unset($data['Kategori_l']);
        $response = true;
        if (string_empty($id)) {
            $data['NI'] = time();
            $response = $this->admin->insertData(INVENTARIS, $data);
        }else{
            $response = $this->admin->updateData(INVENTARIS, $data, ['NI' => $id]);
        }
        if(!$response)
            set_error();
        redirect('main/inventaris');
    }
    public function detail_jadwal($NURP)
    {
        $this->entry_req_jadwal($NURP, $NURP);
    }
    public function jadwal_pemakaian()
    {
        $data = [
            'jadwal_list' => $this->c_main->getAllJadwal()
        ];
        page('jadwal_pemakaian.pie', $data, 'Jadwal Pemakaian');
    }
    public function lihat_permintaan()
    {
        $data = [
            'permintaan_list' => $this->c_main->getAllPermintaan()
        ];
        page('lihat_permintaan.pie', $data, 'Jadwal Pemakaian');
    }
    public function inventaris()
    {
        $data = [
            'alat_list' => $this->c_main->getAllInventaris()
        ];
        page('data_inventaris.pie', $data, 'Data Inventaris');
    }
    public function riwayat_pemakaian()
    {
        $data = [
            'jadwal_list' => $this->c_main->getAllJadwal('=')
        ];
        page('riwayat_pemakaian.pie', $data, 'Riwayat Pemakaian');
    }
    public function anggota()
    {
        $data = [
            'data' => []
        ];
        page('data_anggota.pie', $data, 'Data Anggota');
    }
    public function lihat_alat($NURP = STRING_EMPTY)
    {
        $data['NURP'] = $NURP;
        $data['alat_list'] = $this->c_main->getAlatByNURP($NURP);
        $data['alat_inventaris'] = $this->c_main->getAllInventaris();

        page('lihat_alat.pie', $data, 'Alat Pinjam '.$NURP);
    }
    public function add_alat($NURP)
    {
        $data = [
            'NURPA' => time(),
            'NURP' => $NURP,
            'KodeAlat' => Input::post('KodeAlat'),
            'JumlahAlat' => Input::post('JumlahAlat')
        ];
        $response = $this->c_main->add_alat_req($data);
        if (!$response) {
            set_error();
        }
        redirect('main/lihat_alat/'.$NURP);
    }
    public function delete_alat_nurp($NURP, $id)
    {
        $response = $this->c_main->deleteAlatByNURPA($id);
        if(!$response)
            set_error();

        redirect('main/lihat_alat/'.$NURP);
    }
}