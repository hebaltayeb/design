<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
        }
        
        .page-title {
            margin-bottom: 30px;
            text-align: left;
        }
        
        .page-title h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #333;
        }
        
        .page-title p {
            color: #666;
            font-size: 16px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: left;
        }
        
        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        
        .cart-container {
            display: flex;
            gap: 30px;
            margin-top: 30px;
            flex-direction: row;
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
            flex-direction: row;
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
            text-align: left;
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
            justify-content: flex-start;
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
            margin-bottom: 8px;
            justify-content: flex-start;
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
            width: 36px;
            height: 36px;
            background-color: #f9f9f9;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        
        .quantity-btn:hover {
            background-color: #efefef;
        }
        
        .quantity-input {
            width: 50px;
            height: 36px;
            border: none;
            text-align: center;
            -moz-appearance: textfield;
            font-size: 16px;
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
            width: 36px;
            height: 36px;
            background: none;
            border: 1px solid #eee;
            border-radius: 50%;
            color: #999;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .remove-btn:hover {
            color: #ff5b79;
            border-color: #ff5b79;
            background-color: #fff0f3;
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
            text-align: left;
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
            flex-direction: row;
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
            cursor: pointer;
            font-size: 16px;
        }
        
        .checkout-btn:hover {
            background-color: #e04466;
        }
        
        .continue-shopping {
            display: block;
            text-align: center;
            color: #333;
            text-decoration: none;
            padding: 10px;
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
            font-size: 14px;
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
        
        /* Checkout form styles */
        .checkout-form {
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
            display: none;
        }
        
        .checkout-form h3 {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
            font-size: 16px;
        }
        
        .form-control:focus {
            border-color: #ff5b79;
            outline: none;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .btn-submit {
            background-color: #ff5b79;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 15px 25px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-submit:hover {
            background-color: #e04466;
        }
        
        .btn-cancel {
            background-color: #f2f2f2;
            color: #333;
            border: none;
            border-radius: 4px;
            padding: 15px 25px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
        }
        
        .btn-cancel:hover {
            background-color: #e6e6e6;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
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
                margin: 15px 0 0 0;
            }
            
            .item-total {
                order: 4;
                margin: 15px 0 0 auto;
            }
            
            .item-actions {
                order: 5;
                margin: 15px 0 0 15px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-title">
            <h1>Shopping Cart</h1>
            <p>Review your items and proceed to checkout</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="alert alert-success" id="successAlert" style="display: none;"></div>

        <div class="cart-container">
            <div class="cart-items" id="cartItemsContainer">
                @if(count($products) > 0)
                    @foreach($products as $item)
                        @php
                            $designerName = is_object($item['product']->designer) ? $item['product']->designer->name : $item['product']->designer;
                            $categoryName = is_object($item['product']->category) ? $item['product']->category->name : $item['product']->category;
                            $hasDiscount = $item['product']->hasDiscount();
                            $priceToShow = $hasDiscount ? $item['product']->discounted_price : $item['product']->price;
                        @endphp
                        <div class="cart-item" id="cart-item-{{ $item['product']->id }}-{{ $item['size'] }}">
                            <div class="item-image">
                                <img src="{{ $item['product']->image ? asset('storage/'.$item['product']->image) : '/api/placeholder/120/120' }}" alt="{{ $item['product']->name }}">
                            </div>
                            <div class="item-details">
                                <h3 class="item-name">{{ $item['product']->name }}</h3>
                                <p class="item-designer">By {{ $designerName }}</p>
                                <div class="item-meta">
                                    <span class="item-category">{{ $categoryName }}</span>
                                    <span class="item-size">Size: {{ $item['size'] }}</span>
                                </div>
                                <div class="item-price">
                                    @if($hasDiscount)
                                        <span class="discount-price">${{ number_format($priceToShow, 2) }}</span>
                                        <span class="original-price">${{ number_format($item['product']->price, 2) }}</span>
                                    @else
                                        ${{ number_format($priceToShow, 2) }}
                                    @endif
                                </div>
                            </div>
                            <div class="item-total">
                                $<span class="item-total-value">{{ number_format($priceToShow * $item['quantity'], 2) }}</span>
                            </div>
                            <div class="item-quantity">
                                <div class="quantity-controls">
                                    <button type="button" class="quantity-btn minus" onclick="decrementQuantity('{{ $item['product']->id }}-{{ $item['size'] }}')">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="10" class="quantity-input" data-item-id="{{ $item['product']->id }}-{{ $item['size'] }}" onchange="quantityChanged('{{ $item['product']->id }}-{{ $item['size'] }}')">
                                    <button type="button" class="quantity-btn plus" onclick="incrementQuantity('{{ $item['product']->id }}-{{ $item['size'] }}')">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="item-actions">
                                <button type="button" class="remove-btn" onclick="removeItem('{{ $item['product']->id }}-{{ $item['size'] }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-cart-message">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h2>Your Cart is Empty</h2>
                        <p>It looks like you haven't added any items to your cart yet.</p>
                        <a href="{{ route('products.index') }}" class="btn-primary">Start Shopping</a>
                    </div>
                @endif
            </div>

            @if(count($products) > 0)
            <div class="cart-summary" id="cartSummary">
                <div class="summary-card">
                    <h3>Cart Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span class="cart-subtotal">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    @if($discount > 0)
                        <div class="summary-row discount" id="discountRow">
                            <span>Discount</span>
                            <span class="discount-amount">-${{ number_format($discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="cart-total">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="checkout-actions">
                        <button id="checkoutButton" class="checkout-btn">Proceed to Checkout</button>
                        <a href="{{ route('products.index') }}" class="continue-shopping">Continue Shopping</a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Checkout Form -->
        <div class="checkout-form" id="checkoutForm">
            <h3>Complete Your Purchase</h3>
            <form id="paymentForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address</label>
                    <textarea id="address" class="form-control" rows="3" required></textarea>
                </div>
                <div style="text-align: left; margin-top: 20px;">
                    <button type="button" id="cancelCheckout" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-submit">Complete Purchase</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toastNotification"></div>

    <script>
        // DOM elements
        const cartItemsContainer = document.getElementById('cartItemsContainer');
        const cartSummary = document.getElementById('cartSummary');
        const checkoutForm = document.getElementById('checkoutForm');
        const checkoutButton = document.getElementById('checkoutButton');
        const cancelCheckoutButton = document.getElementById('cancelCheckout');
        const paymentForm = document.getElementById('paymentForm');
        const discountRow = document.getElementById('discountRow');
        const successAlert = document.getElementById('successAlert');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Show toast notification
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toastNotification');
            toast.textContent = message;
            toast.className = 'toast show ' + type;
            setTimeout(() => {
                toast.className = 'toast';
            }, 3000);
        }

        // Toggle loading spinner
        function showLoading(show) {
            const spinner = document.getElementById('loadingSpinner');
            spinner.style.display = show ? 'flex' : 'none';
        }
        
        // Quantity controls
        function incrementQuantity(itemId) {
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            const newValue = parseInt(input.value) + 1;
            
            if (newValue <= parseInt(input.max)) {
                input.value = newValue;
                updateItemQuantity(itemId, newValue);
            }
        }
        
        function decrementQuantity(itemId) {
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            const newValue = parseInt(input.value) - 1;
            
            if (newValue >= parseInt(input.min)) {
                input.value = newValue;
                updateItemQuantity(itemId, newValue);
            }
        }
        
        function quantityChanged(itemId) {
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            const newValue = parseInt(input.value);
            
            if (newValue >= parseInt(input.min) && newValue <= parseInt(input.max)) {
                updateItemQuantity(itemId, newValue);
            } else {
                // Reset to valid value
                const item = document.getElementById(`cart-item-${itemId}`);
                const currentValue = item.querySelector('.quantity-input').value;
                input.value = currentValue;
                showToast('Please enter a valid quantity between 1 and 10', 'error');
            }
        }
        
        // Update item quantity
        function updateItemQuantity(itemId, quantity) {
            showLoading(true);
            
            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    key: itemId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                showLoading(false);
                
                if (data.status === 'success') {
                    // Update item total in DOM
                    const itemTotalElement = document.querySelector(`#cart-item-${itemId} .item-total-value`);
                    itemTotalElement.textContent = parseFloat(data.itemTotal).toFixed(2);
                    
                    // Update cart totals
                    document.querySelector('.cart-subtotal').textContent = '$' + parseFloat(data.subtotal).toFixed(2);
                    document.querySelector('.cart-total').textContent = '$' + parseFloat(data.cartTotal).toFixed(2);
                    
                    // Update discount if exists
                    const discountElement = document.querySelector('.discount-amount');
                    if (data.discount > 0 && discountElement) {
                        discountElement.textContent = '-$' + parseFloat(data.discount).toFixed(2);
                        if (discountRow) discountRow.style.display = 'flex';
                    } else if (discountRow) {
                        discountRow.style.display = 'none';
                    }
                    
                    showToast('Cart updated successfully');
                } else {
                    showToast(data.message || 'Error updating cart', 'error');
                    // Reset to original value
                    const input = document.querySelector(`input[data-item-id="${itemId}"]`);
                    input.value = data.originalQuantity || quantity - 1;
                }
            })
            .catch(error => {
                showLoading(false);
                showToast('Error updating cart', 'error');
                console.error('Error:', error);
            });
        }
        
        // Remove item from cart
        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                showLoading(true);
                
                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        key: itemId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    showLoading(false);
                    
                    if (data.status === 'success') {
                        // Remove item from DOM
                        const cartItem = document.getElementById(`cart-item-${itemId}`);
                        cartItem.remove();
                        
                        // Update cart totals
                        document.querySelector('.cart-subtotal').textContent = '$' + parseFloat(data.subtotal).toFixed(2);
                        document.querySelector('.cart-total').textContent = '$' + parseFloat(data.cartTotal).toFixed(2);
                        
                        // Update discount if exists
                        const discountElement = document.querySelector('.discount-amount');
                        if (data.discount > 0 && discountElement) {
                            discountElement.textContent = '-$' + parseFloat(data.discount).toFixed(2);
                            if (discountRow) discountRow.style.display = 'flex';
                        } else if (discountRow) {
                            discountRow.style.display = 'none';
                        }
                        
                        // Check if cart is empty
                        if (data.cartCount === 0) {
                            showEmptyCart();
                        }
                        
                        showToast('Item removed from cart');
                    } else {
                        showToast(data.message || 'Error removing item', 'error');
                    }
                })
                .catch(error => {
                    showLoading(false);
                    showToast('Error removing item', 'error');
                    console.error('Error:', error);
                });
            }
        }
        
        // Show empty cart message
        function showEmptyCart() {
            const emptyCartMessage = document.createElement('div');
            emptyCartMessage.className = 'empty-cart-message';
            emptyCartMessage.innerHTML = `
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h2>Your Cart is Empty</h2>
                <p>It looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="btn-primary">Start Shopping</a>
            `;
            
            cartItemsContainer.innerHTML = '';
            cartItemsContainer.appendChild(emptyCartMessage);
            if (cartSummary) cartSummary.style.display = 'none';
        }
        
        // Show success message
        function showSuccessMessage(message) {
            successAlert.textContent = message;
            successAlert.style.display = 'block';
            
            // Hide after 5 seconds
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000);
        }
        
        // Checkout process
        function handleCheckout() {
            if (cartSummary) cartSummary.style.display = 'none';
            checkoutForm.style.display = 'block';
            
            // Scroll to checkout form
            checkoutForm.scrollIntoView({ behavior: 'smooth' });
        }
        
        function cancelCheckout() {
            if (cartSummary) cartSummary.style.display = 'block';
            checkoutForm.style.display = 'none';
        }
        
        function submitCheckout(event) {
            event.preventDefault();
            
            showLoading(true);
            
            // Collect form data
            const formData = {
                first_name: document.getElementById('firstName').value,
                last_name: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value
            };
            
            // API call for payment processing
            fetch('/checkout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                showLoading(false);
                
                if (data.status === 'success') {
                    // Show success message
                    showSuccessMessage('تم إكمال طلبك بنجاح! سيتم التواصل معك قريباً لتأكيد الطلب.');
                    
                    // Hide checkout form
                    checkoutForm.style.display = 'none';
                    
                    // Show empty cart
                    showEmptyCart();
                    
                    // Show toast notification
                    showToast('Order completed successfully!', 'success');
                } else {
                    showToast(data.message || 'Error processing order', 'error');
                }
            })
            .catch(error => {
                showLoading(false);
                showToast('Error processing order', 'error');
                console.error('Error:', error);
            });
        }
        
        // Format credit card number with spaces
        function formatCardNumber(input) {
            let value = input.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = '';
            
            for (let i = 0; i < value.length; i++) {
                if (i > 0 && i % 4 === 0) {
                    formattedValue += ' ';
                }
                formattedValue += value[i];
            }
            
            input.value = formattedValue;
        }
        
        // Format expiry date
        function formatExpiryDate(input) {
            let value = input.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            
            if (value.length > 2) {
                input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
            } else {
                input.value = value;
            }
        }
        
        // Event listeners
        document.addEventListener('DOMContentLoaded', () => {
            // Checkout button
            if (checkoutButton) {
                checkoutButton.addEventListener('click', handleCheckout);
            }
            
            // Cancel checkout
            if (cancelCheckoutButton) {
                cancelCheckoutButton.addEventListener('click', cancelCheckout);
            }
            
            // Submit payment form
            if (paymentForm) {
                paymentForm.addEventListener('submit', submitCheckout);
            }
        });
    </script>
</body>
</html>