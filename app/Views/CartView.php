<?php $this->extend('TemplateView'); ?>
<?php $this->section('content'); ?>

<!-- SIDEBAR -->
<section id="sidebar">
  <a href="#" class="brand">
    <i class='bx bxs-smile'></i>
    <span class="text">Foodie Wwdnn</span>
  </a>
  <ul class="side-menu top">
    <li class="active">
      <a href="/">
        <i class='bx bxs-dashboard'></i>
        <span class="text">Dashboard</span>
      </a>
    </li>
    <li>
      <a href="#">
        <i class='bx bxs-shopping-bag-alt'></i>
        <span class="text">TokoKu</span>
      </a>
    </li>
  </ul>
  <ul class="side-menu">
    <li>
      <a href="#" class="logout">
        <i class='bx bx-log-out-circle'></i>
        <span class="text"></span>
      </a>
    </li>
  </ul>
</section>
<!-- END SIDEBAR -->


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
    <a href="<?= base_url('cart') ?>" class="notification">
      <i class='bx bx-cart'></i>
      <!-- Count -->
      <?php
      $cart = \Config\Services::cart();
      $count_cart = 0;

      if ($cart->contents()) {
        foreach ($cart->contents() as $itemProduk) {
          $count_cart = $count_cart + $itemProduk['qty'];
        }
      }
      ?>
      <span class="num"><?= $count_cart ?></span>
    </a>
    <!-- <a href="#" class="profile">
      <img src="img/people.png">
    </a> -->
  </nav>
  <!-- END NAVBAR -->

  <!-- MAIN -->
  <main>
    <div class="table-data">
      <section class="h-100 gradient-custom">
        <div class="row d-flex justify-content-center">
          <div class="col-md-8">
            <div class="card mb-4" style="border-radius: 20px;">
              <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
                <h5 class="mb-0">Cart</h5>
              </div>
              <div class="card-body">
                <form action="/cart/update" method="POST">
                  <?php
                  $i = 1;
                  foreach ($carts as $cart) : ?>



                    <!-- Single item -->
                    <div class="row">
                      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                          <img src="./products/<?= $cart['options']['gambar_barang'] ?>" class="w-100" alt="Blue Jeans Jacket" />

                        </div>
                        <!-- Image -->
                      </div>

                      <div class="col-lg-5 col-md-4 mb-4 mb-lg-0">
                        <!-- Data -->
                        <p><strong><?= $cart['name'] ?></strong></p>
                        <!-- price -->
                        <p class="price"><strong>Harga : Rp <?= number_format($cart['price'], 0, ',', '.') ?></strong></p>
                        <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                          <a href="/cart/delete/<?= $cart['rowid'] ?>" class="btnDelete"><i class="fas fa-trash text-white"></i></a>
                        </button>
                        <!-- Data -->
                      </div>

                      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                        <!-- hidden price-->
                        <input type="hidden" name="price" value="<?= $cart['price'] ?>">

                        <!-- Quantity -->
                        <div class="d-flex mb-4 justify-content-center text-center" style="max-width: 300px">
                          <a class="btn btn-primary px-3 me-2 stepDown" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                            <i class="fas fa-minus"></i>
                          </a>
                          <div class="form-outline">
                            <label class="has-float-label" for="form1">
                              <input id="form1" min="1" name="quantity<?= $i++ ?>" value="<?= $cart['qty'] ?>" type="number" class="form-control text-center" />
                              <span>Quantity</span>
                            </label>
                          </div>
                          <a class="btn btn-primary px-3 ms-2 stepUp" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                            <i class="fas fa-plus"></i>
                          </a>
                        </div>
                        <!-- Quantity -->

                        <!-- Price -->
                        <p class="text-start text-md-center align-items-center subTotal">
                          <strong>Rp <?= number_format($cart['subtotal'], 0, ',', '.') ?></strong>
                        </p>
                        <!-- Price -->
                      </div>
                    </div>
                    <!-- Single item -->
                    <hr class="my-4" />
                  <?php endforeach; ?>
                  <!-- button update -->
                  <div class="text-end">
                    <button class="btn btn-primary" type="submit">
                      <i class="fas fa-save pe-2"></i>Update
                    </button>
                    <a href="/cart/destroy" class="btn btn-warning clearCart"> <i class="fas fa-trash pe-2"></i>Clear Keranjang
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-4" style="border-radius: 20px;">
              <div class="card-header py-3" style="background-color: #F9F9F9; border-radius: 20px">
                <h5 class="mb-0">Summary</h5>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    Products
                    <?php
                    $total = 0;
                    foreach ($carts as $cart) :
                      $total = $total + $cart['subtotal'];
                    endforeach;
                    ?>
                    <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    Ongkir
                    <span>Gratis</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Total Bayar</strong>
                    </div>
                    <span><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></span>
                  </li>
                  </ul>

                <div class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom" title="Cek Lagi Yaa!!">
                  <button type="button" class="btn btn-primary btn-lg btn-block btnCheckout">
                    checkout
                  </button>
                </div>

              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->

<script>
  // btn delete
  const btnDelete = document.querySelectorAll('.btnDelete');
  // clear keranjang
  const clearCart = document.querySelector('.clearCart');
  // step up
  const stepUp = document.querySelectorAll('.stepUp');
  // step down
  const stepDown = document.querySelectorAll('.stepDown');
  // boolean update
  let update = false;

  // btn checkout disable when update
  const btnCheckout = document.querySelector('.btnCheckout');

  // change value cart['subtotal'] when step up
  stepUp.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      const subTotal = btn.parentNode.parentNode.querySelector('.subTotal');
      const price = btn.parentNode.parentNode.querySelector('input[type=hidden]');
      const qty = btn.parentNode.querySelector('input[type=number]');
      const total = parseInt(price.value) * parseInt(qty.value);
      update = true
      subTotal.innerHTML = `<strong>Rp ${total.toLocaleString('id-ID')}</strong>`;
      if (update) {
        btnCheckout.setAttribute('disabled', 'disabled');
        // change title tooltip
        $('[data-toggle="tooltip"]').attr('title', 'Tekan Tombol Update Terlebih Dahulu!!')
      } 
    })
  })

  // change value cart['subtotal'] when step down
  stepDown.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      const subTotal = btn.parentNode.parentNode.querySelector('.subTotal');
      const price = btn.parentNode.parentNode.querySelector('input[type=hidden]');
      const qty = btn.parentNode.querySelector('input[type=number]');
      const total = parseInt(price.value) * parseInt(qty.value);
      update = true;
      subTotal.innerHTML = `<strong>Rp ${total.toLocaleString('id-ID')}</strong>`;
      if (update) {
        btnCheckout.setAttribute('disabled', 'disabled');
        // when update is true, btn checkout disabled and tooltip show
        $('[data-toggle="tooltip"]').tooltip()
      } else {
        // when update is false, btn checkout enabled and tooltip hide
        $('[data-toggle="tooltip"]').tooltip('hide')
      }

    })
  })

  clearCart.addEventListener('click', (e) => {
    e.preventDefault();
    const href = clearCart.getAttribute('href');

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Semua produk akan dihapus dari keranjang!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href;
      }
    })
  })

  btnDelete.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const href = btn.getAttribute('href');

      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Produk akan dihapus dari keranjang!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;
        }
      })
    })
  })
</script>

<?php $this->endSection(); ?>