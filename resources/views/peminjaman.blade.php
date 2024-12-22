<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Daftar Barang Digunakan</h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Berikut adalah daftar barang yang digunakan oleh pegawai.
                </p>
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
                                    <input type="text" id="simple-search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari barang" required>
                                </div>
                            </form>
                        </div>
                        <div class="flex space-x-4">
                            <!-- Ambil Barang Manual Button -->
                            <button data-modal-target="ambilBarangModal" data-modal-toggle="ambilBarangModal"
                                class="px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow-md hover:from-green-400 hover:to-green-600 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900">
                                Ambil Barang
                            </button>
                        
                            <!-- Ambil Barang Otomatis Button -->
                            <button data-modal-target="ambilOtomatisModal" data-modal-toggle="ambilOtomatisModal"
                                class="px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-md hover:from-blue-400 hover:to-blue-600 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                Ambil Otomatis
                            </button>
                        </div>
                        

                    </div>
                </div>

                <div class="mt-4 bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">No.</th>
                                    <th class="px-6 py-3">Kode Barang</th>
                                    <th class="px-6 py-3">Nama Barang</th>
                                    <th class="px-6 py-3">Acara</th>
                                    <th class="px-6 py-3">Waktu Digunakan</th>
                                    <th class="px-6 py-3">Tanggal Digunakan</th>
                                    <th class="px-6 py-3">Petugas</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($peminjaman->isEmpty())
                                    <!-- Pesan jika tidak ada data awal -->
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                            Mohon maaf, belum ada barang yang digunakan.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($peminjaman as $index => $data)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $peminjaman->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">{{ $data->barang->kode_barang }}</td>
                                        <td class="px-6 py-4">{{ $data->barang->nama_barang }}</td>
                                        <td class="px-6 py-4">{{ $data->kegiatan }}</td>
                                        <td class="px-6 py-4">{{ $data->jam_mulai }} - {{ $data->jam_selesai}}</td>
                                        <td class="px-6 py-4">{{ $data->tanggal_pinjam }}</td>
                                        <td class="px-6 py-4">{{ $data->user->name }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="" class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">Edit</a>
                                            <button class="px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 deleteButton" data-url="">
                                                Hapus</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                <!-- Pesan jika pencarian tidak menemukan hasil -->
                                <tr id="no-result-message" style="display: none;">
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                        Mohon maaf, kata kunci yang Anda cari tidak ada.
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                
                    <!-- Pagination -->
                    <div class="flex items-center justify-between p-6 bg-gray-50 dark:bg-gray-700">
                        @if($peminjaman->total() > 0)
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $peminjaman->firstItem() }}</span> 
                                hingga <span class="font-semibold text-gray-900 dark:text-white">{{ $peminjaman->lastItem() }}</span> 
                                dari <span class="font-semibold text-gray-900 dark:text-white">{{ $peminjaman->total() }}</span> data
                            </span>
                        @else
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan 0 dari 0 data
                            </span>
                        @endif
                        {{ $peminjaman->links() }}
                    </div>
                </div>
                
                
            </section>
        </div>
    </div>

    <!-- Modal Ambil Barang -->
    @include('components.modals.pindahmanual')
    @include('components.modals.pindahotomatis')
    @include('components.modals.hapus')

    <script>
        document.getElementById('simple-search').addEventListener('input', function() {
            let searchQuery = this.value.toLowerCase(); // Ambil nilai input pencarian
            let rows = document.querySelectorAll('tbody tr'); // Semua baris dalam tabel
            let noResultMessage = document.getElementById('no-result-message'); // Elemen pesan "tidak ada hasil"
            let found = false; // Untuk memeriksa apakah ada hasil
            
            rows.forEach(row => {
                let routerName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase(); // Nama Router
                let ipRouter = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase(); // IP Router
                let location = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase(); // Lokasi
                let upload = row.querySelector('td:nth-child(5)')?.textContent.toLowerCase(); // Upload
                let download = row.querySelector('td:nth-child(6)')?.textContent.toLowerCase(); // Download
                
                // Periksa apakah salah satu data cocok dengan query pencarian
                if (routerName?.includes(searchQuery) || ipRouter?.includes(searchQuery) || location?.includes(searchQuery) || upload?.includes(searchQuery) || download?.includes(searchQuery)) {
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

<script>
    // JavaScript to retrieve form data from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('acara').value = localStorage.getItem('kegiatan');
        document.getElementById('tanggal').value = localStorage.getItem('tanggal_kegiatan');
        document.getElementById('mulai').value = localStorage.getItem('jam_mulai');
        document.getElementById('selesai').value = localStorage.getItem('jam_selesai');
    });
</script>
    
</x-app-layout>
