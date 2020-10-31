<a href="_(( site('main/jadwal_pemakaian') ))" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali Ke Jadwal</a>
<a href="_(( site('main/entry_req_jadwal') ))" class="btn btn-success"><i class="fa fa-plus"></i> Buat Permintaan Jadwal</a>
<hr />
<label>Pengajuan Jadwal :</label>
<table id="tableData" class="table table-sm table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th class="th-sm">No</th>
            <th class="th-md">Kode Jadwal</th>
            <th class="th-md">Nama Peminta</th>
            <th>Tanggal Permintaan</th>
            <th class="th-sm">Ruangan?</th>
            <th class="th-md">Jam</th>
            <th class="th-sm">Jumlah Alat</th>
            <th class="th-md">Status</th>
            <th class="th-sm"></th>
        </tr>
    </thead>
    <tbody>
        << $i = 1 >>
        @foreach($permintaan_list as $row)
            <tr>
                <td class="text-center">_(( $i ))</td>
                <td>_(( $row['NURP'] ))</td>
                <td>_(( $row['NamaA'] ))</td>
                <td>_(( date('d M y', strtotime($row['TglPakai'])) ))</td>
                <td>_(( $row['Ruangan'] ))</td>
                <td>_(( substr($row['JamMulai'], 0, 5).' - '.substr($row['JamSelesai'], 0,5) ))</td>
                
                <td><a href="_(( site('main/lihat_alat/'.$row['NURP']) ))" target="_blank" class="badge badge-primary">_(( $row['total_alat'] ))</a></td>
                <td>
                    @if(getUser('LevelP') != 'admin')
                        @if($row['ApprKaLab'] == 'disetujui')
                            <span class="badge badge-success">disetujui</span>
                        @elseif($row['ApprKaLab'] == 'pending')
                            <span class="badge badge-warning">pending</span>
                        @else
                            <span class="badge badge-danger">ditolak</span>
                        @endif
                    @else
                        <select onchange="changeStatus(this, _(( $row['NURP'] )),this.value)" _(( $row['ApprKaLab'] == 'disetujui' ? 'disabled' : STRING_EMPTY ))>
                            <option value="disetujui" _(( $row['ApprKaLab'] == 'disetujui' ? 'selected' : STRING_EMPTY ))>Setuju</option>
                            <option value="pending" _(( $row['ApprKaLab'] == 'pending' ? 'selected' : STRING_EMPTY ))>Pending</option>
                            <option value="ditolak" _(( $row['ApprKaLab'] == 'ditolak' ? 'selected' : STRING_EMPTY ))>Tolak</option>
                        </select>
                    @endif
                </td>
                <td><a href="_(( site('main/detail_jadwal/'.$row['NURP']) ))" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
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

    function changeStatus(el, id, value){
        $.post("_(( site('api/main/updatePermintaanStatus') ))",{
            'ApprKaLab':value,
            'NURP' : id
        }, function(data, status) {
            if(value == 'disetujui'){        
                $(el).attr('disabled', '');
            }
            Toast.fire({
                'type':'success',
                'title':' Berhasil di '+value+'!'
            });
        });
    }
</script>