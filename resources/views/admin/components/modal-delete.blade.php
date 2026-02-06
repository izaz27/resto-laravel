<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white rounded-3xl max-w-sm w-full p-8 shadow-2xl transform transition-all">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase">Hapus Data?</h3>
                <p class="text-sm text-gray-500 mt-2">
                    Tindakan ini tidak dapat dibatalkan. Data menu akan dihapus permanen dari sistem.
                </p>
            </div>

            <div class="mt-8 flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition">
                    BATAL
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-2xl font-black hover:bg-red-700 transition shadow-lg shadow-red-200">
                        HAPUS
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }
</script>