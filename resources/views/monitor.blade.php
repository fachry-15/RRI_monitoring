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
                    <div class="p-6 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <!-- Search Bar -->
                        <div class="w-full sm:w-2/3">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Cari laporan monitor jaringan</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Cari laporan monitor" required>
                                </div>
                            </form>
                        </div>
                        <!-- Button Tambah -->
                        <a href="{{ route('monitor.create') }}" class="w-full sm:w-auto flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md hover:from-blue-500 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
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
                                    <th class="px-6 py-3">Petugas</th>
                                    <th class="px-6 py-3 text-center">Status Kecepatan</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($monitor->isEmpty())
                                    <!-- Pesan jika tidak ada data -->
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                            Mohon maaf, belum ada monitor jaringan yang dilakukan.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($monitor as $index => $data)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $monitor->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">{{ $data->jaringan->nama_router }}</td>
                                        <td class="px-6 py-4">{{ $data->created_at->format('H:i:s') }}</td>
                                        <td class="px-6 py-4">{{ $data->petugas->name }}</td>
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
                                            <button data-modal-target="default-modal-{{ $data->id }}" data-modal-toggle="default-modal-{{ $data->id }}" class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800" type="button">
                                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                            <button class="px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 deleteButton" data-url="{{ route('monitor.destroy', $data->id) }}">
                                                <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Main modal -->
                                    <div id="default-modal-{{ $data->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                        Detail Monitor Jaringan
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal-{{ $data->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5 space-y-4">
                                                    <p><strong>Nama Router:</strong> {{ $data->jaringan->nama_router }}</p>
                                                    <p><strong>Timestamp:</strong> {{ $data->created_at->format('H:i:s') }}</p>
                                                    <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M, Y') }}</p>
                                                    <p><strong>Petugas:</strong> {{ $data->petugas->name }}</p>
                                                    <p><strong>Upload (Mbps):</strong> {{ $data->upload }}</p>
                                                    <p><strong>Download (Mbps):</strong> {{ $data->download }}</p>
                                                    <p><strong>Kondisi:</strong> {{ $data->kondisi }}</p>
                                                    <p><strong>Status Kecepatan:</strong> {{ $data->status_kecepatan }}</p>
                                                    <p><strong>Status:</strong> {{ $data->status }}</p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <a href="{{ route('monitor.edit', $data->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellowyellow-600 dark:hover:bg-yellowyellow-700 dark:focus:ring-yellowyellow-800">Edit </a>
                                                    <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Setujui</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    @include('components.modals.hapus')
</x-app-layout>
