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
                <form action="{{ route('peminjaman.store.auto') }}" method="POST" id="form">
                    @csrf
                    <input type="hidden" name="barang" id="kode_barang">
                
                    <!-- Input yang akan diisi dengan data dari localStorage -->
                    <input type="hidden" name="kegiatan" id="kerja" value="">
                    <input type="hidden" name="tanggal_kegiatan" id="date" value="">
                    <input type="hidden" name="jam_mulai" id="start" value="">
                    <input type="hidden" name="jam_selesai" id="end" value="">
                    <input type="hidden" name="petugas" value="{{ Auth::user()->id }}">
                
                    <!-- Button submit form -->
                    <button style="display: none" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    data-modal-hide="ambilOtomatisModal">Tutup</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('kerja').value = localStorage.getItem('kegiatan') || '';
        document.getElementById('date').value = localStorage.getItem('tanggal_kegiatan') || '';
        document.getElementById('start').value = localStorage.getItem('jam_mulai') || '';
        document.getElementById('end').value = localStorage.getItem('jam_selesai') || '';
    });

</script>
