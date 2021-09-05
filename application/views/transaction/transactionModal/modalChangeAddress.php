<!-- Beri Feedback -->
<form id="pilih_address" action="" method="post">
    <div class="modal fade border-0" id="gantiAlamat" tabindex="-1" aria-labelledby="gantiAlamat" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg border-0 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="judulModal">Pilih Alamat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0" style="min-height:20rem;max-height:38rem;">
                    <div class="container">
                        <?php $count=1;
                            foreach ( $data['address_all'] as $add ) { 
                        ?>
                        <div class="form-check mb-3 border-bottom border-3">
                            <input class="form-check-input" type="radio" name="selectAlamat" id="alamat<?= $count ?>" value="<?= $add['id'] ?>">
                            <label class="form-check-label mb-2" for="alamat<?= $count ?>"> 
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1"><b><?= $add['address_name'] ?></b></h6>
                                        <p class="mb-0"><small>Penerima : <?= $add['recipient_name'] ?> - <?= $add['phone_number'] ?></small></p>
                                        <p class="mb-0"><small><?= $add['address'] ?>, Kelurahan <?= $add['nama_kelurahan'] ?>, Kecamatan <?= $add['nama_kecamatan'] ?>, <?= $add['nama_kota'] ?>, <?= $add['nama_provinsi'] ?> <?= $add['kode_pos'] ?></small></p>
                                        <small class="mb-0">Catatan :</small>
                                        <small><?= $add['note_address'] ?></small>
                                    </div>
                                </div>
                            </label>
                        </div>             
                        <?php $count++; } ?>  
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button id="select_address" type="button" class="btn btn-primary">Submit</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Beri Feedback -->