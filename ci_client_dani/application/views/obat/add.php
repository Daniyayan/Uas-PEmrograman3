<div class="container pt-5">
    <h3><?= $title ?></h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>obat</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('obat'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    //create form
                    $attributes = array('method' => "post", "autocomplete" => "off");
                    echo form_open('', $attributes);
                    ?>
                    <div class="form-group row">
                        <label for="id_obat" class="col-sm-2 col-form-label">ID Obat</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="id_obat" name="id_obat" value="<?= set_value('id_boat'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('id_obat') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" value=" <?= set_value('nama_obat'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('nama_obat') ?>
                            </small>
                        </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Jenis Obat</legend>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jenis_obat" name="jenis_obat" value="Ada Obat"
                                        <?php if (set_value('jenis_obat') == "Ada obat") : echo "checked"; endif; ?>>
                                    <label class="form-check-label" for="jenis_obat">
                                        Ada obat
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="jenis_obat2" name="jenis_obat" value="Tidak ada obat"
                                        <?php if (set_value('jenis_obat') == "Tidak ada obat") : echo "checked"; endif; ?>>
                                    <label class="form-check-label" for="jenis_obat2">
                                        Tidak ada obat
                                    </label>
                                </div>
                                <small class="text-danger">
                                    <?php echo form_error('jenis_obat') ?>
                                </small>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Tanggal masuk</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="tanggal_masuk" name="tanggal_masuk" rows="3"><?= set_value('tanggal_masuk'); ?></textarea>
                            <small class="text-danger">
                                <?php echo form_error('tanggal_masuk') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="agama" class="col-sm-2 col-form-label">Bentuk obat</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="bentuk_obat" name="bentuk_obat">
                                <option value="Tablet" selected disabled>Pilih</option>
                                <option value="Tablet" <?php if (set_value('bentuk_obat') == "Tablet") : echo "selected"; endif; ?>>Tablet</option>
                                <option value="Botol" <?php if (set_value('bentuk_obat') == "Botol") : echo "selected"; endif; ?>>Botol</option>
                                <option value="box" <?php if (set_value('bentuk_obat') == "box") : echo "selected"; endif; ?>>box</option>
                            </select>
                            <small class="text-danger">
                                <?php echo form_error('bentuk_obat') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-2 col-form-label">Jumlah Masuk</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="jumlah_masuk" name="jumlah masuk" value="<?= set_value('jumlah_masuk'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('jumlah_masuk') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Harga Beli</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= set_value('harga_beli'); ?>">
                            <small class="text-danger">
                                <?php echo form_error('harga_beli') ?>
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-md-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="javascript:history.back()">Kembali</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>