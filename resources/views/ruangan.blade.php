<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Daftar Ruangan</h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Berikut adalah daftar ruangan yang tersedia. Anda dapat mencari, menambah, mengedit, atau menghapus ruangan sesuai kebutuhan.
                </p>
            </section>

            <!-- Header & Filter Section -->
            <section class="w-full px-6 mx-auto lg:px-12 mt-8">
                <div class="relative bg-white shadow-lg rounded-lg dark:bg-gray-800">
                    <div class="p-6 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <!-- Search Bar -->
                        <div class="w-full md:w-2/3">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Cari ruangan</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari ruangan" required> 
                                </div>
                            </form>
                        </div>
                        <!-- Button Tambah -->
                        <a href="{{ route('ruangan.create') }}" class="w-full md:w-auto flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md hover:from-blue-500 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                            </svg>
                            Tambah Ruangan
                        </a>
                    </div>
                </div>

                <div class="mt-4 bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">No.</th>
                                    <th class="px-6 py-3">Nama Ruangan</th>
                                    <th class="px-6 py-3">Lokasi</th>
                                    <th class="px-6 py-3">Informasi</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($ruangans->isEmpty())
                                    <!-- Pesan jika tidak ada data awal -->
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                            Mohon maaf, belum ada ruangan yang ditambahkan.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($ruangans as $index => $data)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $ruangans->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">{{ $data->nama_ruangan }}</td>
                                        <td class="px-6 py-4">lantai {{ $data->lokasi_ruangan }}</td>
                                        <td class="px-6 py-4">
                                            <button class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">Informasi</button>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('ruangan.edit', $data->id) }}" class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">Edit</a>
                                            <button class="px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 deleteButton" data-url="{{ route('ruangan.destroy', $data->id) }}">
                                                Hapus
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
                        @if($ruangans->total() > 0)
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $ruangans->firstItem() }}</span> 
                                hingga <span class="font-semibold text-gray-900 dark:text-white">{{ $ruangans->lastItem() }}</span> 
                                dari <span class="font-semibold text-gray-900 dark:text-white">{{ $ruangans->total() }}</span> data
                            </span>
                        @else
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan 0 dari 0 data
                            </span>
                        @endif
                        {{ $ruangans->links() }}
                    </div>
                </div>
            </section>
        </div>
    </div>
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
