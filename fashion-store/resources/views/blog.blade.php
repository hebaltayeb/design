<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>المدونة - منصة تصميم الأزياء</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Tajawal', 'Montserrat', 'Segoe UI', sans-serif;
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
      letter-spacing: 1px;
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
    
    .search-bar {
      max-width: 600px;
      margin: 30px auto;
      position: relative;
    }
    
    .search-input {
      width: 100%;
      padding: 15px 20px;
      border: 1px solid #ddd;
      border-radius: 30px;
      font-size: 16px;
      font-family: 'Tajawal', sans-serif;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .search-input:focus {
      outline: none;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border-color: #ffd1dc;
    }
    
    .search-btn {
      position: absolute;
      right: 5px;
      top: 5px;
      background-color: #ffd1dc;
      border: none;
      color: #333;
      padding: 10px 20px;
      border-radius: 30px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: 'Tajawal', sans-serif;
      font-weight: 500;
    }
    
    .search-btn:hover {
      background-color: #ffbbc9;
    }
    
    .blog-tabs {
      display: flex;
      justify-content: center;
      margin: 40px 0;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .blog-tab {
      padding: 12px 25px;
      background-color: #fff;
      border: 1px solid #eee;
      border-radius: 30px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 15px;
      font-weight: 500;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    }
    
    .blog-tab.active, .blog-tab:hover {
      background-color: #ffd1dc;
      border-color: #ffd1dc;
      color: #333;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    .blog-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(370px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }
    
    .blog-card {
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .blog-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .blog-img {
      height: 220px;
      width: 100%;
      object-fit: cover;
    }
    
    .blog-content {
      padding: 25px;
    }
    
    .blog-meta {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
      color: #888;
      font-size: 14px;
    }
    
    .blog-meta a {
      color: #ffd1dc;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    
    .blog-meta a:hover {
      color: #ffbbc9;
    }
    
    .blog-card h3 {
      margin: 0 0 15px;
      font-size: 22px;
      font-weight: 500;
    }
    
    .blog-card p {
      color: #666;
      margin: 0 0 20px;
      line-height: 1.7;
    }
    
    .read-more {
      display: inline-block;
      color: #ffd1dc;
      font-weight: 500;
      text-decoration: none;
      border-bottom: 1px solid transparent;
      transition: all 0.3s ease;
    }
    
    .read-more:hover {
      color: #ffbbc9;
      border-bottom-color: #ffbbc9;
    }
    
    .featured-post {
      margin: 0 0 60px;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }
    
    .featured-post-content {
      display: flex;
      flex-direction: row;
    }
    
    .featured-img {
      flex: 1;
      min-height: 400px;
      background-size: cover;
      background-position: center;
    }
    
    .featured-text {
      flex: 1;
      padding: 40px;
    }
    
    .featured-tag {
      display: inline-block;
      background-color: #ffd1dc;
      color: #333;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 20px;
    }
    
    .featured-post h2 {
      font-size: 32px;
      margin: 0 0 20px;
      font-weight: 500;
    }
    
    .featured-post p {
      color: #666;
      margin: 0 0 25px;
      line-height: 1.8;
    }
    
    .featured-post .read-more {
      font-size: 16px;
    }
    
    .sidebar {
      margin-top: 40px;
      background: #fff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .sidebar h3 {
      margin-top: 0;
      font-size: 22px;
      position: relative;
      padding-bottom: 15px;
    }
    
    .sidebar h3:after {
      content: '';
      position: absolute;
      width: 40px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      right: 0;
    }
    
    .popular-posts {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .popular-posts li {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }
    
    .popular-posts li:last-child {
      margin-bottom: 0;
      padding-bottom: 0;
      border-bottom: none;
    }
    
    .post-thumb {
      width: 80px;
      height: 80px;
      border-radius: 5px;
      overflow: hidden;
      margin-left: 15px;
    }
    
    .post-thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .post-info {
      flex: 1;
    }
    
    .post-info h4 {
      margin: 0 0 8px;
      font-size: 16px;
      font-weight: 500;
    }
    
    .post-info a {
      color: #333;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    .post-info a:hover {
      color: #ffd1dc;
    }
    
    .post-info span {
      font-size: 14px;
      color: #888;
    }
    
    .tags {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
    }
    
    .tag {
      display: inline-block;
      background-color: #f0f0f0;
      color: #666;
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 14px;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .tag:hover {
      background-color: #ffd1dc;
      color: #333;
    }
    
    .newsletter {
      margin-top: 40px;
      background: #fafafa;
      padding: 40px;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .newsletter h3 {
      margin-top: 0;
      font-size: 24px;
    }
    
    .newsletter p {
      max-width: 500px;
      margin: 0 auto 25px;
      color: #666;
    }
    
    .newsletter-form {
      display: flex;
      max-width: 500px;
      margin: 0 auto;
    }
    
    .newsletter-input {
      flex: 1;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 5px 0 0 5px;
      font-family: 'Tajawal', sans-serif;
    }
    
    .newsletter-input:focus {
      outline: none;
      border-color: #ffd1dc;
    }
    
    .newsletter-btn {
      background-color: #000;
      color: white;
      border: none;
      padding: 0 25px;
      border-radius: 0 5px 5px 0;
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-family: 'Tajawal', sans-serif;
      font-weight: 500;
    }
    
    .newsletter-btn:hover {
      background-color: #333;
    }
    
    .pagination {
      display: flex;
      justify-content: center;
      margin: 60px 0 30px;
      gap: 5px;
    }
    
    .pagination a {
      display: inline-block;
      padding: 8px 16px;
      background-color: #fff;
      border: 1px solid #eee;
      color: #333;
      text-decoration: none;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    
    .pagination a:hover, .pagination a.active {
      background-color: #ffd1dc;
      border-color: #ffd1dc;
      color: #333;
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
      .featured-post-content {
        flex-direction: column;
      }
      
      .featured-img {
        min-height: 300px;
      }
      
      .blog-grid {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      }
      
      h1 {
        font-size: 32px;
      }
    }
    
    @media (max-width: 768px) {
      .blog-grid {
        grid-template-columns: 1fr;
      }
      
      .featured-text {
        padding: 30px;
      }
      
      .featured-post h2 {
        font-size: 26px;
      }
      
      h1 {
        font-size: 28px;
      }
      
      .blog-tabs {
        gap: 8px;
      }
      
      .blog-tab {
        padding: 10px 15px;
        font-size: 14px;
      }
    }
    
    @media (max-width: 480px) {
      h1 {
        font-size: 24px;
      }
      
      .featured-post h2 {
        font-size: 22px;
      }
      
      .featured-text {
        padding: 25px;
      }
      
      .search-btn {
        padding: 10px 15px;
      }
      
      .newsletter {
        padding: 30px 20px;
      }
      
      .newsletter-form {
        flex-direction: column;
      }
      
      .newsletter-input {
        border-radius: 5px;
        margin-bottom: 10px;
      }
      
      .newsletter-btn {
        border-radius: 5px;
        padding: 12px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>مدونة الأزياء</h1>
    </header>
    
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="ابحث عن مقالات، مصممين، أو صيحات موضة...">
      <button class="search-btn">بحث</button>
    </div>
    
    <div class="blog-tabs">
      <div class="blog-tab active">الكل</div>
      <div class="blog-tab">نصائح أزياء</div>
      <div class="blog-tab">مقابلات مع مصممين</div>
      <div class="blog-tab">أحدث الصيحات</div>
      <div class="blog-tab">عروض أزياء</div>
      <div class="blog-tab">دورات تدريبية</div>
    </div>
    
    <div class="featured-post">
      <div class="featured-post-content">
        <div class="featured-img" style="background-image: url('/api/placeholder/600/400');"></div>
        <div class="featured-text">
          <span class="featured-tag">مقابلة حصرية</span>
          <h2>حوار مع سارة الخالدي: رحلة التميز في عالم الأزياء المعاصرة</h2>
          <p>تتحدث المصممة سارة الخالدي عن رحلتها الفريدة في عالم الأزياء، وكيف تمكنت من إنشاء علامتها الخاصة المميزة. تشارك أفكارها عن أحدث مجموعاتها وتكشف عن تفاصيل حصرية حول العرض القادم ومصادر إلهامها المتنوعة.</p>
          <p>تتميز تصاميم سارة بالأناقة والبساطة مع لمسات عصرية فريدة، وقد حققت نجاحاً كبيراً في السوق المحلي والعالمي على حد سواء، وذلك بفضل قدرتها على مزج الأصالة بالمعاصرة.</p>
          <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
        </div>
      </div>
    </div>
    
    <div style="display: flex; flex-wrap: wrap; gap: 40px;">
      <div style="flex: 2; min-width: 300px;">
        <div class="blog-grid">
          <div class="blog-card">
            <img src="/api/placeholder/400/220" alt="Fashion Blog" class="blog-img">
            <div class="blog-content">
              <div class="blog-meta">
                <span>15 أبريل 2025</span>
                <a href="#">أحدث الصيحات</a>
              </div>
              <h3>صيحات الربيع والصيف: ألوان وتصاميم تناسب كل امرأة</h3>
              <p>اكتشفي أحدث صيحات الموضة لموسم الربيع والصيف، وكيف يمكن لكل امرأة اختيار ما يناسبها من الألوان والقصات التي ستتربع على عرش الموضة هذا العام.</p>
              <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
          </div>
          
          <div class="blog-card">
            <img src="/api/placeholder/400/220" alt="Fashion Blog" class="blog-img">
            <div class="blog-content">
              <div class="blog-meta">
                <span>10 أبريل 2025</span>
                <a href="#">عروض أزياء</a>
              </div>
              <h3>لمحة عن عرض أزياء ريما السعدي: أناقة محتشمة بلمسات حديثة</h3>
              <p>نستعرض أبرز الإطلالات من العرض الأخير للمصممة ريما السعدي، والذي قدمت فيه مجموعة متميزة من الأزياء المحتشمة بلمسات عصرية أنيقة.</p>
              <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
          </div>
          
          <div class="blog-card">
            <img src="/api/placeholder/400/220" alt="Fashion Blog" class="blog-img">
            <div class="blog-content">
              <div class="blog-meta">
                <span>5 أبريل 2025</span>
                <a href="#">دورات تدريبية</a>
              </div>
              <h3>دورة تصميم الأزياء للمبتدئين من لينا العمري: التسجيل مفتوح الآن</h3>
              <p>أعلنت المصممة لينا العمري عن إطلاق دورتها الجديدة لتعليم أساسيات تصميم الأزياء للمبتدئين، حيث ستشارك خبرتها في مجال الأزياء الكلاسيكية.</p>
              <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
          </div>
          
          <div class="blog-card">
            <img src="/api/placeholder/400/220" alt="Fashion Blog" class="blog-img">
            <div class="blog-content">
              <div class="blog-meta">
                <span>1 أبريل 2025</span>
                <a href="#">نصائح أزياء</a>
              </div>
              <h3>كيفية اختيار المقاس المناسب عند التسوق عبر الإنترنت</h3>
              <p>نقدم لكِ مجموعة من النصائح العملية التي تساعدك على اختيار المقاس المناسب عند التسوق عبر الإنترنت، وتجنب مشكلة عدم ملاءمة الملابس.</p>
              <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
          </div>
          
          <div class="blog-card">
            <img src="/api/placeholder/400/220" alt="Fashion Blog" class="blog-img">
            <div class="blog-content">
              <div class="blog-meta">
                <span>28 مارس 2025</span>
                <a href="#">مقابلات مع مصممين</a>
              </div>
              <h3>نور الهاشمي تكشف عن مصادر إلهامها في تصميم ملابس المناسبات</h3>
              <p>في حوار خاص، تتحدث المصممة نور الهاشمي عن رحلتها في عالم تصميم أزياء المناسبات وكيف تستوحي تصاميمها من الثقافة والتراث.</p>
              <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
          </div>
          
          <div class="blog-card">
            <img src="/api/placeholder/400/220" alt="Fashion Blog" class="blog-img">
            <div class="blog-content">
              <div class="blog-meta">
                <span>25 مارس 2025</span>
                <a href="#">أحدث الصيحات</a>
              </div>
              <h3>الخامات المستدامة: مستقبل صناعة الأزياء</h3>
              <p>نسلط الضوء على التوجه المتزايد نحو استخدام الخامات المستدامة في صناعة الأزياء، وكيف يمكن للمستهلك دعم هذا التوجه البيئي.</p>
              <a href="#" class="read-more">اقرأ المزيد <i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
          </div>
        </div>
        
        <div class="pagination">
          <a href="#"><i class="fas fa-angle-right"></i></a>
          <a href="#" class="active">1</a>
          <a href="#">2</a>
          <a href="#">3</a>
          <a href="#"><i class="fas fa-angle-left"></i></a>
        </div>
      </div>
      
      <div style="flex: 1; min-width: 250px;">
        <div class="sidebar">
          <h3>أحدث المقالات</h3>
          <ul class="popular-posts">
            <li>
              <div class="post-thumb">
                <img src="/api/placeholder/80/80" alt="Popular Post">
              </div>
              <div class="post-info">
                <h4><a href="#">كيف تختارين اللون المناسب لبشرتك؟</a></h4>
                <span>20 أبريل 2025</span>
              </div>
            </li>
            <li>
              <div class="post-thumb">
                <img src="/api/placeholder/80/80" alt="Popular Post">
              </div>
              <div class="post-info">
                <h4><a href="#">أساسيات خزانة الملابس العصرية</a></h4>
                <span>18 أبريل 2025</span>
              </div>
            </li>
            <li>
              <div class="post-thumb">
                <img src="/api/placeholder/80/80" alt="Popular Post">
              </div>
              <div class="post-info">
                <h4><a href="#">تقرير: عروض أزياء الموسم الجديد</a></h4>
                <span>15 أبريل 2025</span>
              </div>
            </li>
          </ul>
        </div>
        
        <div class="sidebar">
          <h3>تصفح حسب الوسوم</h3>
          <div class="tags">
            <a href="#" class="tag">أزياء معاصرة</a>
            <a href="#" class="tag">موضة محتشمة</a>
            <a href="#" class="tag">فساتين سهرة</a>
            <a href="#" class="tag">أزياء كلاسيكية</a>
            <a href="#" class="tag">عبايات</a>
            <a href="#" class="tag">إكسسوارات</a>
            <a href="#" class="tag">تخفيضات</a>
            <a href="#" class="tag">أحدث التشكيلات</a>
          </div>
        </div>
        
        <div class="sidebar">
          <h3>المصممون المميزون</h3>
          <ul class="popular-posts">
            <li>
              <div class="post-thumb">
                <img src="/api/placeholder/80/80" alt="Designer">
              </div>
              <div class="post-info">
                <h4><a href="#">سارة الخالدي</a></h4>
                <span>أزياء معاصرة</span>
              </div>
            </li>
            <li>
              <div class="post-thumb">
                <img src="/api/placeholder/80/80" alt="Designer">
              </div>
              <div class="post-info">
                <h4><a href="#">لينا العمري</a></h4>
                <span>أزياء كلاسيكية</span>
              </div>
            </li>
            <li>
              <div class="post-thumb">
                <img src="/api/placeholder/80/80" alt="Designer">
              </div>
              <div class="post-info">
                <h4><a href="#">ريما السعدي</a></h4>
                <span>أزياء محتشمة</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
    <div class="newsletter">
      <h3>اشتركي في نشرتنا البريدية</h3>
      <p>احصلي على آخر أخبار الموضة والأزياء، والعروض الحصرية، وإطلاقات المصممين الجدد مباشرة إلى بريدك الإلكتروني.</p>
      <form class="newsletter-form">
        <input type="email" class="newsletter-input" placeholder="البريد الإلكتروني">
        <button type="submit" class="newsletter-btn">اشتراك</button>
      </form>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <p>جميع الحقوق محفوظة &copy; 2025 - منصة تصميم الأزياء</p>
    </div>
  </footer>
</body>
</html>