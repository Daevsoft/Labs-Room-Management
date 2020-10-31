@!isset($NURP)
<form class="form-horizontal" action="_(( site('main/add_alat/'.$NURP) ))" method="POST">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Alat</label>
        <div class="col-sm-3">
            <select name="KodeAlat" class="form-control">
                <option value="">-- Alat --</option>
                @foreach($alat_inventaris as $row)
                    <option value="_(( $row['NI'] ))">_(( $row['Nama'] )) { _(( $row['Satuan'] )) }</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <input type="number" class="form-control" name="JumlahAlat">
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">TAMBAH ALAT</button>
        </div>
    </div>
</form>
@endisset
<hr />
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
            <th class="th-sm">Kondisi (%)</th>
            <th class="th-sm"></th>
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
                <td>
                    @if(getUser('LevelP') == 'anggota')
                        _(( $row['Kondisi'] ))%
                    @else
                        <input class="wd-sm" type="number" placeholder="%" value="_(( $row['Kondisi'] ))" onblur="updateKondisi(_(( $row['NURPA'] )), this.value)">
                    @endif
                </td>
                <td>
                    @!isset($NURP)
                    <a href="_(( site('main/delete_alat_nurp/'.$NURP.'/'.$row['NURPA']) ))" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    @endisset
                </td>
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
    function updateKondisi(nurpa, value){
        $.post("_(( site('api/main/updateKondisiAlat') ))",{
            NURPA:nurpa,
            Kondisi:value
        }, (data, status) => {
            Toast.fire({
                'type':'success',
                'title':'Kondisi '+value+'%!'
            });
        });
    }
</script>