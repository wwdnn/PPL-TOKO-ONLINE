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
        <input type="search" placeholder="Search...">
        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
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
    <div class="head-title">
      <div class="left">
        <h1>Dashboard</h1>

      </div>
    </div>

    <div class="table-data">
      <div class="order">
        <div class="row">
          <a href="/carttes">cek</a>
          <?php foreach ($barangs as $brg) : ?>
            <div class="col-md-3 py-3">
              <!-- Card Produk -->
              <form action="/dashboard/cart" method="post" id="formCart_<?= $brg['kode_barang'] ?>">
                <input type="hidden" name="kode_barang" value="<?= $brg['kode_barang'] ?>">
                <input type="hidden" name="nama_barang" value="<?= $brg['nama_barang'] ?>">
                <input type="hidden" name="harga_barang" value="<?= $brg['harga_barang'] ?>">
                <input type="hidden" name="gambar_barang" value="<?= $brg['gambar_barang'] ?>">
                <input type="hidden" name="stok_barang" value="<?= $brg['stok_barang'] ?>">
                <div class="card" style="width: 15rem;">
                  <img src="./products/<?= $brg['gambar_barang'] ?>" class="card-img-top" alt="...">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?= $brg['nama_barang'] ?></h5>
                    <p class="card-text">Rp <?= number_format($brg['harga_barang'], 0, ',', '.'); ?></p>
                    <?php if ($brg['stok_barang'] > 0) : ?>
                      <p class="card-text text-success">Stok Tersedia : <?= $brg['stok_barang'] ?></p>
                    <?php else : ?>
                      <p class="card-text text-danger">Stok Habis</p>
                    <?php endif; ?>
                    <button type="submit" class="btn submitBtn" data-formid="formCart_<?= $brg['kode_barang'] ?>">Add To Cart</button>
                  </div>
                </div>
              </form>
              <!-- End Card Produk -->
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </main>
  <!-- END MAIN -->
</section>
<!-- END CONTENT -->

<script>
  const submitBtns = document.querySelectorAll('.btn');
  submitBtns.forEach(function(submitBtn) {
    submitBtn.addEventListener('click', function(event) {
      event.preventDefault();
      const formId = this.getAttribute('data-formid');
      const form = document.getElementById(formId);
      Swal.fire({
        icon: 'success',
        text: 'Barang Berhasil Ditambahkan',
        showConfirmButton: false,
        customClass: {
          container: 'position-absolute'
        },
        toast: true,
        position: 'top-right',
        timer: 1500
      }).then(() => {
        form.submit();
      })
    });
  });
</script>

<?php $this->endSection(); ?>