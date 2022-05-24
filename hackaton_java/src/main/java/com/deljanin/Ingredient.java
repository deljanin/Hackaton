package main.java.com.deljanin;

public class Ingredient {
    private String amount;
    private String unit;
    private String IngredientName;

    public Ingredient(String amount, String unit, String ingredientName) {
        this.amount = amount;
        this.unit = unit;
        IngredientName = ingredientName;
    }

//TODO    Amount parser

//TODO    Unit parser


    @Override
    public String toString() {
        return "Ingredient{" +
                "amount='" + amount + '\'' +
                ", unit='" + unit + '\'' +
                ", IngredientName='" + IngredientName + '\'' +
                '}';
    }

    public String getAmount() {
        return amount;
    }

    public void setAmount(String amount) {
        this.amount = amount;
    }

    public String getUnit() {
        return unit;
    }

    public void setUnit(String unit) {
        this.unit = unit;
    }

    public String getIngredientName() {
        return IngredientName;
    }

    public void setIngredientName(String ingredientName) {
        IngredientName = ingredientName;
    }
}
