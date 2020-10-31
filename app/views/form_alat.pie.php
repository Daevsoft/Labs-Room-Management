<form class="form-horizontal" action="_(( site('main/form_alat/'.$data['NI']) ))" method="POST">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Alat</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Nama Alat" name="Nama" value="_(( $data['Nama'] ))">
        </div>
        <label class="col-sm-2 col-form-label">No. Referensi</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Nomor Referensi" name="NoReferensi" value="_(( $data['NoReferensi'] ))">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Satuan</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Satuan" name="Satuan" value="_(( $data['Satuan'] ))">
        </div>
        <label class="col-sm-2 col-form-label">Kategori</label>
        <div class="col-sm-2">
            <select name="KodeKategori" class="form-control">
                @foreach($kategori_list as $row)
                    <option value="_(( $row['KodeKategori'] ))" _(( $row['KodeKategori'] == $data['KodeKategori'] ? 'selected' : '' ))>_(( $row['Deskripsi'] ))</option>
                @endforeach
                <option value="">-- Lainnya --</option>
            </select>
        </div>
        <div class="col-sm-2">
            <input type="text" name="Kategori_l" placeholder="Lainnya" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Asal</label>
        <div class="col-sm-2">
            <select name="KodeAsal" class="form-control">
                @foreach($asal_list as $row)
                    <option value="_(( $row['KodeAsal'] ))" _(( $row['KodeAsal'] == $data['KodeAsal'] ? 'selected' : '' ))>_(( $row['Deskripsi'] ))</option>
                @endforeach
                <option value="">-- Lainnya --</option>
            </select>
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" placeholder="Lainnya" name="Asal_l">
        </div>
        <div class="col-sm-6"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <a href="_(( site('main/inventaris') ))" class="btn btn-link"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Alat</button>
        </div>
    </div>
<!-- /.card-footer -->
</form>