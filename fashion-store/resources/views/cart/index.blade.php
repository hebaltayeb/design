<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, rgba(255, 107, 157, 0.05) 0%, rgba(196, 69, 105, 0.05) 100%);
    margin: 0;
    padding: 0;
    color: #2c3e50;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.page-title {
    margin-bottom: 40px;
    text-align: center;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.page-title h1 {
    font-size: 48px;
    font-weight: 300;
    margin-bottom: 15px;
    color: #2c3e50;
    position: relative;
    display: inline-block;
    padding-bottom: 20px;
}

.page-title h1::after {
    content: '';
    position: absolute;
    width: 80px;
    height: 4px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 2px;
}

.page-title p {
    color: #666;
    font-size: 18px;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
}

.alert {
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.alert-success {
    border-left: 4px solid #27ae60;
    background: rgba(39, 174, 96, 0.05);
    color: #27ae60;
}

.cart-container {
    display: flex;
    gap: 40px;
    margin-top: 30px;
    flex-direction: row;
}

.cart-items {
    flex: 1;
}

.cart-item {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    flex-direction: row;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cart-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(196, 69, 105, 0.15);
}

.item-image {
    width: 120px;
    height: 120px;
    overflow: hidden;
    border-radius: 15px;
    margin-right: 25px;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(196, 69, 105, 0.1);
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.cart-item:hover .item-image img {
    transform: scale(1.05);
}

.item-details {
    flex: 1;
    text-align: left;
}

.item-name {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #2c3e50;
}

.item-designer {
    font-size: 14px;
    color: #666;
    margin-bottom: 12px;
}

.item-meta {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    justify-content: flex-start;
}

.item-size, .item-category {
    font-size: 12px;
    color: #666;
    background: rgba(255, 107, 157, 0.1);
    padding: 6px 12px;
    border-radius: 20px;
    border: 1px solid rgba(255, 107, 157, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

.item-price {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    justify-content: flex-start;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    margin-right: 10px;
    font-size: 16px;
}

.discount-price {
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 18px;
}

.regular-price {
    font-weight: 700;
    font-size: 18px;
    color: #2c3e50;
}

.item-quantity {
    margin: 0 30px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 2px solid #e1e8ed;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 15px rgba(196, 69, 105, 0.05);
}

.quantity-btn {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    color: #2c3e50;
    font-weight: 600;
}

.quantity-btn:hover {
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: #fff;
}

.quantity-input {
    width: 60px;
    height: 40px;
    border: none;
    text-align: center;
    -moz-appearance: textfield;
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input:focus {
    outline: none;
    background: rgba(255, 107, 157, 0.05);
}

.item-total {
    font-weight: 700;
    font-size: 20px;
    margin: 0 30px;
    min-width: 100px;
    text-align: center;
    color: #2c3e50;
}

.item-actions {
    margin-left: 20px;
}

.remove-btn {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid #e1e8ed;
    border-radius: 50%;
    color: #999;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.remove-btn:hover {
    color: #fff;
    background: #e74c3c;
    border-color: #e74c3c;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
}

.cart-summary {
    width: 400px;
    flex-shrink: 0;
}

.summary-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-align: left;
}

.summary-card h3 {
    font-size: 24px;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(196, 69, 105, 0.1);
    color: #2c3e50;
    font-weight: 600;
    position: relative;
}

.summary-card h3::after {
    content: '';
    position: absolute;
    width: 50px;
    height: 3px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    bottom: -2px;
    left: 0;
    border-radius: 2px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    font-size: 16px;
    color: #666;
    flex-direction: row;
}

.summary-row.total {
    font-weight: 700;
    font-size: 20px;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 2px solid rgba(196, 69, 105, 0.1);
    color: #2c3e50;
}

.summary-row.discount {
    color: #27ae60;
    font-weight: 600;
}

.checkout-actions {
    margin-top: 30px;
}

.checkout-btn {
    display: block;
    width: 100%;
    padding: 18px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: white;
    border: none;
    border-radius: 12px;
    text-align: center;
    font-weight: 600;
    margin-bottom: 15px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.checkout-btn:hover {
    background: linear-gradient(45deg, #c44569, #ff6b9d);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
}

.continue-shopping {
    display: block;
    text-align: center;
    color: #666;
    text-decoration: none;
    padding: 15px;
    transition: color 0.3s ease;
    font-weight: 500;
}

.continue-shopping:hover {
    color: #c44569;
}

.empty-cart-message {
    text-align: center;
    padding: 80px 20px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.empty-cart-icon {
    font-size: 80px;
    color: rgba(196, 69, 105, 0.3);
    margin-bottom: 25px;
}

.empty-cart-message h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: #2c3e50;
    font-weight: 600;
}

.empty-cart-message p {
    color: #666;
    margin-bottom: 30px;
    font-size: 16px;
}

.btn-primary {
    display: inline-block;
    padding: 15px 30px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: white;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #c44569, #ff6b9d);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
}

.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    padding: 15px 25px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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
    background: linear-gradient(45deg, #27ae60, #2ecc71);
}

.toast.error {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
}

.loading-spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(5px);
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
    border: 3px solid #f3f3f3;
    border-top: 3px solid #c44569;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/* Checkout form styles */
.checkout-form {
    padding: 30px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 30px;
    display: none;
}

.checkout-form h3 {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid rgba(196, 69, 105, 0.1);
    font-size: 24px;
    color: #2c3e50;
    font-weight: 600;
    text-align: left;
    position: relative;
}

.checkout-form h3::after {
    content: '';
    position: absolute;
    width: 50px;
    height: 3px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    bottom: -2px;
    left: 0;
    border-radius: 2px;
}

.form-group {
    margin-bottom: 25px;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    color: #2c3e50;
}

.form-control {
    width: 100%;
    padding: 15px;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 16px;
    font-family: inherit;
    background: #fff;
}

.form-control:focus {
    border-color: #c44569;
    outline: none;
    box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
}

.form-row {
    display: flex;
    gap: 20px;
}

.form-row .form-group {
    flex: 1;
}

.btn-submit {
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 15px 30px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-submit:hover {
    background: linear-gradient(45deg, #c44569, #ff6b9d);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
}

.btn-cancel {
    background: #f8f9fa;
    color: #2c3e50;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    padding: 15px 30px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-cancel:hover {
    background: #2c3e50;
    color: #fff;
    border-color: #2c3e50;
    transform: translateY(-2px);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .container {
        padding: 30px 15px;
    }
    
    .cart-container {
        gap: 30px;
    }
    
    .cart-summary {
        width: 350px;
    }
}

@media (max-width: 992px) {
    .cart-container {
        flex-direction: column;
        gap: 30px;
    }
    
    .cart-summary {
        width: 100%;
        max-width: none;
    }
    
    .summary-card {
        position: static;
    }

    .page-title h1 {
        font-size: 40px;
    }
    
    .page-title {
        padding: 30px 20px;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 20px 15px;
    }
    
    .page-title {
        padding: 25px 15px;
        margin-bottom: 30px;
    }
    
    .page-title h1 {
        font-size: 32px;
    }
    
    .page-title p {
        font-size: 16px;
    }
    
    .cart-item {
        flex-direction: column;
        align-items: flex-start;
        padding: 20px;
        gap: 15px;
    }
    
    .item-image {
        width: 100%;
        max-width: 200px;
        height: 200px;
        margin-right: 0;
        margin-bottom: 15px;
        align-self: center;
    }
    
    .item-details {
        width: 100%;
        text-align: center;
    }
    
    .item-meta {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .item-price {
        justify-content: center;
    }
    
    .cart-item-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(196, 69, 105, 0.1);
    }
    
    .item-quantity {
        margin: 0;
    }
    
    .item-total {
        margin: 0;
        text-align: right;
        order: 2;
    }
    
    .item-actions {
        margin-left: 15px;
        order: 3;
    }
    
    .summary-card {
        padding: 25px 20px;
    }
    
    .checkout-form {
        padding: 25px 20px;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 15px 10px;
    }
    
    .page-title {
        padding: 20px 15px;
        margin-bottom: 25px;
    }
    
    .page-title h1 {
        font-size: 28px;
    }
    
    .page-title p {
        font-size: 14px;
    }
    
    .cart-item {
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .item-image {
        max-width: 150px;
        height: 150px;
    }
    
    .item-name {
        font-size: 18px;
    }
    
    .item-designer {
        font-size: 13px;
    }
    
    .item-size, .item-category {
        font-size: 11px;
        padding: 4px 8px;
    }
    
    .item-total {
        font-size: 18px;
    }
    
    .quantity-controls {
        transform: scale(0.9);
    }
    
    .summary-card {
        padding: 20px 15px;
    }
    
    .summary-card h3 {
        font-size: 20px;
    }
    
    .checkout-form {
        padding: 20px 15px;
    }
    
    .checkout-form h3 {
        font-size: 20px;
    }
    
    .btn-cancel,
    .btn-submit {
        padding: 12px 20px;
        font-size: 14px;
    }
    
    .toast {
        right: 10px;
        bottom: 10px;
        padding: 12px 20px;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .page-title h1 {
        font-size: 24px;
    }
    
    .item-image {
        max-width: 120px;
        height: 120px;
    }
    
    .item-name {
        font-size: 16px;
    }
    
    .item-total {
        font-size: 16px;
    }
    
    .summary-card h3 {
        font-size: 18px;
    }
    
    .checkout-btn {
        padding: 15px;
        font-size: 14px;
    }
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, rgba(255, 107, 157, 0.05) 0%, rgba(196, 69, 105, 0.05) 100%);
    margin: 0;
    padding: 0;
    color: #2c3e50;
    line-height: 1.6;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 25px 15px;
    position: relative;
}

.page-title {
    margin-bottom: 25px;
    text-align: center;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.page-title h1 {
    font-size: 36px;
    font-weight: 300;
    margin-bottom: 10px;
    color: #2c3e50;
    position: relative;
    display: inline-block;
    padding-bottom: 15px;
}

.page-title h1::after {
    content: '';
    position: absolute;
    width: 60px;
    height: 3px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 2px;
}

.page-title p {
    color: #666;
    font-size: 16px;
    font-weight: 400;
    max-width: 500px;
    margin: 0 auto;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    box-shadow: 0 5px 20px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.alert-success {
    border-left: 3px solid #27ae60;
    background: rgba(39, 174, 96, 0.05);
    color: #27ae60;
}

.cart-container {
    display: flex;
    gap: 25px;
    margin-top: 20px;
    flex-direction: row;
    width: 100%;
}

.cart-items {
    flex: 1;
    min-width: 0;
}

.cart-item {
    display: flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    box-shadow: 0 5px 20px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    flex-direction: row;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%;
    box-sizing: border-box;
}

.cart-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(196, 69, 105, 0.15);
}

.item-image {
    width: 80px;
    height: 80px;
    overflow: hidden;
    border-radius: 12px;
    margin-right: 20px;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(196, 69, 105, 0.1);
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.cart-item:hover .item-image img {
    transform: scale(1.05);
}

.item-details {
    flex: 1;
    text-align: left;
    min-width: 0;
    padding-right: 10px;
}

.item-name {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #2c3e50;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.3;
}

.item-designer {
    font-size: 12px;
    color: #666;
    margin-bottom: 8px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.3;
}

.item-meta {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.item-size, .item-category {
    font-size: 10px;
    color: #666;
    background: rgba(255, 107, 157, 0.1);
    padding: 4px 8px;
    border-radius: 15px;
    border: 1px solid rgba(255, 107, 157, 0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 500;
}

.item-price {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.original-price {
    text-decoration: line-through;
    color: #999;
    margin-right: 8px;
    font-size: 14px;
}

.discount-price {
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 16px;
}

.regular-price {
    font-weight: 700;
    font-size: 16px;
    color: #2c3e50;
}

.item-quantity {
    margin: 0 20px;
    flex-shrink: 0;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 2px solid #e1e8ed;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 10px rgba(196, 69, 105, 0.05);
}

.quantity-btn {
    width: 32px;
    height: 32px;
    background: #f8f9fa;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    color: #2c3e50;
    font-weight: 600;
    font-size: 12px;
}

.quantity-btn:hover {
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: #fff;
}

.quantity-input {
    width: 45px;
    height: 32px;
    border: none;
    text-align: center;
    -moz-appearance: textfield;
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.quantity-input:focus {
    outline: none;
    background: rgba(255, 107, 157, 0.05);
}

.item-total {
    font-weight: 700;
    font-size: 16px;
    margin: 0 20px;
    min-width: 80px;
    text-align: center;
    color: #2c3e50;
    flex-shrink: 0;
}

.item-actions {
    margin-left: 15px;
    flex-shrink: 0;
}

.remove-btn {
    width: 35px;
    height: 35px;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid #e1e8ed;
    border-radius: 50%;
    color: #999;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    font-size: 12px;
}

.remove-btn:hover {
    color: #fff;
    background: #e74c3c;
    border-color: #e74c3c;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.cart-summary {
    width: 320px;
    flex-shrink: 0;
}

.summary-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 20px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-align: left;
    position: sticky;
    top: 20px;
}

.summary-card h3 {
    font-size: 20px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(196, 69, 105, 0.1);
    color: #2c3e50;
    font-weight: 600;
    position: relative;
}

.summary-card h3::after {
    content: '';
    position: absolute;
    width: 40px;
    height: 3px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    bottom: -2px;
    left: 0;
    border-radius: 2px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 14px;
    color: #666;
    flex-direction: row;
}

.summary-row.total {
    font-weight: 700;
    font-size: 18px;
    margin-top: 20px;
    padding-top: 15px;
    border-top: 2px solid rgba(196, 69, 105, 0.1);
    color: #2c3e50;
}

.summary-row.discount {
    color: #27ae60;
    font-weight: 600;
}

.checkout-actions {
    margin-top: 25px;
}

.checkout-btn {
    display: block;
    width: 100%;
    padding: 15px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: white;
    border: none;
    border-radius: 10px;
    text-align: center;
    font-weight: 600;
    margin-bottom: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.checkout-btn:hover {
    background: linear-gradient(45deg, #c44569, #ff6b9d);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(196, 69, 105, 0.3);
}

.continue-shopping {
    display: block;
    text-align: center;
    color: #666;
    text-decoration: none;
    padding: 12px;
    transition: color 0.3s ease;
    font-weight: 500;
    font-size: 14px;
}

.continue-shopping:hover {
    color: #c44569;
}

.empty-cart-message {
    text-align: center;
    padding: 60px 20px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.empty-cart-icon {
    font-size: 60px;
    color: rgba(196, 69, 105, 0.3);
    margin-bottom: 20px;
}

.empty-cart-message h2 {
    font-size: 24px;
    margin-bottom: 12px;
    color: #2c3e50;
    font-weight: 600;
}

.empty-cart-message p {
    color: #666;
    margin-bottom: 25px;
    font-size: 14px;
}

.btn-primary {
    display: inline-block;
    padding: 12px 25px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 14px;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #c44569, #ff6b9d);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(196, 69, 105, 0.3);
}

.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 9999;
    font-size: 13px;
}

.toast.show {
    transform: translateY(0);
    opacity: 1;
}

.toast.success {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
}

.toast.error {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
}

.loading-spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(5px);
    z-index: 9998;
    justify-content: center;
    align-items: center;
}

.loading-spinner.active {
    display: flex;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #c44569;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

/* Checkout form styles */
.checkout-form {
    padding: 25px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(196, 69, 105, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 25px;
    display: none;
}

.checkout-form h3 {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(196, 69, 105, 0.1);
    font-size: 20px;
    color: #2c3e50;
    font-weight: 600;
    text-align: left;
    position: relative;
}

.checkout-form h3::after {
    content: '';
    position: absolute;
    width: 40px;
    height: 3px;
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    bottom: -2px;
    left: 0;
    border-radius: 2px;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 14px;
    font-family: inherit;
    background: #fff;
}

.form-control:focus {
    border-color: #c44569;
    outline: none;
    box-shadow: 0 0 15px rgba(196, 69, 105, 0.2);
}

.form-row {
    display: flex;
    gap: 15px;
}

.form-row .form-group {
    flex: 1;
}

.btn-submit {
    background: linear-gradient(45deg, #ff6b9d, #c44569);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 12px 25px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-submit:hover {
    background: linear-gradient(45deg, #c44569, #ff6b9d);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(196, 69, 105, 0.3);
}

.btn-cancel {
    background: #f8f9fa;
    color: #2c3e50;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    padding: 12px 25px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-cancel:hover {
    background: #2c3e50;
    color: #fff;
    border-color: #2c3e50;
    transform: translateY(-2px);
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Extra Small Screens */
@media (max-width: 360px) {
    .container {
        padding: 10px 5px;
    }
    
    .page-title {
        padding: 15px 10px;
    }
    
    .page-title h1 {
        font-size: 22px;
    }
    
    .cart-item {
        padding: 12px;
    }
    
    .summary-card,
    .checkout-form {
        padding: 15px 10px;
    }
    
    .btn-cancel,
    .btn-submit {
        padding: 10px 15px;
        font-size: 13px;
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
                   showSuccessMessage('Your order has been successfully completed! You will be contacted shortly to confirm the order.');

                    
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