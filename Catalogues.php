<?php
include 'connectionDB.php';
include 'NavBar.php';

// Fetch catalog data from the database
$sql = "SELECT c_photo, c_name, c_pdf FROM catalogues";
$result = $con->query($sql);

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-12 mt-20 text-gray-800">الكتالوجات</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Loop through the fetched data and display each catalog
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $c_photo = htmlspecialchars($row['c_photo']);
                    $c_name = htmlspecialchars($row['c_name']);
                    $c_pdf = htmlspecialchars($row['c_pdf']);
            ?>
                    <div class="bg-white rounded-lg shadow-lg p-4 text-center hover:shadow-xl">
                        <img src="<?php echo  $c_photo; ?>" alt="">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800"><?php echo  $c_name; ?></h3>
                        <a href="<?php echo  $c_pdf; ?>" target="_blank"
                            class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
                            download>
                            تحميل PDF
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </div>
    <?php include "footer.php"; ?>

    <style>
        /* Add RTL support */
        body {
            direction: rtl;
        }

        /* Add smooth hover effects */



        /* Responsive adjustments */
        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</body>

</html>