<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Obat</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('obat'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header bg-info">
                    Detail Data Obat
                </div>
                <div class="card-body">
                    <h5 class="card-title"><b>ID Obat :</b><br><?= $data_obat['id_obat'] ?></h5>
                    <p class="card-text"><b>Nama Obat :</b><br><?= $data_obat['nama_obat'] ?></p>
                    <p class="card-text"><b>Jenis Obat :</b><br><?= $data_obat['jenis_obat'] ?></p>
                    <p class="card-text"><b>Tanggal masuk :</b><br><?= $data_obat['tanggal_masuk'] ?></p>
                    <p class="card-text"><b>Bentuk Obat :</b><br><?= $data_obat['bentuk_obat'] ?></p>
                    <p class="card-text"><b>Harga Beli :</b><br><?= $data_obat['harga_beli'] ?></p>
                    <h6 class="card-subtitle mb-2 text-muted"><b>Jumlah masuk :</b><br><?= $data_obat['jumlah_masuk'] ?></h6>
                    <p></p>
                    <a href="<?= base_url(); ?>mahasiswa" class="btn btn-primary">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</div>