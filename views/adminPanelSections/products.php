<?php
    require_once ("models/functions.php");
?>
<div class="col">
        <h1 class="mt-5">Products</h1>
        <table id="champTable" >

            <?php
                $products = selectQuery("products");
                if(count($products)): ?>
                <thead id="tableHead">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>On sale</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="tableBody">
            <?php foreach ($products as $product):?>
            <tr class="dataRows">
                <td><img class="champImg" src="assets/img/<?=$product->src?>" alt="<?=$product->alt?>" /> </td>
                <td><?=$product->title?></td>
                <td><?=$product->price?></td>
                <td><?php echo checkIfOnSale($product->onSale)?></td>
                <td><a href="index.php?page=adminPanel&adminPage=updateProduct&id=<?=$product->id?>"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td><a href="models/product/deleteProduct.php?id=<?=$product->id?>"><button type="button" class="btn btn-danger btnDelete">Delete</button></a></td>
            </tr>
            <?php endforeach;?>
            <?php else:?>
            <h2>There is currently no products at database</h2>
            <?php endif;?>

            </tbody>
        </table>
    </div>
<div class="col-12">
    <h1 class="mt-5">Add new product</h1>
    <form method="POST" action="models/product/addProduct.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Title:</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput2">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Upload product picture:</label>
            <input type="file" name="image"  class="form-control" id="inputGroupFile01" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Price:</label>
            <input type="text" name="price" class="form-control" id="exampleFormControlInput2">
        </div>

        <select class="form-control mt-4" name="onSale" aria-label="Default select example">
           <option value="1">On sale</option>
           <option value="0">Not on sale</option>
        </select>
        <input class="btn btn-primary mb-5 mt-5" name="sendData" type="submit" value="Add product">

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


<?php
function checkIfOnSale($onSale){
    if($onSale){
        return "On sale";
    }
    else {
        return "Not on sale";
    }
}
?>