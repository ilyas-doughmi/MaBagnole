<?php
session_start();
// Mock Data for Reservations
$reservations = [
    [
        'id' => 1023,
        'vehicle' => 'Volvo V60',
        'image' => 'https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png',
        'start_date' => '2025-12-20',
        'end_date' => '2025-12-25',
        'total_price' => 375,
        'status' => 'Confirmée',
        'status_color' => 'green'
    ],
    [
        'id' => 980,
        'vehicle' => 'BMW X5',
        'image' => 'https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png',
        'start_date' => '2025-11-10',
        'end_date' => '2025-11-12',
        'total_price' => 300,
        'status' => 'Terminée',
        'status_color' => 'gray'
    ],
    [
        'id' => 1045,
        'vehicle' => 'Mercedes C-Class',
        'image' => 'https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png',
        'start_date' => '2026-01-05',
        'end_date' => '2026-01-10',
        'total_price' => 600,
        'status' => 'En attente',
        'status_color' => 'yellow'
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations | MaBagnole</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito Sans', 'sans-serif'],
                    },
                    colors: {
                        'locar-orange': '#FF5F00',
                        'locar-black': '#1a1a1a',
                        'locar-dark': '#0F0F0F',
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-100 fixed w-full z-40">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="../../index.php" class="flex items-center gap-2">
                    <div class="bg-locar-orange text-white w-10 h-10 flex items-center justify-center rounded text-xl font-bold">
                        <i class="fa-solid fa-car"></i>
                    </div>
                    <span class="font-black text-2xl tracking-tighter">Ma<span class="text-locar-orange">Bagnole</span></span>
                </a>
                
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-gray-500">Bonjour, Ahmed</span>
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500">
                        A
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-20 min-h-screen flex">
        
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 p-8">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-black uppercase text-gray-900">Mes Réservations</h1>
                        <p class="text-gray-500 font-medium mt-1">Consultez l'historique et l'état de vos locations.</p>
                    </div>
                </div>

                <!-- Reservations Table -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-400 font-bold tracking-wider">
                                    <th class="p-6">Véhicule</th>
                                    <th class="p-6">Dates</th>
                                    <th class="p-6">Prix Total</th>
                                    <th class="p-6">Statut</th>
                                    <th class="p-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php foreach($reservations as $res): ?>
                                <tr class="hover:bg-gray-50 transition group">
                                    <td class="p-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-12 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                                <img src="<?= $res['image'] ?>" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-black text-gray-800"><?= $res['vehicle'] ?></p>
                                                <p class="text-xs text-gray-400 font-bold">#<?= $res['id'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="text-sm font-bold text-gray-600">
                                            <p><span class="text-gray-400 w-8 inline-block">Du:</span> <?= date('d/m/Y', strtotime($res['start_date'])) ?></p>
                                            <p><span class="text-gray-400 w-8 inline-block">Au:</span> <?= date('d/m/Y', strtotime($res['end_date'])) ?></p>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <span class="font-black text-lg text-locar-orange"><?= $res['total_price'] ?>$</span>
                                    </td>
                                    <td class="p-6">
                                        <?php
                                            $statusClass = '';
                                            switch($res['status_color']) {
                                                case 'green': $statusClass = 'bg-green-100 text-green-600'; break;
                                                case 'yellow': $statusClass = 'bg-yellow-100 text-yellow-600'; break;
                                                case 'gray': $statusClass = 'bg-gray-100 text-gray-500'; break;
                                            }
                                        ?>
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-black uppercase <?= $statusClass ?>">
                                            <?= $res['status'] ?>
                                        </span>
                                    </td>
                                    <td class="p-6 text-right">
                                        <button class="text-gray-400 hover:text-locar-orange transition">
                                            <i class="fa-solid fa-eye text-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php if(empty($reservations)): ?>
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-calendar-xmark text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Aucune réservation trouvée</h3>
                        <p class="text-gray-500 text-sm mb-6">Vous n'avez pas encore effectué de réservation.</p>
                        <a href="../vehicles.php" class="inline-block bg-black text-white font-bold py-3 px-6 rounded-lg hover:bg-locar-orange transition">
                            Réserver un véhicule
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
