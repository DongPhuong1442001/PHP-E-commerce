<?php 

include('server/connection.php');

//Su dung search product
if(isset($_POST['search'])){

  $category = $_POST['category'];

  $price = $_POST['price'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_category= ? AND product_price <= ?");

  $stmt->bind_param("si",$category,$price);

  $stmt->execute();

  $products = $stmt->get_result();

//Tra ve toan bo san pham
}else{

}

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$products = $stmt->get_result();

?>

<?php include('layouts/header.php');?>

      <section id="search" class="my-5 py-5 ms-2">
        <div class="container mt-5 py-5">
          <p>Search Products</p>
          <hr/>
        </div>

          <form action="shop.php" method="POST">
            <div class="row mx-auto container">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <p>Category</p>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category_one" value="shoes"/>
                    <label class="form-check-label" for="flexRadioDefault1">
                      Shoes
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category_two" value="coats"/>
                    <label class="form-check-label" for="flexRadioDefault2">
                      Coats
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category_three" value="watches"/>
                    <label class="form-check-label" for="flexRadioDefault3">
                      Watches
                    </label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="category" id="category_four" value="bags"/>
                    <label class="form-check-label" for="flexRadioDefault4">
                      Bags
                    </label>
                  </div>
              </div>
            </div>

            <div class="row mx-auto container mt-5">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <p>Price</p>
                <input type="range" class="form-range w-58" min="1" max="1000" id="customRange2" name="price" value="100"/>
                <div class="w-58">
                  <span style="float: left;">1</span>
                  <span style="float: right;">1000</span>
                </div>
              </div>
            </div>

            <div class="form-group my-3 mx-3">
              <input type="submit" name="search" value="Search" class="btn btn-primary"/>
            </div>

          </form>
      </section>

      <section id="shop" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
          <h3>Our Products</h3>
          <hr>
          <p class="text-dark">Check out our new products</p>
        </div>
    

      <?php while($row = $products->fetch_assoc()){?>

        <div class="row mx-auto container">
          <div onclick="window.location.href='single.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/<?php echo $row['product_image'];?>">

            <!--rating add here-->

            <h5 class="p-name text-dark"><?php echo $row['product_name'];?></h5>
            
            <h4 class="p-price"><?php echo $row['product_price'];?>kVND</h4>

            <a class="btn buy-btn" href="<?php echo "single.php?product_id=".$row['product_id'];?>">Buy Now</a>
          </div>
      <?php }?>

          <nav aria-label="Page navigation example">
            <ul class="pagination mt-5">
                <li class="page-item"><a href="#" class="page-link">Back</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
          </nav>
        </div>
    
      </section>

<?php include('layouts/footer.php'); ?>