<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Buat Ticket Maintenance Barang</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Silakan isi formulir di bawah ini untuk membuat ticket maintenance barang.
                </p>

                <!-- Form Tambah Router -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('maintenance.store') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="kode_ticket" id="kode_barang">
                        
                        <!-- Input Nama Router -->
                        <div class="mb-4">
                            <label for="nama_router" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Barang
                            </label>
                            <select id="Barang" name="barang" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih barang yang akan dimaintenance</option>
                                @foreach ($barangs as $data)
                                    <option value="{{ $data->id }}">{{ $data->kode_barang}} - {{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input IP Router -->
                        <div class="mb-4">
                            <label for="status_router" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jenis Perawatan
                            </label>
                            <select id="jenis_perawatan" name="jenis_perawatan" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih jenis perawatan</option>
                                <option value="Perawatan">Perawatan</option>
                                <option value="Pergantian">Pergantian</option>
                            </select>
                        </div>

                        <!-- Diagnosa -->
                        <div class="mb-4">
                            <label for="diagnosa" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Diagnosa
                            </label>
                            <input type="text" id="diagnosa" name="diagnosa" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan diagnosa">
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Deskripsi
                            </label>
                            <textarea id="deskripsi" name="deskripsi" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan deskripsi"></textarea>
                        </div>

                        <!-- lampiran -->
                        <div class="mb-4">
                            <label for="lampiran" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lampiran
                            </label>
                            <input type="file" id="NotaDinas" name="NotaDinas" accept="application/pdf"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Buat Ticket Maintenance
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisPerawatanSelect = document.getElementById('jenis_perawatan');
            const kodeBarangInput = document.getElementById('kode_barang');
    
            jenisPerawatanSelect.addEventListener('change', function () {
                const selectedValue = jenisPerawatanSelect.value;
                const prefix = selectedValue === 'Perawatan' ? 'PRW' : 'PRG';
    
                // Generate unique 4-character code
                const uniqueCode = Math.random().toString(36).substring(2, 6).toUpperCase();
    
                // Set the kode_barang input value
                kodeBarangInput.value = prefix + uniqueCode;
            });
        });
    </script>
    
</x-app-layout>
