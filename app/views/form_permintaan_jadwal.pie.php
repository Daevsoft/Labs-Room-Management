<< $status = STRING_EMPTY >>
@!isempty($data['NURP'])
    << 
        $theme = 'success';
        $msg = 'telah disetujui';
        $status = '<div class="badge badge-primary">'.$data['StatusPakai'].'</div>';
        if($data['ApprKaLab'] == 'pending'){
            $theme = 'warning';
            $msg = 'belum dikonfirmasi';
        }else if($data['ApprKaLab'] == 'ditolak'){
            $theme = 'danger';
            $msg = 'telah ditolak.';
        }
    >>
    <div class="alert alert-_(( $theme ))">Permintaan jadwal ini _(( $msg ))</div>
@endisempty
<form class="form-horizontal" action="_(( site('main/form_req_jadwal/'.$data['NURP']) ))" method="POST">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Peminta Jadwal</label>
        <div class="col-sm-10">
            <<
                $disable = STRING_EMPTY;
                $nra = $data['NRA'];
                $newData = string_empty($data['NURP']);
                $isAdmin = getUser('LevelP') != 'anggota';

                $editable = (getUser('NRA') == $nra || $isAdmin || $newData) && ($data['ApprKaLab'] == 'pending' || string_empty($data['ApprKaLab']));

                if(!$isAdmin){
                    if($newData){
                        $nra = getUser('NRA');
                    }
                    $disable = 'disabled="true"';
                    echo '<input type="hidden" value="'.$nra.'" name="NRA">';
                }
                if($data['ApprKaLab'] == 'disetujui' || $data['ApprKaLab'] == 'ditolak'){
                    $disable = 'disabled="true"';
                }
            >>
            <select name="NRA" class="form-control" _(( $disable ))>
                @foreach($anggota_list as $row)
                    <option value="_(( $row['NRA'] ))" _(( $row['NRA'] == $nra ? 'selected' : STRING_EMPTY ))>_(( '{'.$row['NIK'].'} '.$row['NamaA'] ))</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Pakai</label>
        <div class="col-sm-5">
            <input type="date" class="form-control" name="TglPakai" value="_(( $data['TglPakai'] ))"  _(( $editable ? '' : 'disabled="true"' ))>
        </div>
        <div class="col-sm-3">
            <input type="time" class="form-control" name="JamMulai" value="_(( $data['JamMulai'] ))"  _(( $editable ? '' : 'disabled="true"' ))>
        </div>
        <div class="col-sm-2">
            <input type="time" class="form-control" name="JamSelesai" value="_(( $data['JamSelesai'] ))"  _(( $editable ? '' : 'disabled="true"' ))>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengulangan</label>
        <div class="col-sm-4">
            <select name="Pengulangan" class="form-control"  _(( $editable ? '' : 'disabled="true"' ))>
                <option value="tidak" _(( $data['Pengulangan'] == 'tidak' ? 'selected' : '' ))>Tidak</option>
                <option value="ulangi" _(( $data['Pengulangan'] == 'ulangi' ? 'selected' : '' ))>Ulangi</option>
            </select>
        </div>
        <div class="col-sm-5">
            _(( $status ))
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Dengan Ruangan ?</label>
        <div class="col-sm-4">
            <select name="Ruangan" class="form-control"  _(( $editable ? '' : 'disabled="true"' ))>
                <option value="ya" _(( $data['Ruangan'] == 'ya' ? 'selected' : '' ))>Ya</option>
                <option value="tidak" _(( $data['Ruangan'] == 'tidak' ? 'selected' : '' ))>Tidak</option>
            </select>
        </div>
        <div class="col-sm-5">
        </div>
    </div>
    
    <hr>
<!-- /.card-footer -->
@if($editable)
    <div class="form-horizontal">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alat</label>
            <div class="col-sm-3">
                <select class="form-control" id="alatId">
                    <option value="">-- Alat --</option>
                    @foreach($inventaris_list as $row)
                        <option value="_(( $row['NI'] ))">_(( $row['Nama'] )) { _(( $row['Satuan'] )) }</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <input type="number" id="jumlahAlat" placeholder="Jumlah Alat" class="form-control">
            </div>
            <div class="col-sm-4">
                <div type="submit" class="btn btn-primary" onclick="addAlat()">TAMBAH ALAT</div>
            </div>
        </div>
    </div>
@endif
<hr />
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        
        <label>Alat yang dipinjam :</label>
        <table class="table table-sm table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th class="th-md">Kategori</th>
                    <th class="th-md">Asal</th>
                    <th class="th-sm">Jumlah Alat</th>
                    <th class="th-sm">Satuan</th>
                    <th class="th-sm">
                    </th>
                    <th class="th-sm">
                        Kondisi
                    </th>
                    <th class="wd-sm">Konfirmasi</th>
                </tr>
            </thead>
            <tbody id="tableList">
                @foreach($alat_list as $row)
                    <tr id="row_(( $row['KodeAlat'] ))" class="_(( $row['StatusRec'] == '0' ? ($isAdmin ? 'bg-dark' : '') : 'bg-success' ))">
                        <td>_(( $row['Nama'] ))</td>
                        <td>_(( $row['s_Kategori'] ))</td>
                        <td>_(( $row['s_Asal'] ))</td>
                        <td>
                            @if($editable)                    
                                <input type="number" class="wd-sm text-center" value="_(( $row['JumlahAlat'] ))" name="alat[_(( $row['KodeAlat'] ))][JumlahAlat]">
                            @else
                                _(( $row['JumlahAlat'] ))
                            @endif
                        </td>
                        <td>_(( $row['Satuan'] ))</td>
                        <td>
                            @if($editable)
                                <span onclick="deleteAlat('row_(( $row['KodeAlat'] ))')" class="btn btn-danger"><i class="fa fa-trash"></i></span>
                            @endif
                        </td>
                        <td>
                            @if($isAdmin)
                                <input class="wd-sm" type="number" placeholder="%" value="_(( $row['Kondisi'] ))" onblur="updateKondisi(_(( $row['NURPA'] )), this.value)">
                            @else
                                _(( $row['Kondisi'] ))%
                            @endif
                        </td>
                        <td>
                            @if($isAdmin)
                                <select name="alat[_(( $row['KodeAlat'] ))][StatusRec]" onchange="changeColor(this.value, 'row_(( $row['KodeAlat'] ))')">
                                    <option value="1" _(( $row['StatusRec'] == '1' ? 'selected' : '' ))>Setuju</option>
                                    <option value="0" _(( $row['StatusRec'] == '0' ? 'selected' : '' ))>Tidak</option>
                                </select>
                            @else
                                @if($row['StatusRec'] == '1')
                                    <span class="badge badge-success">disetujui</span>
                                @elseif($editable || $data['ApprKaLab'] == 'pending')
                                    <span class="badge badge-warning">pending</span>
                                @else
                                    <span class="badge badge-danger">ditolak</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>

<div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <a href="_(( site('main/jadwal_pemakaian') ))" class="btn btn-link"><i class="fas fa-arrow-left"></i> Kembali</a>
            @if($editable)
                <a href="_(( site('main/delete_pengajuan/'.$data['NURP']) ))" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus Pengajuan</a>
                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Simpan Pengajuan</button>
            @endif

            @if($isAdmin && $editable && !$newData)
                <div class="float-right">
                    <button type="submit" name="konfirmasi" value="tidak" class="btn btn-default"><i class="fas fa-times"></i> Batalkan Jadwal</button>
                    <button type="submit" name="konfirmasi" value="ya" class="btn btn-success"><i class="fas fa-check"></i> Konfirmasi Jadwal</button>
                </div>
            @endif
        </div>
    </div>
</form>
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
    
    function deleteAlat(id) {
        $('#'+id).remove();
    }
    function addAlat(){
        let tableData = $('#tableList');
        var alatId = $('#alatId').val();
        var jumlahAlat = $('#jumlahAlat').val();

        $.post("_(( site('api/main/alat') ))", {
            'NI' : alatId
        }, (data, status) => {
            const alat = JSON.parse(data);
            let newTr = `<tr id="row${alatId}">
                <td>${alat.Nama} <input type="hidden" value="${alatId}" name="alat[${alatId}][KodeAlat]"></td>
                <td>${alat.s_Kategori}</td>
                <td>${alat.s_Asal}</td>
                <td>
                    <input type="number" class="wd-sm text-center" value="${jumlahAlat}" name="alat[${alatId}][JumlahAlat]">
                </td>
                <td>${alat.Satuan}</td>
                <td><span onclick="deleteAlat('row${alatId}')" class="btn btn-danger"><i class="fa fa-trash"></i></span></td>
                <td>--</td>
            </tr>`;
            tableData.append(newTr);
        })
    }
    function changeColor(value, id){
        var theme = 'bg-success';
        if(value == 0)
            theme = 'bg-dark';
        $('#'+id).attr('class', theme);
    }
</script>