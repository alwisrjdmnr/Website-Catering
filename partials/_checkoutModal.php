<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkoutModal">Isikan Detail Pemesanan:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="partials/_manageCart.php" method="post">
                <div class="form-group">
                    <b><label for="address">Alamat Rumah:</label></b>
                    <input class="form-control" id="address" name="address" placeholder="" type="text" required minlength="3" maxlength="500">
                </div>
                <div class="form-group">
                    <b><label for="address1">Detail Alamat Rumah:</label></b>
                    <input class="form-control" id="address1" name="address1" placeholder="" type="text">
                </div>
                <div class="form-group">
                    <b><label for="pengiriman">Tanggal & Waktu Pengiriman</label></b>
                    <input class="form-control" id="pengiriman" name="pengiriman" placeholder="" type="datetime-local">
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <b><label for="phone">No. Hp:</label></b>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">+62</span>
                        </div>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx" required pattern="[0-9]{10}" maxlength="13">
                        </div>
                    </div>
                    <div class="form-group">
                    <b><label for="metode">Acara</label></b>
                    <input class="form-control" id="metode" name="metode" placeholder="Contoh = Rapat" type="text">
                </div>
                <div class="form-group">
                    <b><label for="zipcode">Catatan</label></b>
                    <input class="form-control" id="zipcode" name="zipcode" placeholder="Di antar / Ambil sendiri" type="text">
                </div>
        
                </div>
                <div class="form-group">
                    <b><label for="password">Password:</label></b>    
                    <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required minlength="4" maxlength="21" data-toggle="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="hidden" name="amount" value="<?php echo $harga_semua ?>">
                    <input type="hidden" name="lokasi" value="<?php echo $lokasi ?>">
                    <button type="submit" name="checkout" class="btn btn-success">Pesan</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>