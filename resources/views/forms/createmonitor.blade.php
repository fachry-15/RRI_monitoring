<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Tambah Data Monitor Jaringan</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Silakan isi formulir di bawah ini untuk menambahkan data monitor jaringan baru.
                </p>

                <!-- Form Tambah Router -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('monitor.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Input Nama Router -->
                        <div class="mb-4">
                            <label for="nama_router" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Router
                            </label>
                            <select id="nama_router" name="router" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih router yang akan anda monitor</option>
                                @foreach ($jaringan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_router }} - {{ $data->ruangan->nama_ruangan}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input IP Router -->
                        <div class="mb-4">
                            <label for="status_router" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status Router
                            </label>
                            <select id="status_router" name="status" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih status router</option>
                                <option value="Ada">Ada</option>
                                <option value="Tidak ada / Mati">Tidak ada / Mati</option>
                            </select>
                        </div>

                        <!-- Input Bandwidth Upload -->
                        <div class="mb-4">
                            <label for="upload" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Bandwidth Upload (Mbps)
                            </label>
                            <input type="number" id="upload" name="upload" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan bandwidth upload">
                        </div>

                        <!-- Input Bandwidth Download -->
                        <div class="mb-4">
                            <label for="download" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Bandwidth Download (Mbps)
                            </label>
                            <input type="number" id="download" name="download" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan bandwidth download">
                        </div>

                        <input type="hidden" id="petugas_id" name="petugas_id" value="{{ auth()->user()->id }}">

                        <!-- Tombol Submit -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Simpan Monitor Jaringan
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
