<img class="bg_image" src="assets/bg_image.jpg" alt="background image" />

<?php
include './header.php';
include './conn.php';
include './components/navbar.component.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Enter Names</title>
	<style type="text/css">
	p, input{
		display: inline-block;
	}
	#output{
		width: 100px;
		height: 30px;
		border: 1px solid black;
		margin: 1px;
		font-size: 20px;
		text-align: center;
		display: block;
	}
	.btn{
		background-color: black;
		color: white;
		border: none;
		height: 30px;

	}
    .add_div{
        box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;
        border-radius: 4px;
        background-color: rgba(245, 245, 245, 0.875);
        width: 40%;
        margin-top: 20px;
        padding:20px;
        text-align: justify;
    }

	</style>
	<script type="text/javascript">
		function addName() {
			let newName = document.createElement("li");

			let name = document.getElementById("name");
            let date = document.getElementById("date"); 
            let amount = document.getElementById("amount"); 
            let type = document.getElementById("type"); 

			newName.innerHTML = name.value;
			
            let newValue = newName + ' ' + amount.value;

            let list = document.getElementById("list");
			list.appendChild(newValue);  
            
            name.value = "";
            date.value = "";
		}

	</script>
</head>
<body>
    <div class="add_div">
        <p>Enter ingredient:</p>
        <input type="text" id="name"><br>
        <p>Enter exparation date:</p>
        <input type="text" id="date"><br>
        <p>Enter amount:</p>
        <input type="text" id="amount">
        <select name="type" id="type">
            <option value="kg">kg</option>
            <option value="l">l</option>
            <option value="whole">whole</option>
            <option value="clove">clove</option>
        </select>
        <br>

        <ul id="list">
            <li>Pasta 0.2kg</li>
            <li>Tomato sauce 1l</li>
        </ul>
        <button class="btn" onclick="addName()">Add Ingridient</button>
    </div>
</body>
</html>