<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Farmer</title>
</head>
<body>
    <h2>Add Farmer</h2>
    <input type="text" id="farmerName" placeholder="Enter Farmer Name">
    <button id="addFarmerBtn">Add Farmer</button>

    <script>
        document.getElementById("addFarmerBtn").addEventListener("click", function() {
            var farmerName = document.getElementById("farmerName").value;
            
            // Create a JSON object with the farmer name
            var data = { "name": farmerName };

            // Send an AJAX request to the PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/API_LAB/add_a_farmer.php", true);
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
