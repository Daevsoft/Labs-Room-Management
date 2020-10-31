<?php
/**
 * AdminModel
 */
class AdminModel extends dsModel
{
    public function __construct()
    {
    }
    public function insertData($table, $data)
    {
        return $this->insert($table, $data);
    }
    public function updateData($table, $data, $where)
    {
        return $this->update($table, $data, $where);
    }
    public function deleteData($table, $where)
    {
        return $this->delete($table, $where);
    }
    public function getDataById($table, $where)
    {
        return $this->row($table, $where)->get_row(PDO::FETCH_ASSOC);
    }
    public function getExist($table, $where)
    {
        return $this->select($table)->where($where)->get_exist();
    }
    public function getAllData($table, $where = NULL)
    {
        $sel = $this->select($table);

        if($where != null)
            $sel = $sel->where($where);

        return $sel->get_assoc();
    }
    public function getEmpty($table)
    {
        return $this->getPattern($table);
    }
    public function saveAnggota($data)
    {
        return $this->insert(ANGGOTA, $data);
    }
    public function savePengguna($data)
    {
        return $this->insert(PENGGUNA, $data);
    }
    public function getAllAnggota()
    {
        return $this->select([
                'a.*',
                'b.NamaP'
        ], ANGGOTA.' a')
        ->left_join(PENGGUNA.' b', 'a.NRA=b.NRA')
        ->get_assoc();
    }
    public function getAnggotaByNRA($NRA)
    {
        return $this->select([
            'a.*',
            'b.NUP',
            'b.NamaP',
            'b.LevelP'
        ],ANGGOTA.' a')
        ->left_join(PENGGUNA.' b', 'a.NRA=b.NRA')
        ->where(['a.NRA' => $NRA])->get_row_assoc();
    }
    public function getDashboardData()
    {
        return $this->select([
            'COUNT(NUJP)' => 'total',
            'TglPakai'
        ], JADWAL_PEMAKAIAN)
        ->where([
            'MONTH(TglPakai )' => '6'
        ])
        ->groupBy("TglPakai")
        ->get_assoc();
    }
}