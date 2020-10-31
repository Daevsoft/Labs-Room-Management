<div class="form-horizontal">
    <div class="form-group row">
        <label class="col-sm-2">Nama Anggota</label>
        <div class="col-sm-4">
            _(( string_condition($jadwal['NamaA'],'(Tidak ada jadwal hari ini)') ))
        </div>
        <label class="col-sm-2">Tanggal Req</label>
        <div class="col-sm-4">
        _(( string_condition($jadwal['TglPakai'],'-') ))
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">NIK</label>
        <div class="col-sm-4">
            _(( string_condition($jadwal['NIK'],'-') ))
        </div>
        <label class="col-sm-2">Mulai</label>
        <div class="col-sm-4">
        _(( substr(string_condition($jadwal['JamMulai'],'-'), 0, 5).' - '.substr(string_condition($jadwal['JamSelesai'],'-'), 0,5) ))
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">Ruangan?</label>
        <div class="col-sm-4">
            _(( $jadwal['Ruangan'] ))
        </div>
        <label class="col-sm-2">Status</label>
        <div class="col-sm-4">
            @if(string_condition($jadwal['StatusPakai']) == 'mulai')
                <span class="badge badge-success">_(( string_condition($jadwal['StatusPakai'],'-') ))</span>
            @elseif($jadwal['StatusPakai'] == 'antrian')
                <span class="badge badge-warning">_(( string_condition($jadwal['StatusPakai'],'-') ))</span>
            @else
                <span class="badge badge-danger">_(( string_condition($jadwal['StatusPakai'],'-') ))</span>
            @endif
        </div>
    </div>
</div>
<label>Alat yang dipinjam :</label>
<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th>Kode Alat</th>
            <th>Nama Alat</th>
            <th class="th-md">Kategori</th>
            <th class="th-md">Asal</th>
            <th class="th-md">Jumlah Alat</th>
        </tr>
    </thead>
    <tbody>
        << $i = 1 >>
        @foreach($alat_list as $row)
            <tr>
                <td class="text-center">_(( $i ))</td>
                <td>_(( $row['KodeAlat'] ))</td>
                <td>_(( $row['Nama'] ))</td>
                <td>_(( $row['s_Kategori'] ))</td>
                <td>_(( $row['s_Asal'] ))</td>
                <td>_(( $row['JumlahAlat'].' '.$row['Satuan'] ))</td>
            </tr>
        << $i++ >>
        @endforeach
    </tbody>
</table>