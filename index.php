<img class="bg_image" src="assets/bg_image.jpg" alt="background image" />

<?php
include './header.php';
include './conn.php';
include './components/navbar.component.php';

$data = $conn->query('SELECT * FROM recipes;');
?>

<html><body>
<h1 class="mt-5 mb-0 index__mainText">Recipes:</h1>
<div class="m-5 index__cardContainer">
    <?php
    if ($data->num_rows > 0) {
        while ($rows = $data->fetch_assoc()) {
            echo '
                <form action="recipe.php" method="post">
                    <button type="submit" class="index__card">
                        <div class="card m-3" style="width: 20rem; height:22rem">
                            <img src="' . $rows["imageURL"] . '" class="card-img-top index__cardImage" alt="Image">
                            <div class="card-body">
                                <p class="card-text">' . $rows["name"] . '</p>
                            </div>
                        </div>
                        <input type="hidden" name="recipe_id" value="' . $rows["id"] . '" />
                        <input type="hidden" name="recipe_name" value="' . $rows["name"] . '" />
                        <input type="hidden" name="recipe_imgURL" value="' . $rows["imageURL"] . '" />
                    </button>
                </form>
            ';
        }
    }
    ?>
</div>
<!--Recipe cards end-->
</body>

</html>