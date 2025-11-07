@extends("layouts.app")
@section("title", "Bibliothèque en ligne - Détails du livre")
@section("content")
    <!-- Main Content -->
    <main class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Content (Book Details) -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                        <div class="md:flex items-start">
                            <div class="shrink-0 mr-6 mb-4 md:mb-0">
                                <img class="w-48 h-auto object-cover rounded-md shadow-lg mx-auto" src="https://placehold.co/200x300" alt="Book Cover">
                            </div>
                            <div class="grow">
                                <h3 class="text-3xl font-bold text-gray-900">Laravel for Dummies</h3>
                                <ul class="mt-2 flex flex-wrap gap-x-4 gap-y-2 text-gray-500">
                                    <li>by Chain Coder</li>
                                    <li class="list-disc list-inside">PHP, LARAVEL</li>
                                </ul>
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                    <h4 class="text-xl font-semibold text-gray-800">Description</h4>
                                    <p class="mt-4 text-gray-600 leading-relaxed">
                                        A few months back I bought a license for Laravel Spark but never got around to using it. To be honest I find the thought of using PHP a little hard since I have been working on Django/Flask apps for so long but Laravel Spark framework does address a lot of my issues with frameworks like Django and Flask. It is very opinionated and takes care of a lot of bolier-plate tedium.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Book Overview) -->
                <aside class="col-span-1">
                    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md">
                        <h4 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-4">Aperçu du livre</h4>
                        <ul class="mt-4 space-y-3 text-gray-600">
                            <li class="flex justify-between"><span>Date de création:</span> <span class="font-medium text-gray-900">12 Aug 2019</span></li>
                            <li class="flex justify-between"><span>Auteur:</span> <span class="font-medium text-gray-900">Chain Coder</span></li>
                            <li class="flex justify-between"><span>Editeur:</span> <span class="font-medium text-gray-900">Dummies Lab</span></li>
                            <li class="flex justify-between"><span>Catégorie:</span> <span class="font-medium text-gray-900">Informatique</span></li>
                            <li class="flex justify-between"><span>Prix:</span> <span class="font-medium text-gray-900">$35</span></li>
                        </ul>
                        <div class="mt-6">
                            <a href="#" class="w-full flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Acheter
                            </a>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
