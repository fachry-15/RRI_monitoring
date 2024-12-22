<!-- Modal Ambil Otomatis -->
<div id="ambilOtomatisModal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Ambil Barang Otomatis
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="ambilOtomatisModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <video id="preview" class="w-full h-full"></video>
                </div>
                <form action="{{ route('peminjaman.store') }}" id="form" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Nama Barang -->
                        <input type="hidden" name="barang" id="kode_barang"> 
                        <!-- Acara/Kegiatan -->
                        <div class="mb-3">
                            <label for="acara" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Acara / Kegiatan</label>
                            <input type="text" id="kerja" name="acara"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Masukkan acara/kegiatan" required>
                        </div>

                        <!-- Tanggal Digunakan -->
                        <div class="mb-3">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tanggal Digunakan</label>
                            <input type="date" id="date" name="tanggal"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>

                        <!-- Jam Mulai -->
                        <div class="mb-3">
                            <label for="mulai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jam Mulai</label>
                            <input type="time" id="start" name="mulai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>

                        <!-- Jam Selesai -->
                        <div class="mb-3">
                            <label for="selesai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jam Selesai</label>
                            <input type="time" id="end" name="selesai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>

                        <input type="text" id="petugas_id" name="petugas" value="{{ auth()->user()->id }}" hidden> 
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    data-modal-hide="ambilOtomatisModal">Tutup</button>
                    <button type="submit" 
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
      console.log(content);
      document.getElementById('kode_barang').value = content;
      document.getElementById('form').submit();
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  </script>

<script>
    // JavaScript to retrieve form data from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('kerja').value = localStorage.getItem('kegiatan');
        document.getElementById('date').value = localStorage.getItem('tanggal_kegiatan');
        document.getElementById('start').value = localStorage.getItem('jam_mulai');
        document.getElementById('end').value = localStorage.getItem('jam_selesai');
    });
</script>
