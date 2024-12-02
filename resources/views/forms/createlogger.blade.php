<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Channel Logger</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Silakan isi formulir di bawah ini untuk mencatat log channel.
                </p>

                <!-- Form Logger -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('logger.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Select 1 -->
                        <div class="mb-4">
                            <label for="select_1" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Channel Logger
                            </label>
                            <select id="select_1" name="channel" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih channel</option>
                                <option value="Pro 1">Pro 1</option>
                                <option value="Pro 2">Pro 2</option>
                                <option value="Pro 3">Pro 3</option>
                                <option value="Pro 4">Pro 4</option>
                                <option value="Pro 5 / Channel lima">Pro 5 / Channel lima</option>
                                <!-- Tambahkan opsi di sini -->
                            </select>
                        </div>

                        <!-- Input Jam Masuk -->
                        <div class="mb-4">
                            <label for="jam_masuk" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jam Masuk
                            </label>
                            <input type="time" id="jam_masuk" name="jam_masuk" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Input Jam Keluar -->
                        <div class="mb-4">
                            <label for="jam_keluar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jam Keluar
                            </label>
                            <input type="time" id="jam_keluar" name="jam_keluar" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Input Tanggal -->
                        <div class="mb-4">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal
                            </label>
                            <input type="date" id="tanggal" name="tanggal" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                          <!-- Input untuk Mengunggah File -->
                        <div class="mb-4">
                            <label for="attachment" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Unggah File (JPG, PNG, PDF)
                            </label>
                            <input type="file" id="attachment" name="attachment" accept=".jpg,.jpeg,.png,.pdf" required
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Format yang diperbolehkan: JPG, PNG, PDF.</p>
                        </div>

                        <!-- Input Petugas (Hidden ID) -->
                        <input type="hidden" id="petugas_id" name="petugas_id" value="{{ auth()->user()->id }}">

                        <!-- Tombol Submit -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Simpan Log Rekaman
                        </button>

                      

                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
