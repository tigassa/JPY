<?php
// تضمين ملف الاتصال بقاعدة البيانات
include 'connectionDB.php';
include 'NavBar.php';

// كتابة الاستعلام لجلب المنتجات من النوع "enterior"
$query = "SELECT pr_photo, pr_name, pr_description, pr_pdf FROM products WHERE pr_type = 'enterior'";
$result = $con->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');

        * {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .product-content {
            flex-grow: 1;
        }

        .product-footer {
            margin-top: auto;
        }
    </style>
    <title> الدهانات الداخلية </title>
</head>

<body class="bg-gray-50">
    <!-- Main Content -->
    <main class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-12 mt-6">الدهانات الداخلية</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                // التحقق من وجود نتائج
                if ($result->num_rows > 0) {
                    // عرض كل منتج
                    while ($row = $result->fetch_assoc()) {
                        $pr_photo = htmlspecialchars($row['pr_photo']);
                        $pr_name = htmlspecialchars($row['pr_name']);
                        $pr_description = htmlspecialchars($row['pr_description']);
                        $pr_pdf = htmlspecialchars($row['pr_pdf']);
                ?>
                        <!-- بطاقة المنتج -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden h-full product-card">
                            <div class="h-48">
                                <!-- صورة المنتج -->
                                <img src="<?php echo $pr_photo; ?>" alt="<?php echo $pr_name; ?>" class="product-image">
                            </div>
                            <div class="p-6 product-content">
                                <!-- اسم المنتج -->
                                <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo $pr_name; ?></h3>
                                <!-- وصف المنتج -->
                                <p class="text-gray-600 mb-4"><?php echo $pr_description; ?></p>
                            </div>
                            <!-- تحميل ملف PDF -->
                            <div class="p-6 product-footer">
                                <a href="<?php echo $pr_pdf; ?>" target="_blank"
                                    class="block w-full bg-blue-600 text-white text-center py-2 rounded-md hover:bg-blue-700 transition-colors">
                                    تحميل المواصفات
                                </a>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    // إذا لم تكن هناك منتجات
                    echo '<p class="text-center text-gray-500">لا توجد منتجات متاحة.</p>';
                }

                // إغلاق الاتصال بقاعدة البيانات
                $con->close();
              
                ?>
            </div>
        </div>
    </main>
   <?php include 'footer.php'; ?>
</body>

</html>