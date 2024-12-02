<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Edit Data jaringan</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Silakan isi formulir di bawah ini untuk memperbarui data jaringan.
                </p>

                <!-- Form Edit jaringan -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('jaringan.update', $jaringan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input Nama jaringan -->
                        <div class="mb-4">
                            <label for="nama_jaringan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama jaringan
                            </label>
                            <input type="text" id="nama_jaringan" name="nama" value="{{ $jaringan->nama_router }}" required 
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan nama jaringan">
                        </div>

                        <!-- Input IP jaringan -->
                        <div class="mb-4">
                            <label for="ip_jaringan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                IP jaringan
                            </label>
                            <input type="text" id="ip_jaringan" name="ip" value="{{ $jaringan->ip_router }}" required pattern="^(\d{1,3}\.){3}\d{1,3}$"
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan IP jaringan (contoh: 192.168.1.1)">
                        </div>

                        <!-- Pilih Lokasi Ruangan -->
                        <div class="mb-4">
                            <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lokasi Ruangan
                            </label>
                            <select id="lokasi" name="ruangan" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled>Pilih lokasi ruangan</option>
                                @foreach ($ruangans as $ruangan)
                                    <option value="{{ $ruangan->id }}" {{ $jaringan->ruangan_id == $ruangan->id ? 'selected' : '' }}>
                                        {{ $ruangan->nama_ruangan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input Bandwidth Upload -->
                        <div class="mb-4">
                            <label for="upload" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Bandwidth Upload (Mbps)
                            </label>
                            <input type="number" id="upload" name="upload" value="{{ $jaringan->upload }}" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan bandwidth upload">
                        </div>

                        <!-- Input Bandwidth Download -->
                        <div class="mb-4">
                            <label for="download" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Bandwidth Download (Mbps)
                            </label>
                            <input type="number" id="download" name="download" value="{{ $jaringan->download }}" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan bandwidth download">
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Perbarui Data jaringan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
