<?php $this->extend('TemplateView'); ?>
<?php $this->section('content'); ?>

<!-- CONTENT -->
<section id="content">
  <!-- NAVBAR -->
  <nav>
    <i class='bx bx-menu'></i>
    <form action="#">
      <div class="form-input">

      </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>
  </nav>
  <!-- END NAVBAR -->

  <!-- MAIN -->
  <main>
    <section class="h-100 gradient-custom">
    <form action="/checkout" method="POST">
      <div class="row">
        <div class="col-md-5">
          <div class="card mb-4" style="border-radius: 20px;">
            <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
              <h5 class="mb-0"> Checkout</h5>
            </div>
            <div class="card-body">
              

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="inputNama">Nama</label>
                    <input type="text" class="form-control" id="inputNama" name="nama_pembeli" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputNoTelepon">Nomor Telepon</label>
                    <input type="number" class="form-control" id="inputNoTelepon" name="nomor_pembeli" placeholder="No Telepon +62">
                  </div>
                </div>

                <hr class="my-4" />

                <div class="form-group mt-3">
                  <label for="inputAlamat">Nama Jalan, Gedung, No. Rumah</label>
                  <input type="text" class="form-control" id="inputAlamat" name="alamat_pembeli" placeholder="">
                </div>

                <hr class="my-4" />

                <div class="row mt-3">
                  <div class="form-group col-md-6">
                    <label for="inputProvinsi">Provinsi</label>
                    <input type="text" class="form-control" id="inputProvinsi" name="provinsi_pembeli">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputKota">Kota</label>
                    <input type="text" class="form-control" id="inputKota" name="kota_pembeli">
                  </div>
                </div>

                <hr class="my-4" />

                <div class="row mt-3">
                  <div class="form-group col-md-6">
                    <label for="inputKecamatan">Kecamatan</label>
                    <input type="text" class="form-control" id="inputKecamatan" name="kecamatan_pembeli">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputKodePos">Kode Pos</label>
                    <input type="number" class="form-control" id="inputKodePos" name="kodePos_pembeli">
                  </div>
                </div>
                <hr class="my-4" />
           
            </div>
          </div>
        </div>

        <!-- Summary -->
        <div class="col-md-7">
          <div class="card mb-4" style="border-radius: 20px;">
            <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
              <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
            <div class="table-responsive overflow-auto" style="height:220px;">
              <table class="d-block table table-borderless">
                <thead>
                  <tr class="">
                    <th class="col-md-1">No</th>
                    <th class="col-md-5">Produk</th>
                    <th class="col-md-2 text-center">Kuantitas</th>
                    <th class="col-md-3 text-center">SubTotal</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                  $i = 1;
                  foreach ($carts as $cart) : ?>
                  <tr class="">
        
                    <th scope="row">
                      <?= $i ?>
                    </th>
     
                    <td>
                      <div class="row align-items-center">
                        <div class="col-md-3">
                        <img src="./products/<?= $cart['options']['gambar_barang'] ?>" class="w-75" class="img-fluid"/>
                        </div>
                        <div class="col-md-9">
                          <h6 class="mt-2"><?= $cart['name'] ?></h6>
                        </div>
                      </div>
                    </td>
                    <td class="text-center align-items-center"><?= $cart['qty'] ?></td>
                    <td class="text-center">Rp <?= number_format($cart['subtotal'], 0, ',', '.') ?></td>
                  </tr>
                  <?php 
                  $i++; 
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>

              <hr class="my-4" />

              <?php
                $total = 0;
                foreach ($carts as $cart) :
                  $total = $total + $cart['subtotal'];
                endforeach;
              ?>

              <div class="row">
                <div class="col-md-8">
                  <h3 class="text-uppercase">Total Yang Harus Dibayar</h3>
                </div>
                <div class="col-md-4 text-right">
                  <h3 class="text-center">Rp <?= number_format($total, 0, ',', '.') ?></h3>
                </div>
              </div>

              <hr class="my-4" />


              <div class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom" title="Cek Lagi Yaa!!">
                <button type="submit" class="btn btn-primary btn-lg btn-block btnCheckout">
                  Checkout
                </button>

                <button type="button" class="btn btn-warning btn-lg btn-block btnCheckout">
                  <a href="/cart" class="text-white">Kembali</a>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Summary -->
      </div>
      </form>
    </section>
  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->



<?php $this->endSection(); ?>