<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Favorites</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 0;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-title h1 {
            font-size: 36px;
            font-weight: 300;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        
        .page-title h1::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background-color: #ffd1dc;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .favorites-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }
        
        .product-image {
            height: 220px;
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
            top: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateY(0);
        }
        
        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .action-btn:hover {
            background-color: #ffd1dc;
            color: #333;
            transform: scale(1.1);
        }
        
        .action-btn.remove-favorite {
            color: #ff5b79;
        }
        
        .action-btn.rate-product:hover {
            color: #ffc107;
        }
        
        .product-info {
            padding: 20px;
        }
        
        .product-name {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }
        
        .product-card:hover .product-name {
            color: #ff5b79;
        }
        
        .product-designer {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .product-price {
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 10px;
            font-weight: normal;
            font-size: 16px;
        }
        
        .discount-price {
            color: #ff5b79;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .product-rating {
            color: #ffc107;
            font-size: 14px;
        }
        
        .product-date {
            font-size: 12px;
            color: #999;
        }
        
        .empty-favorites {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
        }
        
        .empty-favorites i {
            font-size: 70px;
            color: #ffd1dc;
            margin-bottom: 25px;
        }
        
        .empty-favorites h3 {
            font-size: 26px;
            font-weight: 400;
            margin-bottom: 15px;
        }
        
        .empty-favorites p {
            color: #777;
            margin-bottom: 25px;
        }
        
        .empty-favorites .btn {
            background-color: #ffd1dc;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .empty-favorites .btn:hover {
            background-color: #ff5b79;
            color: white;
        }
        
        .checkout-section {
            margin-top: 30px;
            text-align: center;
        }
        
        .checkout-section .btn {
            background-color: #333;
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .checkout-section .btn:hover {
            background-color: #ff5b79;
            transform: translateY(-3px);
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        
        /* Rating Modal */
        .rating-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(3px);
        }
        
        .rating-content {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 400px;
            padding: 35px;
            position: relative;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 22px;
            color: #999;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .close-modal:hover {
            color: #ff5b79;
        }
        
        .rating-form h3 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 500;
        }
        
        .rating-stars {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
            direction: rtl;
        }
        
        .rating-stars input {
            display: none;
        }
        
        .rating-stars label {
            cursor: pointer;
            font-size: 30px;
            color: #ddd;
            padding: 0 3px;
            transition: color 0.2s ease;
        }
        
        .rating-stars label:hover,
        .rating-stars label:hover ~ label,
        .rating-stars input:checked ~ label {
            color: #ffc107;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group textarea {
            width: 100%;
            height: 120px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: none;
            transition: border 0.3s ease;
        }
        
        .form-group textarea:focus {
            border-color: #ffd1dc;
            outline: none;
        }
        
        .rating-actions {
            text-align: center;
        }
        
        .rating-actions .btn {
            background-color: #ff5b79;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .rating-actions .btn:hover {
            background-color: #ff3a5f;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 91, 121, 0.3);
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
        }
        
        .pagination .page-item {
            list-style: none;
        }
        
        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .pagination .page-item.active .page-link {
            background-color: #ffd1dc;
            color: #333;
        }
        
        .pagination .page-link:hover {
            background-color: #ffd1dc;
            color: #333;
        }
        
        @media (max-width: 992px) {
            .favorites-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .favorites-container {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }
            
            .page-title h1 {
                font-size: 28px;
            }
            
            .rating-content {
                width: 95%;
                padding: 25px;
            }
        }
        
        @media (max-width: 480px) {
            .favorites-container {
                grid-template-columns: 1fr;
            }
            
            .page-title h1 {
                font-size: 24px;
            }
            
            .product-actions {
                flex-direction: row;
                opacity: 1;
                transform: none;
                top: auto;
                bottom: 10px;
                right: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-title">
            <h1>My Favorites</h1>
            <p>Your collection of favorite designs from our talented designers</p>
        </div>

        <div class="favorites-container" id="favorites-container">
            @if(count($favorites) > 0)
                @foreach($favorites as $favorite)
                <div class="product-card" id="favorite-{{ $favorite->product->id }}">
                    <div class="product-image">
                        <img src="{{ $favorite->product->image_url ?? '/api/placeholder/400/220?text=Product+Image' }}" alt="{{ $favorite->product->name }}">
                        <div class="product-actions">
                            <button class="action-btn remove-favorite" 
                                    title="Remove from Favorites" 
                                    data-id="{{ $favorite->product->id }}"
                                    data-url="{{ route('favorites.toggle') }}">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="action-btn rate-product" 
                                    title="Rate Product" 
                                    data-product-id="{{ $favorite->product->id }}"
                                    data-product-name="{{ $favorite->product->name }}">
                                <i class="fas fa-star"></i>
                            </button>
                            <a href="{{ route('products.show', $favorite->product->id) }}" 
                               class="action-btn" 
                               title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">{{ $favorite->product->name }}</h3>
                        <p class="product-designer">by {{ $favorite->product->designer->name ?? 'Unknown Designer' }}</p>
                        <div class="product-price">
                            @if($favorite->product->discount && $favorite->product->discount->percentage > 0)
                                <span class="original-price">${{ number_format($favorite->product->price, 2) }}</span>
                                <span class="discount-price">${{ number_format($favorite->product->price * (1 - $favorite->product->discount->percentage / 100), 2) }}</span>
                            @else
                                ${{ number_format($favorite->product->price, 2) }}
                            @endif
                        </div>
                        <div class="product-meta">
                            <div class="product-rating">
                                @php
                                    $avgRating = $favorite->product->ratings->avg('rating') ?? 0;
                                    $fullStars = floor($avgRating);
                                    $halfStar = $avgRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp
                                
                                @for($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                
                                @if($halfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                                
                                @for($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                                
                                <span>({{ number_format($avgRating, 1) }})</span>
                            </div>
                            <div class="product-date">Added {{ $favorite->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-favorites" id="empty-favorites">
                    <i class="far fa-heart"></i>
                    <h3>Your favorites list is empty</h3>
                    <p>Save your favorite designs to come back to them later</p>
                    <a href="{{ route('products.index') }}" class="btn">Browse Products</a>
                </div>
            @endif
        </div>

        @if(count($favorites) > 0)
            <!-- Pagination -->
            <div class="pagination" id="pagination">
                {{ $favorites->links() }}
            </div>

            <!-- Add all to cart button -->
            <div class="checkout-section" id="checkout-section">
                <form action="{{ route('favorites.add-all-to-cart') }}" method="POST" id="add-all-form">
                    @csrf
                    <button type="submit" class="btn">Add All to Cart</button>
                </form>
            </div>
        @endif
    </div>

    <!-- Rating Modal -->
    <div class="rating-modal" id="rating-modal">
        <div class="rating-content">
            <span class="close-modal" id="close-modal"><i class="fas fa-times"></i></span>
            <form class="rating-form" id="rating-form" action="{{ route('ratings.store') }}" method="POST">
                @csrf
                <input type="hidden" id="product-id" name="product_id" value="">
                <h3 id="rating-product-name">Rate this Product</h3>
                <div class="rating-stars">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1"><i class="fas fa-star"></i></label>
                </div>
                <div class="form-group">
                    <label for="review">Your Review (Optional)</label>
                    <textarea id="review" name="review" placeholder="Share your thoughts about this product..."></textarea>
                </div>
                <div class="rating-actions">
                    <button type="submit" class="btn">Submit Review</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // إعداد CSRF Token لطلبات AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // التعامل مع تقييم المنتج
        document.querySelectorAll('.rate-product').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                document.getElementById('product-id').value = productId;
                document.getElementById('rating-product-name').textContent = 'Rate: ' + productName;
                document.getElementById('rating-modal').style.display = 'flex';
            });
        });

        // إغلاق نافذة التقييم
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('rating-modal').style.display = 'none';
        });

        // إغلاق النافذة عند النقر خارجها
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('rating-modal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // إزالة من المفضلة باستخدام AJAX
        document.querySelectorAll('.remove-favorite').forEach(button => {
            button.addEventListener('click', function() {
                console.log('زر إزالة المفضلة تم الضغط عليه');
                
                const productId = this.getAttribute('data-id');
                const url = this.getAttribute('data-url');
                const productCard = this.closest('.product-card');
                
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => {
                    console.log('استجابة الخادم:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('بيانات الاستجابة:', data);
                    if (data.status === 'success') {
                        // تحديث عداد المفضلة في شريط التنقل (إذا وجد)
                        const counter = document.querySelector('.favorites-counter');
                        if (counter) {
                            counter.textContent = data.count;
                        }
                        
                        // تأثير حركي وإزالة بطاقة المنتج
                        productCard.style.opacity = '0';
                        productCard.style.transform = 'translateY(20px)';
                        
                        setTimeout(() => {
                            productCard.remove();
                            
                            // تحقق مما إذا لم تعد هناك مفضلات
                            if (document.querySelectorAll('.product-card').length === 0) {
                                // عرض حالة فارغة
                                const emptyFav = document.createElement('div');
                                emptyFav.className = 'empty-favorites';
                                emptyFav.id = 'empty-favorites';
                                emptyFav.innerHTML = `
                                    <i class="far fa-heart"></i>
                                    <h3>Your favorites list is empty</h3>
                                    <p>Save your favorite designs to come back to them later</p>
                                    <a href="/products" class="btn">Browse Products</a>
                                `;
                                document.getElementById('favorites-container').appendChild(emptyFav);
                                
                                // إخفاء التنقل الصفحي وقسم الخروج
                                const pagination = document.getElementById('pagination');
                                const checkout = document.getElementById('checkout-section');
                                
                                if (pagination) pagination.style.display = 'none';
                                if (checkout) checkout.style.display = 'none';
                            }
                        }, 300);
                    } else {
                        alert(data.message || 'حدث خطأ أثناء إزالة المنتج من المفضلة');
                    }
                })
                .catch(error => {
                    console.error('خطأ في إزالة المفضلة:', error);
                    alert('حدث خطأ أثناء الاتصال بالخادم. يرجى المحاولة مرة أخرى.');
                });
            });
        });
    </script>
</body>
</html>