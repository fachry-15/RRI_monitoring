<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Daftar Monitor Jaringan</h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Berikut adalah daftar laporan monitor jaringan yang tersedia. Anda dapat mencari, menambah, mengedit, atau menghapus laporan monitor sesuai kebutuhan.
                </p>
            </section>

            <!-- Header & Filter Section -->
            <section class="w-full px-6 mx-auto lg:px-12 mt-8">
                <div class="relative bg-white shadow-lg rounded-lg dark:bg-gray-800">
                    <div class="p-6 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <!-- Search Bar -->
                        <div class="w-full md:w-2/3">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Cari laporan monitor jaringan</label>
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
                        <a href="{{ route('monitor.create') }}" class="w-full md:w-auto flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md hover:from-blue-500 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                            </svg>
                            Buat Laporan monitor
                        </a>
                    </div>
                </div>

                <div class="mt-4 bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">No.</th>
                                    <th class="px-6 py-3">Nama Router</th>
                                    <th class="px-6 py-3">Timestamp</th>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Petugas</th>
                                    <th class="px-6 py-3 text-center">Upload (Mbps)</th>
                                    <th class="px-6 py-3 text-center">Download (Mbps)</th>
                                    <th class="px-6 py-3 text-center">Kondisi</th>
                                    <th class="px-6 py-3 text-center">Status Kecepatan</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($monitor->isEmpty())
                                    <!-- Pesan jika tidak ada data -->
                                    <tr>
                                        <td colspan="12" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                            Mohon maaf, belum ada monitor jaringan yang dilakukan.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($monitor as $index => $data)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $monitor->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">{{ $data->jaringan->nama_router }}</td>
                                        <td class="px-6 py-4">{{ $data->created_at->format('H:i:s') }}</td>
                                        <td class="px-6 py-4">{{ $data->created_at->format('d M, Y') }}</td>
                                        <td class="px-6 py-4">{{ $data->petugas->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $data->upload }}</td>
                                        <td class="px-6 py-4 text-center">{{ $data->download }}</td>
                                        <td class="px-6 py-4 text-center">
                                            @if($data->kondisi == 'Ada')
                                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                    Ada
                                                </span>
                                                @else
                                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                    Tidak Ada
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($data->status_kecepatan === 'Tidak Stabil')
                                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                    Tidak Stabil
                                                </span>
                                            @else
                                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                    Stabil
                                                </span>
                                            @endif
                                        </td>
                                        
                                        
                                        <td class="px-6 py-4 text-center">
                                        @if($data->status == 'Disetujui')
                                            <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                Belum Disetujui
                                            </span>
                                        @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">Edit</a>
                                            <form action="" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow-md hover:bg-red-500 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                
                    <!-- Pagination -->
                    <div class="flex items-center justify-between p-6 bg-gray-50 dark:bg-gray-700">
                        @if($monitor->total() > 0)
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $monitor->firstItem() }}</span> 
                                hingga <span class="font-semibold text-gray-900 dark:text-white">{{ $monitor->lastItem() }}</span> 
                                dari <span class="font-semibold text-gray-900 dark:text-white">{{ $monitor->total() }}</span> data
                            </span>
                        @else
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan 0 dari 0 data
                            </span>
                        @endif
                        {{ $monitor->links() }}
                    </div>
                </div>
                
                
            </section>
        </div>
    </div>
</x-app-layout>
