<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jovial Events</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#8b5cf6',
                            primaryHover: '#7c3aed',
                            darkBg: '#2c3e50',
                            darkText: '#ecf0f1',
                            accent: '#e74c3c'
                        },
                        boxShadow: {
                            'custom': '0 10px 20px rgba(0, 0, 0, 0.2)',
                        }
                    }
                }
            }
        </script>
        <style>
            .text-shadow {
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }
            .text-shadow-lg {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Header/Navigation -->
        <header class="fixed w-full top-0 left-0 right-0 z-50 bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-primary">Jovial Events</h1>
                </div>

                <!-- Auth Links -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out">Tableau de bord</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold text-white bg-primary hover:bg-primaryHover px-4 py-2 rounded-full transition duration-300 hover:shadow-custom ml-4">
                                    Inscription
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="pt-20"> <!-- Padding top to account for fixed header -->

            <!-- Hero Banner -->
            <section class="relative bg-cover bg-center h-screen flex items-center justify-center text-center text-white px-5"
                     style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80')">
                <div class="max-w-4xl px-4">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-shadow-lg">Vivez des événements comme jamais auparavant</h1>
                    <p class="text-lg md:text-xl leading-relaxed mb-10 text-shadow">
                        Plongez au cœur d'expériences uniques où chaque détail est pensé pour émerveiller vos sens.
                        Laissez-nous vous transporter vers des moments magiques qui marqueront votre mémoire à jamais.
                    </p>
                    <a href="{{ route('login') }}"
   class="inline-flex items-center justify-center bg-primary hover:bg-primaryHover text-white font-semibold py-3 px-8 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
   Commencer
   <svg class="w-5 h-5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
   </svg>
</a>
                </div>
            </section>

            <!-- Main Content Section -->
            <section class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
                <div class="max-w-6xl mx-auto">
                    <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-6">Comment pouvons-nous répondre à vos besoins ?</h1>
                    <div class="w-24 h-1 bg-accent mx-auto mb-10"></div>
                    <p class="text-base md:text-lg text-gray-600 text-center mb-16 max-w-4xl mx-auto">
                        <strong class="text-gray-800">Jovial Events</strong> est votre partenaire idéal pour
                        <strong class="text-gray-800"> organiser et vivre des expériences uniques !</strong><br/><br/>
                        Grâce à notre plateforme intuitive, découvrez des événements près de chez vous,
                        réservez vos tickets en ligne en quelques clics et recevez instantanément
                        votre reçu par email, le tout avec un paiement 100% sécurisé.<br/><br/>
                        Notre solution vous propose des fonctionnalités et technologies qui facilitent
                        la gestion de vos événements, des inscriptions et des paiements en ligne.
                    </p>

                    <!-- Organizers Section -->
                    <!-- Organizers Section -->
                <h2 class="text-3xl font-bold text-gray-800 mt-20 mb-6">Pour les organisateurs</h2>
                <div class="w-24 h-1 bg-accent mb-12"></div>

                <!-- First Organizer Block -->
                <div class="flex flex-col md:flex-row gap-10 mb-16">
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Organisation et configuration de votre événement</h3>
                        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                            <p class="text-gray-600">
                                L'organisation d'un événement est un véritable défi. Il faut penser à une multitude de détails en très peu de temps ! La solution Jovial Events
                                vous propose des fonctionnalités et technologies qui facilitent la gestion de vos événements, gestion des inscriptions et des paiements en ligne, contrôle d'accès sur place, suivi de votre caisse... Nos outils sont conçus pour vous et pour vos événements, petits comme grands !
                            </p>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                             alt="Organisation d'événement"
                             class="w-full h-auto rounded-lg shadow-md object-cover">
                    </div>
                </div>

                <!-- Second Organizer Block -->
                <div class="flex flex-col md:flex-row gap-10 mb-16">
                    <div class="md:w-1/2 order-1 md:order-2">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Gestion de votre inscription et Suivi de votre caisse</h3>
                        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                            <p class="text-gray-600">
                                La bonne gestion de votre événement passe d'abord par la gestion des inscriptions. Nous avons tout fait pour que saisir les participants soit le plus rapide et le plus simple possible. Vos participants souhaitent payer sur place ? D'un simple clic, validez le paiement d'un participant. Un rapport journalier de votre vente ou caisse est enregistré automatiquement pour vous faciliter la comptabilité.
                            </p>
                        </div>
                    </div>
                    <div class="md:w-1/2 order-2 md:order-1">
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                             alt="Gestion des inscriptions"
                             class="w-full h-auto rounded-lg shadow-md object-cover">
                    </div>
                </div>

                <!-- Third Organizer Block -->
                <div class="flex flex-col md:flex-row gap-10 mb-16">
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Vos événements sur mesure</h3>
                        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                            <p class="text-gray-600">
                                Créez autant d'événements que vous le souhaitez. Donnez leurs un nom, un lieu et une date, créez différentes épreuves, gérez les prix et les remises.
                                Si l'inscription à votre événement est payante, vous pouvez donner la possibilité aux participants de s'inscrire et de payer en ligne. Vous êtes informé à chaque paiement et vous pouvez à tout moment consulter votre solde depuis l'application.
                            </p>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                             alt="Organisation d'événement"
                             class="w-full h-auto rounded-lg shadow-md object-cover">
                    </div>
                </div>


                    <!-- Partners Section -->
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-20 mb-6 text-center">Nos partenaires</h2>
                    <div class="w-24 h-1 bg-accent mx-auto mb-12"></div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 my-12">
                        <div class="p-5 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 text-center">
                            <div class="h-20 mb-4 flex items-center justify-center">
                                <img src="/images/partner1.png" alt="Logo Partenaire 1" class="max-h-full max-w-full object-contain">
                            </div>
                            <h4 class="font-semibold text-gray-800">EventPro</h4>
                        </div>
                        <div class="p-5 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 text-center">
                            <div class="h-20 mb-4 flex items-center justify-center">
                                <img src="/images/partner2.jpg" alt="Logo Partenaire 2" class="max-h-full max-w-full object-contain">
                            </div>
                            <h4 class="font-semibold text-gray-800">Festival Horizon</h4>
                        </div>
                        <div class="p-5 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 text-center">
                            <div class="h-20 mb-4 flex items-center justify-center">
                                <img src="/images/partner3.png" alt="Logo Partenaire 3" class="max-h-full max-w-full object-contain">
                            </div>
                            <h4 class="font-semibold text-gray-800">TechEvent</h4>
                        </div>
                        <div class="p-5 bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 text-center">
                            <div class="h-20 mb-4 flex items-center justify-center">
                                <img src="/images/partner4.jpg" alt="Logo Partenaire 4" class="max-h-full max-w-full object-contain">
                            </div>
                            <h4 class="font-semibold text-gray-800">Cultural Connect</h4>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-darkBg text-darkText pt-16 pb-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- About Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-accent">Jovial Events</h3>
                    <p class="mb-6 text-gray-400">
                        Plateforme de gestion d'événements tout-en-un pour organisateurs et participants.
                    </p>
                    <div class="flex gap-4">
                        <a href="#facebook" class="bg-gray-700 hover:bg-accent w-9 h-9 rounded-full flex items-center justify-center transition-colors duration-300 text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#twitter" class="bg-gray-700 hover:bg-accent w-9 h-9 rounded-full flex items-center justify-center transition-colors duration-300 text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#instagram" class="bg-gray-700 hover:bg-accent w-9 h-9 rounded-full flex items-center justify-center transition-colors duration-300 text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#linkedin" class="bg-gray-700 hover:bg-accent w-9 h-9 rounded-full flex items-center justify-center transition-colors duration-300 text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-accent">Liens rapides</h3>
                    <ul class="space-y-3">
                        <li><a href="/evenements" class="text-gray-400 hover:text-white transition-colors duration-300">Événements</a></li>
                        <li><a href="/organisation" class="text-gray-400 hover:text-white transition-colors duration-300">Organisation</a></li>
                        <li><a href="/tarifs" class="text-gray-400 hover:text-white transition-colors duration-300">Tarifs</a></li>
                        <li><a href="/blog" class="text-gray-400 hover:text-white transition-colors duration-300">Blog</a></li>
                        <li><a href="/contact" class="text-gray-400 hover:text-white transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-accent">Contact</h3>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-accent"></i>
                            <span>123 Rue des Événements, Tunis</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-accent"></i>
                            <span>+216 99 999 999</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-accent"></i>
                            <span>contact@jovialevents.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-accent">Newsletter</h3>
                    <p class="mb-6 text-gray-400">
                        Abonnez-vous pour recevoir nos actualités.
                    </p>
                    <form class="flex">
                        <input type="email" placeholder="Votre email"
                               class="flex-1 px-4 py-2 rounded-l focus:outline-none text-gray-800">
                        <button type="submit" class="bg-accent hover:bg-red-600 px-4 py-2 rounded-r transition-colors duration-300 text-white">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-500 text-sm mb-4 md:mb-0">
                        &copy; {{ date('Y') }} Jovial Events. Tous droits réservés.
                    </p>
                    <div class="flex gap-4 md:gap-6">
                        <a href="/mentions-legales" class="text-gray-500 hover:text-white text-sm transition-colors duration-300">Mentions légales</a>
                        <a href="/cgv" class="text-gray-500 hover:text-white text-sm transition-colors duration-300">CGV</a>
                        <a href="/confidentialite" class="text-gray-500 hover:text-white text-sm transition-colors duration-300">Confidentialité</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
