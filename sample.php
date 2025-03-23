<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo & Tech Name -->
            <div class="flex items-center space-x-3">
                <img src="logo.png" alt="Logo" class="h-10 w-10"> 
                <span class="text-xl font-semibold text-gray-800">TechName</span>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Services</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="menu-btn" class="md:hidden text-gray-600 focus:outline-none text-2xl">
                ☰
            </button>
        </div>
    </header>

    <!-- Sidebar Menu (Hidden by default) -->
    <div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300">
        <div class="p-6">
            <button id="close-btn" class="text-gray-600 text-2xl">✖</button>
            <nav class="mt-6 flex flex-col space-y-4">
                <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">About</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Services</a>
                <a href="#" class="text-gray-600 hover:text-blue-500">Contact</a>
            </nav>
        </div>
    </div>

    <!-- Overlay (Hidden by default) -->
    <div id="overlay" class="hidden fixed inset-0 bg-black opacity-50"></div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        // Open Sidebar
        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        // Close Sidebar
        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Close when clicking outside
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

</body>
</html>
