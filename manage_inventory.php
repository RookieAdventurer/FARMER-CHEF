<?php
$dsn = 'mysql:host=localhost;dbname=chefnfarmer';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Check if required fields are present in the request body
    if (isset($data->farmer_id, $data->ingredient, $data->quantity)) {
        $farmer_id = $data->farmer_id;
        $ingredient = $data->ingredient;
        $quantity = $data->quantity;

        // Check if the farmer_id exists in the farmers table
        $stmt = $db->prepare("SELECT id FROM farmers WHERE id = ?");
        $stmt->execute([$farmer_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            echo "Error: Farmer with id $farmer_id does not exist.";
            exit;
        }

        // Manage inventory
        $stmt = $db->prepare("INSERT INTO inventory (farmer_id, ingredient, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$farmer_id, $ingredient, $quantity]);

        echo "Inventory managed successfully";
    } else {
        // Handle case where required fields are missing
        echo "Error: One or more required fields (farmer_id, ingredient, quantity) are missing in the request body";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
