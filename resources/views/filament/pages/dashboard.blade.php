<x-filament::page>
    <div class="relative min-h-screen p-4 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Floating Shapes Background -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-96 h-96 bg-blue-100 rounded-full opacity-20 -top-20 -left-20 blur-3xl"></div>
            <div class="absolute w-96 h-96 bg-purple-100 rounded-full opacity-20 -bottom-20 -right-20 blur-3xl"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10">
            <!-- Header Section -->
            <div class="flex flex-col items-center mb-8 space-y-4">
                <div class="relative group">
                    <div class="absolute inset-0 bg-blue-500 rounded-full opacity-20 group-hover:opacity-30 transition-opacity blur-xl"></div>
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMKN 1 Punggelan" 
                         class="relative w-32 h-32 transition-transform duration-300 transform group-hover:scale-105">
                </div>
                <h1 class="text-4xl font-bold text-gray-800 text-center tracking-tight">
                    SMK NEGERI 1 PUNGGELAN
                </h1>
                <p class="text-gray-600 text-center max-w-2xl leading-relaxed">
                    Semangat, Optimis, Loyal, Ikhlas, Disiplin
                </p>
                <p class="text-sm text-gray-500 text-center">
                    Jl. Raya Pasar Manis, Loji, Punggelan, Banjarnegara
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Kompetensi Keahlian Card -->
                <div class="p-6 bg-white rounded-xl shadow-soft hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">4</p>
                            <p class="text-sm text-gray-600">Kompetensi Keahlian</p>
                        </div>
                    </div>
                </div>

                <!-- Program Stats -->
                <div class="p-6 bg-white rounded-xl shadow-soft hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-green-50 rounded-lg">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">5</p>
                            <p class="text-sm text-gray-600">Layanan</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-span-2 p-6 bg-white rounded-xl shadow-soft hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Telepon</p>
                                <p class="font-medium text-gray-800">08112517414</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-yellow-50 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium text-gray-800">smkn1_pgl@yahoo.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Kompetensi Keahlian -->
                <div class="p-6 bg-white rounded-xl shadow-soft hover:shadow-md transition-all transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Kompetensi Keahlian
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-blue-500">●</span>
                            <p class="text-gray-600">TBO (Teknik Bodi Otomotif)</p>
                        </div>
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-green-500">●</span>
                            <p class="text-gray-600">TKRO (Teknik Kendaraan Ringan Otomotif)</p>
                        </div>
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-purple-500">●</span>
                            <p class="text-gray-600">AKL (Akuntansi dan Keuangan Lembaga)</p>
                        </div>
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-yellow-500">●</span>
                            <p class="text-gray-600">SIJA (Sistem Informatika Jaringan dan Aplikasi)</p>
                        </div>
                    </div>
                </div>

                <!-- Berita Terbaru -->
                <div class="p-6 bg-white rounded-xl shadow-soft hover:shadow-md transition-all transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2" />
                        </svg>
                        Berita Terbaru
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-blue-500">●</span>
                            <p class="text-gray-600">Spirit Maulid Nabi (17 Sep 2024)</p>
                        </div>
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-green-500">●</span>
                            <p class="text-gray-600">Workshop Literasi: Sekolah Berbasis Industri 4.0</p>
                        </div>
                        <div class="flex items-center space-x-3 text-sm">
                            <span class="text-purple-500">●</span>
                            <p class="text-gray-600">Workshop Implementasi TEFA SMK 4.0</p>
                        </div>
                    </div>
                </div>

                <!-- Kutipan -->
                <div class="p-6 bg-white rounded-xl shadow-soft hover:shadow-md transition-all transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        Kutipan Inspiratif
                    </h3>
                    <div class="space-y-4">
                        <blockquote class="text-sm text-gray-600 italic">
                            "Tujuan akhir dari pendidikan bukanlah pengetahuan, melainkan tindakan."
                            <footer class="text-gray-500 mt-1">- Herbert Spencer</footer>
                        </blockquote>
                        <blockquote class="text-sm text-gray-600 italic">
                            "Pendidikan adalah senjata paling ampuh yang bisa kamu gunakan untuk mengubah dunia."
                            <footer class="text-gray-500 mt-1">- Nelson Mandela</footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-500">
        © 2024 SMKN 1 Punggelan - Developed by idiarso
    </div>

    <!-- Custom Styles -->
    <style>
        .shadow-soft {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</x-filament::page> 