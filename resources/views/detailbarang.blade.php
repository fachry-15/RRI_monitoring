<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Header Section -->
            <section class="w-full px-4 sm:px-6 lg:px-12 mx-auto">
                <!-- Header Detail -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 dark:text-white">Detail Barang</h1>
                        <p class="text-base md:text-lg text-gray-600 dark:text-gray-300 mt-2">
                            Informasi lengkap mengenai barang yang terdaftar di sistem.
                        </p>
                    </div>
                    <div class="flex items-center space-x-2 md:space-x-4 mt-4 md:mt-0">
                        <!-- Tombol Kembali -->
                        <a href="{{ route('barang.index') }}" 
                           class="inline-flex items-center px-3 md:px-4 py-2 text-sm font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L6.414 9H17a1 1 0 110 2H6.414l3.293 3.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Kembali
                        </a>

                        <!-- Tombol Cetak Barcode -->
                        <a href="{{ route('barcode.cetak', $barang->id) }}" 
                           class="inline-flex items-center px-3 md:px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                           <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 4h6v6H4V4Zm10 10h6v6h-6v-6Zm0-10h6v6h-6V4Zm-4 10h.01v.01H10V14Zm0 4h.01v.01H10V18Zm-3 2h.01v.01H7V20Zm0-4h.01v.01H7V16Zm-3 2h.01v.01H4V18Zm0-4h.01v.01H4V14Z"/>
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M7 7h.01v.01H7V7Zm10 10h.01v.01H17V17Z"/>
                          </svg>
                            Cetak Barcode
                        </a>
                    </div>
                </div>

                <!-- Detail Card -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 md:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <!-- Informasi Barang -->
                        <div>
                            <h2 class="text-xl md:text-2xl font-semibold text-gray-800 dark:text-white mb-4 md:mb-6 border-b border-gray-300 dark:border-gray-700 pb-2">
                                Informasi Barang
                            </h2>
                            <div class="space-y-2 md:space-y-4">
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Nama Barang:</strong> {{ $barang->nama_barang }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Merek:</strong> {{ $barang->merek }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Tipe:</strong> {{ $barang->tipe }}</p>
                                @if($barang->Processor)
                                    <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Processor:</strong> {{ $barang->Processor }}</p>
                                @endif
                                @if($barang->RAM)
                                    <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">RAM:</strong> {{ $barang->RAM }}</p>
                                @endif
                                @if($barang->Storage)
                                    <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Penyimpanan:</strong> {{ $barang->Storage }} GB</p>
                                @endif
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Kategori:</strong> {{ $barang->kategori->nama }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Kondisi:</strong> {{ $barang->kondisi }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Sumber Barang:</strong> {{ $barang->sumber_barang }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Tahun Perolehan:</strong> {{ $barang->Tahun_perolehan ?? 'Tidak Diketahui' }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Kantor/Satker Pemiliki:</strong> {{ $barang->kantor->nama }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Petugas yang Mengisi:</strong> {{ $barang->petugas->name }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Tanggal Pengisian:</strong> {{ $barang->created_at->format('d F Y') }}</p>
                                <p class="text-gray-600 dark:text-gray-300"><strong class="font-medium">Ruangan:</strong> {{ $barang->ruangan->nama_ruangan }}</p>
                            </div>
                        </div>

                        <!-- Gambar dan QR Code -->
                        <div class="text-center">
                            <!-- Modal Trigger -->
                            <button onclick="showModal()" 
                                    class="mb-4 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12 7c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0-2a5 5 0 100 10 5 5 0 000-10zm-8 13c0-2.667 5.333-4 8-4s8 1.333 8 4v2H4v-2zm2.333-.833C6.72 16.764 9.208 16 12 16s5.28.764 5.667 1.167H6.333z" />
                                </svg>
                                Lihat Bukti Gambar
                            </button>
                            <!-- QR Code -->
                            <div class="my-6">
                                <img src="{{ asset('barcodes/' . $barang->kode_barang . '.png') }}" alt="QR Code {{ $barang->kode_barang }}" class="mx-auto w-1/2 md:w-1/3 lg:w-1/4">
                                <p class="mt-4 text-sm font-medium text-gray-600 dark:text-gray-300">{{ $barang->kode_barang }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal Gambar -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
        <div class="relative w-full max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">Gambar Bukti</h3>
                    <button onclick="hideModal()" class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
                        &times;
                    </button>
                </div>
                <div class="p-6">
                    <img src="{{ asset('images/' . $barang->bukti_gambar) }}" alt="Gambar Bukti" class="mx-auto rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModal() {
            document.getElementById('imageModal').classList.remove('hidden');
        }
        function hideModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
