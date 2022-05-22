<?php
include './header.php';
include './conn.php';
include './components/navbar.component.php';


$data = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_id = $_POST['recipe_id'];
    $recipe_name = $_POST['recipe_name'];
    $recipe_imgURL = $_POST['recipe_imgURL'];

    $data = $conn->query(
        'SELECT ingrediants.name, recipes_ingrediants.amount, recipes_ingrediants.type FROM recipes, ingrediants, recipes_ingrediants WHERE recipes.id = ' . $recipe_id . ' AND recipes_ingrediants.ingrediant_id = ingrediants.id AND recipes.id = recipes_ingrediants.recipe_id'
    );
}

// TODO Needs formating
if ($data->num_rows > 0) {
    echo $recipe_name . "<br>";
    while ($rows = $data->fetch_assoc()) {
        echo $rows['name'] . " " . $rows['amount'] . " " . $rows['type'] . "<br>";
    }
    echo '<img src="' . $recipe_imgURL . '" class="card-img-top index__cardImage" alt="Image">';
}
