<x-app-layout>
  <div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
      <div class="p-4 bg-gray-100 min-h-screen">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Total Subscribers -->
          <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-purple-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5"/>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Jumlah Router</p>
                <p class="text-2xl font-semibold text-gray-900">{{ count($jaringans) }} Unit</p>
              </div>
            </div>
            <a href="{{ route('jaringan.index') }}" class="text-purple-600 text-sm mt-2 block hover:underline">Lihat semua</a>
          </div>
          <!-- Avg. Open Rate -->
          <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Jumlah Ruangan</p>
                <p class="text-2xl font-semibold text-gray-900">{{ count($ruangans) }} Ruangan</p>
              </div>
            </div>
            <a href="{{ route('ruangan.index') }}" class="text-purple-600 text-sm mt-2 block hover:underline">Lihat semua</a>
          </div>
          <!-- Avg. Click Rate -->
          <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-purple-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Pegawai Terdaftar</p>
                <p class="text-2xl font-semibold text-gray-900">{{ count($petugas) }} Pegawai</p>
              </div>
            </div>
            <a href="#" class="text-purple-600 text-sm mt-2 block hover:underline">Lihat semua</a>
          </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th class="px-6 py-3">No.</th>
                <th class="px-6 py-3">Nama Router</th>
                <th class="px-6 py-3">IP Router</th>
                <th class="px-6 py-3">Lokasi</th>
                <th class="px-6 py-3">Upload</th>
                <th class="px-6 py-3">Download</th>
              </tr>
            </thead>
            <tbody>
              @if($jaringans->isEmpty())
                <tr>
                  <td colspan="6" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                    Mohon maaf, belum ada Router jaringan yang ditambahkan.
                  </td>
                </tr>
              @else
                @foreach ($jaringans as $index => $data)
                  <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $data->nama_router }}</td>
                    <td class="px-6 py-4">{{ $data->ip_router }}</td>
                    <td class="px-6 py-4">{{ $data->ruangan->nama_ruangan }}</td>
                    <td class="px-6 py-4">{{ $data->upload }} Mbps</td>
                    <td class="px-6 py-4">{{ $data->download }} Mbps</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
