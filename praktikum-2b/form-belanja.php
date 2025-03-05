<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="font-size: 18px;">
<form method="POST" action="total-belanja.php" class="container mt-5">
    <fieldset class="border border-dark p-3 rounded">
        <legend class="float-none w-auto px-3 fw-bold h3">Form Belanja</legend>
  <div class="form-group row">
    <label for="nama_customer" class="col-4 col-form-label">Customer</label> 
    <div class="col-8">
      <textarea id="nama_customer" name="nama_customer" placeholder="Nama Customer" cols="40" rows="1" required="required" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Pilih Produk</label> 
    <div class="col-8">
    <div class="custom-control custom-radio custom-control-inline">
    <input name="pilih_produk" id="pilih_produk_0" type="radio" class="custom-control-input" value="TV" required="required">
    <label for="pilih_produk_0" class="custom-control-label">TV</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
    <input name="pilih_produk" id="pilih_produk_1" type="radio" class="custom-control-input" value="KULKAS" required="required">
    <label for="pilih_produk_1" class="custom-control-label">KULKAS</label>
</div>
<div class="custom-control custom-radio custom-control-inline">
    <input name="pilih_produk" id="pilih_produk_2" type="radio" class="custom-control-input" value="MESIN CUCI" required="required">
    <label for="pilih_produk_2" class="custom-control-label">MESIN CUCI</label>
</div>
    </div>
  </div>
  <div class="form-group row">
    <label for="jumlah" class="col-4 col-form-label">Jumlah</label> 
    <div class="col-8">
      <input id="jumlah" name="jumlah" placeholder="Jumlah" type="text" class="form-control" required="required">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div style="border: 1px solid #ccc; padding: 20px; width: 300px;">
  <h2 style="background-color: #007bff; color: white; padding: 5px;">Daftar Harga</h2>
  <ul>
    <li>TV : 4.200.000</li>
    <li>Kulkas : 3.100.000</li>
    <li>MESIN CUCI : 3.800.000</li>
  </ul>
  <p style="background-color: #007bff; color: white; padding: 5px;">Harga Dapat Berubah Setiap Saat</p>
</div>
  </div>
</form>
</form>
</body>
</html>