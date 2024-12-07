<?php
include 'NavBar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروعنا | دهانات الجزيرة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }


        .branches-title {
            text-align: center;
            margin: 30px 0;
            color: #1a4c6b;
            font-size: clamp(1.8em, 4vw, 2.5em);
        }

        .branch-section {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
            background: #e9e9eb;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 95%;
        }

        .branch-image {
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        .branch-info {
            padding: 20px;
            direction: rtl;
            flex: 1;
        }

        .branch-info h3 {
            color: #1a4c6b;
            margin-bottom: 15px;
            font-size: clamp(1.2em, 3vw, 1.5em);
        }

        .branch-info p {
            margin: 10px 0;
            font-size: clamp(0.9em, 2vw, 1.1em);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .branch-info i {
            color: #1a4c6b;
            min-width: 20px;
        }

       
        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .branch-section {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .branch-image {
                margin-bottom: 20px;
            }

            .branch-info {
                padding: 10px;
            }

            .branch-info p {
                justify-content: center;
            }

          
        }

        @media screen and (max-width: 480px) {
            .header h1 {
                font-size: 1.5em;
            }

            .branch-info {
                padding: 5px;
            }

        }
    </style>
</head>

   

    <h2 class="branches-title">فروعنا</h2>

    <section class="branch-section">
        <img src="images/airport_brunch.jpg" class="branch-image" alt="">
        <div class="branch-info">
            <h3>فرع صنعاء المطار</h3>
            <p><i class="fas fa-map-marker-alt"></i> صنعاء - شارع المطار - جولة الجمنة - مقابل مستشفى يوني ماكس الدولي </p>
            <p><i class="fas fa-phone"></i>772774499</p>
            <p><i class="fas fa-clock"></i> من 8 صباحاً - 9 مساءً</p>
        </div>
    </section>

    <section class="branch-section">
        <img src="images/sauan_brunch.jpg" class="branch-image" alt="">
        <div class="branch-info">
            <h3>فرع صنعاء سعوان</h3>
            <p><i class="fas fa-map-marker-alt"></i> صنعاء - سعوان - جولة النصر - مقابل مستشفى الدكتورة مها البيضاني            </p>
            <p><i class="fas fa-phone"></i> 770399888 </p>
            <p><i class="fas fa-clock"></i> من 8 صباحاً - 9 مساءً</p>
        </div>
    </section>

    <section class="branch-section">
        <img src="images/sixty_brunch.jpg" class="branch-image" alt="">
        <div class="branch-info">
            <h3>فرع صنعاء الستين</h3>
            <p><i class="fas fa-map-marker-alt"></i> صنعاء - شارع الستين - السنينة - جوار بنك الكريمي </p>
            <p><i class="fas fa-phone"></i> 779110044 </p>
            <p><i class="fas fa-clock"></i> من 8 صباحاً - 9 مساءً</p>
        </div>
    </section>

    <section class="branch-section">
        <img src="images/hoban.jpg" class="branch-image" alt="">
        <div class="branch-info">
            <h3>فرع تعز الحوبان</h3>
            <p><i class="fas fa-map-marker-alt"></i> تعز - الحوبان - مصلحة الطرقات - جوار مجمع ريفان الدولي </p>
            <p><i class="fas fa-phone"></i> 777276999 </p>
            <p><i class="fas fa-clock"></i> من 8 صباحاً - 9 مساءً</p>
        </div>
    </section>

    <section class="branch-section">
        <img src="images/taiz_brunch.jpg" class="branch-image" alt="">
        <div class="branch-info">
            <h3>فرع تعز الحصب</h3>
            <p><i class="fas fa-map-marker-alt"></i> تعز - المدينة - شارع الحصب - جوار فندق فور سيزونز</p>
            <p><i class="fas fa-phone"></i> 771282948 </p>
            <p><i class="fas fa-clock"></i> من 8 صباحاً - 9 مساءً</p>
        </div>
    </section>
    </body>

</html>