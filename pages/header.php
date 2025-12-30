<?php
if (!isset($root_path)) {
    $root_path = '../'; // Default for pages inside 'pages/'
}
$current_page = basename($_SERVER['PHP_SELF']);

function isActivePublic($page, $current) {
    return $page === $current 
        ? 'text-locar-orange font-bold text-xs tracking-widest transition' 
        : 'text-gray-900 font-bold text-xs tracking-widest hover:text-locar-orange transition';
}
?>
<nav class="glass-nav fixed w-full z-40 border-b border-gray-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <a href="<?= $root_path ?>index.php" class="flex items-center gap-2">
                <div class="bg-locar-orange text-white w-10 h-10 flex items-center justify-center rounded text-xl font-bold">
                    <i class="fa-solid fa-car"></i>
                </div>
                <span class="font-black text-2xl tracking-tighter">Ma<span class="text-locar-orange">Bagnole</span></span>
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="<?= $root_path ?>index.php" class="<?= isActivePublic('index.php', $current_page) ?>">ACCUEIL</a>
                <a href="<?= $root_path ?>pages/vehicles.php" class="<?= isActivePublic('vehicles.php', $current_page) ?>">VÉHICULES</a>
                <a href="<?= $root_path ?>index.php#Service" class="text-gray-900 font-bold text-xs tracking-widest hover:text-locar-orange transition">SERVICES</a>
                <a href="<?= $root_path ?>index.php#Contact" class="text-gray-900 font-bold text-xs tracking-widest hover:text-locar-orange transition">CONTACT</a>
            </div>

            <div class="hidden md:flex items-center">
                <a href="<?= $root_path ?>pages/login.php" class="flex items-center gap-2 font-bold text-xs bg-black text-white px-6 py-3 rounded-full hover:bg-locar-orange transition shadow-lg">
                    <i class="fa-solid fa-user"></i> LOGIN / SIGN UP
                </a>
            </div>
        </div>
    </div>
</nav>