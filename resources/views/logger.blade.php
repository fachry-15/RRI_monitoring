<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Daftar Laporan Logger</h1>
                <p class="text-gray-600 dark:text-gray-300">
                    Berikut adalah daftar laporan logger yang tersedia. Anda dapat mencari, menambah, mengedit, atau menghapus laporan logger sesuai kebutuhan.
                </p>
            </section>

            <!-- Header & Filter Section -->
            <section class="w-full px-6 mx-auto lg:px-12 mt-8">
                <div class="relative bg-white shadow-lg rounded-lg dark:bg-gray-800">
                    <div class="p-6 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <!-- Search Bar -->
                        <div class="w-full md:w-2/3">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Cari laporan logger</label>
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
                        <a href="{{ route('logger.create') }}" class="w-full md:w-auto flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-md hover:from-blue-500 hover:to-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                            </svg>
                            Buat Laporan Logger
                        </a>
                    </div>
                </div>

                <div class="mt-4 bg-white shadow-lg rounded-lg overflow-hidden dark:bg-gray-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">No.</th>
                                    <th class="px-6 py-3">Channel Logger</th>
                                    <th class="px-6 py-3">Petugas</th>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Waktu</th>
                                    <th class="px-6 py-3">Gambar</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($logger->isEmpty())
                                    <!-- Pesan jika tidak ada data -->
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                            Mohon maaf, belum ada Logger yang direcord.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($logger as $index => $data)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $logger->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">{{ $data->channel_logger }}</td>
                                        <td class="px-6 py-4">{{ $data->petugas->name }}</td>
                                        <td class="px-6 py-4">{{ $data->tanggal }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($data->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($data->jam_keluar)->format('H:i') }}</td>
                                        <td class="px-6 py-4">
                                            <button data-modal-target="large-modal" data-modal-toggle="large-modal" class="px-3 py-2 text-xs font-medium text-white bg-green-700 rounded-lg hover:bg-green-800" type="button">
                                                Gambar
                                            </button>

                                            <!-- Large Modal -->
                                            <div id="large-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative w-full max-w-4xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                                                Bukti Gambar Logger
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="large-modal">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <img src="{{ asset('storage/'.$data->bukti_gambar) }}" alt="Gambar Logger" class="mx-auto max-w-xl h-auto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('logger.edit', $data->id) }}" class="px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">Edit</a>
                                            <button class="px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 deleteButton" data-url="{{ route('logger.destroy', $data->id) }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between p-6 bg-gray-50 dark:bg-gray-700">
                        @if($logger->total() > 0)
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan <span class="font-semibold text-gray-900 dark:text-white">{{ $logger->firstItem() }}</span>
                                hingga <span class="font-semibold text-gray-900 dark:text-white">{{ $logger->lastItem() }}</span>
                                dari <span class="font-semibold text-gray-900 dark:text-white">{{ $logger->total() }}</span> data
                            </span>
                        @else
                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                Menampilkan 0 dari 0 data
                            </span>
                        @endif
                        {{ $logger->links() }}
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('components.modals.hapus')
</x-app-layout>
