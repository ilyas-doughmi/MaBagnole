<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | MaBagnole</title>
    
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
                    boxShadow: {
                        'neon': '0 0 20px rgba(255, 95, 0, 0.4)',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex items-center justify-center p-4 relative overflow-x-hidden">
    
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-2/3 h-full bg-gradient-to-r from-gray-200 to-transparent -z-10"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-locar-orange rounded-full blur-[150px] opacity-10 -z-10"></div>

    <div class="bg-white w-full max-w-6xl rounded-2xl overflow-hidden shadow-2xl flex flex-col md:flex-row relative z-10 my-10">
        
        <!-- Left Side: Promo/Login Link -->
        <div class="w-full md:w-1/3 bg-locar-dark text-white p-10 flex flex-col justify-center items-center text-center relative overflow-hidden order-2 md:order-1">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-transparent to-black/80"></div>
            
            <div class="relative z-10">
                <h3 class="font-black text-3xl mb-4 uppercase">Déjà membre ?</h3>
                <p class="text-gray-400 mb-8 leading-relaxed font-medium">
                    Connectez-vous pour accéder à votre compte et gérer vos réservations en toute simplicité.
                </p>
                
                <a href="login.php" class="inline-block bg-white text-black hover:bg-locar-orange hover:text-white font-black py-4 px-10 rounded-full shadow-xl transition-all duration-300 transform hover:scale-105">
                    SE CONNECTER
                </a>
            </div>

            <!-- Decorative Car Image -->
            <img src="https://raw.githubusercontent.com/AChaoub/Fil_rouge_2020/master/Public/IMG/Img_voiture/Lexus.png" class="absolute bottom-20 -left-20 w-80 opacity-30 transform rotate-12 pointer-events-none">
        </div>

        <!-- Right Side: Registration Form -->
        <div class="w-full md:w-2/3 p-10 md:p-16 flex flex-col justify-center order-1 md:order-2">
            <div class="mb-8">
                <a href="../index.php" class="inline-flex items-center gap-2 text-gray-400 hover:text-locar-orange transition mb-6 font-bold text-sm">
                    <i class="fa-solid fa-arrow-left"></i> Retour à l'accueil
                </a>
                <h2 class="font-black text-4xl uppercase mb-2">Créer un compte</h2>
                <p class="text-gray-500 font-medium">Remplissez le formulaire ci-dessous pour commencer.</p>
            </div>

            <form action="" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Nom</label>
                        <input type="text" name="nom" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="Votre nom">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Prénom</label>
                        <input type="text" name="prenom" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="Votre prénom">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="votre@email.com">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Téléphone</label>
                        <input type="tel" name="telephone" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="+212 6...">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Ville</label>
                        <input type="text" name="ville" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="Votre ville">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Adresse</label>
                        <input type="text" name="adresse" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="Votre adresse">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Mot de passe</label>
                        <input type="password" name="password" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2 uppercase tracking-wider">Confirmer</label>
                        <input type="password" name="confirm_password" class="w-full px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 focus:border-locar-orange focus:ring-2 focus:ring-locar-orange/20 outline-none font-bold transition" placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-locar-orange hover:bg-black text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        S'INSCRIRE MAINTENANT
                    </button>
                </div>
                
                <p class="text-center text-xs text-gray-400 font-bold mt-4">
                    En vous inscrivant, vous acceptez nos <a href="#" class="text-locar-orange hover:underline">Conditions d'utilisation</a> et notre <a href="#" class="text-locar-orange hover:underline">Politique de confidentialité</a>.
                </p>
            </form>
        </div>
    </div>

</body>
</html>
