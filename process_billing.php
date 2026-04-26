<?php
include 'connection.php';

// Ensure billing_history table exists
$tableCheckQuery = "CREATE TABLE IF NOT EXISTS billing_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    mobile_no VARCHAR(20),
    total_amount DECIMAL(10,2) NOT NULL,
    items_json TEXT NOT NULL,
    date DATE NOT NULL,
    time VARCHAR(20) NOT NULL
)";
mysqli_query($con, $tableCheckQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if(!$data || !isset($data['cart']) || empty($data['cart'])) {
        echo json_encode(['success' => false, 'message' => 'Cart is empty.']);
        exit;
    }

    $customer_name = $data['customer_name'] ?? 'Walk-in Customer';
    $mobile_no = $data['mobile_no'] ?? '';
    $cart = $data['cart'];
    $total_amount = $data['total_amount'];
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $time = date('h:i A');
    
    // Start transaction
    mysqli_begin_transaction($con);
    
    try {
        foreach($cart as $item) {
            $id = $item['id'];
            $sell_qty = $item['quantity'];
            
            // Deduct stock
            $stmt = $con->prepare("UPDATE add_med SET total_quantity = total_quantity - ? WHERE `s.no` = ? AND total_quantity >= ?");
            $stmt->bind_param("iii", $sell_qty, $id, $sell_qty);
            $stmt->execute();
            
            if ($stmt->affected_rows === 0) {
                throw new Exception("Insufficient stock for item: " . $item['name']);
            }
            $stmt->close();
        }
        
        // Save billing history
        $items_json = json_encode($cart);
        $stmt2 = $con->prepare("INSERT INTO billing_history (customer_name, mobile_no, total_amount, items_json, date, time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssdsss", $customer_name, $mobile_no, $total_amount, $items_json, $date, $time);
        $stmt2->execute();
        $bill_id = $stmt2->insert_id;
        $stmt2->close();
        
        mysqli_commit($con);
        
        echo json_encode(['success' => true, 'message' => 'Bill generated successfully!', 'bill_id' => $bill_id]);
    } catch (Exception $e) {
        mysqli_rollback($con);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
