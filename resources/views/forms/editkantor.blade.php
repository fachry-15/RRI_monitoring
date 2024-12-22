<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Update Kantor</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Silakan ubah data di bawah ini untuk memperbarui kantor yang dipilih.
                </p>

                <!-- Form Update kantor -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
                    <form method="POST" action="{{ route('kantor.update', $kantor->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input Nama Kantor -->
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Kantor
                            </label>
                            <input type="text" id="nama" name="nama" required 
                                value="{{ old('nama', $kantor->nama) }}"
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan nama kantor">
                        </div>

                        <!-- Input alamat kantor -->
                        <div class="mb-6">
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Alamat Kantor
                            </label>
                            <input type="text" id="alamat" name="alamat" required 
                                value="{{ old('alamat', $kantor->alamat) }}"
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Alamat Kantor">
                        </div>
                        
                        <!-- Tombol Update -->
                        <button type="submit" 
                            class="w-full md:w-auto px-5 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Update Kantor
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
