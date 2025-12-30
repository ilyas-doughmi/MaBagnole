<?php
session_start();
// Mock Data
$reservations = [
    ['id' => 1023, 'client' => 'Ahmed Benali', 'vehicule' => 'Volvo V60', 'dates' => '20/12 - 25/12', 'status' => 'Confirmée'],
    ['id' => 1045, 'client' => 'Sarah K.', 'vehicule' => 'BMW X5', 'dates' => '05/01 - 10/01', 'status' => 'En attente'],
    ['id' => 980, 'client' => 'John Doe', 'vehicule' => 'Peugeot 208', 'dates' => '10/11 - 12/11', 'status' => 'Annulée'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer Réservations | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Nunito Sans', 'sans-serif'] },
                    colors: { 'locar-orange': '#FF5F00', 'locar-black': '#1a1a1a' }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
        <div class="container mx-auto px-6 py-8">
            <h3 class="text-gray-700 text-3xl font-black uppercase mb-8">Réservations</h3>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-400 font-bold tracking-wider">
                            <th class="p-4">ID</th>
                            <th class="p-4">Client</th>
                            <th class="p-4">Véhicule</th>
                            <th class="p-4">Dates</th>
                            <th class="p-4">Statut</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach($reservations as $r): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-bold text-gray-500">#<?= $r['id'] ?></td>
                            <td class="p-4 font-bold"><?= $r['client'] ?></td>
                            <td class="p-4 text-sm"><?= $r['vehicule'] ?></td>
                            <td class="p-4 text-sm text-gray-500"><?= $r['dates'] ?></td>
                            <td class="p-4">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                                    <?= $r['status'] == 'Confirmée' ? 'bg-green-100 text-green-600' : ($r['status'] == 'Annulée' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-600') ?>">
                                    <?= $r['status'] ?>
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <button class="text-green-500 hover:text-green-700" title="Confirmer"><i class="fa-solid fa-check"></i></button>
                                <button class="text-red-500 hover:text-red-700" title="Annuler"><i class="fa-solid fa-xmark"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
