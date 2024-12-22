<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Daftar Barang</h1>
                        <p class="text-gray-600 dark:text-gray-300">Berikut adalah daftar barang yang tersedia.</p>
                    </div>
                    <div class="flex space-x-4">
                        <!-- Tombol Export -->
                        <button onclick="openExportModal()"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v9.293l-2-2a1 1 0 0 0-1.414 1.414l.293.293h-6.586a1 1 0 1 0 0 2h6.586l-.293.293A1 1 0 0 0 18 16.707l2-2V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                                  </svg>
                            Export
                        </button>

                        <!-- Tombol Import -->
                        <button onclick="openImportModal()"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 3a1 1 0 00-1 1v4a1 1 0 102 0V5h10v10H5v-3a1 1 0 10-2 0v4a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H4z" />
                                <path d="M9 7a1 1 0 012 0v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H7a1 1 0 110-2h2V7z" />
                            </svg>
                            Import
                        </button>
                    </div>
                </div>
            </section>

            <!-- Header & Filter Section -->
            <section class="w-full px-6 mx-auto lg:px-12 mt-8">
                <div class="relative bg-white shadow-lg rounded-lg dark:bg-gray-800">
                    <div class="p-6 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <!-- Search Bar -->
                        <div class="w-full md:w-2/3">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Cari Barang</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari Barang" required> 
                                </div>
                            </form>
                        </div>
                        <!-- Button Tambah -->
                        <a href="{{ route('barang.create') }}" class="w-full md:w-auto flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md hover:from-blue-500 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                            </svg>
                            Tambah Barang
                        </a>
                    </div>
                </div>

                <div class="mt-4 bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Kode Barang</th>
                                    <th class="px-6 py-3">Nama Barang</th>
                                    <th class="px-6 py-3">Merek Barang</th>
                                    <th class="px-6 py-3">Tipe</th>
                                    <th class="px-6 py-3">Lokasi Ruangan</th>
                                    <th class="px-6 py-3">Kategori</th>
                                    <th class="px-6 py-3">Tanggal Penambahan </th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($barang->isEmpty())
                                    <!-- Pesan jika tidak ada data awal -->
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                            Mohon maaf, belum ada barang yang ditambahkan.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($barang as $index => $data)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $data->kode_barang }}</td>
                                        <td class="px-6 py-4">{{ $data->nama_barang }}</td>
                                        <td class="px-6 py-4">{{ $data->merek }}</td>
                                        <td class="px-6 py-4">{{ $data->tipe }}</td>
                                        <td class="px-6 py-4">{{ $data->ruangan->nama_ruangan }}</td>
                                        <td class="px-6 py-4">{{ $data->kategori->nama }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($data->tanggal_masuk)->translatedFormat('l, d F Y') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <!-- Tombol Detail -->
                                            <a href="{{ route('barang.detail', $data->id) }}" 
                                               class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                                                </svg>
                                            </a>
                                        
                                            <!-- Tombol Edit -->
                                            <a href="#"
                                               class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd" />
                                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        
                                            <!-- Tombol Hapus -->
                                            <button class="inline-flex items-center px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900 deleteButton" data-url="#">
                                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                        
                                        
                                    </tr>
                                    @endforeach
                                @endif
                                <!-- Pesan jika pencarian tidak menemukan hasil -->
                                <tr id="no-result-message" style="display: none;">
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                        Mohon maaf, kata kunci yang Anda cari tidak ada.
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between p-6 bg-gray-50 dark:bg-gray-700">
                        @if($barang->total() > 0)
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $barang->firstItem() }}</span> 
                                hingga <span class="font-semibold text-gray-900 dark:text-white">{{ $barang->lastItem() }}</span> 
                                dari <span class="font-semibold text-gray-900 dark:text-white">{{ $barang->total() }}</span> data
                            </span>
                        @else
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan 0 dari 0 data
                            </span>
                        @endif
                        {{ $barang->links() }}
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal Export -->
    <div id="exportModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Export Barang</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">Pilih format export:</p>
            <div class="flex space-x-4">
                <a href="{{ route('barang.cetak') }}" target="_blank"  
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    Export PDF
                </a>
                <a href="{{ route('barang.export') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                    Export Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div id="importModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-sm w-full">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Import Barang</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload File</label>
                    <input type="file" name="file" id="file" 
                           class="block w-full text-sm text-gray-900 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 border border-gray-300 rounded-lg cursor-pointer focus:outline-none dark:border-gray-600 dark:placeholder-gray-400">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeImportModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExportModal() {
            document.getElementById('exportModal').classList.remove('hidden');
        }

        function closeExportModal() {
            document.getElementById('exportModal').classList.add('hidden');
        }

        function openImportModal() {
            document.getElementById('importModal').classList.remove('hidden');
        }

        function closeImportModal() {
            document.getElementById('importModal').classList.add('hidden');
        }
    </script>
@include('components.modals.hapus')
<script>
    document.getElementById('simple-search').addEventListener('input', function() {
        let searchQuery = this.value.toLowerCase(); // Ambil nilai input pencarian
        let rows = document.querySelectorAll('tbody tr'); // Semua baris dalam tabel
        let noResultMessage = document.getElementById('no-result-message'); // Elemen pesan "tidak ada hasil"
        let found = false; // Untuk memeriksa apakah ada hasil
        
        rows.forEach(row => {
            let roomName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase(); // Nama ruangan
            let location = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase(); // Lokasi ruangan
            
            // Periksa apakah nama ruangan atau lokasi cocok dengan query pencarian
            if (roomName?.includes(searchQuery) || location?.includes(searchQuery)) {
                row.style.display = ''; // Tampilkan baris
                found = true; // Tandai ada hasil
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });

        // Jika tidak ada hasil, tampilkan pesan "tidak ada hasil"
        if (!found) {
            noResultMessage.style.display = ''; // Tampilkan pesan
        } else {
            noResultMessage.style.display = 'none'; // Sembunyikan pesan
        }
    });
</script>


</x-app-layout>
