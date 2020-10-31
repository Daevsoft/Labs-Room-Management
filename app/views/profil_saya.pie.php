<div class="form-horizontal">
    <div class="form-group row">
        <label class="col-sm-2">Nama Pengguna</label>
        <div class="col-sm-4">
            _(( $data['NamaP'] ))
        </div>
        <label class="col-sm-2"></label>
        <div class="col-sm-4">
            @if($data['Gender'] == 'L')
                <label class="badge badge-primary">Laki-laki</label>
            @else
                <label class="badge badge-warning">Perempuan</label>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">Nama Anggota</label>
        <div class="col-sm-4">
            _(( $data['NamaA'] ))
        </div>
        <label class="col-sm-2">No. Telpon</label>
        <div class="col-sm-4">
        _(( $data['Telp'] ))
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">Tempat, Tgl Lahir</label>
        <div class="col-sm-4">
        _(( $data['TmpLahir'].' ,'.$data['TglLahir'] ))
        </div>
        <label class="col-sm-2">NIDN/NPM/NIK</label>
        <div class="col-sm-4">
            _(( $data['NIK'] ))
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">Tgl Registrasi</label>
        <div class="col-sm-4">
            _(( date('d-m-y h:i', strtotime($data['TglReg'])) ))
        </div>
        <label class="col-sm-2">Status</label>
        <div class="col-sm-4">
            @if($data['StatusA'] == 'active')
                <span class="badge badge-success">Active</span>
            @else
                <span class="badge badge-danger">Off</span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2">Alamat</label>
        <div class="col-sm-4">
            _(( $data['Alamat'] ))
        </div>
        <label class="col-sm-2"></label>
        <div class="col-sm-4">
            <a href="_(( site('main/edit_profile') ))" class="btn btn-warning">Ubah Profil</a>
        </div>
    </div>
</div>