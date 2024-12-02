<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Update Channel Logger</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Silakan isi formulir di bawah ini untuk memperbarui log channel.
                </p>

                <!-- Form Logger -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('logger.update', $logger->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Select 1 -->
                        <div class="mb-4">
                            <label for="select_1" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Channel Logger
                            </label>
                            <select id="select_1" name="channel" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled>Pilih channel</option>
                                <option value="Pro 1" {{ $logger->channel_logger == 'Pro 1' ? 'selected' : '' }}>Pro 1</option>
                                <option value="Pro 2" {{ $logger->channel_logger == 'Pro 2' ? 'selected' : '' }}>Pro 2</option>
                                <option value="Pro 3" {{ $logger->channel_logger == 'Pro 3' ? 'selected' : '' }}>Pro 3</option>
                                <option value="Pro 4" {{ $logger->channel_logger == 'Pro 4' ? 'selected' : '' }}>Pro 4</option>
                                <option value="Pro 5 / Channel lima" {{ $logger->channel_logger == 'Pro 5 / Channel lima' ? 'selected' : '' }}>Pro 5 / Channel lima</option>
                                <!-- Tambahkan opsi di sini -->
                            </select>
                        </div>

                        <!-- Input Jam Masuk -->
                        <div class="mb-4">
                            <label for="jam_masuk" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jam Masuk
                            </label>
                            <input type="time" id="jam_masuk" name="jam_masuk" value="{{ $logger->jam_masuk }}" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Input Jam Keluar -->
                        <div class="mb-4">
                            <label for="jam_keluar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jam Keluar
                            </label>
                            <input type="time" id="jam_keluar" name="jam_keluar" value="{{ $logger->jam_keluar }}" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Input Tanggal -->
                        <div class="mb-4">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal
                            </label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ $logger->tanggal }}" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Input untuk Mengunggah File -->
                        <div class="mb-4">
                            <label for="attachment" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Unggah File (JPG, PNG, PDF)
                            </label>
                            <input type="file" id="attachment" name="attachment" accept=".jpg,.jpeg,.png,.pdf"
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 cursor-pointer focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-400 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Format yang diperbolehkan: JPG, PNG, PDF.</p>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            Perbarui Log Rekaman
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
