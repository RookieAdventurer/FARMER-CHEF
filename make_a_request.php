<?php
$dsn = 'mysql:host=localhost;dbname=chefnfarmer';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get JSON data from request body
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Check if required fields are present in the request body
    if (isset($data->chef_id, $data->ingredient, $data->quantity)) {
        $chef_id = $data->chef_id;
        $ingredient = $data->ingredient;
        $quantity = $data->quantity;

        // Submit a request
        $stmt = $db->prepare("INSERT INTO requests (chef_id, ingredient, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$chef_id, $ingredient, $quantity]);
        
        echo "Request submitted successfully";
    } else {
        // Handle case where required fields are missing
        echo "Error: One or more required fields (chef_id, ingredient, quantity) are missing in the request body";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
