<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .cart-container {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }
        
        .cart-items {
            flex: 1;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .item-image {
            width: 120px;
            height: 120px;
            overflow: hidden;
            border-radius: 8px;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .item-designer {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .item-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 8px;
        }
        
        .item-size, .item-category {
            font-size: 14px;
            color: #666;
            background-color: #f7f7f7;
            padding: 4px 8px;
            border-radius: 4px;
        }
        
        .item-price {
            display: flex;
            align-items: center;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 8px;
        }
        
        .discount-price {
            color: #ff5b79;
            font-weight: 700;
        }
        
        .item-quantity {
            margin: 0 20px;
        }
        
        .quantity-controls {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .quantity-btn {
            width: 32px;
            height: 32px;
            background-color: #f9f9f9;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .quantity-input {
            width: 40px;
            height: 32px;
            border: none;
            text-align: center;
            -moz-appearance: textfield;
        }
        
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .item-total {
            font-weight: 700;
            font-size: 18px;
            margin: 0 20px;
            min-width: 80px;
            text-align: right;
        }
        
        .item-actions {
            margin-left: 15px;
        }
        
        .remove-btn {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .remove-btn:hover {
            color: #ff5b79;
        }
        
        .cart-summary {
            width: 350px;
            flex-shrink: 0;
        }
        
        .summary-card {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 100px;
        }
        
        .summary-card h3 {
            font-size: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .summary-row.total {
            font-weight: 700;
            font-size: 18px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .summary-row.discount {
            color: #4CAF50;
        }
        
        .coupon-form {
            margin: 20px 0;
        }
        
        .coupon-form .form-group {
            display: flex;
        }
        
        .coupon-form input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
        }
        
        .coupon-form button {
            padding: 10px 15px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
        
        .checkout-actions {
            margin-top: 30px;
        }
        
        .checkout-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #ff5b79;
            color: white;
            border: none;
            border-radius: 4px;
            text-align: center;
            font-weight: 500;
            margin-bottom: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .checkout-btn:hover {
            background-color: #e04466;
        }
        
        .continue-shopping {
            display: block;
            text-align: center;
            color: #333;
            text-decoration: none;
        }
        
        .empty-cart {
            margin-top: 20px;
            text-align: center;
        }
        
        .clear-cart-btn {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
        }
        
        .empty-cart-message {
            text-align: center;
            padding: 50px 0;
        }
        
        .empty-cart-icon {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-cart-message h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .empty-cart-message p {
            color: #666;
            margin-bottom: 30px;
        }
        
        .btn-primary {
            display: inline-block;
            padding: 12px 25px;
            background-color: #ff5b79;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #e04466;
        }
        
        /* Toast notification styles */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #333;
            color: white;
            padding: 15px 25px;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.success {
            background-color: #4CAF50;
        }

        .toast.error {
            background-color: #F44336;
        }

        /* Loading spinner */
        .loading-spinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9998;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #ff5b79;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .cart-container {
                flex-direction: column;
            }
            
            .cart-summary {
                width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .cart-item {
                flex-wrap: wrap;
            }
            
            .item-image {
                width: 80px;
                height: 80px;
            }
            
            .item-quantity {
                order: 3;
                margin: 15px 0 0 140px;
            }
            
            .item-total {
                order: 4;
                margin: 15px 0 0 auto;
            }
            
            .item-actions {
                order: 5;
                margin: 15px 0 0 15px;
            }
        }
        
        @media (max-width: 480px) {
            .item-quantity {
                margin-left: 0;
            }
        }

        /* Additional styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .page-title {
            margin-bottom: 30px;
        }
        
        .page-title h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .page-title p {
            color: #666;
            font-size: 16px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-title">
            <h1>Shopping Cart</h1>
            <p>Review your items and proceed to checkout</p>
        </div>

        <!-- Success message would appear here -->
        <div class="alert alert-success" style="display: none;" id="successMessage"></div>

        <!-- Cart items section - this would be populated dynamically -->
        <div class="cart-container">
            <div class="cart-items">
                <!-- Example cart item - in a real app these would be generated from your data -->
                <div class="cart-item" id="cart-item-1">
                    <div class="item-image">
                        <img src="/api/placeholder/120/120" alt="Product Name">
                    </div>
                    <div class="item-details">
                        <h3 class="item-name">Product Name</h3>
                        <p class="item-designer">By Designer Name</p>
                        <div class="item-meta">
                            <span class="item-size">Size: M</span>
                            <span class="item-category">Category Name</span>
                        </div>
                        <div class="item-price">
                            <span class="original-price">$99.99</span>
                            <span class="discount-price">$79.99</span>
                        </div>
                    </div>
                    <div class="item-quantity">
                        <form action="/cart/update/1" method="POST" class="quantity-form">
                            <input type="hidden" name="_token" value="csrf_token_placeholder">
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn minus" onclick="decrementQuantity(this)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="10" class="quantity-input">
                                <button type="button" class="quantity-btn plus" onclick="incrementQuantity(this)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="item-total">
                        $<span class="item-total-value">79.99</span>
                    </div>
                    <div class="item-actions">
                        <form action="/cart/remove/1" method="POST" class="remove-form">
                            <input type="hidden" name="_token" value="csrf_token_placeholder">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="remove-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="cart-summary">
                <div class="summary-card">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="cart-subtotal">$79.99</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Calculated at checkout</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="cart-total">$79.99</span>
                    </div>
                    
                    <div class="coupon-form">
                        <form action="/coupon/apply" method="POST">
                            <input type="hidden" name="_token" value="csrf_token_placeholder">
                            <div class="form-group">
                                <input type="text" name="coupon_code" placeholder="Promo code" class="form-control">
                                <button type="submit">Apply</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="checkout-actions">
                        <a href="/checkout" class="checkout-btn">Proceed to Checkout</a>
                        <a href="/products" class="continue-shopping">Continue Shopping</a>
                    </div>
                    
                    <div class="empty-cart">
                        <form action="/cart/clear" method="POST" id="clear-cart-form">
                            <input type="hidden" name="_token" value="csrf_token_placeholder">
                            <button type="submit" class="clear-cart-btn">Clear Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toastNotification"></div>

    <script>
        // Function to show toast notification
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toastNotification');
            toast.textContent = message;
            toast.className = `toast show ${type}`;
            
            setTimeout(() => {
                toast.className = 'toast';
            }, 3000);
        }

        // Function to show loading spinner
        function showLoading(show) {
            const spinner = document.getElementById('loadingSpinner');
            spinner.className = show ? 'loading-spinner active' : 'loading-spinner';
        }
        
        // Increment quantity
        function incrementQuantity(button) {
            const input = button.parentElement.querySelector('.quantity-input');
            const newValue = parseInt(input.value) + 1;
            if (newValue <= parseInt(input.max)) {
                input.value = newValue;
                updateCart(button.closest('.quantity-form'));
            }
        }
        
        // Decrement quantity
        function decrementQuantity(button) {
            const input = button.parentElement.querySelector('.quantity-input');
            const newValue = parseInt(input.value) - 1;
            if (newValue >= parseInt(input.min)) {
                input.value = newValue;
                updateCart(button.closest('.quantity-form'));
            }
        }
        
        // Update cart quantity
        function updateCart(form) {
            const formData = new FormData(form);
            const cartItemId = form.closest('.cart-item').id.replace('cart-item-', '');
            
            showLoading(true);
            
            fetch(`/cart/update/${cartItemId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                showLoading(false);
                
                if (data.status === 'success') {
                    // Update item total
                    const itemTotalElement = form.closest('.cart-item').querySelector('.item-total-value');
                    itemTotalElement.textContent = data.itemTotal;
                    
                    // Update cart totals
                    document.querySelector('.cart-subtotal').textContent = '$' + data.cartTotal;
                    document.querySelector('.cart-total').textContent = '$' + data.cartTotal;
                    
                    // Update cart count in header
                    const cartCount = document.getElementById('cartCount');
                    if (cartCount) {
                        cartCount.textContent = data.cartCount;
                    }
                    
                    showToast('Cart updated successfully');
                } else {
                    showToast(data.message || 'An error occurred', 'error');
                }
            })
            .catch(error => {
                showLoading(false);
                showToast('An error occurred. Please try again.', 'error');
                console.error('Error:', error);
            });
        }
        
        // Delete item from cart
        document.addEventListener('DOMContentLoaded', function() {
            const removeForms = document.querySelectorAll('.remove-form');
            
            removeForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    if (confirm('Are you sure you want to remove this item from your cart?')) {
                        const cartItem = this.closest('.cart-item');
                        
                        showLoading(true);
                        
                        fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: new FormData(this)
                        })
                        .then(response => response.json())
                        .then(data => {
                            showLoading(false);
                            
                            if (data.status === 'success') {
                                // Remove item from DOM
                                cartItem.remove();
                                
                                // Update cart totals
                                document.querySelector('.cart-subtotal').textContent = '$' + data.cartTotal;
                                document.querySelector('.cart-total').textContent = '$' + data.cartTotal;
                                
                                // Update cart count in header
                                const cartCount = document.getElementById('cartCount');
                                if (cartCount) {
                                    if (data.cartCount > 0) {
                                        cartCount.textContent = data.cartCount;
                                    } else {
                                        cartCount.textContent = '';
                                        // Reload to show empty cart message
                                        window.location.reload();
                                    }
                                }
                                
                                showToast('Item removed from cart');
                            } else {
                                showToast(data.message || 'An error occurred', 'error');
                            }
                        })
                        .catch(error => {
                            showLoading(false);
                            showToast('An error occurred. Please try again.', 'error');
                            console.error('Error:', error);
                        });
                    }
                });
            });
            
            // Clear cart
            const clearCartForm = document.getElementById('clear-cart-form');
            if (clearCartForm) {
                clearCartForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    if (confirm('Are you sure you want to clear your cart? This will remove all items.')) {
                        showLoading(true);
                        
                        fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'},
                            body: new FormData(this)
                        })
                        .then(response => response.json())
                        .then(data => {
                            showLoading(false);
                            
                            if (data.status === 'success') {
                                showToast('Cart cleared successfully');
                                
                                // Update cart count in header
                                const cartCount = document.getElementById('cartCount');
                                if (cartCount) {
                                    cartCount.textContent = '';
                                }
                                
                                // Reload page to show empty cart message
                                window.location.reload();
                            } else {
                                showToast(data.message || 'An error occurred', 'error');
                            }
                        })
                        .catch(error => {
                            showLoading(false);
                            showToast('An error occurred. Please try again.', 'error');
                            console.error('Error:', error);
                        });
                    }
                });
            }
            
            // Apply coupon
            const couponForm = document.querySelector('.coupon-form form');
            if (couponForm) {
                couponForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    
                    showLoading(true);
                    
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        showLoading(false);
                        
                        if (data.status === 'success') {
                            showToast('Coupon applied successfully');
                            // Reload page to update totals with coupon
                            window.location.reload();
                        } else {
                            showToast(data.message || 'Invalid coupon code', 'error');
                        }
                    })
                    .catch(error => {
                        showLoading(false);
                        showToast('An error occurred. Please try again.', 'error');
                        console.error('Error:', error);
                    });
                });
            }

            // Display success message if URL has success parameter
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                const successMessage = document.getElementById('successMessage');
                successMessage.textContent = urlParams.get('success');
                successMessage.style.display = 'block';
            }
        });
    </script>
</body>
</html>