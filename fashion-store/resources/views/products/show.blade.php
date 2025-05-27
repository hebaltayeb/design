<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family={{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: '{{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #2c3e50;
            line-height: 1.6;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header Styles - Matching products page */
        header {
            position: fixed;
            width: 100%;
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 20px rgba(196, 69, 105, 0.1);
            transition: all 0.3s ease;
        }
        
        header.scrolled {
            background-color: #fff;
            box-shadow: 0 6px 30px rgba(196, 69, 105, 0.15);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
        }
        
        .logo {
            font-size: 32px;
            font-weight: 300;
            color: #2c3e50;
            text-decoration: none;
            letter-spacing: 1px;
        }
        
        .logo span {
            font-weight: 700;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin: 0 15px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: #2c3e50;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }
        
        nav ul li a:hover,
        nav ul li a.active {
            color: #c44569;
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        
        nav ul li a:hover::after,
        nav ul li a.active::after {
            width: 100%;
        }

        .header-icons {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .icon-btn {
            color: #2c3e50;
            font-size: 20px;
            position: relative;
            transition: all 0.3s ease;
            text-decoration: none;
            padding: 8px;
            border-radius: 50%;
        }
        
        .icon-btn:hover {
            color: #c44569;
            background: rgba(255, 107, 157, 0.1);
            transform: translateY(-2px);
        }
        
        .counter {
            position: absolute;
            top: 2px;
            right: 2px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            font-size: 11px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        .cta-buttons {
            display: flex;
            gap: 15px;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #2c3e50;
        }
        
        /* Main Content */
        .main-content {
            padding: 140px 0 60px;
        }

        .breadcrumb {
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.05);
        }
        
        .breadcrumb a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .breadcrumb a:hover {
            color: #c44569;
        }
        
        .breadcrumb .separator {
            margin: 0 10px;
            color: #ccc;
        }
        
        .breadcrumb .current {
            color: #2c3e50;
            font-weight: 500;
        }
        
        .product-detail {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            margin-bottom: 60px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .product-detail-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }
        
        .product-gallery {
            padding: 40px;
            border-right: 1px solid rgba(196, 69, 105, 0.1);
        }
        
        .main-image {
            width: 100%;
            height: 500px;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(196, 69, 105, 0.1);
            position: relative;
        }
        
        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .main-image:hover img {
            transform: scale(1.05);
        }

        .image-zoom-indicator {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .main-image:hover .image-zoom-indicator {
            opacity: 1;
        }
        
        .thumbnails {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding: 5px 0;
        }

        .thumbnails::-webkit-scrollbar {
            height: 6px;
        }

        .thumbnails::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .thumbnails::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            border-radius: 10px;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.1);
            flex-shrink: 0;
        }
        
        .thumbnail.active {
            border-color: #c44569;
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(196, 69, 105, 0.2);
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info {
            padding: 40px;
            display: flex;
            flex-direction: column;
        }
        
        .product-name {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 15px;
            line-height: 1.2;
            color: #2c3e50;
        }
        
        .product-designer {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding: 20px;
            background: rgba(255, 107, 157, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 107, 157, 0.1);
        }
        
        .designer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.2);
        }
        
        .designer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .designer-name {
            font-size: 16px;
            color: #666;
        }
        
        .designer-name a {
            color: #2c3e50;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .designer-name a:hover {
            color: #c44569;
        }
        
        .product-price {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            color: #2c3e50;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 15px;
            font-size: 22px;
            font-weight: normal;
        }
        
        .discount-price {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .savings-badge {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 15px;
            text-transform: uppercase;
        }
        
        .product-description {
            margin-bottom: 30px;
            line-height: 1.8;
            color: #666;
            font-size: 16px;
            padding: 20px;
            background: rgba(44, 62, 80, 0.03);
            border-radius: 10px;
            border-left: 4px solid #c44569;
        }
        
        .product-options {
            margin-bottom: 30px;
        }
        
        .option-group {
            margin-bottom: 25px;
        }
        
        .option-label {
            display: block;
            font-weight: 600;
            margin-bottom: 12px;
            font-size: 16px;
            color: #2c3e50;
        }
        
        .size-options {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }
        
        .size-option {
            width: 50px;
            height: 50px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            background: #fff;
            position: relative;
        }
        
        .size-option.active {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: white;
            border-color: transparent;
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.3);
        }
        
        .size-option.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f8f9fa;
        }

        .size-option.disabled::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 2px;
            height: 80%;
            background: #999;
            transform: translate(-50%, -50%) rotate(45deg);
        }
        
        .color-options {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .color-option {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .color-option.active {
            box-shadow: 0 0 0 2px white, 0 0 0 4px #c44569, 0 4px 15px rgba(196, 69, 105, 0.3);
            transform: scale(1.1);
        }

        .color-option.active::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 0 0 3px rgba(0,0,0,0.7);
            font-weight: bold;
            font-size: 14px;
        }
        
        .quantity-input {
            display: flex;
            align-items: center;
            width: fit-content;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 10px rgba(196, 69, 105, 0.05);
        }
        
        .quantity-btn {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #2c3e50;
        }
        
        .quantity-btn:hover {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
        }
        
        .quantity-input input {
            width: 80px;
            height: 50px;
            text-align: center;
            border: none;
            border-left: 1px solid #e1e8ed;
            border-right: 1px solid #e1e8ed;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .quantity-input input:focus {
            outline: none;
            background: rgba(255, 107, 157, 0.05);
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: auto;
            margin-bottom: 20px;
        }
        
        .btn {
            padding: 16px 30px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }
        
        .btn i {
            margin-right: 10px;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: white;
            border: 2px solid transparent;
            flex: 1;
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.2);
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #c44569, #ff6b9d);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
        }
        
        .btn-outline {
            background-color: transparent;
            color: #2c3e50;
            border: 2px solid #2c3e50;
        }
        
        .btn-outline:hover {
            background-color: #2c3e50;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
        }
        
        .error-message {
            animation: shake 0.5s ease-in-out;
            color: #c44569;
            font-size: 13px;
            margin-top: 8px;
            font-weight: 500;
            padding: 8px 12px;
            background: rgba(196, 69, 105, 0.1);
            border-radius: 6px;
            border-left: 3px solid #c44569;
        }

        @keyframes shake {
            0%, 100% {transform: translateX(0);}
            20%, 60% {transform: translateX(-5px);}
            40%, 80% {transform: translateX(5px);}
        }
        
        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            padding: 25px;
            background: rgba(255, 107, 157, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 107, 157, 0.1);
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
            padding: 8px 0;
        }
        
        .meta-item i {
            margin-right: 8px;
            color: #c44569;
            width: 16px;
        }

        .stock-indicator {
            display: flex;
            align-items: center;
            margin-top: 15px;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .stock-indicator.in-stock {
            background: rgba(39, 174, 96, 0.1);
            color: #27ae60;
            border: 1px solid rgba(39, 174, 96, 0.2);
        }

        .stock-indicator.low-stock {
            background: rgba(255, 193, 7, 0.1);
            color: #f39c12;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        .stock-indicator.out-of-stock {
            background: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid rgba(231, 76, 60, 0.2);
        }

        .stock-indicator i {
            margin-right: 8px;
        }
        
        .product-tabs {
            margin-bottom: 60px;
        }
        
        .tabs-navigation {
            display: flex;
            border-bottom: 2px solid #e1e8ed;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px 15px 0 0;
            padding: 0 20px;
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.05);
        }
        
        .tab-button {
            padding: 20px 30px;
            font-size: 16px;
            font-weight: 600;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            position: relative;
        }
        
        .tab-button.active {
            color: #2c3e50;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            border-radius: 2px;
        }

        .tab-button:hover:not(.active) {
            color: #c44569;
            background: rgba(255, 107, 157, 0.05);
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .tab-content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tab-content h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(196, 69, 105, 0.1);
        }

        .tab-content ul {
            list-style: none;
            padding: 0;
        }

        .tab-content ul li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(196, 69, 105, 0.05);
            display: flex;
            align-items: center;
        }

        .tab-content ul li:before {
            content: '•';
            color: #c44569;
            font-weight: bold;
            width: 20px;
        }
        
        .reviews-list {
            margin-bottom: 30px;
        }
        
        .review-card {
            background: rgba(255, 107, 157, 0.05);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 107, 157, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 69, 105, 0.15);
        }
        
        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            box-shadow: 0 4px 15px rgba(196, 69, 105, 0.2);
        }
        
        .reviewer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .reviewer-info {
            flex: 1;
        }
        
        .reviewer-name {
            font-weight: 600;
            margin-bottom: 3px;
            color: #2c3e50;
        }
        
        .review-date {
            font-size: 12px;
            color: #999;
        }
        
        .review-rating {
            color: #ffc107;
            font-size: 16px;
        }
        
        .review-content {
            line-height: 1.7;
            color: #666;
        }
        
        .review-form {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .review-form h3 {
            margin-bottom: 25px;
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            font-size: 28px;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .rating-input input {
            display: none;
        }
        
        .rating-input label {
            cursor: pointer;
            color: #ddd;
            transition: all 0.2s ease;
        }
        
        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            color: #ffc107;
            transform: scale(1.1);
        }
        
        .form-control {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-family: inherit;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #c44569;
            box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        /* Confirmation Modal */
        #confirmationModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        #confirmationModal > div {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            max-width: 450px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(196, 69, 105, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        #confirmationModal h3 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 15px;
        }

        #confirmationModal p {
            color: #666;
            margin-bottom: 25px;
        }

        #confirmationModal .btn {
            min-width: 120px;
        }
        
        .related-products {
            margin-bottom: 60px;
        }
        
        .section-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
            color: #2c3e50;
        }
        
        .section-title::after {
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
        
        .related-products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .product-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
        }
        
        .product-card-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }
        
        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-card-image img {
            transform: scale(1.05);
        }
        
        .product-card-info {
            padding: 20px;
        }
        
        .product-card-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        .product-card-designer {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
        }
        
        .product-card-price {
            font-weight: 700;
            color: #2c3e50;
        }

        /* Toast notification styles */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(45deg, #2c3e50, #34495e);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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
            background: linear-gradient(45deg, #27ae60, #2ecc71);
        }

        .toast.error {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
        }

        /* Loading spinner */
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

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Footer - Matching products page */
        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1;
            padding: 80px 0 30px;
            margin-top: 100px;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 50px;
        }
        
        .footer-column {
            flex: 1;
            min-width: 250px;
            margin-bottom: 40px;
        }
        
        .footer-column h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            color: #fff;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        
        .footer-column p {
            font-size: 15px;
            color: #bdc3c7;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links li a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            padding: 5px 0;
            display: inline-block;
        }
        
        .footer-links li a:hover {
            color: #ff6b9d;
            transform: translateX(5px);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            color: #bdc3c7;
            font-size: 20px;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }
        
        .social-links a:hover {
            color: #ff6b9d;
            background: rgba(255, 107, 157, 0.1);
            transform: translateY(-3px);
        }
        
        .newsletter {
            margin-top: 25px;
        }
        
        .newsletter form {
            display: flex;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .newsletter input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            font-family: inherit;
            font-size: 14px;
            background: #fff;
        }
        
        .newsletter button {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            border: none;
            padding: 0 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            font-weight: 600;
        }
        
        .newsletter button:hover {
            background: linear-gradient(45deg, #c44569, #ff6b9d);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #455a64;
            font-size: 14px;
            color: #95a5a6;
        }
        
        @media (max-width: 992px) {
            .product-detail-content {
                grid-template-columns: 1fr;
            }
            
            .product-gallery {
                border-right: none;
                border-bottom: 1px solid rgba(196, 69, 105, 0.1);
            }
            
            .main-image {
                height: 400px;
            }

            .product-name {
                font-size: 28px;
            }

            .related-products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .header-icons {
                display: none;
            }
            
            .cta-buttons {
                display: none;
            }

            .tabs-navigation {
                flex-wrap: wrap;
                padding: 0 10px;
            }
            
            .tab-button {
                padding: 15px 20px;
                font-size: 14px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .product-name {
                font-size: 24px;
            }
            
            .product-price {
                font-size: 24px;
            }
            
            .original-price {
                font-size: 20px;
            }

            .related-products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }

            .main-content {
                padding: 120px 0 40px;
            }
        }

        @media (max-width: 576px) {
            .related-products-grid {
                grid-template-columns: 1fr;
            }

            .product-detail {
                margin: 0 -5%;
                border-radius: 15px;
            }

            .product-gallery,
            .product-info {
                padding: 20px;
            }

            .main-image {
                height: 300px;
                border-radius: 10px;
            }

            .thumbnails {
                gap: 10px;
            }

            .thumbnail {
                width: 60px;
                height: 60px;
            }

            .section-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <a href="{{ route('landing') }}" class="logo">Ele<span>gance</span></a>
                
                <nav>
                    <ul>
                        <li><a href="{{ route('landing') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="active">Products</a></li>
                        <li><a href="{{ route('designers.index') }}">Designers</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
                
                <div class="header-icons">
                    <a href="{{ route('favorites.index') }}" class="icon-btn" title="Favorites">
                        <i class="fas fa-heart"></i>
                        @auth
                            @if(auth()->user()->favorites()->count() > 0)
                                <span class="counter favorites-counter">{{ auth()->user()->favorites()->count() }}</span>
                            @endif
                        @endauth
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="icon-btn" title="Cart">
                        <i class="fas fa-shopping-cart"></i>
                        @if(session()->has('cart') && !empty(session('cart')))
                            <span class="counter cart-counter">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="cta-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Create Account</a>
                    @endauth
                </div>

                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toastNotification"></div>

    <div class="container">
        <div class="main-content">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('landing') }}">Home</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('products.index') }}">Products</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span class="current">{{ $product->name }}</span>
            </div>

            <!-- Product Detail -->
            <div class="product-detail">
                <div class="product-detail-content">
                    <!-- Product Gallery -->
                    <div class="product-gallery">
                        <div class="main-image">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/500/500' }}" alt="{{ $product->name }}" id="main-product-image">
                            <div class="image-zoom-indicator">
                                <i class="fas fa-search-plus"></i> Hover to zoom
                            </div>
                        </div>
                        <div class="thumbnails">
                            <div class="thumbnail active" data-image="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/500/500' }}">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/80/80' }}" alt="{{ $product->name }}">
                            </div>
                            <!-- Placeholder thumbnails -->
                            <div class="thumbnail" data-image="/api/placeholder/500/500?text=Image+2">
                                <img src="/api/placeholder/80/80?text=2" alt="Product view 2">
                            </div>
                            <div class="thumbnail" data-image="/api/placeholder/500/500?text=Image+3">
                                <img src="/api/placeholder/80/80?text=3" alt="Product view 3">
                            </div>
                            <div class="thumbnail" data-image="/api/placeholder/500/500?text=Image+4">
                                <img src="/api/placeholder/80/80?text=4" alt="Product view 4">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="product-info">
                        <h1 class="product-name">{{ $product->name }}</h1>
                        
                        <div class="product-designer">
                            <div class="designer-avatar">
                                <img src="{{ optional($product->designer)->profile_picture ? asset('storage/'.optional($product->designer)->profile_picture) : '/api/placeholder/50/50' }}" alt="{{ optional($product->designer)->name ?? 'Unknown Designer' }}">
                            </div>
                            <div class="designer-name">
                                Designed by
                                @if($product->designer)
                                    <a href="{{ route('designers.show', $product->designer->id) }}">
                                        {{ $product->designer->name }}
                                    </a>
                                @else
                                    <span>Unknown Designer</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="product-price">
                            @if($product->hasDiscount())
                                <span class="original-price">${{ number_format($product->price, 2) }}</span>
                                <span class="discount-price">${{ number_format($product->discounted_price, 2) }}</span>
                                <span class="savings-badge">Save ${{ number_format($product->price - $product->discounted_price, 2) }}</span>
                            @else
                                ${{ number_format($product->price, 2) }}
                            @endif
                        </div>
                        
                        <div class="product-description">
                            {{ $product->description }}
                        </div>

                        <!-- Stock Indicator -->
                        <div class="stock-indicator in-stock">
                            <i class="fas fa-check-circle"></i>
                            In Stock - Ready to Ship
                        </div>
                        
                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="product-options">
                                <div class="option-group">
                                    <label class="option-label">Size:</label>
                                    <div class="size-options">
                                        @foreach($product->sizes as $sizeOption)
                                            <div class="size-option {{ $loop->first ? 'active' : '' }} {{ $sizeOption->stock_quantity <= 0 ? 'disabled' : '' }}" 
                                                 data-size="{{ $sizeOption->size }}">
                                                {{ $sizeOption->size }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="size" value="{{ $product->sizes->first()->size ?? 'M' }}" id="selected-size">
                                    <div class="error-message" id="size-error" style="display: none;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Please select a size
                                    </div>
                                </div>
                                
                                <div class="option-group">
                                    <label class="option-label">Color:</label>
                                    <div class="color-options">
                                        <div class="color-option active" data-color="{{ $product->color }}" style="background-color: {{ $product->color }};"></div>
                                    </div>
                                    <input type="hidden" name="color" value="{{ $product->color }}" id="selected-color">
                                </div>
                                
                                <div class="option-group">
                                    <label class="option-label">Quantity:</label>
                                    <div class="quantity-input">
                                        <button type="button" class="quantity-btn" id="decrease-qty">−</button>
                                        <input type="number" name="quantity" value="1" min="1" max="10" id="quantity-input">
                                        <button type="button" class="quantity-btn" id="increase-qty">+</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="action-buttons">
                                <button type="button" id="addToCartBtn" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                
                                @auth
                                    <form action="{{ route('favorites.toggle') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-outline">
                                            <i class="fas fa-heart {{ auth()->user()->hasFavorited($product->id) ? 'text-danger' : '' }}"></i> 
                                            {{ auth()->user()->hasFavorited($product->id) ? 'Remove from Favorites' : 'Add to Favorites' }}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline">
                                        <i class="fas fa-heart"></i> Add to Favorites
                                    </a>
                                @endauth
                            </div>
                        </form>
                        
                        <!-- Confirmation Modal -->
                        <div id="confirmationModal">
                            <div>
                                <i class="fas fa-check-circle" style="font-size: 60px; color: #4CAF50; margin-bottom: 20px;"></i>
                                <h3>Added to Cart!</h3>
                                <p>The item has been added to your shopping cart.</p>
                                <div style="display: flex; gap: 15px; justify-content: center;">
                                    <button id="continueShoppingBtn" class="btn btn-outline">Continue Shopping</button>
                                    <a href="{{ route('cart.index') }}" class="btn btn-primary">View Cart</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="product-meta">
                            <div class="meta-item">
                                <i class="fas fa-tag"></i> Category: {{ $product->category }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-palette"></i> Color: {{ ucfirst($product->color) }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-box"></i> SKU: PROD-{{ $product->id }}
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-truck"></i> Free Shipping
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Tabs -->
            <div class="product-tabs">
                <div class="tabs-navigation">
                    <button class="tab-button active" data-tab="details">Product Details</button>
                    <button class="tab-button" data-tab="shipping">Shipping & Returns</button>
                    <button class="tab-button" data-tab="reviews">Customer Reviews ({{ $product->ratings->count() }})</button>
                </div>
                
                <!-- Tab Contents -->
                <div class="tab-content active" id="details-tab">
                    <h3>Product Information</h3>
                    <p>{{ $product->description }}</p>
                    <ul style="margin-top: 20px;">
                        <li><strong>Material:</strong> Premium quality fabric</li>
                        <li><strong>Color:</strong> {{ ucfirst($product->color) }}</li>
                        <li><strong>Style:</strong> Contemporary</li>
                        <li><strong>Care Instructions:</strong> Hand wash or gentle machine wash</li>
                        <li><strong>Origin:</strong> Designed by {{ optional($product->designer)->name ?? 'Unknown Designer' }}</li>
                        <li><strong>Sustainability:</strong> Ethically sourced materials</li>
                    </ul>
                </div>
                
                <div class="tab-content" id="shipping-tab">
                    <h3>Shipping Information</h3>
                    <p>We offer worldwide shipping on all orders. Shipping times may vary depending on your location:</p>
                    <ul style="margin: 15px 0;">
                        <li><strong>Domestic:</strong> 1-3 business days</li>
                        <li><strong>International:</strong> 7-14 business days</li>
                        <li><strong>Express Shipping:</strong> Available for urgent orders</li>
                        <li><strong>Free Shipping:</strong> On orders over $100</li>
                    </ul>
                    
                    <h3 style="margin: 25px 0 15px; color: #2c3e50;">Return Policy</h3>
                    <p>We want you to be completely satisfied with your purchase. If for any reason you're not happy with your order, you can return it within 30 days of delivery for a full refund or exchange.</p>
                    <ul style="margin-top: 15px;">
                        <li>Items must be unworn, unwashed, and in original packaging</li>
                        <li>Original tags must be attached</li>
                        <li>Return shipping is free for defective items</li>
                        <li>Refunds processed within 5-7 business days</li>
                    </ul>
                </div>
                
                <div class="tab-content" id="reviews-tab">
                    <div class="reviews-list">
                        @forelse($product->ratings as $rating)
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-avatar">
                                        <img src="/api/placeholder/50/50" alt="{{ $rating->user->name }}">
                                    </div>
                                    <div class="reviewer-info">
                                        <div class="reviewer-name">{{ $rating->user->name }}</div>
                                        <div class="review-date">{{ $rating->created_at->format('F d, Y') }}</div>
                                    </div>
                                    <div class="review-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="review-content">
                                    {{ $rating->review }}
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px;">
                                <i class="far fa-comment-dots" style="font-size: 60px; color: #ddd; margin-bottom: 20px;"></i>
                                <h3 style="color: #2c3e50; margin-bottom: 10px;">No reviews yet</h3>
                                <p style="color: #666;">Be the first to review this product and help other customers</p>
                            </div>
                        @endforelse
                    </div>
                    
                    @auth
                        <div class="review-form">
                            <h3>Leave a Review</h3>
                            <form action="{{ route('ratings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="form-group">
                                    <label>Your Rating</label>
                                    <div class="rating-input">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                            <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                        @endfor
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="review">Your Review</label>
                                    <textarea class="form-control" id="review" name="review" required minlength="10" placeholder="Share your experience with this product..."></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        </div>
                    @else
                        <div style="text-align: center; padding: 30px; background: rgba(255, 107, 157, 0.05); border-radius: 15px; border: 1px solid rgba(255, 107, 157, 0.1);">
                            <p style="color: #666;">Please <a href="{{ route('login') }}" style="color: #c44569; text-decoration: underline; font-weight: 600;">log in</a> to leave a review.</p>
                        </div>
                    @endauth
                </div>
            </div>
            
            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="related-products">
                    <h2 class="section-title">You May Also Like</h2>
                    <div class="related-products-grid">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="product-card">
                                <div class="product-card-image">
                                    <img src="{{ $relatedProduct->image ? asset('storage/'.$relatedProduct->image) : '/api/placeholder/280/220' }}" alt="{{ $relatedProduct->name }}">
                                </div>
                                <div class="product-card-info">
                                    <h3 class="product-card-name">{{ $relatedProduct->name }}</h3>
                                    <p class="product-card-designer">by {{ optional($relatedProduct->designer)->name ?? 'Unknown Designer' }}</p>
                                    <div class="product-card-price">
                                        @if($relatedProduct->hasDiscount())
                                            <span class="original-price">${{ number_format($relatedProduct->price, 2) }}</span>
                                            <span class="discount-price">${{ number_format($relatedProduct->discounted_price, 2) }}</span>
                                        @else
                                            ${{ number_format($relatedProduct->price, 2) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <a href="{{ route('landing') }}" class="logo" style="color: #fff; font-size: 32px; font-weight: 300; text-decoration: none; letter-spacing: 1px;">Ele<span style="font-weight: 700; background: linear-gradient(45deg, #ff6b9d, #c44569); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">gance</span></a>
                    <p>A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('landing') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}">Products</a></li>
                        <li><a href="{{ route('designers.index') }}">Designers</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <div class="footer-links">
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <i class="fas fa-map-marker-alt" style="margin-right: 15px; color: #ff6b9d;"></i>
                            <span>123 Fashion Street, Amman, Jordan</span>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <i class="fas fa-phone-alt" style="margin-right: 15px; color: #ff6b9d;"></i>
                            <span>+962 77 123 4567</span>
                        </div>
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <i class="fas fa-envelope" style="margin-right: 15px; color: #ff6b9d;"></i>
                            <span>info@elegance.com</span>
                        </div>
                    </div>
                    <div class="newsletter">
                        <form action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="Join our newsletter" required>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Elegance. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });

            // Mobile menu toggle
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navMenu = document.querySelector('nav ul');

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
                });
            }

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

            // Get DOM elements
            const addToCartBtn = document.getElementById('addToCartBtn');
            const addToCartForm = document.getElementById('addToCartForm');
            const confirmationModal = document.getElementById('confirmationModal');
            const continueShoppingBtn = document.getElementById('continueShoppingBtn');
            const sizeError = document.getElementById('size-error');
            
            // Add to cart button click handler
            addToCartBtn.addEventListener('click', function() {
                // Check if size is selected
                const selectedSize = document.getElementById('selected-size').value;
                if (!selectedSize) {
                    sizeError.style.display = 'block';
                    return;
                }
                
                // Hide error message
                sizeError.style.display = 'none';
                
                // Show loading
                showLoading(true);
                
                // Change button text
                addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                addToCartBtn.disabled = true;
                
                // Send form using AJAX
                const formData = new FormData(addToCartForm);
                
                fetch(addToCartForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    showLoading(false);
                    
                    if (data.success) {
                        // Show confirmation modal
                        confirmationModal.style.display = 'flex';
                        
                        // Update cart count in header
                        const cartCount = document.querySelector('.cart-counter');
                        if (cartCount) {
                            cartCount.textContent = data.cartCount || parseInt(cartCount.textContent) + 1;
                        } else {
                            const cartIcon = document.querySelector('.icon-btn[title="Cart"]');
                            if (cartIcon) {
                                const newCounter = document.createElement('span');
                                newCounter.className = 'counter cart-counter';
                                newCounter.textContent = '1';
                                cartIcon.appendChild(newCounter);
                            }
                        }
                        
                        showToast('Product added to cart successfully!');
                    } else {
                        showToast(data.message || 'Error adding product to cart.', 'error');
                        addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                        addToCartBtn.disabled = false;
                    }
                })
                .catch(error => {
                    showLoading(false);
                    console.error('Error:', error);
                    showToast('Error adding product to cart.', 'error');
                    addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                    addToCartBtn.disabled = false;
                });
            });
            
            // Continue shopping button
            continueShoppingBtn.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
                addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                addToCartBtn.disabled = false;
            });
            
            // Size selection
            document.querySelectorAll('.size-option:not(.disabled)').forEach(sizeOption => {
                sizeOption.addEventListener('click', function() {
                    document.querySelectorAll('.size-option').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('selected-size').value = this.dataset.size;
                    sizeError.style.display = 'none';
                });
            });
            
            // Color selection
            document.querySelectorAll('.color-option').forEach(colorOption => {
                colorOption.addEventListener('click', function() {
                    document.querySelectorAll('.color-option').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('selected-color').value = this.dataset.color;
                });
            });

            // Thumbnail gallery functionality
            document.querySelectorAll('.thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Update active state
                    document.querySelectorAll('.thumbnail').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update main image
                    document.getElementById('main-product-image').src = this.dataset.image;
                });
            });
            
            // Quantity input
            const quantityInput = document.getElementById('quantity-input');
            document.getElementById('decrease-qty').addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
            
            document.getElementById('increase-qty').addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue < 10) {
                    quantityInput.value = currentValue + 1;
                }
            });
            
            // Tabs functionality
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Update active tab button
                    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update active tab content
                    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                    document.getElementById(this.dataset.tab + '-tab').classList.add('active');
                });
            });

            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe product cards and other elements
            const animatedElements = document.querySelectorAll('.product-card, .review-card, .tab-content');
            animatedElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(30px)';
                element.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(element);
            });

            // Image zoom effect on hover
            const mainImage = document.querySelector('.main-image img');
            const mainImageContainer = document.querySelector('.main-image');
            
            mainImageContainer.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                
                mainImage.style.transformOrigin = `${x}% ${y}%`;
            });

            mainImageContainer.addEventListener('mouseleave', function() {
                mainImage.style.transformOrigin = 'center center';
            });
        });
    </script>
</body>
</html>