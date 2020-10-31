<a href="_(( site('main/riwayat_pemakaian') ))" class="btn btn-default float-right"><i class="fas fa-calendar-check"></i> Lihat Riwayat Pemakaian</a>
<a href="_(( site('main/lihat_permintaan') ))" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Jadwal Pemakaian</a>
<hr />
<label>Pengajuan Jadwal :</label>
<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th class="th-md">Kode Jadwal</th>
            <th class="th-md">Nama Peminta</th>
            <th>Tanggal Permintaan</th>
            <th class="th-md">Ruangan?</th>
            <th class="th-md">Jam</th>
            <th class="th-sm">Jumlah Alat</th>
            <th class="th-sm">Status</th>
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
                
                <td><a href="_(( site('main/lihat_alat/'.$row['NUJP']) ))" class="badge badge-primary">_(( $row['total_alat'] ))</a></td>
                
                <td>
                    @if(getUser('LevelP') == 'anggota')
                        @if($row['StatusPakai'] == 'selesai')
                            <span class="badge badge-primary">selesai</span>
                        @elseif($row['StatusPakai'] == 'mulai')
                            <span class="badge badge-success">mulai</span>
                        @else
                            <span class="badge badge-dark">antrian</span>
                        @endif
                    @else
                        <select onchange="changeStatus(_(( $row['NUJP'] )),this.value)">
                            <option value="selesai" _(( $row['StatusPakai'] == 'selesai' ? 'selected' : STRING_EMPTY ))>Selesai</option>
                            <option value="mulai" _(( $row['StatusPakai'] == 'mulai' ? 'selected' : STRING_EMPTY ))>Mulai</option>
                            <option value="antrian" _(( $row['StatusPakai'] == 'antrian' ? 'selected' : STRING_EMPTY ))>Antrian</option>
                        </select>
                    @endif
                </td>
                <td><a href="_(( site('main/detail_jadwal/'.$row['NUJP']) ))" target="_blank" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
            </tr>
        << $i++ >>
        @endforeach
    </tbody>
</table>
@js('sweetalert2/sweetalert2.min')
@js('sweetalert2/toastr.min')
<script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    function changeStatus(id,value){
        console.log(value);
        $.post("_(( site('api/main/updateJpStatus') ))",{
            'StatusPakai':value,
            'NUJP' : id
        }, function(data, status) {
            Toast.fire({
                'type':'success',
                'title':'Jadwal '+value+'!'
            });
        });
    }
</script>