<header class="shadow-lg position-relative z-3 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg ">
        <x-main-menu :menus="$menus" />
        <!-- قائمة جانبية للموبايل -->
        <x-mobile-menu :menus="$menus" />
    </nav>
</header>
