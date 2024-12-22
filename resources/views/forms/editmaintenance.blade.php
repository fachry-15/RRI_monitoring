<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Edit Ticket Maintenance Barang</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Silakan perbarui formulir di bawah ini untuk mengedit ticket maintenance barang.
                </p>

                <!-- Form Edit Router -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                    <form method="POST" action="{{ route('maintenance.update', $ticket->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Kode Ticket -->
                        <div class="mb-4">
                            <label for="kode_barang" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kode Ticket
                            </label>
                            <input type="text" name="kode_ticket" id="kode_barang" value="{{ $ticket->kode_ticket }}" readonly
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Input Nama Barang -->
                        <div class="mb-4">
                            <label for="Barang" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Barang
                            </label>
                            <select id="Barang" name="barang" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled>Pilih barang yang akan dimaintenance</option>
                                @foreach ($barangs as $data)
                                    <option value="{{ $data->id }}" {{ $ticket->barang_id == $data->id ? 'selected' : '' }}>
                                        {{ $data->kode_barang }} - {{ $data->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jenis Perawatan -->
                        <div class="mb-4">
                            <label for="jenis_perawatan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jenis Perawatan
                            </label>
                            <select id="jenis_perawatan" name="jenis_perawatan" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="Perawatan" {{ $ticket->jenis == 'Perawatan' ? 'selected' : '' }}>Perawatan</option>
                                <option value="Pergantian" {{ $ticket->jenis == 'Pergantian' ? 'selected' : '' }}>Pergantian</option>
                            </select>
                        </div>

                        <!-- Diagnosa -->
                        <div class="mb-4">
                            <label for="diagnosa" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Diagnosa
                            </label>
                            <input type="text" id="diagnosa" name="diagnosa" value="{{ $ticket->diagnosa }}" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Deskripsi
                            </label>
                            <textarea id="deskripsi" name="deskripsi" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $ticket->deskripsi }}</textarea>
                        </div>

                        <!-- Lampiran -->
                        <div class="mb-4">
                            <label for="NotaDinas" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lampiran (PDF)
                            </label>
                            <input type="file" id="NotaDinas" name="NotaDinas" accept="application/pdf"
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @if($ticket->lampiran)
                                <p class="text-sm text-gray-600 mt-2">
                                    File saat ini: <a href="{{ asset($ticket->lampiran) }}" target="_blank" class="text-blue-500">Lihat Lampiran</a>
                                </p>
                            @endif
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Perbarui Ticket Maintenance
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
