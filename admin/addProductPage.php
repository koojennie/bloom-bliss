<?php
include ('layout/header.php');

?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Add Product</h3>
                <h6 class="op-7 mb-2">Product Management Bloom & Bliss</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Product</div>
                    </div>
                    <div class="card-body">
                        <form action="action/insertProductAction.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                        <input type="hidden" name="bouquet_id" value="">
                                            <label for="bouquetCode">Code</label>
                                            <input type="text" class="form-control" id="bouquetCode"
                                                placeholder="Enter code" name="bouquet_code" value=""
                                                required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bouquetName">Name</label>
                                        <input type="text" class="form-control" id="bouquetName"
                                            placeholder="Enter Name" name="bouquet_name" value="" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Image</label>
                                        <input type="file" class="form-control" id="exampleInputName1" value=""
                                            name="bouquet_image" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Description</label>
                                        <textarea class="form-control" id="comment" placeholder="Enter Description" name="bouquet_description" rows="5"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="bouquetType">Type</label>
                                        <input type="text" class="form-control" id="bouquetType"
                                            placeholder="Enter type" name="bouquet_type" value="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bouquetPrice">Price (Rp)</label>
                                        <input type="text" class="form-control" id="bouquetPrice" placeholder="Enter price"
                                            name="bouquet_price" value="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bouquetStock">Stock</label>
                                        <input type="text" class="form-control" id="bouquetStock" placeholder="Enter stock"
                                            name="bouquet_stock" value="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="bouquetRatings">Ratings</label>
                                        <input type="number" class="form-control" id="bouquetRatings" placeholder="Enter ratings" step=".01"
                                           name="bouquet_ratings" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label for="bouquetCategory">Category</label>
                                        <select class="form-select form-control" name="bouquet_category" id="bouquetCategory">
                                            <option value="" selected disabled>Select category</option>
                                            <option value="wedding">Wedding</option>
                                            <option value="graduation">Graduation</option>
                                            <option value="birthday">Birthday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 pt-5">
                                    <a href="product.php" class="btn btn-secondary">BACK</a>
                                    <button class="btn btn-primary" type="submit">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script></script> -->

<!-- footer -->
<?php include ('layout/footer.php') ?>