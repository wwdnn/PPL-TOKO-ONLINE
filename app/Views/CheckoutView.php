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
      <?php $validation = \Config\Services::validation(); ?>

      <form action="/checkout" method="POST" class="formCheckout">
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4" style="border-radius: 20px;">
              <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
                <h5 class="mb-0"> Checkout</h5>
              </div>
              <div class="card-body">


                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="inputNama">Nama</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputNama" name="nama_pembeli" placeholder="Nama Lengkap">
                    <!-- error input -->
                    <div class="invalid-feedback">
                      <?= $validation->getError('nama_pembeli'); ?>
                    </div>
                    <!-- end error input -->
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputNoTelepon">Nomor Telepon</label>
                    <input type="number" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputNoTelepon" name="nomor_pembeli" placeholder="No Telepon 08">

                    <!-- error input -->
                    <div class="invalid-feedback">
                      <?= $validation->getError('nomor_pembeli'); ?>
                    </div>
                    <!-- end error input -->
                  </div>
                </div>

                <hr class="my-4" />

                <div class="form-group mt-3">
                  <label for="inputAlamat">Nama Jalan, Gedung, No. Rumah</label>
                  <input type="text" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputAlamat" name="alamat_pembeli" placeholder="">

                  <!-- error input -->
                  <div class="invalid-feedback">
                    <?= $validation->getError('alamat_pembeli'); ?>
                  </div>
                  <!-- end error input -->
                </div>

                <hr class="my-4" />

                <div class="row mt-3">
                  <div class="form-group col-md-6">
                    <label for="inputProvinsi">Provinsi</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputProvinsi" name="provinsi_pembeli">
                    <!-- error input -->
                    <div class="invalid-feedback">
                      <?= $validation->getError('provinsi_pembeli'); ?>
                    </div>
                    <!-- end error input -->
                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputKota">Kota</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputKota" name="kota_pembeli">
                    <!-- error input -->
                    <div class="invalid-feedback">
                      <?= $validation->getError('kota_pembeli'); ?>
                    </div>
                    <!-- end error input -->
                  </div>
                </div>

                <hr class="my-4" />

                <div class="row mt-3">
                  <div class="form-group col-md-6">
                    <label for="inputKecamatan">Kecamatan</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputKecamatan" name="kecamatan_pembeli">
                    <!-- error input -->
                    <div class="invalid-feedback">
                      <?= $validation->getError('kecamatan_pembeli'); ?>
                    </div>
                    <!-- end error input -->
                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputKodePos">Kode Pos</label>
                    <input type="number" class="form-control <?= $validation->hasError('nama_pembeli') ? 'is-invalid' : null ?>" id="inputKodePos" name="kodePos_pembeli">
                    <!-- error input -->
                    <div class="invalid-feedback">
                      <?= $validation->getError('kodePos_pembeli'); ?>
                    </div>
                    <!-- end error input -->
                  </div>
                </div>
                <hr class="my-4" />

              </div>
            </div>
          </div>

          <!-- Summary -->
          <div class="col-md-6">
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
                                <img src="./products/<?= $cart['options']['gambar_barang'] ?>" class="w-75" class="img-fluid" />
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

<script>
  // make code sweetalert for submit checkout
  const btnCheckout = document.querySelector('.btnCheckout');

  btnCheckout.addEventListener('click', function(event) {
    event.preventDefault();

    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Pastikan data yang anda masukkan sudah benar!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Lanjutkan!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.querySelector('.formCheckout').submit();
      }
    })
  });
</script>



<?php $this->endSection(); ?>