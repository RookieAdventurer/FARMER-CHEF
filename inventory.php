<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
</head>
<body>
    <h2>Manage Inventory</h2>
    <input type="number" id="farmerId" placeholder="Enter Farmer ID">
    <input type="text" id="inventoryIngredient" placeholder="Enter Inventory Ingredient">
    <input type="number" id="inventoryQuantity" placeholder="Enter Inventory Quantity">
    <button id="manageInventoryBtn">Manage Inventory</button>

    <script>
        document.getElementById("manageInventoryBtn").addEventListener("click", function() {
            var farmerId = document.getElementById("farmerId").value;
            var inventoryIngredient = document.getElementById("inventoryIngredient").value;
            var inventoryQuantity = document.getElementById("inventoryQuantity").value;
            
            // Create a JSON object with the inventory data
            var data = { "farmer_id": farmerId, "ingredient": inventoryIngredient, "quantity": inventoryQuantity };

            // Send an AJAX request to the PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/API_LAB/manage_inventory.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request successful, display response
                        alert(xhr.responseText);
                    } else {
                        // Request failed, display error message
                        alert("Error: " + xhr.responseText);
                    }
                }
            };
            xhr.send(JSON.stringify(data));
        });
    </script>
</body>
</html>
