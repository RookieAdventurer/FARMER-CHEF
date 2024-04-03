<?php
$dsn = 'mysql:host=localhost;dbname=chefnfarmer';
$username = 'root';
$password = ')))222jaeDaa;';

try {
    // Create a PDO instance
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if the farmer_id is provided in the query string
    if(isset($_GET['farmer_id'])) {
        $farmer_id = $_GET['farmer_id'];

        // Retrieve farmer data from the database
        $stmt = $db->prepare("SELECT * FROM farmers WHERE id = ?");
        $stmt->execute([$farmer_id]);
        $farmer = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if farmer exists
        if($farmer) {
            // Return farmer data as JSON response
            header('Content-Type: application/json');
            echo json_encode($farmer);
        } else {
            // Farmer with the given ID not found
            echo "Error: Farmer with ID $farmer_id not found";
        }
    } else {
        // Error: farmer_id parameter is missing
        echo "Error: farmer_id parameter is missing in the request";
    }
} catch (PDOException $e) {
    // Database error
    echo 'Error: ' . $e->getMessage();
}
?>
