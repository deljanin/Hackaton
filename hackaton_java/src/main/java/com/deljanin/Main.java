package main.java.com.deljanin;


import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;

import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;

public class Main {
    public static ArrayList<String> alreadyIn = new ArrayList<>();

    public static void main(String[] args) {
        Document doc = null;
        try {
            doc = Jsoup.connect("https://www.yummly.com/recipes?q=meat+balls&taste-pref-appended=true").userAgent("Mozilla/5.0").get();
        } catch (IOException e) {
            e.printStackTrace();
        }
        String baseURL = "https://www.yummly.com";
        Elements pageHtml = doc.getElementsByClass("link-overlay");
        ArrayList<String> allRecipeUrls = new ArrayList<>();
        for (int i = 0; i < pageHtml.size(); i++) {
            allRecipeUrls.add(i,baseURL + pageHtml.get(i).attr("href"));
        }
//        TODO Run this baby in parallel???
        ArrayList<Recipe> ALlRecipes = new ArrayList<>();
        for (int i = 0; i < allRecipeUrls.size(); i++) {
            ALlRecipes.add(i, getIngredientsFromSinglePage(allRecipeUrls.get(i)));
            System.out.println();
        }
//Not removeing duplicates, tried but workaround is SELECT DISTINCT
        for (int i = 0; i < ALlRecipes.size(); i++) {
            insertIntoDB(filterIngrediants(ALlRecipes.get(i)));
        }
    }

    public static void insertIntoDB(Recipe recipe){
        Connection conn = null;
        Statement stmt = null;
        try {
            conn = (Connection) DriverManager.getConnection("jdbc:mysql://localhost/hackaton", "root", "");
            stmt = (Statement) conn.createStatement();
            String str = recipe.getIngredients().get(0).getIngredientName();
            System.out.println(str);
            for (int i = 0; i < recipe.getIngredients().size(); i++) {
                String query1 = "INSERT INTO ingrediants (name)" + " VALUES ('"+ recipe.getIngredients().get(i).getIngredientName() +"')";
                System.out.println(query1);
                stmt.executeUpdate(query1);
            }

//            String query2 = "INSERT INTO recipes (name)" + "VALUES ("+ recipes.get(0).getRecipeName() +")";
//            String query3 = "INSERT INTO recipes_ingrediants (recipe_id)" + "VALUES ("+ recipes.get(0).getRecipeName() +")";

//            System.out.println("Record is inserted in the table successfully");
        } catch (SQLException excep) {
            excep.printStackTrace();
        } catch (Exception excep) {
            excep.printStackTrace();
        } finally {
            try {
                if (stmt != null)
                    conn.close();
            } catch (SQLException se) {}
            try {
                if (conn != null)
                    conn.close();
            } catch (SQLException se) {
                se.printStackTrace();
            }
        }
    }

    public static Recipe filterIngrediants(Recipe recipe){
        Recipe value = new Recipe(recipe.getIngredients(),recipe.getRecipeName());
        Connection conn = null;
        Statement stmt = null;
        try {
            conn = (Connection) DriverManager.getConnection("jdbc:mysql://localhost/hackaton", "root", "");
            stmt = (Statement) conn.createStatement();
            ArrayList<ResultSet> sqlResult = new ArrayList<>();
            for (int i = 0; i < recipe.getIngredients().size(); i++) {
                String query = "SELECT name FROM ingrediants where '"+ recipe.getIngredients().get(i).getIngredientName() +"' = name";
//                System.out.println(query);
                ResultSet r = stmt.executeQuery(query);
                while(r.next() == true){
//                    System.out.println(r.getString("name"));
                    value.getIngredients().remove(recipe.getIngredients().get(i));
                }
            }
        } catch (SQLException excep) {
            excep.printStackTrace();
        } catch (Exception excep) {
            excep.printStackTrace();
        } finally {
            try {
                if (stmt != null)
                    conn.close();
            } catch (SQLException se) {}
            try {
                if (conn != null)
                    conn.close();
            } catch (SQLException se) {
                se.printStackTrace();
            }
        }
        return value;
    }

    public static Recipe getIngredientsFromSinglePage(String pageURL){
//        Using jsoup library
        Document doc = null;
        try {
            doc = Jsoup.connect(pageURL).userAgent("Mozilla/5.0").get();
        } catch (IOException e) {
            e.printStackTrace();
        }
//        Getting title and cleaning it up
        String title = doc.title();
//        Not working for some reason
//        String remove = " Recipe | Yummly";
//        StringBuilder builder = new StringBuilder(title);
//        title = builder.delete(title.indexOf(remove), title.indexOf(remove)+remove.length()).toString();
        System.out.println(title);

//      Getting ingredients
        Elements ingredients = doc.getElementsByClass("IngredientLine");

        ArrayList<Ingredient> ingredientsArr = new ArrayList<>();
        for (int i = 0; i < ingredients.size(); i++) {
            ingredientsArr.add(i,new Ingredient(ingredients.get(i).getElementsByClass("amount").text(),
                    ingredients.get(i).getElementsByClass("unit").text(),
                    ingredients.get(i).getElementsByClass("ingredient").text()));

        }
        ingredientsArr.forEach(i -> System.out.println(i.getAmount() + " " + i.getUnit() + " " + i.getIngredientName()));
        return new Recipe(ingredientsArr,title);
    }
}
