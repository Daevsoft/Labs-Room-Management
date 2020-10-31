<label>Pengajuan Jadwal :</label>
<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th class="th-md">No.Permintaan</th>
            <th>Tanggal Permintaan</th>
            <th>Tanggal Pakai</th>
            <th class="th-md">Ruangan?</th>
            <th class="th-md">Jam</th>
            <th class="th-md">Pengulangan</th>
            <th class="th-sm">Jumlah Alat</th>
            <th class="th-md">Status</th>
        </tr>
    </thead>
    <tbody>
        << $i = 1 >>
        @foreach($jadwal_list as $row)
            <tr>
                <td class="text-center">_(( $i ))</td>
                <td>
                    <a href="_(( site('main/detail_jadwal/'.$row['NURP']) ))" target="_blank">_(( $row['NURP'] ))</a>
                </td>
                <td>_(( date('d M y', strtotime($row['TglReq'])) ))</td>
                <td>_(( date('d M y', strtotime($row['TglPakai'])) ))</td>
                <td>_(( $row['Ruangan'] ))</td>
                <td>_(( substr($row['JamMulai'], 0, 5).' - '.substr($row['JamSelesai'], 0,5) ))</td>
                <td>
                    @if($row['Pengulangan'] == 'ulang')
                        <span class="badge badge-success">Ulang</span>
                    @else
                        <span class="badge badge-danger">Tidak</span>
                    @endif
                </td>
                <td><a href="_(( site('main/lihat_alat/'.$row['NURP']) ))" target="_blank" class="badge badge-primary">_(( $row['total_alat'] ))</a></td>
                <td>
                    @if($row['ApprKaLab'] == 'disetujui')
                        <span class="badge badge-success">disetujui</span>
                    @elseif($row['ApprKaLab'] == 'pending')
                        <span class="badge badge-dark">pending</span>
                    @else
                        <span class="badge badge-danger">ditolak</span>
                    @endif
                </td>
            </tr>
        << $i++ >>
        @endforeach
    </tbody>
</table>