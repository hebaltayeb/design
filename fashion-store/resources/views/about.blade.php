

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Fashion Design Website</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #333;
      line-height: 1.6;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    header {
      text-align: center;
      padding: 30px 0;
    }
    
    h1 {
      color: #000;
      font-size: 36px;
      font-weight: 300;
      text-transform: uppercase;
      letter-spacing: 3px;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }
    
    h1:after {
      content: '';
      position: absolute;
      width: 80px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .about-content {
      display: flex;
      flex-direction: column;
      gap: 60px;
      margin: 60px 0;
    }
    
    .section {
      display: flex;
      flex-direction: row;
      gap: 50px;
      align-items: center;
    }
    
    .section:nth-child(even) {
      flex-direction: row-reverse;
    }
    
    .section-text {
      flex: 1;
    }
    
    .section-media {
      flex: 1;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      position: relative;
      height: 400px;
      overflow: hidden;
    }
    
    h2 {
      color: #000;
      font-size: 28px;
      font-weight: 400;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 12px;
    }
    
    h2:after {
      content: '';
      position: absolute;
      width: 50px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 0;
    }
    
    p {
      margin-bottom: 20px;
      font-weight: 300;
      line-height: 1.8;
      font-size: 16px;
    }
    
    .highlight {
      color: #000;
      font-weight: 500;
    }
    
    .feature-list {
      padding: 0;
      margin: 20px 0;
      list-style-type: none;
    }
    
    .feature-list li {
      padding: 10px 0 10px 35px;
      position: relative;
      font-weight: 300;
      font-size: 16px;
    }
    
    .feature-list li:before {
      content: '●';
      color: #ffd1dc;
      position: absolute;
      left: 0;
      font-size: 18px;
    }
    
    .designers-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 40px;
      margin: 50px 0;
    }
    
    .designer-card {
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
      padding: 30px;
      border-radius: 5px;
    }
    
    .designer-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .designer-img {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 20px;
      border: 2px solid #f0f0f0;
    }
    
    .designer-name {
      font-size: 22px;
      margin: 0 0 8px;
      font-weight: 500;
    }
    
    .designer-specialty {
      font-size: 16px;
      color: #666;
      margin: 0 0 20px;
    }
    
    .btn {
      display: inline-block;
      background-color: #000;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      font-size: 15px;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
    }
    
    .btn:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    .cta-section {
      text-align: center;
      padding: 80px 0;
      background-color: #fafafa;
      margin: 60px 0;
      border-radius: 5px;
    }
    
    .cta-section h2 {
      display: inline-block;
      margin-bottom: 30px;
    }
    
    .cta-section h2:after {
      left: 50%;
      transform: translateX(-50%);
    }
    
    .cta-section p {
      max-width: 600px;
      margin: 0 auto 30px;
      font-size: 18px;
    }
    
    footer {
      background-color: #000;
      color: white;
      padding: 40px 0;
      text-align: center;
      font-size: 15px;
      font-weight: 300;
    }
    
    @media (max-width: 992px) {
      .section-media {
        height: 350px;
      }
      
      h1 {
        font-size: 32px;
      }
      
      h2 {
        font-size: 24px;
      }
    }
    
    @media (max-width: 768px) {
      .section {
        flex-direction: column;
        gap: 30px;
      }
      
      .section:nth-child(even) {
        flex-direction: column;
      }
      
      .section-media {
        width: 100%;
        height: 300px;
      }
      
      .about-content {
        gap: 50px;
      }
      
      h1 {
        font-size: 28px;
      }
      
      .designers-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      }
      
      .designer-img {
        width: 150px;
        height: 150px;
      }
    }
    
    @media (max-width: 480px) {
      h1 {
        font-size: 24px;
      }
      
      h2 {
        font-size: 20px;
      }
      
      p, .feature-list li {
        font-size: 15px;
      }
      
      .section-media {
        height: 250px;
      }
      
      .designer-img {
        width: 120px;
        height: 120px;
      }
      
      .designer-name {
        font-size: 18px;
      }
      
      .designer-specialty {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>About Us</h1>
    </header>
    
    <div class="about-content">
      <div class="section">
        <div class="section-text">
          <h2>A Platform for Creative Designers</h2>
          <p>Welcome to our <span class="highlight">unique fashion design platform</span>, where we bring together creative talents from distinguished fashion designers and offer customers a unique shopping experience with the opportunity to get customized pieces.</p>
          <p>We believe that every woman deserves to wear unique pieces that express her personality and style, which is why we work with creative designers who can transform each piece into a unique story of creativity and distinction.</p>
        </div>
        <div class="section-media">
            <img src="http://www.topsarabia.com/wp-content/uploads/2020/10/%D9%85%D8%B5%D9%85%D9%85%D9%8A%D9%86-%D8%A7%D8%B2%D9%8A%D8%A7%D8%A1.jpg" alt="" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
      </div>
      
      <div class="section">
        <div class="section-text">
          <h2>Why Choose Us?</h2>
          <p>We offer a distinctive shopping experience that combines elegance and privacy, with a range of features that make our platform the perfect choice for every woman looking for excellence:</p>
          <ul class="feature-list">
            <li>Exclusive designs from professional designers</li>
            <li>Size customization options (S, M, L, XL)</li>
            <li>Product filtering by price, color, and best-selling</li>
            <li>Products exclusively for women</li>
            <li>Educational content through fashion design courses</li>
            <li>Exclusive fashion shows for designers</li>
            <li>Seamless shopping experience with multiple payment options</li>
          </ul>
        </div>
        <div class="section-media">
          <img src="https://cdn.clo3d.com/resource/images/artwork/landing/watermark_landing_sustainably_renewal_1920.png" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
      </div>
      
      <div class="section">
        <div class="section-text">
          <h2>How Our Platform Works</h2>
          <p>Our platform is designed to provide a seamless experience for both designers and shoppers:</p>
          <p><span class="highlight">For Designers:</span> Our platform offers an opportunity to showcase their creations, create personal pages to display their designs, participate in fashion shows, offer educational courses, and reach a wide customer base.</p>
          <p><span class="highlight">For Shoppers:</span> Users can browse different designs, customize sizes, add favorite products to their shopping cart, and pay through multiple methods including cash on delivery.</p>
        </div>
        <div class="section-media">
          <img src="https://cdn.clo3d.com/resource/images/artwork/clo/whyclo/watermark_whyclo_showcase_1_v2.png" alt="How the Platform Works" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
      </div>
    </div>
    
  <footer>
    <div class="container">
      <p>All Rights Reserved &copy; 2025 - Fashion Design Platform</p>
    </div>
  </footer>
</body>
</html>
        
    </div>





















