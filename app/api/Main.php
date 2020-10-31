<?php 
Api::register('main');

Api::request('updateJpStatus', function($data, dsModel $sql)
{ 
    $sql->update(JADWAL_PEMAKAIAN, $data, 'NUJP='.$data['NUJP']);
    return [
        'response' => 'success'
    ];
});

Api::request('updateKondisiAlat', function($data, dsModel $sql)
{ 
    $sql->update(REQ_PINJAM_ALAT, $data, 'NURPA='.$data['NURPA']);
    return [
        'response' => 'success'
    ];
});

Api::request('updatePermintaanStatus', function($data, dsModel $sql)
{
    $where['NURP']= $data['NURP'];

    $sql->update(REQ_PEMAKAIAN, $data,$where);
    if($data['ApprKaLab'] == 'disetujui'){
        $req = $sql->select(REQ_PEMAKAIAN)->where($where)->get_row_assoc();
        $jadwal = [
            'NUJP' => $data['NURP'],
            'NRA' => $req['NRA'],
            'TglPakai' => $req['TglPakai'],
            'JamMulai' => $req['JamMulai'],
            'JamSelesai' => $req['JamSelesai'],
            'StatusPakai' => 'antrian'
        ];
        $sql->insert(JADWAL_PEMAKAIAN, $jadwal);
    }
    
    return [
        'response' => 'success'
    ];
});
Api::request('alat', function($data, dsModel $sql)
{
    return $sql->select([
        'a.*',
        'b.Deskripsi' => 's_Asal',
        'c.Deskripsi' => 's_Kategori'
    ],INVENTARIS.' a')
                ->join(ASAL_BARANG.' b', 'b.KodeAsal=a.KodeAsal')
                ->join(KATEGORI.' c', 'c.KodeKategori=a.KodeKategori')
                ->where(['a.NI' => $data['NI']])->get_row_assoc();
});
Api::request('delete_ekskul', function($data, dsModel $sql)
{
    $response = $sql->delete('dataekskul', $data);

    if($response)
        return ['status' => 'success', 'message' => 'Berhasil dihapus !'];
    else 
        return ['status' => 'error', 'message' => 'Gagal menghapus. Terjadi kesalahan.'];
});

Api::request('save_ekskul', function($data, dsModel $sql)
{
    $response = $sql->insert('dataekskul', $data);

    $data = $sql->select('dataekskul')->where($data)->get_row(PDO::FETCH_ASSOC);

    if($response)
        return ['status' => 'success', 'message' => 'Berhasil tersimpan !', 'data' => $data];
    else 
        return ['status' => 'error', 'message' => 'Gagal menyimpan. Terjadi kesalahan.'];
});

Api::post('mapel', function($data, dsModel $sql)
{
    Load::model('Admin', 'adm');
    $kelas = _get('adm')->getDataById('kelas', 'id_kelas='.$data['id_kelas']);

    return _get('adm')->getAllMapel([
        'kelas' => $kelas['kelas'],
        'id_jurusan' => $kelas['id_jurusan']
    ]);
});