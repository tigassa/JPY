<?php
include 'NavBar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>دهانات الجزيرة اليمن</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');

        * {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
        }

        body {
            padding-top: 4rem;
            /* Adjust this value based on your navbar height */
        }

       
        .drum_img{
            max-width: 50%;
            margin-right: 30%;
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        .footer-link {
            transition: color 0.3s ease, transform 0.3s ease;
            display: inline-block;
        }

        .footer-link:hover {
            transform: translateX(-5px);
        }

    </style>
</head>

<body class="bg-gray-50">

   

    <!-- Hero Section -->
    <section class="py-16 px-4 my-16">
        <div class="max-w-6xl mx-auto flex flex-wrap items-center">
            <div class="w-full md:w-1/2 mb-8 md:mb-0 flexitems-center" >
                <h1 class="text-4xl font-bold mb-4">دهانات الجزيرة اليمن</h1>
                <p class="text-gray-600 text-lg">تمتع برؤية شاملة لتشكيلة متميزة من الدهانات والعوازل ذات جودة عالية تلبي احتياجاتك وتطلعاتك</p>
            </div>
            <div class="w-full md:w-1/2">
                <img src="images/drum.webp" class="drum_img" alt="">
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-20"> منتجاتنا</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <a href="EnteriorPaints.php" class="product-card text-center">
                    <div class="bg-white rounded-lg p-2 shadow-md mb-4">
                       <img src="images/enterior.webp" alt="">
                    </div>
                    <span class="text-gray-700">دهانات داخلية</span>
                </a>
                <a href="ExteriorPaints.php" class="product-card text-center">
                    <div class="bg-white rounded-lg p-2 shadow-md mb-4">
                        <img src="images/exterior.webp" alt="">
                    </div>
                    <span class="text-gray-700">دهانات خارجية</span>
                </a>
                <a href="ProofPaints.php" class="product-card text-center">
                    <div class="bg-white rounded-lg p-2 shadow-md mb-4">
                        <img src="images/proof.jpeg" alt="">
                    </div>
                    <span class="text-gray-700">دهانات العزل والبناء</span>
                </a>
                <a href="Catalogues.php" class="product-card text-center">
                    <div class="bg-white rounded-lg p-2 shadow-md mb-4">
                        <img src="images/exterior.webp" alt="">
                    </div>
                    <span class="text-gray-700">الكتلوجات</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-20">ما يميزنا</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center"> 
                    <svg class="w-16 h-16 mx-auto mb-4" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="#2563eb" opacity="0.1" />
                        <path d="M30 50 L45 65 L70 35" stroke="#2563eb" stroke-width="8" fill="none" />
                    </svg>
                    <h3 class="text-xl font-bold mb-2">جودة عالية</h3>
                    <p class="text-gray-600">نستخدم أفضل المواد الخام لضمان جودة منتجاتنا</p>
                </div>
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="#2563eb" opacity="0.1" />
                        <path d="M35 50 A15 15 0 0 1 65 50" stroke="#2563eb" stroke-width="8" fill="none" />
                    </svg>
                    <h3 class="text-xl font-bold mb-2">خدمة متميزة</h3>
                    <p class="text-gray-600">فريق متخصص لتقديم أفضل خدمة للعملاء</p>
                </div>
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="#2563eb" opacity="0.1" />
                        <path d="M50 25 L65 40 L50 55 L35 40 Z" fill="#2563eb" />
                    </svg>
                    <h3 class="text-xl font-bold mb-2">تنوع المنتجات</h3>
                    <p class="text-gray-600">مجموعة واسعة من المنتجات لتلبية جميع الاحتياجات</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-8 md:mb-0">
                   <img src="images/company.jpeg" alt="">
                </div>
                <div class="w-full md:w-1/2 md:pr-8">
                    <h2 class="text-3xl font-bold mb-4">من نحن</h2>
                    <p class="text-gray-600">دهانات الجزيرة اليمن هي شركة رائدة في مجال الدهانات، تأسست منذ أكثر من 30
                        عاماً. نحن ملتزمون بتقديم منتجات عالية الجودة وخدمات متميزة لعملائنا في جميع أنحاء اليمن.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-lg font-bold mb-4">فروعنا</h4>
                    <ul class="space-y-2">
                        <li><a href="https://aljazeerah.com/sanaa" class="footer-link hover:text-blue-400">صنعاء</a>
                        </li>
                        <li><a href="https://aljazeerah.com/aden" class="footer-link hover:text-blue-400">عدن</a></li>
                        <li><a href="https://aljazeerah.com/taiz" class="footer-link hover:text-blue-400">تعز</a></li>
                        <li><a href="https://aljazeerah.com/hodeidah"
                                class="footer-link hover:text-blue-400">الحديدة</a></li>
                        <li><a href="https://aljazeerah.com/ibb" class="footer-link hover:text-blue-400">إب</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">منتجاتنا</h4>
                    <ul class="space-y-2">
                        <li><a href="https://aljazeerah.com/products/internal"
                                class="footer-link hover:text-blue-400">دهانات داخلية</a></li>
                        <li><a href="https://aljazeerah.com/products/external"
                                class="footer-link hover:text-blue-400">دهانات خارجية</a></li>
                        <li><a href="https://aljazeerah.com/products/decorative"
                                class="footer-link hover:text-blue-400">دهانات ديكورية</a></li>
                        <li><a href="https://aljazeerah.com/products/industrial"
                                class="footer-link hover:text-blue-400">دهانات صناعية</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">تواصل معنا</h4>
                    <ul class="space-y-2">
                        <li>هاتف: 777123456</li>
                        <li>واتساب: 737123456</li>
                        <li>البريد الإلكتروني: info@aljazeerah.com</li>
                        <li>العنوان: صنعاء - شارع الزبيري</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400">
                <p>جميع الحقوق محفوظة © 2024 دهانات الجزيرة اليمن</p>
            </div>
        </div>
    </footer>

  


</body>

</html>