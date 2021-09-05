<!-- Beri Feedback -->
<form id="add_feedback" action="" method="post">
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
                            <div class="produk-1 border-bottom border-3 mb-3">
                                <div class="d-flex mt-3">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-3" src="<?= base_url('assets/image/masker.jpg'); ?>" alt="Product Image" width="100">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Masker kali ya</h6>
                                        <div class="stars d-flex justify-content-end flex-row-reverse">
                                            <input class="star star-5" id="prod1-rat5" type="radio" name="star1"/>
                                            <label class="star star-5" for="prod1-rat5"></label>
                                            <input class="star star-4" id="prod1-rat4" type="radio" name="star1"/>
                                            <label class="star star-4" for="prod1-rat4"></label>
                                            <input class="star star-3" id="prod1-rat3" type="radio" name="star1"/>
                                            <label class="star star-3" for="prod1-rat3"></label>
                                            <input class="star star-2" id="prod1-rat2" type="radio" name="star1"/>
                                            <label class="star star-2" for="prod1-rat2"></label>
                                            <input class="star star-1" id="prod1-rat1" type="radio" name="star1"/>
                                            <label class="star star-1" for="prod1-rat1"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3 mt-2">
                                    <div class="col-12">
                                        <label for="ulasProduk" class="form-label mb-0">Ulas Produk</label>
                                        <textarea class="form-control" placeholder="Produk sangat bagus!" id="ulasProduk" name="ulasProduk" style="height: 100px" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="produk-2 border-bottom border-3 mb-3">
                                <div class="d-flex mt-3">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-3" src="<?= base_url('assets/image/masker.jpg'); ?>" alt="Product Image" width="100">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Masker kali ya</h6>
                                        <div class="stars d-flex justify-content-end flex-row-reverse">
                                            <input class="star star-5" id="prod2-rat5" type="radio" name="star2"/>
                                            <label class="star star-5" for="prod2-rat5"></label>
                                            <input class="star star-4" id="prod2-rat4" type="radio" name="star2"/>
                                            <label class="star star-4" for="prod2-rat4"></label>
                                            <input class="star star-3" id="prod2-rat3" type="radio" name="star2"/>
                                            <label class="star star-3" for="prod2-rat3"></label>
                                            <input class="star star-2" id="prod2-rat2" type="radio" name="star2"/>
                                            <label class="star star-2" for="prod2-rat2"></label>
                                            <input class="star star-1" id="prod2-rat1" type="radio" name="star2"/>
                                            <label class="star star-1" for="prod2-rat1"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-1 mb-3 mt-2">
                                    <div class="col-12">
                                        <label for="ulasProduk" class="form-label mb-0">Ulas Produk</label>
                                        <textarea class="form-control" placeholder="Produk sangat bagus!" id="ulasProduk" name="ulasProduk" style="height: 100px" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button id="add_ulasan" type="button" class="btn btn-primary">Submit</button>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Beri Feedback -->