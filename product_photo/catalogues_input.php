<?php
include "connectionDB.php";

if (isset($_POST["save"])) {
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
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-lg">
        <h2 class="text-2xl font-bold text-center mb-4">قم بإدخال بيانات الكتلوج</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="my-4">
                <label for="photo" class="block text-lg">صورة الكتلوج</label>
                <input type="file" class="border border-gray-300 rounded px-4 py-2 w-full" id="photo" name="photo">
            </div>
            <div class="my-4">
                <label for="name" class="block text-lg">اسم الكتلوج</label>
                <input type="text" class="border border-gray-300 rounded px-4 py-2 w-full" id="name" name="name" placeholder=" اسم الكتلوج">
            </div>
            <div class="my-4">
                <label for="pdf" class="block text-lg">الكتلوج PDF</label>
                <input type="file" class="border border-gray-300 rounded px-4 py-2 w-full" id="pdf" name="pdf">
            </div>
            <button type="submit" name="save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                إضافة
            </button>
        </form>
    </div>
</body>

</html>