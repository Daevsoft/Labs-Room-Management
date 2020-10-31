<a href="_(( site('admin/entry_anggota') ))" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Anggota</a>
<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th>Tanggal Daftar</th>
            <th>Nama Anggota</th>
            <th class="th-md">Nama Pengguna</th>
            <th class="th-md">NIDN/NPM/NIK</th>
            <th class="th-sm">Gender</th>
            <th class="th-md">No. Telpon</th>
            <th class="th-sm">Status</th>
            <th class="th-sm"></th>
        </tr>
    </thead>
    <tbody>
        << $i = 1 >>
        @foreach($anggota_list as $row)
            <tr>
                <td class="text-center">_(( $i ))</td>
                <td>_(( date('d M Y', strtotime($row['TglReg'])) ))</td>
                <td>_(( $row['NamaA'] ))</td>
                <td>_(( $row['NamaP'] ))</td>
                <td>_(( $row['NIK'] ))</td>
                <td>_(( $row['Gender'] ))</td>
                <td>_(( $row['Telp'] ))</td>
                <td>_(( $row['StatusA'] ))</td>
                <td>
                    <a href="_(( site('admin/entry_anggota/'.$row['NRA']) ))" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        << $i++ >>
        @endforeach
    </tbody>
</table>