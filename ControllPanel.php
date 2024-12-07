<?php
include "connectionDB.php";

session_start();


// التحقق من تسجيل الدخول
if (!isset($_SESSION['username'])) {
    header('Location: Admin_login.php');
    exit();
}

// جلب اسم المستخدم
$username = $_SESSION['username'];



if (isset($_POST["add"])) {
    $name = $_POST["name"];
    $photo_target = "catalogues_photo/";
    $pdf_target = "catalogues_pdf/";

    // Initialize error messages
    $photoError = "";
    $pdfError = "";

    // Handle photo upload
    if (isset($_FILES["photo"])) {
        $fileName = $_FILES["photo"]["name"];
        $fileSize = $_FILES["photo"]["size"];
        $tmpFile = $_FILES["photo"]["tmp_name"];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed_extensions = array("png", "jpg", "jpeg", "webp");

        if (!in_array($ext, $allowed_extensions)) {
            $photoError = "إمتداد الصورة غير مسموح به";
        }
        if ($fileSize > 2097152) {
            $photoError .= " الحجم كبير";
        }
        if (empty($photoError)) {
            move_uploaded_file($tmpFile, $photo_target . $fileName);
            $photoPath = $photo_target . $fileName;
        } else {
            echo $photoError;
        }
    } else {
        echo "لم تقم بتحميل أي صورة";
    }

    // Handle PDF upload
    if (isset($_FILES["pdf"])) {
        $pdfName = $_FILES["pdf"]["name"];
        $pdfSize = $_FILES["pdf"]["size"];
        $tmpPdfFile = $_FILES["pdf"]["tmp_name"];
        $pdfExt = pathinfo($pdfName, PATHINFO_EXTENSION);
        $allowed_pdf_extensions = array("pdf");

        if (!in_array($pdfExt, $allowed_pdf_extensions)) {
            $pdfError = "إمتداد ملف PDF غير مسموح به";
        }
        if ($pdfSize > 2097152) {
            $pdfError .= " الحجم كبير";
        }
        if (empty($pdfError)) {
            move_uploaded_file($tmpPdfFile, $pdf_target . $pdfName);
            $pdfPath = $pdf_target . $pdfName;
        } else {
            echo $pdfError;
        }
    } else {
        echo "لم تقم بتحميل أي ملف PDF";
    }

    // Insert into database
    if (empty($photoError) && empty($pdfError)) {
        $stmt = $con->prepare("INSERT INTO catalogues (c_photo, c_name, c_pdf) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $photoPath, $name, $pdfPath);
        if ($stmt->execute()) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSuccessMessage('تمت الإضافة بنجاح!');
                    clearProductForm();
                });
            </script>";
            header('ControllPanel.php');
        } else {
            echo "خطأ أثناء إضافة الكتلوج: " . $stmt->error;
        }
        $stmt->close();
    }
}
if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $search_name = $_POST["search_name"];
    $description = $_POST["description"];
    $type = $_POST["type"];
    $photo_target = "product_photo/";
    $pdf_target = "product_pdf/";

    // Initialize error messages
    $photoError = "";
    $pdfError = "";

    // Handle photo upload
    if (isset($_FILES["photo"])) {
        $fileName = $_FILES["photo"]["name"];
        $fileSize = $_FILES["photo"]["size"];
        $tmpFile = $_FILES["photo"]["tmp_name"];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowed_extensions = array("png", "jpg", "jpeg", "webp");

        if (!in_array($ext, $allowed_extensions)) {
            $photoError = "إمتداد الصورة غير مسموح به";
        }
        if ($fileSize > 2097152) {
            $photoError .= " الحجم كبير";
        }
        if (empty($photoError)) {
            move_uploaded_file($tmpFile, $photo_target . $fileName);
            $photoPath = $photo_target . $fileName;
        } else {
            echo $photoError;
        }
    } else {
        echo "لم تقم بتحميل أي صورة";
    }

    // Handle PDF upload
    if (isset($_FILES["pdf"])) {
        $pdfName = $_FILES["pdf"]["name"];
        $pdfSize = $_FILES["pdf"]["size"];
        $tmpPdfFile = $_FILES["pdf"]["tmp_name"];
        $pdfExt = pathinfo($pdfName, PATHINFO_EXTENSION);
        $allowed_pdf_extensions = array("pdf");

        if (!in_array($pdfExt, $allowed_pdf_extensions)) {
            $pdfError = "إمتداد ملف PDF غير مسموح به";
        }
        if ($pdfSize > 2097152) {
            $pdfError .= " الحجم كبير";
        }
        if (empty($pdfError)) {
            move_uploaded_file($tmpPdfFile, $pdf_target . $pdfName);
            $pdfPath = $pdf_target . $pdfName;
        } else {
            echo $pdfError;
        }
    } else {
        echo "لم تقم بتحميل أي ملف PDF";
    }

    // Insert into database
    if (empty($photoError) && empty($pdfError)) {
        $stmt = $con->prepare("INSERT INTO products (pr_photo, pr_name, search_name, pr_type, pr_description, pr_pdf) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $photoPath, $name, $search_name, $type, $description, $pdfPath);
        if ($stmt->execute()) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    showSuccessMessage('تم إضافة المنتج بنجاح!');
                    clearProductForm();
                });
            </script>";
            header('ControllPanel.php');
        } else {
            echo "خطأ أثناء إضافة المنتج: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - إدارة المنتجات</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }

        body {
            background-color: #f5f6fa;
            direction: rtl;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .menu-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .menu-item:hover {
            background-color: #34495e;
        }

        .menu-item.active {
            background-color: #3498db;
        }

        .main-content {
            padding: 20px;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .add-product-form {
            background-color: white;
            padding: 25px;
            /* Reduced from 30px */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            /* Add max-width to make form narrower */
            margin: 0 auto;
            /* Center the form */
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 15px;
            /* Reduced from 20px */
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            /* Reduced from 10px */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            /* Reduced from 16px */
        }

        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: white;
        }

        .form-group select:focus {
            outline: none;
            border-color: #3498db;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            /* Reduced from 12px 25px */
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            /* Reduced from 16px */
            transition: 0.3s;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .product-list {
            margin-top: 30px;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
        }

        .product-list table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 15px;
        }

        .product-list th,
        .product-list td {
            padding: 12px 15px;
            text-align: right;
            border-bottom: 1px solid #eef2f7;
            vertical-align: middle;
        }

        .product-list th {
            background-color: #f8fafc;
            color: #2c3e50;
            font-weight: bold;
            white-space: nowrap;
            border-bottom: 2px solid #e2e8f0;
        }

        .product-list tbody tr {
            transition: all 0.2s ease;
        }

        .product-list tbody tr:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .product-image {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
        }

        .action-buttons button {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .edit-btn {
            background-color: #f39c12;
            color: white;
        }

        .edit-btn:hover {
            background-color: #e67e22;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(243, 156, 18, 0.3);
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(231, 76, 60, 0.3);
        }

        .product-list td:nth-child(4) {
            max-width: 250px;
            line-height: 1.4;
            color: #4a5568;
        }

        .spec-link {
            color: #3498db;
            text-decoration: none;
            font-size: 0.9em;
            margin-top: 8px;
            display: inline-block;
            padding: 4px 8px;
            background-color: #eef7ff;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .spec-link:hover {
            background-color: #3498db;
            color: white;
            text-decoration: none;
        }

        .product-list tbody tr:nth-child(even) {
            background-color: #fafbfd;
        }

        .preview-image {
            max-width: 150px;
            /* Reduced from 200px */
            max-height: 150px;
            /* Reduced from 200px */
            margin: 8px 0;
            /* Reduced from 10px */
        }

        #catalogForm .preview-image {
            max-width: 120px;
            /* Reduced from 150px */
            max-height: 120px;
            /* Reduced from 150px */
            margin: 8px 0;
            /* Reduced from 10px */
        }

        #catalogText {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            resize: vertical;
        }

        /* Add these styles to control section visibility */
        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        /* Add these styles to handle PDF file display */
        .pdf-file-name {
            margin-top: 5px;
            font-size: 14px;
            color: #666;
        }

        #productSpecs {
            margin-bottom: 5px;
        }

        /* الرسالة المنبثقة */
        .popup-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #2ecc71;
            /* لون الخلفية */
            color: white;
            /* لون النص */
            padding: 15px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        /* عند عرض الرسالة */
        .popup-message.show {
            opacity: 1;
        }

        /* يمكنك إضافة الأنماط الخاصة بالصفحة هنا */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        /* تفعيل التمرير الأفقي والعمودي على الجدول */
        .table-container {
            overflow-x: auto;
            /* تفعيل التمرير الأفقي */
            max-height: 400px;
            /* تحديد ارتفاع ثابت للتمرير العمودي */
            overflow-y: auto;
            /* تفعيل التمرير العمودي */
        }

        tbody {
            display: block;
            max-height: 280px;
            overflow-y: auto;
        }

        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-tachometer-alt"></i>
                لوحة التحكم
            </div>
            <div class="menu-item" data-section="products">
                <i class="fas fa-box"></i>
                المنتجات
            </div>
            <div class="menu-item" data-section="catalogues">
                <i class="fas fa-book"></i>
                الكتلوجات
            </div>
            <div class="menu-item" data-section="add-product">
                <i class="fas fa-plus-circle"></i>
                إضافة منتج
            </div>
            <div class="menu-item" data-section="add-catalog">
                <i class="fas fa-book"></i>
                إضافة كتلوج
            </div>
        </div>
        <?php
        include 'connectionDB.php';
        // جلب إجمالي عدد المنتجات
        $productQuery = "SELECT COUNT(*) AS total_products FROM products";
        $productResult = $con->query($productQuery);

        // تحقق من نجاح الاستعلام
        if ($productResult) {
            $productData = $productResult->fetch_assoc();
            $totalProducts = $productData['total_products'];
        } else {
            $totalProducts = 0; // إذا فشل الاستعلام
        }

        // جلب إجمالي عدد الكتالوجات
        $catalogQuery = "SELECT COUNT(*) AS total_catalogues FROM catalogues";
        $catalogResult = $con->query($catalogQuery);

        // تحقق من نجاح الاستعلام
        if ($catalogResult) {
            $catalogData = $catalogResult->fetch_assoc();
            $totalCatalogues = $catalogData['total_catalogues'];
        } else {
            $totalCatalogues = 0; // إذا فشل الاستعلام
        } ?>
        <div class="main-content">
            <div id="products" class="section active">
                <div class="stats-container">
                    <div class="stat-card">
                        <h3>إجمالي المنتجات</h3>
                        <div class="number" id="totalProducts"><?php echo $totalProducts; ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>إجمالي الكتلوجات</h3>
                        <div class="number" id="totalCatalogs"><?php echo $totalCatalogues; ?></div>
                    </div>
                </div>
                <?php include 'connectionDB.php';
                $query = "SELECT * FROM products";
                $result = $con->query($query); ?>
                <div class="product-list">
                    <h2>قائمة المنتجات</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>صورة المنتج</th>
                                <th>اسم المنتج</th>
                                <th>الاسم العامي</th>
                                <th>الوصف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <?php
                            // التحقق إذا كان هناك بيانات للمنتجات
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $photo = $row['pr_photo'];  // مسار الصورة
                                    $name = $row['pr_name'];    // اسم المنتج
                                    $search_name = $row['search_name'];  // الاسم العامي
                                    $description = $row['pr_description']; // الوصف
                                    $product_id = $row['pr_id'];  // معرف المنتج
                            ?>
                                    <tr>
                                        <td><img src="<?php echo $photo; ?>" alt="Product Image" class="product-image"></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $search_name; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td class="action-buttons">
                                            <button class="edit-btn">تعديل</button>
                                            <button class="delete-btn" onclick="deleteProduct(<?php echo $product_id; ?>)">حذف</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>لا توجد منتجات لعرضها</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="catalogues" class="section">
                <?php include 'connectionDB.php';
                $query = "SELECT * FROM catalogues";
                $result = $con->query($query); ?>
                <div class="product-list">
                    <h2>قائمة الكتالوجات</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>صورة الكتلوج</th>
                                <th>اسم الكتلوج</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="cataloguesTableBody">
                            <?php
                            // التحقق إذا كان هناك بيانات للمنتجات
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $photo = $row['c_photo'];  // مسار الصورة
                                    $name = $row['c_name'];    // اسم الكتلوج

                            ?>
                                    <tr>
                                        <td><img src="<?php echo $photo; ?>" alt="Product Image" class="product-image"></td>
                                        <td><?php echo $name; ?></td>
                                        <td class="action-buttons">
                                            <button class="edit-btn">تعديل</button>
                                            <button class="delete-btn" onclick="deleteProduct(<?php echo $product_id; ?>)">حذف</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>لا توجد كتلوجات لعرضها لعرضها</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div id="successMessage" class="popup-message" style="display: none;">
                تم الحفظ بنجاح!
            </div>
            <div id="add-product" class="section">
                <div class="add-product-form">
                    <h2>إضافة منتج جديد</h2>
                    <form id="productForm" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>صورة المنتج</label>
                            <input type="file" id="productImage" name="photo" accept="image/*" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>اسم المنتج</label>
                                <input type="text" id="productName" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>الاسم العامي</label>
                                <input type="text" id="productCommonName" name="search_name" required>
                            </div>
                            <div class="form-group">
                                <label>نوع المنتج</label>
                                <select id="productType" name="type" required>
                                    <option value="enterior">داخلي</option>
                                    <option value="exterior">خارجي</option>
                                    <option value="proof">عازل</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>وصف المنتج</label>
                            <textarea id="productDescription" name="description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>مواصفات المنتج (PDF)</label>
                            <input type="file" id="productSpecs" accept=".pdf" name="pdf" required>
                            <div id="pdfFileName" class="pdf-file-name"></div>
                        </div>
                        <button type="submit" name="save" class="submit-btn">إضافة المنتج</button>
                    </form>
                </div>
            </div>

            <div id="add-catalog" class="section">
                <div class="add-product-form">
                    <h2>إضافة كتلوج جديد</h2>
                    <form id="catalogForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>صورة الكتلوج</label>
                            <input type="file" id="catalogImage" name="photo" accept="image/*" required>
                            <img id="catalogImagePreview" class="preview-image" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label>اسم الكتلوج</label>
                            <input type="text" id="catalogName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>ملف الكتلوج (PDF)</label>
                            <input type="file" id="catalogPDF" name="pdf" accept=".pdf" required>
                            <div id="catalogPDFFileName" class="pdf-file-name"></div>
                        </div>
                        <button type="submit" name="add" class="submit-btn">إضافة الكتلوج</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                // إزالة الصنف "active" من جميع عناصر القائمة
                document.querySelectorAll('.menu-item').forEach(menuItem => {
                    menuItem.classList.remove('active');
                });

                // إضافة الصنف "active" إلى العنصر الحالي
                this.classList.add('active');

                // إخفاء جميع الأقسام
                document.querySelectorAll('.section').forEach(section => {
                    section.style.display = 'none';
                });

                // عرض القسم المحدد بناءً على المعرف
                const sectionId = this.getAttribute('data-section');
                if (sectionId) {
                    const section = document.getElementById(sectionId);
                    section.style.display = 'block';

                    // التعامل مع الجدول الخاص بكل قسم
                    if (sectionId === 'products') {
                        document.querySelector('.product-list').style.display = 'block';
                        document.querySelector('.catalogues-list').style.display = 'none';
                    } else if (sectionId === 'catalogues') {
                        document.querySelector('.catalogues-list').style.display = 'block';
                        document.querySelector('.product-list').style.display = 'none';
                    }
                }
            });
        });

        // إعداد القسم الافتراضي عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            // إخفاء جميع الأقسام أولاً
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });

            // إظهار قسم المنتجات افتراضيًا
            document.getElementById('products').style.display = 'block';
            document.querySelector('.product-list').style.display = 'block';
            document.querySelector('.catalogues-list').style.display = 'none';

            // إضافة الصنف "active" إلى القائمة الافتراضية
            document.querySelector('[data-section="products"]').classList.add('active');
        });


        // دالة لعرض الرسالة المنبثقة
        function showSuccessMessage(message) {
            const successMessage = document.getElementById('successMessage');
            successMessage.textContent = message; // تعيين النص
            successMessage.style.display = 'block'; // عرض العنصر
            successMessage.classList.add('show'); // إضافة كلاس العرض

            // إخفاء الرسالة بعد ثانيتين
            setTimeout(() => {
                successMessage.classList.remove('show'); // إزالة كلاس العرض
                setTimeout(() => successMessage.style.display = 'none', 500); // إخفاء العنصر بعد انتهاء التأثير
            }, 2000);
        }

        // دالة لتفريغ نموذج إضافة منتج
        function clearProductForm() {
            document.getElementById('productForm').reset(); // تفريغ الحقول النصية
            document.getElementById('imagePreview').style.display = 'none'; // إخفاء معاينة الصورة
            document.getElementById('pdfFileName').textContent = ''; // إزالة اسم ملف PDF
        }
    </script>
</body>

</html>