<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $designer->name }} - Fashion Designer Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
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
      margin: 0 20px;
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
    
    /* Breadcrumb */
    .breadcrumb-section {
      padding: 120px 0 30px;
      background: linear-gradient(135deg, rgba(255, 107, 157, 0.05) 0%, rgba(196, 69, 105, 0.05) 100%);
    }
    
    .breadcrumb {
      display: flex;
      align-items: center;
      color: #666;
      font-size: 14px;
    }
    
    .breadcrumb a {
      color: #666;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .breadcrumb a:hover {
      color: #c44569;
    }
    
    .breadcrumb .separator {
      margin: 0 12px;
      color: #ccc;
    }
    
    .breadcrumb .current {
      color: #2c3e50;
      font-weight: 500;
    }
    
    /* Designer Profile */
    .designer-profile {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(196, 69, 105, 0.1);
      margin-bottom: 50px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .profile-banner {
      height: 350px;
      background: linear-gradient(135deg, rgba(255, 107, 157, 0.8) 0%, rgba(196, 69, 105, 0.8) 100%);
      position: relative;
      overflow: hidden;
    }
    
    .profile-banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('/api/placeholder/1200/350') center/cover;
      opacity: 0.3;
    }
    
    .profile-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: 0.3;
    }
    
    .featured-badge {
      position: absolute;
      top: 30px;
      left: 30px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      color: #c44569;
      padding: 12px 25px;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .profile-info {
      display: flex;
      padding: 0 40px 40px;
      position: relative;
      align-items: flex-start;
    }
    
    .profile-avatar {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      border: 6px solid white;
      position: relative;
      margin-top: -90px;
      background: white;
      box-shadow: 0 15px 40px rgba(196, 69, 105, 0.2);
      overflow: hidden;
    }
    
    .profile-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .profile-details {
      padding-left: 40px;
      flex: 1;
      padding-top: 20px;
    }
    
    .profile-name {
      font-size: 36px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #2c3e50;
    }
    
    .profile-specialty {
      color: #c44569;
      margin-bottom: 20px;
      font-size: 18px;
      font-weight: 500;
    }
    
    .profile-bio {
      color: #666;
      margin-bottom: 30px;
      line-height: 1.8;
      font-size: 16px;
      max-width: 600px;
    }
    
    .profile-stats {
      display: flex;
      gap: 40px;
      margin-bottom: 30px;
    }
    
    .profile-stat {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      background: rgba(255, 107, 157, 0.05);
      border-radius: 15px;
      min-width: 120px;
    }
    
    .stat-count {
      font-size: 28px;
      font-weight: 700;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .stat-label {
      font-size: 14px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 5px;
      font-weight: 500;
    }
    
    .profile-social {
      display: flex;
      gap: 20px;
    }
    
    .profile-social a {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: rgba(255, 107, 157, 0.1);
      color: #c44569;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      font-size: 20px;
      text-decoration: none;
    }
    
    .profile-social a:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    .follow-button {
      position: absolute;
      right: 40px;
      top: 40px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      padding: 15px 35px;
      border-radius: 50px;
      text-decoration: none;
      font-size: 16px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    .follow-button:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(196, 69, 105, 0.4);
    }
    
    .follow-button.following {
      background: rgba(255, 255, 255, 0.9);
      color: #c44569;
      border: 2px solid #c44569;
    }
    
    .follow-button.following:hover {
      background: #c44569;
      color: white;
    }
    
    /* Tabs */
    .tabs-container {
      margin-top: 40px;
    }
    
    .tabs-navigation {
      display: flex;
      border-bottom: 2px solid rgba(196, 69, 105, 0.1);
      margin-bottom: 50px;
      gap: 5px;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      border-radius: 15px 15px 0 0;
      padding: 10px;
    }
    
    .tab-button {
      padding: 18px 30px;
      cursor: pointer;
      font-weight: 600;
      border: none;
      background: transparent;
      border-radius: 12px;
      transition: all 0.3s ease;
      color: #666;
      font-size: 16px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .tab-button.active {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    .tab-button:hover:not(.active) {
      background: rgba(255, 107, 157, 0.1);
      color: #c44569;
    }
    
    .tab-content {
      display: none;
      animation: fadeIn 0.5s ease;
    }
    
    .tab-content.active {
      display: block;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .section-title {
      font-size: 32px;
      font-weight: 600;
      margin-bottom: 40px;
      color: #2c3e50;
      position: relative;
      padding-bottom: 15px;
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      width: 80px;
      height: 4px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      bottom: 0;
      left: 0;
      border-radius: 2px;
    }
    
    /* Products Grid */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 40px;
      margin-bottom: 50px;
    }
    
    .product-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .product-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 25px 60px rgba(196, 69, 105, 0.2);
    }
    
    .product-image {
      width: 100%;
      height: 300px;
      overflow: hidden;
      position: relative;
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
      bottom: 20px;
      right: 20px;
      display: flex;
      gap: 12px;
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.3s ease;
    }
    
    .product-card:hover .product-actions {
      opacity: 1;
      transform: translateY(0);
    }
    
    .product-action {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.95);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #c44569;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }
    
    .product-action:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      transform: scale(1.1);
    }
    
    .discount-badge {
      position: absolute;
      top: 20px;
      left: 20px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .product-info {
      padding: 25px;
    }
    
    .product-name {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #2c3e50;
    }
    
    .product-price {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .current-price {
      font-weight: 600;
      font-size: 20px;
      color: #c44569;
    }
    
    .original-price {
      color: #999;
      text-decoration: line-through;
      margin-left: 12px;
      font-size: 16px;
    }
    
    .product-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .product-rating {
      color: #ffc107;
      font-size: 14px;
    }
    
    .product-rating span {
      color: #666;
      margin-left: 8px;
    }
    
    .product-category {
      color: #999;
      font-size: 14px;
      background: rgba(255, 107, 157, 0.1);
      padding: 4px 12px;
      border-radius: 20px;
    }
    
    /* Courses Grid */
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
      gap: 40px;
      margin-bottom: 50px;
    }
    
    .course-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .course-card:hover {
      transform: translateY(-15px);
      box-shadow: 0 25px 60px rgba(196, 69, 105, 0.2);
    }
    
    .course-image {
      width: 100%;
      height: 220px;
      overflow: hidden;
    }
    
    .course-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .course-card:hover .course-image img {
      transform: scale(1.05);
    }
    
    .course-info {
      padding: 25px;
    }
    
    .course-category {
      display: inline-block;
      background: linear-gradient(45deg, rgba(255, 107, 157, 0.2), rgba(196, 69, 105, 0.2));
      color: #c44569;
      padding: 8px 18px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 15px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .course-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 15px;
      line-height: 1.4;
      color: #2c3e50;
    }
    
    .course-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 20px;
      border-top: 2px solid rgba(196, 69, 105, 0.1);
    }
    
    .course-stats {
      display: flex;
      gap: 20px;
      color: #666;
      font-size: 14px;
    }
    
    .course-stat {
      display: flex;
      align-items: center;
    }
    
    .course-stat i {
      margin-right: 8px;
      color: #c44569;
    }
    
    .course-price {
      font-weight: 600;
      font-size: 20px;
      color: #c44569;
    }
    
    /* Events List */
    .events-list {
      margin-bottom: 50px;
    }
    
    .event-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(196, 69, 105, 0.1);
      margin-bottom: 30px;
      display: flex;
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .event-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 25px 60px rgba(196, 69, 105, 0.2);
    }
    
    .event-date {
      width: 120px;
      background: linear-gradient(135deg, #ff6b9d, #c44569);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 25px;
    }
    
    .event-day {
      font-size: 28px;
      font-weight: 700;
    }
    
    .event-month {
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 600;
    }
    
    .event-year {
      font-size: 14px;
      opacity: 0.9;
    }
    
    .event-info {
      flex: 1;
      padding: 25px;
    }
    
    .event-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #2c3e50;
    }
    
    .event-details {
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
    }
    
    .event-location {
      display: flex;
      align-items: center;
      color: #666;
      font-size: 14px;
    }
    
    .event-location i {
      margin-right: 12px;
      color: #c44569;
    }
    
    .event-action {
      margin-left: auto;
      display: flex;
      align-items: center;
      padding: 25px;
    }
    
    .event-button {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      padding: 15px 30px;
      border-radius: 50px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .event-button:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    /* Gallery Grid */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 25px;
      margin-bottom: 50px;
    }
    
    .gallery-item {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 40px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      cursor: pointer;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(15px);
    }
    
    .gallery-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 25px 60px rgba(196, 69, 105, 0.2);
    }
    
    .gallery-image {
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .gallery-item:hover .gallery-image {
      transform: scale(1.05);
    }
    
    /* Contact Section */
    .contact-section {
      background: linear-gradient(135deg, rgba(255, 107, 157, 0.05) 0%, rgba(196, 69, 105, 0.05) 100%);
      border-radius: 25px;
      padding: 50px;
      margin-bottom: 50px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .contact-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
    }
    
    .contact-form .form-group:last-child {
      grid-column: span 2;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 10px;
      font-weight: 600;
      color: #2c3e50;
    }
    
    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid rgba(196, 69, 105, 0.1);
      border-radius: 15px;
      transition: all 0.3s ease;
      font-family: inherit;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #c44569;
      box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
      background: white;
    }
    
    .form-group textarea {
      height: 140px;
      resize: vertical;
    }
    
    .submit-btn {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      padding: 18px 40px;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .submit-btn:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    /* Load More Button */
    .load-more {
      display: flex;
      justify-content: center;
      margin-top: 40px;
    }
    
    .load-more-btn {
      background: rgba(255, 255, 255, 0.9);
      color: #c44569;
      border: 2px solid #c44569;
      padding: 15px 40px;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      backdrop-filter: blur(10px);
    }
    
    .load-more-btn:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    /* Footer */
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
    
    .footer-logo {
      font-size: 28px;
      font-weight: 300;
      margin-bottom: 25px;
      display: inline-block;
      color: white;
      text-decoration: none;
    }
    
    .footer-logo span {
      font-weight: 700;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .footer-desc {
      color: #bdc3c7;
      margin-bottom: 25px;
      line-height: 1.8;
      font-size: 15px;
    }
    
    .footer-social {
      display: flex;
      gap: 15px;
    }
    
    .footer-social a {
      color: #bdc3c7;
      font-size: 20px;
      transition: all 0.3s ease;
      padding: 10px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
    }
    
    .footer-social a:hover {
      color: #ff6b9d;
      background: rgba(255, 107, 157, 0.1);
      transform: translateY(-3px);
    }
    
    .footer-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 15px;
      color: white;
    }
    
    .footer-title::after {
      content: '';
      position: absolute;
      width: 50px;
      height: 3px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      bottom: 0;
      left: 0;
      border-radius: 2px;
    }
    
    .footer-links {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .footer-links li {
      margin-bottom: 12px;
    }
    
    .footer-links a {
      color: #bdc3c7;
      text-decoration: none;
      font-size: 15px;
      transition: all 0.3s ease;
      padding: 5px 0;
      display: inline-block;
    }
    
    .footer-links a:hover {
      color: #ff6b9d;
      transform: translateX(5px);
    }
    
    .footer-contact-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 15px;
      color: #bdc3c7;
    }
    
    .footer-contact-icon {
      margin-right: 15px;
      color: #ff6b9d;
      width: 20px;
    }
    
    .footer-bottom {
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid #455a64;
      color: #95a5a6;
      font-size: 14px;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
      .container {
        width: 95%;
      }
    }
    
    @media (max-width: 992px) {
      .profile-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      
      .profile-details {
        padding-left: 0;
        padding-top: 30px;
      }
      
      .profile-stats {
        justify-content: center;
      }
      
      .profile-social {
        justify-content: center;
      }
      
      .follow-button {
        position: relative;
        right: auto;
        top: auto;
        margin-top: 30px;
      }
      
      .courses-grid {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      }
      
      .event-card {
        flex-direction: column;
      }
      
      .event-date {
        width: 100%;
        flex-direction: row;
        justify-content: space-around;
        padding: 20px;
      }
      
      .event-day, .event-month, .event-year {
        font-size: 18px;
      }
      
      .event-action {
        padding: 20px 25px;
      }
    }
    
    @media (max-width: 768px) {
      nav ul {
        display: none;
      }
      
      .header-icons {
        display: none;
      }
      
      .profile-name {
        font-size: 28px;
      }
      
      .profile-stats {
        flex-wrap: wrap;
        gap: 20px;
      }
      
      .profile-stat {
        min-width: 100px;
        padding: 15px;
      }
      
      .tabs-navigation {
        flex-wrap: wrap;
        gap: 10px;
      }
      
      .tab-button {
        flex: 1;
        padding: 15px 20px;
        font-size: 14px;
        text-align: center;
        min-width: 120px;
      }
      
      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      }
      
      .contact-form {
        grid-template-columns: 1fr;
      }
      
      .contact-form .form-group:last-child {
        grid-column: span 1;
      }
      
      .contact-section {
        padding: 30px;
      }
    }
    
    @media (max-width: 576px) {
      .profile-avatar {
        width: 140px;
        height: 140px;
        margin-top: -70px;
      }
      
      .profile-info {
        padding: 0 20px 30px;
      }
      
      .profile-details {
        padding-top: 20px;
      }
      
      .profile-name {
        font-size: 24px;
      }
      
      .section-title {
        font-size: 24px;
      }
      
      .products-grid, 
      .gallery-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
      }
      
      .courses-grid {
        grid-template-columns: 1fr;
      }
      
      .tabs-navigation {
        padding: 5px;
      }
      
      .tab-button {
        padding: 12px 15px;
        font-size: 12px;
      }
      
      .contact-section {
        padding: 20px;
      }
      
      .footer-content {
        flex-direction: column;
      }
    }
    
    /* Mobile Menu */
    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #2c3e50;
    }
    
    @media (max-width: 768px) {
      .mobile-menu-btn {
        display: block;
      }
    }
    
    /* Scroll animations */
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-slide-up {
      animation: slideInUp 0.6s ease forwards;
    }
    
    /* Success Message Styles */
    .success-message {
      background: linear-gradient(45deg, rgba(76, 175, 80, 0.1), rgba(139, 195, 74, 0.1));
      border: 2px solid #4caf50;
      color: #2e7d32;
      padding: 20px;
      border-radius: 15px;
      margin-bottom: 25px;
      text-align: center;
      font-weight: 500;
    }
    
    .success-message i {
      color: #4caf50;
      font-size: 20px;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="container">
      <div class="header-content">
        <a href="/" class="logo">Ele<span>gance</span></a>
        
        <nav>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/products">Products</a></li>
            <li><a href="/designers" class="active">Designers</a></li>
            <li><a href="/courses">Courses</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </nav>
        
        <div class="header-icons">
          <a href="#" class="icon-btn" title="Favorites">
            <i class="fas fa-heart"></i>
            <span class="counter">3</span>
          </a>
          <a href="#" class="icon-btn" title="Cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="counter">2</span>
          </a>
        </div>

        <button class="mobile-menu-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>
  
  <!-- Breadcrumb -->
  <div class="breadcrumb-section">
    <div class="container">



    <div class="breadcrumb">
        <a href="/">Home</a>
        <span class="separator"><i class="fas fa-chevron-right"></i></span>
        <a href="/designers">Designers</a>
        <span class="separator"><i class="fas fa-chevron-right"></i></span>
        <span class="current">{{ $designer->name }}</span>
      </div>
    </div>
  </div>
  
  <div class="container">
    <!-- Designer Profile -->
    <div class="designer-profile">
      <div class="profile-banner">
        <img src="/api/placeholder/1200/350" alt="Designer Banner">
        @if($designer->is_featured)
        <div class="featured-badge">Featured Designer</div>
        @endif
      </div>
      
      <div class="profile-info">
        <div class="profile-avatar">
          <img src="{{ $designer->profile_picture ? asset('storage/' . $designer->profile_picture) : '/api/placeholder/180/180' }}" alt="{{ $designer->name }}">
        </div>
        
        <div class="profile-details">
          <h1 class="profile-name">{{ $designer->name }}</h1>
          <p class="profile-specialty">{{ $designer->specialty ?? 'Fashion Designer' }}</p>
          <p class="profile-bio">{{ $designer->bio ?? 'A passionate fashion designer dedicated to creating timeless and elegant pieces that empower women to express their unique style with confidence.' }}</p>
          
          <div class="profile-stats">
            <div class="profile-stat">
              <span class="stat-count">{{ $designer->products->count() }}</span>
              <span class="stat-label">Products</span>
            </div>
            <div class="profile-stat">
              <span class="stat-count">{{ $designer->courses->count() }}</span>
              <span class="stat-label">Courses</span>
            </div>
            
            </div>
          </div>
          
          
        </div>
        
       
      </div>
    </div>
    
    <!-- Tabs -->
    <div class="tabs-container">
      <div class="tabs-navigation">
        <button class="tab-button active" data-tab="products">Products</button>
        <button class="tab-button" data-tab="courses">Courses</button>
        
        <button class="tab-button" data-tab="contact">Contact</button>
      </div>
      
      <!-- Products Tab -->
      <div class="tab-content active" id="products-tab">
        <h2 class="section-title">Designer Products</h2>
        
        <div class="products-grid">
          @foreach($designer->products as $product)
          <div class="product-card">
            <div class="product-image">
              <img src="{{ $product->image ? asset('storage/' . $product->image) : '/api/placeholder/300/300' }}" alt="{{ $product->name }}">
              
              @if($product->hasDiscount())
              <div class="discount-badge">Sale</div>
              @endif
              
              <div class="product-actions">
                <a href="{{ route('products.show', $product->id) }}" class="product-action"><i class="fas fa-eye"></i></a>
                <a href="#" class="product-action"><i class="fas fa-shopping-cart"></i></a>
                <a href="#" class="product-action"><i class="far fa-heart"></i></a>
              </div>
            </div>
            
            <div class="product-info">
              <h3 class="product-name">{{ $product->name }}</h3>
              
              <div class="product-price">
                @if($product->hasDiscount())
                <span class="current-price">${{ number_format($product->discounted_price, 2) }}</span>
                <span class="original-price">${{ number_format($product->price, 2) }}</span>
                @else
                <span class="current-price">${{ number_format($product->price, 2) }}</span>
                @endif
              </div>
              
              <div class="product-meta">
                <div class="product-rating">
                  @php
                    $avgRating = $product->ratings->avg('rating') ?? 0;
                    $roundedRating = round($avgRating);
                  @endphp
                  
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $roundedRating)
                      <i class="fas fa-star"></i>
                    @else
                      <i class="far fa-star"></i>
                    @endif
                  @endfor
                  
                  <span>({{ $product->ratings->count() }})</span>
                </div>
                
                <div class="product-category">{{ $product->category }}</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        @if($designer->products->count() > 8)
        <div class="load-more">
          <button class="load-more-btn">Load More Products</button>
        </div>
        @endif
      </div>
      
      <!-- Courses Tab -->
      <div class="tab-content" id="courses-tab">
        <h2 class="section-title">Designer Courses</h2>
        
        @if($designer->courses->count() > 0)
        <div class="courses-grid">
          @foreach($designer->courses as $course)
          <div class="course-card">
            <div class="course-image">
              <img src="{{ $course->image ? asset('storage/' . $course->image) : '/api/placeholder/380/220' }}" alt="{{ $course->title }}">
            </div>
            
            <div class="course-info">
              <span class="course-category">{{ $course->category->name ?? 'Fashion Design' }}</span>
              <h3 class="course-title">{{ $course->title }}</h3>
              <p>{{ \Illuminate\Support\Str::limit($course->description, 100) }}</p>
              
              <div class="course-meta">
                <div class="course-stats">
                  <div class="course-stat">
                    <i class="fas fa-user"></i> {{ $course->enrollments->count() }}
                  </div>
                  <div class="course-stat">
                    <i class="fas fa-clock"></i> {{ $course->duration ?? '12h' }}
                  </div>
                  <div class="course-stat">
                    <i class="fas fa-film"></i> {{ $course->lessons_count ?? '24' }}
                  </div>
                </div>
                
                <div class="course-price">${{ number_format($course->price, 2) }}</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px; color: #666;">
          <i class="fas fa-graduation-cap" style="font-size: 64px; color: #e1e8ed; margin-bottom: 20px;"></i>
          <h3 style="font-size: 24px; margin-bottom: 10px;">No Courses Yet</h3>
          <p>This designer hasn't published any courses yet. Check back soon for new learning opportunities!</p>
        </div>
        @endif
      </div>
      
      <!-- Contact Tab -->
      <div class="tab-content" id="contact-tab">
        <h2 class="section-title">Contact Designer</h2>
        
        <div class="contact-section">
          <form class="contact-form">
            <div class="form-group">
              <label for="name">Your Name</label>
              <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
              <label for="email">Your Email</label>
              <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" name="subject" required>
            </div>
            
            <div class="form-group">
              <label for="message">Your Message</label>
              <textarea id="message" name="message" required placeholder="Tell us about your project or inquiry..."></textarea>
            </div>
            
            <div class="form-group">
              <button type="submit" class="submit-btn">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <a href="/" class="footer-logo">Ele<span>gance</span></a>
          <p class="footer-desc">A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.</p>
          <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
          </div>
        </div>
        
        <div class="footer-column">
          <h3 class="footer-title">Quick Links</h3>
          <ul class="footer-links">
            <li><a href="/">Home</a></li>
            <li><a href="/products">Products</a></li>
            <li><a href="/designers">Designers</a></li>
            <li><a href="/courses">Courses</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </div>
        
        <div class="footer-column">
          <h3 class="footer-title">Contact Info</h3>
          <div class="footer-contact-item">
            <div class="footer-contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>123 Fashion Street, Amman, Jordan</div>
          </div>
          <div class="footer-contact-item">
            <div class="footer-contact-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div>+962 77 123 4567</div>
          </div>
          <div class="footer-contact-item">
            <div class="footer-contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div>info@elegance.com</div>
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

      // Tab navigation functionality
      document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
          // Remove active class from all tabs
          document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('active');
          });
          
          // Hide all tab content
          document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
          });
          
          // Add active class to clicked tab
          this.classList.add('active');
          
          // Show corresponding tab content
          const tabId = this.getAttribute('data-tab');
          document.getElementById(tabId + '-tab').classList.add('active');
        });
      });
      
      // Follow button functionality
      const followButton = document.querySelector('.follow-button');
      followButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        if (this.classList.contains('following')) {
          this.textContent = 'Follow';
          this.classList.remove('following');
        } else {
          this.textContent = 'Following';
          this.classList.add('following');
        }
      });
      
      // Load more products functionality
      const loadMoreBtn = document.querySelector('.load-more-btn');
      if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
          this.textContent = 'Loading...';
          this.style.opacity = '0.7';
          
          setTimeout(() => {
            this.textContent = 'No more products to load';
            this.disabled = true;
            this.style.opacity = '0.5';
          }, 1500);
        });
      }
      
      // Contact form submission
      const contactForm = document.querySelector('.contact-form');
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const name = this.querySelector('#name').value;
        const email = this.querySelector('#email').value;
        const subject = this.querySelector('#subject').value;
        const message = this.querySelector('#message').value;
        
        // Validate form
        if (!name || !email || !subject || !message) {
          alert('Please fill all fields');
          return;
        }
        
        // Create success message
        const successMessage = document.createElement('div');
        successMessage.className = 'success-message';
        successMessage.innerHTML = '<i class="fas fa-check-circle"></i> Your message has been sent successfully! We\'ll get back to you soon.';
        
        // Add success message to the form
        this.parentNode.insertBefore(successMessage, this);
        
        // Reset form
        this.reset();
        
        // Remove success message after 5 seconds
        setTimeout(() => {
          successMessage.remove();
        }, 5000);
      });

      // Gallery lightbox effect
      const galleryItems = document.querySelectorAll('.gallery-item');
      galleryItems.forEach(item => {
        item.addEventListener('click', function() {
          // Add lightbox functionality here if needed
          console.log('Gallery item clicked');
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
            entry.target.classList.add('animate-slide-up');
          }
        });
      }, observerOptions);

      // Observe cards for animation
      const cards = document.querySelectorAll('.product-card, .course-card, .event-card, .gallery-item');
      cards.forEach(card => {
        observer.observe(card);
      });

      // Mobile menu toggle
      const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
      const navMenu = document.querySelector('nav ul');

      if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
          navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
        });
      }
    });
  </script>
</body>
</html>