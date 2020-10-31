<a href="_(( site('main/entry_alat ') ))" class="btn btn-success"><i class="fas fa-plus"> Tambah Alat Baru</i> </a>
<hr />
<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th class="th-md">Kode Alat</th>
            <th>Nama Alat</th>
            <th class="th-md">Satuan</th>
            <th class="th-md">Asal</th>
            <th class="th-sm">No. Ref</th>
            <th class="th-md">Kategori</th>
            <th class="th-md">Tgl Masuk</th>
            <th class="th-sm">Dipakai</th>
        </tr>
    </thead>
    <tbody>
        << $i = 1 >>
        @foreach($alat_list as $row)
            <tr>
                <td class="text-center">_(( $i ))</td>
                <td>_(( $row['NI'] ))</td>
                <td>_(( $row['Nama'] ))</td>
                <td>_(( $row['Satuan'] ))</td>
                <td>_(( $row['s_Asal'] ))</td>
                <td>_(( $row['NoReferensi'] ))</td>
                <td>_(( $row['s_Kategori'] ))</td>
                <td>_(( date('d M Y', strtotime($row['TglInputData'])) ))</td>
                <td>
                    <span class="badge badge-dark">_(( $row['dipakai'].' '.$row['Satuan'] ))</span>   
                </td>
                <td><a href="_(( site('main/entry_alat/'.$row['NI']) ))" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
            </tr>
        << $i++ >>
        @endforeach
    </tbody>
</table>