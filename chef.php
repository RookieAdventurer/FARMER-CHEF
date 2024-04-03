
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Chef</title>
</head>
<body>
    <h2>Add Chef</h2>
    <input type="text" id="chefName" placeholder="Enter Chef Name">
    <button id="addChefBtn">Add Chef</button>

    <script>
        document.getElementById("addChefBtn").addEventListener("click", function() {
            var chefName = document.getElementById("chefName").value;
            
            // Create a JSON object with the chef name
            var data = { "name": chefName };

            // Send an AJAX request to the PHP script
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/API_LAB/add_a_chef.php", true);
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