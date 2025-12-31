<?php
if (!isset($root_path)) {
    $root_path = '../'; 
}
$current_page = basename($_SERVER['PHP_SELF']);

function isActivePublic($page, $current) {
    return $page === $current 
        ? 'text-locar-orange font-bold text-xs tracking-widest transition' 
        : 'text-gray-900 font-bold text-xs tracking-widest hover:text-locar-orange transition';
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isConnected = false;

if(isset($_SESSION["id"])){
    $isConnected = true;
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
                <?php if ($isConnected): ?>
                <a href="<?= $root_path ?>index.php" class="<?= isActivePublic('index.php', $current_page) ?>">ACCUEIL</a>
                <a href="<?= $root_path ?>pages/vehicles.php" class="<?= isActivePublic('vehicles.php', $current_page) ?>">VÉHICULES</a>
                <a href="<?= $root_path ?>pages/user/my-reservations.php" class="<?= isActivePublic('my-reservations.php', $current_page) ?>">MES RÉSERVATIONS</a>
                <a href="<?= $root_path ?>pages/user/my-reviews.php" class="<?= isActivePublic('my-reviews.php', $current_page) ?>">MES AVIS</a>
                <a href="<?= $root_path ?>pages/user/favorites.php" class="<?= isActivePublic('favorites.php', $current_page) ?>">MES FAVORIS</a>
                <?php endif; ?>
            </div>

            <div class="hidden md:flex items-center">
                <?php if ($isConnected): ?>
                    <a href="<?= $root_path ?>includes/logout.php" class="flex items-center gap-2 font-bold text-xs bg-black text-white px-6 py-3 rounded-full hover:bg-locar-orange transition shadow-lg">
                        <i class="fa-solid fa-right-from-bracket"></i> LOGOUT
                    </a>
                <?php else: ?>
                    <a href="<?= $root_path ?>pages/login.php" class="flex items-center gap-2 font-bold text-xs bg-black text-white px-6 py-3 rounded-full hover:bg-locar-orange transition shadow-lg">
                        <i class="fa-solid fa-user"></i> LOGIN / SIGN UP
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>