<!-- Beri Feedback -->
<form>
    <div class="modal fade border-0" id="lihatRating" tabindex="-1" aria-labelledby="lihatRating" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg border-0 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="judulModal">Lihat Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0" style="min-height:20rem;max-height:38rem;">
                    <div class="container">
                        <div class="row mb-3 align-items-center">
                            <?php foreach ($data['trans_prod'] as $key => $value): ?>
                            <div class="produk-<?=$value['id']?> border-bottom border-3 mb-3">
                                <div class="d-flex mt-3">
                                    <div class="flex-shrink-0 mb-3">
                                        <img class="rounded-3" src="<?=  base_url('assets/image/').json_decode($value['product']['photo'])[0] ?>" alt="Product Image" width="100">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1"><?= $value['product']['name'] ?></h6>
                                        <div class="stars-outer" style="order:1;">
                                        <div class="stars-inner" style="width:<?= $value['review']['rate']*20 ?>% !important; "></div>
                                    </div>
                                    <p><?= $value['review']['comment'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>                     
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Beri Feedback -->