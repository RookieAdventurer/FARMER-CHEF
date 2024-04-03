<?php
$dsn = 'mysql:host=localhost;dbname=chefnfarmer';
$username = 'root';
$password = 'SsmM!oVImz5o';

try {
    // Create a PDO instance
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get JSON data from request body
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Check if 'name' field exists in the request body
    if (isset($data->name)) {
        $name = $data->name;

        // Add a chef
        $stmt = $db->prepare("INSERT INTO chefs (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        
        echo "Chef added successfully";
    } else {
        // Handle case where 'name' field is missing
        echo "Error: 'name' field is missing in the request body";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
