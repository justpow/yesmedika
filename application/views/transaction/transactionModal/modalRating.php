<!-- Beri Feedback -->
<form id="add_feedback" action="<?= base_url('rating/submit') ?>" method="post">
    <div class="modal fade border-0" id="beriRating" tabindex="-1" aria-labelledby="beriRating" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg border-0 modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="judulModal">Beri Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0" style="min-height:20rem;max-height:38rem;">
                    <div class="container">
                        <div class="row mb-3 align-items-center">
                            <?php foreach ($data['trans_prod'] as $key => $value): ?>
                            <div class="produk-<?=$value['id']?> border-bottom border-3 mb-3">
                                <div class="d-flex mt-3">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-3" src="<?=  base_url('assets/image/').json_decode($value['product']['photo'])[0] ?>" alt="Product Image" width="100">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1"><?= $value['product']['name'] ?></h6>
                                        <div class="stars d-flex justify-content-end flex-row-reverse">
                                            <input class="star star-5" id="prod<?= $value['id'] ?>-rat5" type="radio" name="<?=$value['id']?>" value="5" required />
                                            <label class="star star-5" for="prod<?= $value['id'] ?>-rat5"></label>
                                            <input class="star star-4" id="prod<?= $value['id'] ?>-rat4" type="radio" name="<?=$value['id']?>" value="4" required />
                                            <label class="star star-4" for="prod<?= $value['id'] ?>-rat4"></label>
                                            <input class="star star-3" id="prod<?= $value['id'] ?>-rat3" type="radio" name="<?=$value['id']?>" value="3" required />
                                            <label class="star star-3" for="prod<?= $value['id'] ?>-rat3"></label>
                                            <input class="star star-2" id="prod<?= $value['id'] ?>-rat2" type="radio" name="<?=$value['id']?>" value="2" required />
                                            <label class="star star-2" for="prod<?= $value['id'] ?>-rat2"></label>
                                            <input class="star star-1" id="prod<?= $value['id'] ?>-rat1" type="radio" name="<?=$value['id']?>" value="1" required />
                                            <label class="star star-1" for="prod<?= $value['id'] ?>-rat1"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3 mt-2">
                                    <div class="col-12">
                                        <label for="ulasProduk" class="form-label mb-0">Ulas Produk</label>
                                        <textarea class="form-control" placeholder="Produk sangat bagus!" id="msg_<?= $value['id'] ?>" name="msg_<?= $value['id'] ?>" style="height: 100px" required></textarea>
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
                        <button id="add_ulasan" type="submit" class="btn btn-primary">Submit</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Beri Feedback -->