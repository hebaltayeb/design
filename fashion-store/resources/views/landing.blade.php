<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Elegance') }} - Fashion Design Platform</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    
    /* Header Styles */
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
    
    nav ul li a:hover {
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
    
    nav ul li a:hover::after {
      width: 100%;
    }
    
    .cta-buttons {
      display: flex;
      gap: 15px;
    }
    
    .btn {
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .btn-outline {
      border: 2px solid #2c3e50;
      color: #2c3e50;
      background: transparent;
    }
    
    .btn-outline:hover {
      background: #2c3e50;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
    }
    
    .btn-primary {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border: 2px solid transparent;
    }
    
    .btn-primary:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    .btn-secondary {
      background-color: transparent;
      color: #c44569;
      border: 2px solid #c44569;
    }
    
    .btn-secondary:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border-color: transparent;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #2c3e50;
    }
    
    /* Header Icons */
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
    
    /* Hero Section Styles - لا تعديل هنا */
    .hero {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      padding-top: 80px;
      background: linear-gradient(rgba(255,245,247,0.85), rgba(240,248,255,0.85)), 
                  url('https://cdn.clo3d.com/resource/images/artwork/clo/whyclo/watermark_whyclo_showcase_1_v2.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      overflow: hidden;
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 650px;
      animation: fadeInUp 1s ease-out;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 40px;
      border-radius: 15px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .hero-content h1 {
      font-size: 52px;
      font-weight: 300;
      margin-bottom: 25px;
      color: #2c3e50;
      line-height: 1.2;
      text-shadow: 2px 2px 4px rgba(255,255,255,0.8);
    }
    
    .hero-content h1 strong {
      font-weight: 700;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .hero-content p {
      font-size: 20px;
      color: #333;
      margin-bottom: 35px;
      line-height: 1.7;
      font-weight: 500;
      text-shadow: 1px 1px 2px rgba(255,255,255,0.8);
    }
    
    .hero-cta {
      display: flex;
      gap: 25px;
      flex-wrap: wrap;
    }
    
    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateY(-50%) translateX(30px);
      }
      to {
        opacity: 1;
        transform: translateY(-50%) translateX(0);
      }
    }
    
    /* Features Section */
    .features {
      padding: 120px 0;
      background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    }
    
    .section-header {
      text-align: center;
      margin-bottom: 80px;
    }
    
    .section-header h2 {
      font-size: 42px;
      font-weight: 300;
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
      padding-bottom: 20px;
      color: #2c3e50;
    }
    
    .section-header h2::after {
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
    
    .section-header p {
      font-size: 20px;
      color: #555;
      max-width: 700px;
      margin: 0 auto;
      font-weight: 400;
    }
    
    .features-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 40px;
    }
    
    .feature-card {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 40px 30px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .feature-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
    }
    
    .feature-icon {
      font-size: 56px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 25px;
    }
    
    .feature-card h3 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 18px;
      color: #2c3e50;
    }
    
    .feature-card p {
      font-size: 16px;
      color: #666;
      line-height: 1.6;
    }
    
    /* Designers Section */
    .designers {
      padding: 120px 0;
      background: linear-gradient(135deg, #f8f9fa 0%, #fff5f7 100%);
    }
    
    .designers-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 40px;
    }
    
    .designer-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .designer-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
    }
    
    .designer-image {
      width: 100%;
      height: 320px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    
    .designer-card:hover .designer-image {
      transform: scale(1.05);
    }
    
    .designer-info {
      padding: 30px;
      text-align: center;
    }
    
    .designer-info h3 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #2c3e50;
    }
    
    .designer-info span {
      font-size: 16px;
      color: #666;
      display: block;
      margin-bottom: 20px;
    }
    
    .designer-social {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 20px;
    }
    
    .designer-social a {
      color: #666;
      font-size: 20px;
      transition: all 0.3s ease;
      padding: 8px;
      border-radius: 50%;
    }
    
    .designer-social a:hover {
      color: #c44569;
      background: rgba(255, 107, 157, 0.1);
      transform: translateY(-2px);
    }
    
    .designer-action {
      display: inline-block;
      color: #c44569;
      text-decoration: none;
      font-weight: 600;
      padding: 10px 20px;
      border: 2px solid #c44569;
      border-radius: 25px;
      transition: all 0.3s ease;
    }
    
    .designer-action:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border-color: transparent;
      transform: translateY(-2px);
    }
    
    /* Products Section */
    .products {
      padding: 120px 0;
      background: linear-gradient(135deg, #fff 0%, #f0f8ff 100%);
    }
    
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 40px;
    }
    
    .product-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      position: relative;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .product-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
    }
    
    .product-image {
      position: relative;
      width: 100%;
      height: 300px;
      overflow: hidden;
    }
    
    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image img {
      transform: scale(1.05);
    }
    
    .product-actions {
      position: absolute;
      top: 15px;
      right: 15px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      opacity: 0;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      z-index: 10;
    }
    
    .product-card:hover .product-actions {
      opacity: 1;
      transform: translateY(0);
    }
    
    .action-btn {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #2c3e50;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .action-btn:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      transform: scale(1.1);
    }
    
    .action-btn.toggle-favorite.favorited {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
    }
    
    .product-action-form {
      display: contents;
    }
    
    .product-info {
      padding: 25px;
    }
    
    .product-name {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #2c3e50;
    }
    
    .product-designer {
      font-size: 14px;
      color: #666;
      margin-bottom: 15px;
    }
    
    .product-price {
      font-weight: 700;
      font-size: 18px;
      color: #2c3e50;
    }
    
    .original-price {
      text-decoration: line-through;
      color: #999;
      margin-right: 8px;
      font-weight: normal;
    }
    
    .discount-price {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .view-all-btn {
      display: flex;
      justify-content: center;
      margin-top: 60px;
    }
    
    /* Courses Section */
    .courses {
      padding: 120px 0;
      background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    }
    
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 40px;
    }
    
    .course-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .course-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
    }
    
    .course-image {
      width: 100%;
      height: 220px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    
    .course-card:hover .course-image {
      transform: scale(1.05);
    }
    
    .course-info {
      padding: 25px;
    }
    
    .course-category {
      display: inline-block;
      padding: 6px 15px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 15px;
      letter-spacing: 0.5px;
    }
    
    .course-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 15px;
      color: #2c3e50;
    }
    
    .course-instructor {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .instructor-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 12px;
    }
    
    .instructor-name {
      font-size: 14px;
      color: #666;
    }
    
    .course-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid rgba(196, 69, 105, 0.1);
      padding-top: 20px;
    }
    
    .course-price {
      font-weight: 700;
      font-size: 20px;
      color: #2c3e50;
    }
    
    .course-action {
      color: #c44569;
      text-decoration: none;
      font-weight: 600;
      padding: 8px 16px;
      border: 2px solid #c44569;
      border-radius: 20px;
      transition: all 0.3s ease;
    }
    
    .course-action:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border-color: transparent;
      transform: translateY(-2px);
    }
    
    /* CTA Section */
    .cta {
      padding: 100px 0;
      background: linear-gradient(135deg, rgba(255, 107, 157, 0.1) 0%, rgba(196, 69, 105, 0.1) 100%);
      text-align: center;
    }
    
    .cta h2 {
      font-size: 42px;
      font-weight: 300;
      margin-bottom: 25px;
      color: #2c3e50;
    }
    
    .cta p {
      font-size: 20px;
      color: #555;
      max-width: 700px;
      margin: 0 auto 40px;
      line-height: 1.6;
    }
    
    /* Footer */
    footer {
      background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
      color: #ecf0f1;
      padding: 80px 0 30px;
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
    
    /* User Menu Styles */
    .user-menu {
      position: relative;
      display: inline-block;
    }
    
    .user-menu-toggle {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      min-width: 160px;
      justify-content: space-between;
    }
    
    .user-menu-toggle i.fa-chevron-down {
      font-size: 12px;
      transition: transform 0.3s ease;
    }
    
    .user-menu.active .user-menu-toggle i.fa-chevron-down {
      transform: rotate(180deg);
    }
    
    .user-dropdown {
      position: absolute;
      top: 100%;
      right: 0;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.2);
      min-width: 200px;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      margin-top: 8px;
    }
    
    .user-dropdown.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .dropdown-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      color: #2c3e50;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s ease;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
    }
    
    .dropdown-item:hover {
      background: rgba(196, 69, 105, 0.1);
      color: #c44569;
    }
    
    .dropdown-item:first-child {
      border-radius: 12px 12px 0 0;
    }
    
    .dropdown-item:last-child {
      border-radius: 0 0 12px 12px;
    }
    
    .dropdown-divider {
      height: 1px;
      background: rgba(196, 69, 105, 0.1);
      margin: 8px 0;
    }
    
    .dropdown-form {
      margin: 0;
    }
    
    .logout-btn {
      color: #e74c3c;
      font-family: inherit;
    }
    
    .logout-btn:hover {
      background: rgba(231, 76, 60, 0.1);
      color: #c0392b;
    }
    
    /* Responsive Styles */
    @media (max-width: 992px) {
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .hero-content h1 {
        font-size: 40px;
      }
      
      .section-header h2 {
        font-size: 36px;
      }
    }
    
    @media (max-width: 768px) {
      nav ul {
        display: none;
      }
      
      .mobile-menu-btn {
        display: block;
      }
      
      .hero-content {
        text-align: center;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        padding: 30px;
        border-radius: 10px;
      }
      
      .hero-cta {
        justify-content: center;
      }
      
      .features-grid {
        grid-template-columns: 1fr;
      }
      
      .header-icons {
        display: none;
      }
      
      .section-header h2 {
        font-size: 32px;
      }
      
      .cta h2 {
        font-size: 36px;
      }
    }
    
    @media (max-width: 576px) {
      .header-content {
        padding: 15px 0;
      }
      
      .cta-buttons {
        display: none;
      }
      
      .logo {
        font-size: 28px;
      }
      
      .hero-content h1 {
        font-size: 32px;
      }
      
      .hero-content p {
        font-size: 16px;
      }
      
      .section-header h2 {
        font-size: 28px;
      }
      
      .section-header p {
        font-size: 16px;
      }
      
      .features {
        padding: 80px 0;
      }
      
      .designers, .products, .courses {
        padding: 80px 0;
      }
      
      .cta {
        padding: 60px 0;
      }
      
      .cta h2 {
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
            <li><a href="{{ route('landing') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('designers.index') }}">{{ __('Designers') }}</a></li>
            <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
            
          </ul>
        </nav>
        
        <div class="header-icons">
          <a href="{{ route('favorites.index') }}" class="icon-btn" title="Favorites">
            <i class="fas fa-heart"></i>
            @if(auth()->user() && auth()->user()->favorites()->count() > 0)
              <span class="counter favorites-counter">{{ auth()->user()->favorites()->count() }}</span>
            @endif
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
            @if(auth()->user()->role === 'designer' || auth()->user()->is_designer)
              <a href="{{ route('designer.dashboard') }}" class="btn btn-outline">{{ __('Designer Dashboard') }}</a>
            @elseif(in_array(auth()->user()->role, ['admin', 'super_admin']))
              <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">{{ __('Admin Dashboard') }}</a>
            @else
              <!-- User Menu -->
              <div class="user-menu">
                <button class="btn btn-outline user-menu-toggle" onclick="toggleUserMenu()">
                  <i class="fas fa-user"></i>
                  {{ auth()->user()->name }}
                  <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-dropdown" id="userDropdown">
                  <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-user-edit"></i>
                    {{ __('Profile') }}
                  </a>
                  
                  <a href="{{ route('favorites.index') }}" class="dropdown-item">
                    <i class="fas fa-heart"></i>
                    {{ __('Favorites') }}
                  </a>
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('logout') }}" class="dropdown-form">
                    @csrf
                    <button type="submit" class="dropdown-item logout-btn">
                      <i class="fas fa-sign-out-alt"></i>
                      {{ __('Logout') }}
                    </button>
                  </form>
                </div>
              </div>
            @endif
          @else
            <a href="{{ route('login') }}" class="btn btn-outline">{{ __('Sign In') }}</a>
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Create Account') }}</a>
          @endauth
        </div>

        <button class="mobile-menu-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="container">
      <div class="hero-content">
        <h1>{{ __('Discover Your') }} <strong>{{ __('Fashion Style') }}</strong></h1>
        <p>{{ __('Where creativity meets elegance. Explore unique designs from talented designers, and learn the art of fashion through our exclusive courses.') }}</p>
        <div class="hero-cta">
          <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Explore Collection') }}</a>
          <a href="{{ route('designers.index') }}" class="btn btn-secondary">{{ __('Meet Designers') }}</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="container">
      <div class="section-header">
        <h2>{{ __('Why Choose Us?') }}</h2>
        <p>{{ __('We offer a unique experience combining creativity, elegance, and privacy') }}</p>
      </div>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-tshirt"></i>
          </div>
          <h3>{{ __('Exclusive Designs') }}</h3>
          <p>{{ __('Unique designs from professional designers that match your taste and personality.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-sliders-h"></i>
          </div>
          <h3>{{ __('Size Customization') }}</h3>
          <p>{{ __('Size customization options (S, M, L, XL) to fit all body types.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h3>{{ __('Educational Courses') }}</h3>
          <p>{{ __('Outstanding educational content through fashion design courses.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <h3>{{ __('Exclusive Fashion Shows') }}</h3>
          <p>{{ __('Exclusive fashion shows for designers to showcase their latest creations.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <h3>{{ __('Seamless Shopping') }}</h3>
          <p>{{ __('Easy and smooth shopping experience with multiple payment options.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-filter"></i>
          </div>
          <h3>{{ __('Product Filtering') }}</h3>
          <p>{{ __('Filter products by price, color, and bestsellers.') }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Designers Section -->
  <section class="designers" id="designers">
    <div class="container">
      <div class="section-header">
        <h2>{{ __('Featured Designers') }}</h2>
        <p>{{ __('Meet our elite fashion designers in the fashion world') }}</p>
      </div>
      <div class="designers-grid">
        @foreach($designers as $designer)
        <div class="designer-card">
          <img src="{{ $designer->profile_picture ? asset('storage/'.$designer->profile_picture) : '/api/placeholder/400/300' }}" 
               alt="{{ $designer->name }}" class="designer-image">
          <div class="designer-info">
            <h3>{{ $designer->name }}</h3>
            <span>{{ $designer->bio ? \Illuminate\Support\Str::limit($designer->bio, 30) : 'Fashion Designer' }}</span>
            
            <a href="{{ route('products.index', ['designer' => $designer->id]) }}" class="designer-action">{{ __('View Designs') }}</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section class="products" id="products">
  <div class="container">
    <div class="section-header">
      <h2>{{ __('Top Products') }}</h2>
      <p>{{ __('Explore our best-selling exclusive designs') }}</p>
    </div>
    <div class="products-grid">
      @foreach($topProducts as $product)
      <div class="product-card">
        <div class="product-image">
          <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/300/280' }}" alt="{{ $product->name }}">
          
          <div class="product-actions">
            <a href="{{ route('products.show', $product->id) }}" class="action-btn" title="View Details">
              <i class="fas fa-eye"></i>
            </a>
            
            <form action="{{ route('cart.add') }}" method="POST" class="product-action-form">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">
              <input type="hidden" name="size" value="M">
              <input type="hidden" name="quantity" value="1">
              <button type="submit" class="action-btn add-to-cart" title="Add to Cart">
                <i class="fas fa-shopping-cart"></i>
              </button>
            </form>
            
            @auth
              <form action="{{ route('favorites.toggle') }}" method="POST" class="product-action-form favorite-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="action-btn toggle-favorite {{ auth()->user()->hasFavorited($product->id) ? 'favorited' : '' }}"
                        title="{{ auth()->user()->hasFavorited($product->id) ? 'Remove from Favorites' : 'Add to Favorites' }}">
                  <i class="fas fa-heart"></i>
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" class="action-btn" title="Add to Favorites">
                <i class="fas fa-heart"></i>
              </a>
            @endauth
          </div>
        </div>
        <div class="product-info">
          <h3 class="product-name">{{ $product->name }}</h3>
          <p class="product-designer">{{ __('Design by') }}:  <a href="{{ route('designers.show', $product->designer->id) }}" class="designer-link" style="color: #c44569; text-decoration: none; hover: text-decoration: underline;">
           
              {{ $product->designer->name }}
            </a>
          </p>
          <span class="product-price">
            @if($product->hasDiscount())
              <span class="original-price">${{ number_format($product->price, 2) }}</span>
              <span class="discount-price">${{ number_format($product->discounted_price, 2) }}</span>
            @else
              ${{ number_format($product->price, 2) }}
            @endif
          </span>
        </div>
      </div>
      @endforeach
    </div>
    <div class="view-all-btn">
      <a href="{{ route('products.index') }}" class="btn btn-outline">{{ __('View All Products') }}</a>
    </div>
  </div>
</section>

  <!-- Courses Section -->
  <section class="courses" id="courses">
    <div class="container">
      <div class="section-header">
        <h2>{{ __('Featured Courses') }}</h2>
        <p>{{ __('Learn fashion design from our professional designers') }}</p>
      </div>
      <div class="courses-grid">
        @foreach($featuredCourses as $course)
        <div class="course-card">
          <img src="{{ $course->image ? asset('storage/'.$course->image) : '/api/placeholder/400/200' }}" alt="{{ $course->title }}" class="course-image">
          <div class="course-info">
            <span class="course-category">{{ $course->category ? $course->category->name : 'Fashion Design' }}</span>
            <h3 class="course-title">{{ $course->title }}</h3>
            <div class="course-instructor">
              <img src="/api/placeholder/45/45" alt="Instructor" class="instructor-avatar">
              <span class="instructor-name">{{ __('Professional Instructor') }}</span>
            </div>
            <div class="course-meta">
              <span class="course-price">${{ number_format($course->price, 2) }}</span>
              <a href="{{ route('courses.show', $course->id) }}" class="course-action">{{ __('Learn More') }}</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="view-all-btn">
        <a href="{{ route('courses.index') }}" class="btn btn-outline">{{ __('View All Courses') }}</a>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta" id="contact">
    <div class="container">
      <h2>{{ __('Start Your Fashion Journey Today') }}</h2>
      <p>{{ __('Join our platform to explore exclusive designs, connect with talented designers, and learn fashion design skills') }}</p>
      <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Create Account') }}</a>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <h3>{{ __('About Elegance') }}</h3>
          <p>{{ __('A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.') }}</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-column">
          <h3>{{ __('Quick Links') }}</h3>
          <ul class="footer-links">
            <li><a href="{{ route('landing') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('designers.index') }}">{{ __('Designers') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
            <li><a href="#contact">{{ __('Contact') }}</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>{{ __('Contact Info') }}</h3>
          <ul class="footer-links">
            <li><i class="fas fa-map-marker-alt"></i> {{ __('123 Fashion Street, Amman, Jordan') }}</li>
            <li><i class="fas fa-phone"></i> +962 77 123 4567</li>
            <li><i class="fas fa-envelope"></i> info@elegance.com</li>
          </ul>
          <div class="newsletter">
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
              @csrf
              <input type="email" name="email" placeholder="{{ __('Join our newsletter') }}">
              <button type="submit">{{ __('Subscribe') }}</button>
            </form>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} {{ __('Elegance. All Rights Reserved.') }}</p>
      </div>
    </div>
  </footer>

  <script>
    // Scroll header effect
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

    mobileMenuBtn.addEventListener('click', function() {
      navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === "#") return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 80,
            behavior: 'smooth'
          });
          
          // Close mobile menu after clicking
          if (window.innerWidth < 768) {
            navMenu.style.display = 'none';
          }
        }
      });
    });

    // AJAX functionality for favorite toggle
    document.addEventListener('DOMContentLoaded', function() {
      const favoritesForms = document.querySelectorAll('.favorite-form');
      
      favoritesForms.forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const formData = new FormData(this);
          const button = this.querySelector('.toggle-favorite');
          const productId = formData.get('product_id');
          
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
            if (data.status === 'success') {
              // Toggle the button appearance
              button.classList.toggle('favorited');
              
              // Update tooltip/title
              if (button.classList.contains('favorited')) {
                button.setAttribute('title', 'Remove from Favorites');
              } else {
                button.setAttribute('title', 'Add to Favorites');
              }
              
              // Update favorites counter in navbar if it exists
              const counter = document.querySelector('.favorites-counter');
              if (counter) {
                // If favorites count is 0, remove the counter
                if (data.count === 0) {
                  counter.remove();
                } else {
                  counter.textContent = data.count;
                }
              } else if (data.count > 0) {
                // If counter doesn't exist but count is > 0, create counter
                const favoritesIcon = document.querySelector('.icon-btn[title="Favorites"]');
                if (favoritesIcon) {
                  const newCounter = document.createElement('span');
                  newCounter.className = 'counter favorites-counter';
                  newCounter.textContent = data.count;
                  favoritesIcon.appendChild(newCounter);
                  
                  // Also set the heart icon color
                  favoritesIcon.querySelector('i').style.color = '#ff5b79';
                }
              }
              
              // Optional: Show a toast notification
              if (typeof showToast === 'function') {
                showToast(data.message);
              }
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
        });
      });
    });
    
    // User menu toggle functionality
    function toggleUserMenu() {
      const dropdown = document.getElementById('userDropdown');
      const userMenu = document.querySelector('.user-menu');
      
      dropdown.classList.toggle('show');
      userMenu.classList.toggle('active');
    }
    
    // Close user menu when clicking outside
    document.addEventListener('click', function(event) {
      const userMenu = document.querySelector('.user-menu');
      const dropdown = document.getElementById('userDropdown');
      
      if (userMenu && !userMenu.contains(event.target)) {
        dropdown.classList.remove('show');
        userMenu.classList.remove('active');
      }
    });
    
    // Close user menu on scroll
    window.addEventListener('scroll', function() {
      const dropdown = document.getElementById('userDropdown');
      const userMenu = document.querySelector('.user-menu');
      
      if (dropdown && dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        userMenu.classList.remove('active');
      }
    });
  </script>
</body>
</html>