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
        <span class="text">Logout</span>
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
            <div class="card mb-4">
              <div class="card-header py-3">
                <h5 class="mb-0">Cart</h5>
              </div>
              <div class="card-body">
                <?php foreach ($carts as $cart) : ?>
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
                      <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                        <i class="fas fa-trash"></i>
                      </button>
                      <!-- Data -->
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                      <!-- Quantity -->
                      <div class="d-flex mb-4 justify-content-center text-center" style="max-width: 300px">
                        <button class="btn btn-primary px-3 me-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                          <i class="fas fa-minus"></i>
                        </button>

                        <form action="">


                          <div class="form-outline">
                            <label class="has-float-label" for="form1">
                              <input id="form1" min="1" name="quantity" value="<?= $cart['qty'] ?>" type="number" class="form-control text-center quantity-input" />
                              <span>Quantity</span>
                            </label>
                          </div>
                        </form>
                        <button class="btn btn-primary px-3 ms-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <!-- Quantity -->

                      <!-- Price -->
                      <p class="text-start text-md-center align-items-center">
                        <strong>Rp <?= number_format($cart['subtotal'], 0, ',', '.') ?></strong>
                      </p>
                      <!-- Price -->
                    </div>
                  </div>
                  <!-- Single item -->
                  <hr class="my-4" />
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header py-3">
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
                    Shipping
                    <span>Gratis</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Total amount</strong>
                    </div>
                    <span><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></span>
                  </li>
                </ul>

                <button type="button" class="btn btn-primary btn-lg btn-block">
                  Go to checkout
                </button>
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
  const quantityInputs = document.querySelectorAll('input[name="quantity"]');

  quantityInputs.forEach(function(input) {
    input.addEventListener('change', function() {
      console.log("hai")
    })
  });
</script>



<?php $this->endSection(); ?>