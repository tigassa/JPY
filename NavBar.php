<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        nav{
            background-color: #374151;
        }
        
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            right: 0;
            background-color: #2563eb;
            transition: width 0.3s ease-in-out;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            background-color: #374151;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 50;
        }

        .mobile-menu.active {
            max-height: 200px;
        }

        .logo-text-ar {
            font-size: 1.125rem;
            /* text-lg */
            font-weight: 600;
            color: white;
            /* text-gray-700 */
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex space-x-7">
                    <div>
                        <a href="HomePage.php" class="flex items-center py-4">
                            <img src="images/logo.png" class="max-w-16" alt="">
                            <div class="flex flex-col justify-center">
                                <span class="logo-text-ar">دهـانـات الـجزيـرة</span>
                                <span class="logo-text-ar">JAZEERA PAINTS</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none text-white">
                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-16 6h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden md:flex items-center space-x-8 space-x-reverse">
                    <a href="index.html" class="nav-link py-4 px-2 text-gray-700 hover:text-blue-600 text-white">الرئيسية</a>
                    <a href="branches.php" class="nav-link py-4 px-2 text-gray-700 hover:text-blue-600 text-white">الفروع</a>
                    <a href="https://aljazeerah.com/contact"
                        class="nav-link py-4 px-2 text-gray-700 hover:text-blue-600 text-white">التواصل</a>
                    <a href="https://aljazeerah.com/about" class="nav-link py-4 px-2 text-gray-700 hover:text-blue-600 text-white">حول</a>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu">
                <a href="index.html" class="block py-2 px-4 text-gray-700 hover:text-blue-600 text-white">الرئيسية</a>
                <a href="branches.php" class="block py-2 px-4 text-gray-700 hover:text-blue-600 text-white">الفروع</a>
                <a href="https://aljazeerah.com/contact"
                    class="block py-2 px-4 text-gray-700 hover:text-blue-600 text-white">التواصل</a>
                <a href="https://aljazeerah.com/about"
                    class="block py-2 px-4 text-gray-700 hover:text-blue-600 text-white">حول</a>
            </div>
        </div>
    </nav>

    <!-- Search Form -->
    <nav class="bg-gray-100 shadow-md fixed top-20 left-0 right-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <form action="Search_Result.php" method="POST" class="flex justify-center space-x-4">
                <input
                    type="text"
                    name="search_term"
                    class="w-96 border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600 me-8"
                    placeholder="ابحث عن المنتجات..."
                    required />
                <button
                    type="submit"
                    name="search"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    بحث
                </button>
            </form>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('active');
        });
    </script>
</body>

</html>
