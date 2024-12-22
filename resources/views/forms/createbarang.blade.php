<x-app-layout>
    <div class="p-6 sm:ml-64 bg-gray-100 min-h-screen mt-14">
        <div class="w-full mx-auto">
            <!-- Bagian Judul dan Penjelasan -->
            <section class="w-full px-6 mx-auto lg:px-12">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Tambah Barang</h1>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Silakan isi form untuk menambahkan barang baru.
                </p>

                <!-- Form Tambah Ruangan -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
                    <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-1">1. Informasi Barang</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Isikan semua input yang terdapat di bawah ini.</p>
                        <!-- Input Nama kantor -->
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Barang
                            </label>
                            <input type="text" id="nama" name="nama" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan nama barang">
                        </div>

                        <div class="mb-6">
                            <label for="merek" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Merek Barang
                            </label>
                            <input type="text" id="merek" name="merek" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan merek barang">
                        </div>

                        <div class="mb-6">
                            <label for="tipe" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tipe Barang
                            </label>
                            <input type="text" id="tipe" name="tipe" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan tipe barang">
                        </div>

                        <div class="mb-4">
                            <label for="InputCategory" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kategori Barang
                            </label>
                            <select id="InputCategory" name="kategori" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih kategori</option>
                                @foreach ($kategori as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }} ({{ $data->deskripsi }})</option> 
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="InputCode" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kode Barang
                            </label>
                            <input type="text" id="InputCode" name="kode_barang" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan tipe barang" readonly>
                        </div>

                        <div id="barcodeContainer" class="mb-6">
                            <!-- Gambar QR code akan ditampilkan di sini -->
                        </div>

                        <hr class="my-8 border-gray-300 dark:border-gray-600">


                        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-1 mt-4">2. Spesifikasi dan Kebutuhan Informasi Barang</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Isi Semua Data yang Dibutuhkan jika barang anda memiliki sepsifikasi lengkap</p>

                        <div class="mb-6">
                            <label for="processor" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Processor barang
                            </label>
                            <input type="text" id="processor" name="processor" 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Processor barang">
                        </div>

                        <div class="mb-6">
                            <label for="ram" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                RAM barang
                            </label>
                            <input type="text" id="ram" name="ram" 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan RAM barang">
                        </div>

                        <div class="mb-6">
                            <label for="storage" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Storage barang
                            </label>
                            <input type="text" id="storage" name="storage" 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Storage barang">
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Alamat Kantor
                            </label>
                            <select id="alamat" name="kantor" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih kategori</option>
                                @foreach ($kantor as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option> 
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="ruangan" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Ruangan
                            </label>
                            <select id="ruangan" name="ruangan" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih ruangan</option>
                                @foreach ($ruangan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_ruangan }}</option> 
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Gambar Barang
                            </label>
                            <input required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="gambar" id="gambar" name="gambar" type="file">
                        </div>

                        <div class="mb-6">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal Input Barang
                            </label>
                            <input required type="date" id="tanggal" name="tanggal" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Tanggal Input Barang">
                        </div>

                        <div class="mb-6">
                            <label for="tahun" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tahun perolehan barang
                            </label>
                            <input type="number" id="tahun" name="tahun" required 
                                class="block w-full p-4 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan tahun perolehan barang">
                        </div>

                        <div class="mb-4">
                            <label for="kondisi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kondisi Barang
                            </label>
                            <select id="kondisi" name="kondisi" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih kondisi barang</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="sumber" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Sumber Perolehan Barang
                            </label>
                            <select id="sumber" name="sumber" required
                                class="block w-full p-3 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled selected>Pilih sumber perolehan barang</option>
                                <option value="Pembelian">Pembelian</option>
                                <option value="Hibah">Hibah</option>
                            </select>
                        </div>

                        <!-- Input alamat kantor -->
                        <div class="mb-6">
                            <label for="lampiran" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Lampiran Dokumen
                            </label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="lampiran" name="file" type="file">
                        </div>

                        <input type="text" id="petugas_id" name="penanggungjawab" value="{{ auth()->user()->id }}" hidden>


                        <!-- Tombol Tambah kantor -->
                        <button type="submit" 
                            class="w-full md:w-auto px-6 py-3 text-white bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg hover:from-blue-500 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                            <svg class="inline-block w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Tambah kantor
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.getElementById('InputCategory').addEventListener('change', function() {
            const category = this.value;
            const codeInput = document.getElementById('InputCode');
            const uniqueCode = Math.random().toString(36).substring(2, 9).toUpperCase(); // menghasilkan 7 karakter acak
            const prefix = category.substring(0, 3).toUpperCase(); // menghasilkan 3 huruf pertama dari kategori
    
            const generatedCode = `${prefix}${uniqueCode}`;
            codeInput.value = generatedCode;
    
            // Mengirim permintaan AJAX untuk mendapatkan gambar QR code tanpa menyimpannya
            fetch(`/generate-qrcode/${generatedCode}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('barcodeContainer').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    
    
    
    <script>
        $(document).ready(function() {
            $("#InputName").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('barang.show') }}",
                        dataType: "json",
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.nama,
                                    value: item.nama
                                };
                            }));
                        }
                    });
                },
                minLength: 2
            });
        });
    </script>
</x-app-layout>
