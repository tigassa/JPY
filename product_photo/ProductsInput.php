<?php
include "connectionDB.php";

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
        $allowed_extensions = array("png", "jpg", "jpeg");

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
            echo "نجح الحفظ<br>";
        } else {
            echo "خطأ في حفظ البيانات";
        }
        $stmt->close();
    }
} else {
}


?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدخال منتج</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto w-1/2 p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">قم بإدخال بيانات المنتج</h2>
        <form action="" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">صورة المنتج</label>
                <input type="file" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="photo" name="photo">
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">اسم المنتج</label>
                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" placeholder="">
            </div>
            <div class="mb-4">
                <label for="search_name" class="block text-gray-700 text-sm font-bold mb-2">اسم المنتج العامي</label>
                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="search_name" name="search_name" placeholder="">
            </div>
            <div class="mb-4">
                <label for="selectInput" class="block text-gray-700 text-sm font-bold mb-2">نوع المنتج</label>
                <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="selectInput" name="type">
                    <option value="enterior">داخلي</option>
                    <option value="exterior">خارجي</option>
                    <option value="proof">عزل</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">وصف المنتج</label>
                <input type="text" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="">
            </div>
            <div class="mb-4">
                <label for="pdf" class="block text-gray-700 text-sm font-bold mb-2">مواصفات المنتج PDF</label>
                <input type="file" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pdf" name="pdf">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="save">إضافة</button>
        </form>
    </div>
</body>

</html>