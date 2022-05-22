<img class="bg_image" src="assets/bg_image2.jpg" alt="background image" />
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
    echo "<div style='text-align: center'>";
    echo '<div style="width: 100%; text-align: center;"> <h1 class="recipe__title">' . $recipe_name . '</div> </h1>' . "<br>";
    echo "</div>";
    echo "<div class='recipe__container'>";

    echo '<img src="' . $recipe_imgURL . '" class="recipe__img" alt="Image" >';

    $column = "";
    while ($rows = $data->fetch_assoc()) {   
        $column = $column . '<b>' . $rows['name'] . '</b>' . " " . $rows['amount'] . " " . $rows['type'] . "<br>";
        
    }

    echo '<div class="recipe__ingredients">' . $column . '</div>';

    $recipe = "Melt butter with olive oil in a large saucepan over medium heat; cook onion, celery, and carrot with pinch of salt until onion turns translucent, about 5 minutes. Stir ground beef into vegetables and cook, stirring constantly until meat is crumbly and no longer pink, about 5 minutes. Season meat mixture with 1 1/2 teaspoon salt, black pepper, cayenne pepper, and nutmeg. Pour milk into ground beef mixture and bring to a simmer. Cook, stirring often, until most of the milk has evaporated and bottom of pan is still slightly saucy, about 5 minutes. Reduce heat to low and simmer, stirring often, until mixture cooks down into a thick sauce, at least 3 hours but preferably 4 to 6 hours. Skim fat from top of sauce if desired. If sauce is too thick or too hot on the bottom, add a little more water. Taste and adjust seasonings before serving.";

    echo '<div class="recipe__text">' . $recipe . '</div>';
    //$main_div = '<img src="' . $recipe_imgURL . '" class="recipe__img" alt="Image" >' . '<div class="recipe__ingredients">' . $column . '</div>';
    //echo '<div class="recipe__main_div">' . $main_div . '</div>';
    echo '</div>';
}
?>