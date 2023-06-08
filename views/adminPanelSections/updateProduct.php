<?php
    require_once ("models/functions.php");
?>
<div class="col">
    <h1 class="mt-5">Change existing product</h1>
    <?php
        global $conn;
        $id=$_GET['id'];
        $product = selectQueryWithCondition("products",$id);
    ?>
    <form method="POST" action="models/product/updateProduct.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Title:</label>
            <input type="text" name="title" value="<?=$product->title?>" class="form-control" id="exampleFormControlInput2">
        </div>
        <input type="hidden" name="id" value="<?=$product->id?>">
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Price:</label>
            <input type="text" name="price" value="<?=$product->price?>" class="form-control" id="exampleFormControlInput2">
        </div>
        <label for="exampleFormControlInput2" class="form-label">Is on sale:</label>
        <select class="form-control" name="onSale"  aria-label="Default select example">-->
            <?php if($product->onSale):?>
            <option value="1" selected>On sale</option>
            <option value="0">Not on sale</option>
            <?php else:?>
            <option value="1">On sale</option>
            <option value="0" selected>Not on sale</option>
            <?php endif;?>
        </select>
        <div class="mb-3 mt-5">
            <input class="btn btn-primary mb-5" type="submit" value="Change product data">
        </div>
        <?php
        if(isset($_GET['error'])){
            echo "<p class='alert alert-danger col-9 mt-3 mx-auto'>".$_GET["error"]."</p>";
        }
        if(isset($_GET['msg'])){
            echo "<p class='alert alert-success  col-9 mt-3 mx-auto'>".$_GET["msg"]."</p>";
        }
        ?>
    </form>
</div>
