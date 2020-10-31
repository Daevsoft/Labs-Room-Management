<?php
/**
 * AdminController
 */
class AdminController extends dsController
{
    public function __construct()
    {
        parent::__construct();
        auth();
        $this->add_model('Admin', 'admin');
    }
    
    public function index()
    {
        $data = [
        ];
        page('dashboard.pie', $data, 'Dashboard');
    }
    public function form_anggota($NRA = STRING_EMPTY)
    {
        $anggota = Input::getArray();
        $anggota['NRA'] = string_empty($NRA) ? time() : $NRA;
        $NUP =  $anggota['NUP'];

        $pengguna = [
            'NUP' => $NUP,
            'LevelP' => 'anggota',
            'NRA' => $anggota['NRA'],
            'TglBuat' => date('y-m-d'),
            'NamaP' => $anggota['NamaP']
        ];
        if(!string_empty($anggota['KtSandi']))
            $pengguna['KtSandi'] = md5($anggota['KtSandi']);
        else
            unset($pengguna['KtSandi']);

        if(isset($anggota['LevelP']))
            $pengguna['LevelP'] = $anggota['LevelP'];

        unset($anggota['NUP']);
        unset($anggota['NamaP']);
        unset($anggota['LevelP']);
        unset($anggota['KtSandi']);

        if (string_empty($NRA))
            $result = $this->admin->saveAnggota($anggota);
        else{
            unset($anggota['NRA']);
            $result = $this->admin->updateData(ANGGOTA, $anggota, ['NRA' => $NRA]);
        }
        if(string_empty($NUP)){
            $pengguna['NUP'] = time();
            $this->admin->savePengguna($pengguna);
        }else{
            unset($pengguna['NUP']);
            $this->admin->updateData(PENGGUNA, $pengguna, ['NUP' => $NUP]);
        }
        redirect('admin/anggota');
    }
    public function entry_anggota($NRA = STRING_EMPTY)
    {
        $data = [];

        if (!string_empty($NRA)) {
            $data['data'] = $this->admin->getAnggotaByNRA($NRA);
        }else{
            $data['data'] = $this->admin->getEmpty(ANGGOTA);
            $data['data']['NUP'] =
            $data['data']['NamaP'] =
            $data['data']['LevelP'] =
            $data['data']['KtSandi'] = STRING_EMPTY;
        }

        page('entry_anggota.pie', $data, 'Anggota');
    }
    public function anggota()
    {
        $this->add_model('Admin', 'admin');
        $data = [
            'anggota_list' => $this->admin->getAllAnggota()
        ];
        page('table_anggota.pie', $data, 'Anggota');
    }
    public function delete_anggota($nra)
    {
        $this->add_model('Admin','admin');
        $this->admin->deleteData(ANGGOTA, ['NRA' => $nra]);
        redirect('admin/anggota');
    }
}