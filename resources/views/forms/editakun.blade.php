<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Edit Akun Pegawai</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Silakan isi form untuk pembuatan akun pegawai baru.
                </p>

                <!-- Form Tambah Ruangan -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
                    <form method="POST" action="{{ route('pegawai.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Input Nama -->
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Pegawai
                            </label>
                            <input type="text" id="nama" name="nama" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan nama Pegawai" value="{{$user->name}}">
                        </div>

                        <!-- Input Email -->
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email Pegawai
                            </label>
                            <input type="email" id="email" name="email" required min="1"
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan email pegawai" value="{{$user->email}}">
                        </div>

                        <!-- Input Password -->
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            <input type="password" id="password" name="password" 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan password lama jika anda tidak mengganti password">
                        </div>

                        <!-- Input Role -->
                        <div class="mb-6">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status Jabatan
                            </label>
                            <select id="role" name="role" required
                            class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled>Pilih role</option>
                            @foreach ($roles as $id => $name)
                                <option value="{{ $id }}" {{ $id == $userRole ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        
                        @error('role')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        
                        </div>

                        <!-- Tombol Tambah Ruangan -->
                        <button type="submit" 
                            class="w-full md:w-auto px-6 py-3 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Perbarui Akun Pegawai
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
