<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/med_man2.png" />
    <title>Billing Portal</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        <?php include "styles/style.css" ?>
        
        .billing-container {
            display: flex;
            gap: 20px;
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .billing-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
            padding: 25px;
            box-sizing: border-box;
        }

        .left-panel {
            flex: 1;
            min-width: 400px;
        }

        .right-panel {
            flex: 1.5;
            display: flex;
            flex-direction: column;
        }

        .section-title {
            color: var(--blue);
            font-family: 'DotGothic16', sans-serif, monospace;
            text-transform: uppercase;
            border-bottom: 2px solid var(--blue);
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            color: #333;
        }

        .cart-table th {
            background-color: var(--blue);
            color: white;
            font-family: 'DotGothic16', sans-serif, monospace;
        }

        .total-box {
            text-align: right;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--blue);
            margin: 20px 0;
        }

        .remove-btn {
            background: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        #suggestion-box {
            position: absolute;
            background: white;
            width: calc(100% - 30px);
            max-height: 200px;
            overflow-y: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 10;
            border: 1px solid #ccc;
            display: none;
        }
        
        #suggestion-box ul {
            margin: 0;
            padding: 0;
        }

        #suggestion-box li {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        #suggestion-box li:hover {
            background: #f0f8ff;
        }

        .relative {
            position: relative;
        }

        .generate-btn {
            background: #28a745;
            width: 100%;
            justify-content: center;
        }
    </style>
</head>

<body>
    <section class="main">
        <?php include 'navbar.php' ?>
        
        <div class="billing-container">
            <!-- Left Panel: Add Items -->
            <div class="billing-panel left-panel">
                <h2 class="section-title">Customer Details</h2>
                <div class="form-group mb-3">
                    <label>Customer Name</label>
                    <input type="text" id="cust_name" placeholder="Walk-in Customer">
                </div>
                <div class="form-group mb-3">
                    <label>Mobile Number</label>
                    <input type="text" id="cust_mobile" placeholder="Enter Mobile No">
                </div>
                <div class="form-group mb-4">
                    <label>Address</label>
                    <input type="text" id="cust_address" placeholder="Enter Address">
                </div>

                <h2 class="section-title">Add Medicine</h2>
                <div class="form-group relative mb-3">
                    <label>Search Medicine</label>
                    <input type="text" id="enter-med" autocomplete="off" placeholder="Type to search...">
                    <div id="suggestion-box"></div>
                </div>
                
                <input type="hidden" id="med_id">
                <input type="hidden" id="med_stock">
                <input type="hidden" id="med_price">

                <div class="form-grid">
                    <div class="form-group">
                        <label>Price (Rs)</label>
                        <input type="number" id="disp_price" readonly disabled>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" id="med_qty" min="1" value="1">
                        <small id="stock_info" style="color:red; margin-top:5px;"></small>
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <button class="premium-btn" onclick="addToCart()" style="width: 100%; justify-content: center;">
                        <img src="img/add.svg" alt="">
                        <span>Add To Cart</span>
                    </button>
                </div>
            </div>

            <!-- Right Panel: Cart & Checkout -->
            <div class="billing-panel right-panel">
                <h2 class="section-title">Current Bill</h2>
                <div style="flex:1; overflow-y:auto;">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Medicine</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="cart_body">
                            <!-- Items go here -->
                        </tbody>
                    </table>
                </div>

                <div class="total-box">
                    Grand Total: Rs. <span id="grand_total">0.00</span>
                </div>

                <button class="premium-btn generate-btn" onclick="generateBill()">
                    <span>Generate Bill & Download PDF</span>
                </button>
            </div>
        </div>
    </section>



    <script>
    let cart = [];
    let grandTotal = 0;
    let currentFocus = -1;

    // Search Autocomplete
    $(document).ready(function(){
        $("#enter-med").keyup(function(e){
            // Ignore arrow keys and enter for the AJAX request
            if(e.keyCode === 38 || e.keyCode === 40 || e.keyCode === 13) return;
            
            let keyword = $(this).val();
            if(keyword.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "rm-live-search.php",
                    data: 'keyword=' + keyword,
                    success: function(data){
                        $("#suggestion-box").show();
                        $("#suggestion-box").html(data);
                        currentFocus = -1; // reset focus
                    }
                });
            } else {
                $("#suggestion-box").hide();
                currentFocus = -1;
            }
        });

        // Keyboard Navigation
        // Enter to move between fields
        $("#cust_name").keydown(function(e) {
            if(e.keyCode === 13) { e.preventDefault(); $("#cust_mobile").focus(); }
        });
        $("#cust_mobile").keydown(function(e) {
            if(e.keyCode === 13) { e.preventDefault(); $("#cust_address").focus(); }
        });
        $("#cust_address").keydown(function(e) {
            if(e.keyCode === 13) { e.preventDefault(); $("#enter-med").focus(); }
        });
        $("#med_qty").keydown(function(e) {
            if(e.keyCode === 13) { 
                e.preventDefault(); 
                addToCart(); 
                // Focus goes back to search automatically inside addToCart
            }
        });

        // Arrow keys for medicine search
        $("#enter-med").keydown(function(e) {
            let items = $("#suggestion-box .suggestion-item");
            if (e.keyCode === 40) { // Arrow Down
                e.preventDefault();
                currentFocus++;
                addActive(items);
            } else if (e.keyCode === 38) { // Arrow Up
                e.preventDefault();
                currentFocus--;
                addActive(items);
            } else if (e.keyCode === 13) { // Enter
                e.preventDefault();
                if (currentFocus > -1) {
                    if (items.length > 0) items[currentFocus].click();
                } else if ($("#suggestion-box").is(":visible") && items.length > 0) {
                    // Select first item if none is focused but list is open
                    items[0].click();
                } else if ($("#med_id").val() !== "") {
                    // Already selected something, jump to quantity
                    $("#med_qty").focus();
                }
            }
        });
    });

    function addActive(items) {
        if (!items || items.length === 0) return false;
        removeActive(items);
        if (currentFocus >= items.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (items.length - 1);
        $(items[currentFocus]).addClass("suggestion-active");
        
        // Ensure visible in scrollbox
        let parent = $("#suggestion-box");
        let activeEl = items[currentFocus];
        parent.scrollTop(activeEl.offsetTop - parent.height()/2);
    }

    function removeActive(items) {
        items.removeClass("suggestion-active");
    }

    // Handle Selection from Search
    function selectmedicine(id, name, price, stock) {
        $("#med_id").val(id);
        $("#enter-med").val(name);
        $("#med_price").val(price);
        $("#disp_price").val(price);
        $("#med_stock").val(stock);
        $("#stock_info").text("Stock available: " + stock);
        $("#med_qty").val(1).attr('max', stock);
        $("#suggestion-box").hide();
        $("#med_qty").focus(); // Automatically jump to quantity field
    }

    // Add Item to Cart
    function addToCart() {
        let id = $("#med_id").val();
        let name = $("#enter-med").val();
        let price = parseFloat($("#med_price").val());
        let qty = parseInt($("#med_qty").val());
        let stock = parseInt($("#med_stock").val());

        if(!id || !name) {
            alert("Please select a medicine.");
            return;
        }

        if(qty > stock) {
            alert("Quantity exceeds available stock (" + stock + ")!");
            return;
        }
        if(qty <= 0 || isNaN(qty)) {
            alert("Please enter a valid quantity.");
            return;
        }

        // Check if item already in cart
        let existing = cart.find(i => i.id === id);
        if(existing) {
            if(existing.quantity + qty > stock) {
                alert("Cannot add more. Exceeds stock.");
                return;
            }
            existing.quantity += qty;
        } else {
            cart.push({ id, name, price, quantity: qty });
        }

        // Clear inputs
        $("#med_id, #enter-med, #med_price, #disp_price, #med_stock").val('');
        $("#med_qty").val(1);
        $("#stock_info").text('');

        renderCart();
        $("#enter-med").focus();
    }

    function renderCart() {
        let html = '';
        grandTotal = 0;

        cart.forEach((item, index) => {
            let total = item.price * item.quantity;
            grandTotal += total;
            html += `
                <tr>
                    <td>${item.name}</td>
                    <td>Rs. ${item.price.toFixed(2)}</td>
                    <td>${item.quantity}</td>
                    <td>Rs. ${total.toFixed(2)}</td>
                    <td><button class="remove-btn" onclick="removeFromCart(${index})">X</button></td>
                </tr>
            `;
        });

        $("#cart_body").html(html);
        $("#grand_total").text(grandTotal.toFixed(2));
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        renderCart();
    }

    function generateBill() {
        if(cart.length === 0) {
            alert("Cart is empty!");
            return;
        }

        let customer_name = $("#cust_name").val() || "Walk-in Customer";
        let mobile_no = $("#cust_mobile").val();
        let address = $("#cust_address").val() || "-";

        // 1. Send data to server to process transaction
        $.ajax({
            url: 'process_billing.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                customer_name: customer_name,
                mobile_no: mobile_no,
                cart: cart,
                total_amount: grandTotal
            }),
            success: function(response) {
                let res = JSON.parse(response);
                if(res.success) {
                    // Open native printing tab with the invoice
                    window.open('print_bill.php?id=' + res.bill_id, '_blank');
                    
                    // Clear cart after successful checkout
                    cart = [];
                    renderCart();
                    $("#cust_name, #cust_mobile, #cust_address").val('');
                    currentFocus = -1;

                } else {
                    alert("Error: " + res.message);
                }
            },
            error: function() {
                alert("Failed to connect to server.");
            }
        });
    }
    </script>
</body>
</html>
