<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("confirmModal");
        const closeModal = document.getElementById("closeModal");
        const cancelButton = document.getElementById("cancelButton");
        const deleteForm = document.getElementById("deleteForm");

        // Tambahkan event listener pada tombol hapus
        document.querySelectorAll(".deleteButton").forEach(button => {
            button.addEventListener("click", function () {
                const actionUrl = this.getAttribute("data-url");
                deleteForm.setAttribute("action", actionUrl);
                modal.classList.remove("hidden"); // Tampilkan modal
            });
        });

        // Tutup modal ketika klik tombol batal atau close
        [closeModal, cancelButton].forEach(button => {
            button.addEventListener("click", function () {
                modal.classList.add("hidden"); // Sembunyikan modal
            });
        });
    });
</script>

<!-- Modal Container -->
<div id="confirmModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <!-- Modal Content -->
    <div class="bg-white rounded-lg shadow-lg w-1/3 dark:bg-gray-800">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Konfirmasi Hapus</h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">✕</button>
        </div>
        <!-- Modal Body -->
        <div class="p-6">
            <p class="text-gray-600 dark:text-gray-300">
                Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        <!-- Modal Footer -->
        <div class="flex justify-end items-center p-4 border-t dark:border-gray-700">
            <button id="cancelButton" class="px-4 py-2 text-sm text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">Batal</button>
            <form id="deleteForm" method="POST" class="ml-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">Hapus</button>
            </form>
        </div>
    </div>
</div>