<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Request</title>
</head>
<body>
    <h2>Make a Request</h2>
    <input type="number" id="chefId" placeholder="Enter Chef ID">
    <input type="text" id="ingredient" placeholder="Enter Ingredient">
    <input type="number" id="quantity" placeholder="Enter Quantity">
    <input type="text" id="status" placeholder="Enter Status (optional)">
    <button id="makeRequestBtn">Make Request</button>

    <script>
        document.getElementById("makeRequestBtn").addEventListener("click", function() {
            var chefId = document.getElementById("chefId").value;
            var ingredient = document.getElementById("ingredient").value;
            var quantity = document.getElementById("quantity").value;
            var status = document.getElementById("status").value;
            
            // Create a JSON object with the request data
            var data = {
                "chef_id": chefId,
                "ingredient": ingredient,
                "quantity": quantity,
                "status": status
            };

            // Send an AJAX request to the PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/API_LAB/make_a_request.php", true);
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
