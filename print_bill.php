<?php
include 'connection.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid Bill ID");
}

$stmt = $con->prepare("SELECT * FROM billing_history WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bill = $result->fetch_assoc();
$stmt->close();

if (!$bill) {
    die("Bill not found.");
}

$items = json_decode($bill['items_json'], true);
$dateObj = new DateTime($bill['date']);
$formattedDate = $dateObj->format('d-m-Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo htmlspecialchars($bill['id']); ?></title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7f6;
            display: flex;
            justify-content: center;
        }
        .invoice-box {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            padding: 0;
            box-sizing: border-box;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 40px 0;
            color: #333;
            overflow: hidden;
        }
        .invoice-header-bg {
            background: linear-gradient(135deg, rgb(17, 84, 146), rgb(43, 136, 216));
            color: white;
            padding: 40px 40px 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .invoice-title {
            font-size: 36px;
            font-weight: 900;
            letter-spacing: 2px;
            margin: 0;
            text-transform: uppercase;
        }
        .invoice-subtitle {
            font-size: 15px;
            opacity: 0.95;
            margin-top: 8px;
            letter-spacing: 0.5px;
        }
        .invoice-meta {
            text-align: right;
        }
        .invoice-meta div {
            margin-bottom: 8px;
            font-size: 16px;
        }
        .invoice-body {
            padding: 40px;
        }
        .customer-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            background: #f8f9fa;
            padding: 25px;
            border-left: 6px solid rgb(17, 84, 146);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .customer-info h3 {
            margin: 0 0 12px 0;
            color: rgb(17, 84, 146);
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .customer-details div {
            margin-bottom: 8px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            padding: 16px 12px;
            font-size: 15px;
            border-bottom: 1px solid #eaeaea;
        }
        th {
            background-color: rgba(17, 84, 146, 0.06);
            color: rgb(17, 84, 146);
            font-weight: 800;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }
        tbody tr:last-child td {
            border-bottom: 2px solid rgb(17, 84, 146);
        }
        .summary-box {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 20px;
        }
        .thank-you {
            color: #666;
            font-size: 14px;
            font-style: italic;
            line-height: 1.6;
        }
        .totals {
            width: 320px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            font-size: 16px;
            border-bottom: 1px solid #eaeaea;
        }
        .total-row.grand-total {
            font-size: 22px;
            font-weight: 900;
            color: rgb(17, 84, 146);
            border-bottom: none;
            background: rgba(17, 84, 146, 0.08);
            padding: 18px 15px;
            border-radius: 6px;
            margin-top: 15px;
        }
        @media print {
            body {
                background: white;
                margin: 0;
            }
            .invoice-box {
                margin: 0;
                box-shadow: none;
                width: 100%;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header-bg">
        <div>
            <h1 class="invoice-title">Tax Invoice</h1>
            <div class="invoice-subtitle"><b>KHALIQUE MEDICAL HALL, AURAI</b></div>
            <div class="invoice-subtitle">Near Aurai Block, Aurai, Muz. +91-9939192097</div>
        </div>
        <div class="invoice-meta">
            <div>Invoice No: <b>#<?php echo str_pad($bill['id'], 4, '0', STR_PAD_LEFT); ?></b></div>
            <div>Date: <b><?php echo $formattedDate; ?></b></div>
        </div>
    </div>

    <div class="invoice-body">
        <div class="customer-info">
            <div class="customer-details">
                <h3>Billed To</h3>
                <div>Name: <b><?php echo htmlspecialchars($bill['customer_name']); ?></b></div>
                <div>Mob. No: <b><?php echo htmlspecialchars($bill['mobile_no']); ?></b></div>
            </div>
            <div class="customer-details" style="text-align: right;">
                <h3>Payment Status</h3>
                <div style="color: #28a745; font-weight: 900; font-size: 24px; letter-spacing: 2px;">PAID</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="text-align: center; width: 8%;">#</th>
                    <th style="text-align: left; width: 45%;">Item Description</th>
                    <th style="text-align: center; width: 12%;">Qty</th>
                    <th style="text-align: right; width: 15%;">Rate</th>
                    <th style="text-align: right; width: 20%;">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                foreach($items as $item): 
                    $amt = $item['quantity'] * $item['price'];
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td style="text-align: center;"><?php echo $item['quantity']; ?></td>
                    <td style="text-align: right;">₹<?php echo number_format($item['price'], 2); ?></td>
                    <td style="text-align: right; font-weight: bold;">₹<?php echo number_format($amt, 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="summary-box">
            <div class="thank-you">
                <p><b>Thank you for shopping with us!</b></p>
                <p>Goods once sold cannot be returned or exchanged.</p>
                <p>For any queries, please contact us at the number above.</p>
            </div>
            <div class="totals">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>₹<?php echo number_format($bill['total_amount'], 2); ?></span>
                </div>
                <div class="total-row">
                    <span>Discount:</span>
                    <span>0%</span>
                </div>
                <div class="total-row grand-total">
                    <span>Grand Total:</span>
                    <span>₹<?php echo number_format($bill['total_amount'], 2); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Automatically trigger print dialog when page loads
    window.onload = function() {
        window.print();
    };
</script>

</body>
</html>
