<?php
$dsn = 'mysql:host=localhost;dbname=chefnfarmer';
$username = 'root';
$password = ')))222jaeDaa;';

try {
    // Create a PDO instance
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if the chef_id is provided in the query string
    if(isset($_GET['chef_id'])) {
        $chef_id = $_GET['chef_id'];

        // Retrieve chef data from the database
        $stmt = $db->prepare("SELECT * FROM chefs WHERE id = ?");
        $stmt->execute([$chef_id]);
        $chef = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if chef exists
        if($chef) {
            // Return chef data as JSON response
            header('Content-Type: application/json');
            echo json_encode($chef);
        } else {
            // Chef with the given ID not found
            echo "Error: Chef with ID $chef_id not found";
        }
    } else {
        // Error: chef_id parameter is missing
        echo "Error: chef_id parameter is missing in the request";
    }
} catch (PDOException $e) {
    // Database error
    echo 'Error: ' . $e->getMessage();
}
?>
