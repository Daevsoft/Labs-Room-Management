<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th class="th-md">Kode Jadwal</th>
            <th class="th-md">Nama Peminta</th>
            <th>Tanggal Permintaan</th>
            <th class="th-md">Ruangan</th>
            <th class="th-md">Jam</th>
            <th class="th-sm">Jumlah Alat</th>
            <th class="th-sm"></th>
        </tr>
    </thead>
    <tbody>
        << $i = 1 >>
        @foreach($jadwal_list as $row)
            <tr>
                <td class="text-center">_(( $i ))</td>
                <td>_(( $row['NUJP'] ))</td>
                <td>_(( $row['NamaA'] ))</td>
                <td>_(( date('d M y', strtotime($row['TglPakai'])) ))</td>
                <td>_(( $row['Ruangan'] ))</td>
                <td>_(( substr($row['JamMulai'], 0, 5).' - '.substr($row['JamSelesai'], 0,5) ))</td>
                
                <td><a href="_(( site('main/lihat_alat/'.$row['NUJP']) ))" target="_blank" class="badge badge-primary">_(( $row['total_alat'] ))</a></td>
                <td><a href="_(( site('main/detail_jadwal/'.$row['NUJP']) ))" target="_blank" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
            </tr>
        << $i++ >>
        @endforeach
    </tbody>
</table>
<hr>
<a href="_(( site('main/jadwal_pemakaian') ))" class="btn btn-link"><i class="fas fa-arrow-left"></i> Kembali</a>
