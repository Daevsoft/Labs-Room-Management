<?php
/**
 * MainModel
 */
class MainModel extends dsModel
{
    public function __construct()
    {
    }

    public function getCurrentJadwal()
    {

        $jadwal = $this->select('a.*, b.NamaA, b.NIK',
                    JADWAL_PEMAKAIAN.' a')
                    ->left_join(ANGGOTA.' b', 'a.NRA=b.NRA')
                    ->where([
                        'a.TglPakai' => date('y-m-d'),
                        'a.StatusPakai' => 'mulai'
                    ], 'OR')
                    ->desc('a.TglPakai')
                    ->get_row_assoc();
        if($jadwal == null)
            $jadwal['NUJP'] = STRING_EMPTY;
        $alat = $this->getAlatByNURP($jadwal['NUJP']);

        return [
            'jadwal' => $jadwal,
            'alat_list' => $alat
        ];
    }
    public function getJadwalByAnggota($NRA = STRING_EMPTY)
    {
        return $this->select([
                    'a.*',
                    'SUM(b.JumlahAlat)' => 'total_alat'
                ],REQ_PEMAKAIAN.' a')
                ->left_join(REQ_PINJAM_ALAT.' b', 'a.NURP=b.NURP')
                ->where([
                    'a.NRA' => $NRA
                ])
                ->groupBy('a.NURP')
                ->get_assoc();
    }
    public function getJadwalByNURP($NURP = STRING_EMPTY)
    {
        $data = $this->select([
                'a.*',
                'b.StatusPakai'
                ],REQ_PEMAKAIAN.' a')
                ->left_join(JADWAL_PEMAKAIAN.' b', 'a.NURP=b.NUJP')
                ->where([ 'a.NURP' => $NURP ])
                ->get_row_assoc();
        if($data == null || $data == []){
            $data = $this->getPattern(REQ_PEMAKAIAN);
        }
        return $data;
    }
    
    public function getAllJadwal($oprSelesai = '!=')
    {
        return $this->select([
                    'a.*',
                    'c.NamaA',
                    'SUM(b.JumlahAlat)' => 'total_alat'
                ],JADWAL_PEMAKAIAN.' a')
                ->left_join(REQ_PINJAM_ALAT.' b', 'a.NUJP=b.NURP')
                ->left_join(ANGGOTA.' c', 'a.NRA=c.NRA')
                ->where('a.StatusPakai', 'selesai', $oprSelesai)
                ->groupBy('a.NUJP')
                ->desc('a.TglPakai,a.JamMulai')
                ->get_assoc();
    }
    public function getAllPermintaan()
    {
        return $this->select([
                    'a.*',
                    'c.NamaA',
                    'SUM(b.JumlahAlat)' => 'total_alat'
                ],REQ_PEMAKAIAN.' a')
                ->left_join(REQ_PINJAM_ALAT.' b', 'a.NURP=b.NURP')
                ->left_join(ANGGOTA.' c', 'a.NRA=c.NRA')
                ->groupBy('a.NURP')
                ->desc('a.ApprKaLab,a.TglPakai,a.JamMulai')
                ->get_assoc();
    }
    
    public function getAlatByNURP($NURP)
    {
        if($NURP == NULL)
            $NURP = STRING_EMPTY;
        return $this->select([
                            'a.*',
                            'c.Deskripsi' => 's_Asal',
                            'd.Deskripsi' => 's_Kategori',
                            'b.*'
                        ],REQ_PINJAM_ALAT. ' a')
                        ->join(INVENTARIS.' b', 'b.NI=a.KodeAlat')
                        ->join(ASAL_BARANG.' c', 'c.KodeAsal=b.KodeAsal')
                        ->join(KATEGORI.' d', 'd.KodeKategori=b.KodeKategori')
                        ->where(['a.NURP' => $NURP])
                        ->desc('a.StatusRec')
                        ->get_assoc();
    }
    public function getAllInventaris()
    {
        return $this->select([
                            'a.*',
                            'b.Deskripsi' => 's_Asal',
                            'c.Deskripsi' => 's_Kategori',
                            'SUM(e.JumlahAlat)' => 'dipakai'
                        ],INVENTARIS. ' a')
                        ->join(ASAL_BARANG.' b', 'b.KodeAsal=a.KodeAsal')
                        ->join(KATEGORI.' c', 'c.KodeKategori=a.KodeKategori')
                        ->left_join(REQ_PINJAM_ALAT.' e', 'a.NI=e.KodeAlat')
                        ->left_join(JADWAL_PEMAKAIAN.' d', [
                            'e.NURP' => 'd.NUJP',
                            'd.StatusPakai' => "'mulai'"
                        ])
                        ->groupBy('a.NI')
                        ->get_assoc();
    }
    public function add_alat_req($data)
    {
        return $this->insert(REQ_PINJAM_ALAT, $data);
    }
    public function deleteAlatByNURPA($id)
    {
        return $this->delete(REQ_PINJAM_ALAT, 'NURPA='.$id);;
    }
    public function newReqJadwal($data)
    {
        $this->insert(REQ_PEMAKAIAN, $data);
    }
    public function newReqAlat($nurp, $alat)
    {
        $data = [];
        $id = 1;
        foreach ($alat as $key => $row) {
            $data[] = [
                'NURPA'=>time() + $id,
                'KodeAlat' => $key,
                'NURP' => $nurp,
                'JumlahAlat' => $row['JumlahAlat']
            ];
            $id++;
        }
        $this->insert(REQ_PINJAM_ALAT, $data);
    }
    public function updateReqJadwal($data, $NURP)
    {
        if (isset($data['konfirmasi'])) {
            if($data['konfirmasi'] == 'ya'){
                unset($data['konfirmasi']);
                $jadwal = $data;

                $jadwal['NUJP'] = $NURP;
                unset($jadwal['TglReq']);
                unset($jadwal['Pengulangan']);

                $this->insert(JADWAL_PEMAKAIAN, $jadwal);
                $data['ApprKaLab'] = 'disetujui';
            }else{
                unset($data['konfirmasi']);
                $data['ApprKaLab'] = 'ditolak';
            }
        }
        $this->update(REQ_PEMAKAIAN, $data, ['NURP' => $NURP]);
    }
    public function updateReqAlat($nurp, $alat)
    {
        $data = [];
        $id = 1;
        foreach ($alat as $key => $row) {
            $new = [
                'NURPA'=>time() + $id,
                'KodeAlat' => $key,
                'NURP' => $nurp,
                'JumlahAlat' => $row['JumlahAlat']
            ];
            if(isset($row['StatusRec']))
                $new['StatusRec'] = $row['StatusRec'];
            $data[] = $new;
            $id++;
        }
        $this->delete(REQ_PINJAM_ALAT, ['NURP' => $nurp]);
        $this->insert(REQ_PINJAM_ALAT, $data);
    }
}