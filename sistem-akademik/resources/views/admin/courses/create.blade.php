<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Tambah Mata Kuliah</h2>

                    <form id="course-form" action="{{ route('admin.courses.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">Kode MK</label>
                            <input type="text" name="kode_mk" id="kode_mk" class="border rounded w-full py-2 px-3" required>
                            <p id="error-kode_mk" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Nama MK</label>
                            <input type="text" name="nama_mk" id="nama_mk" class="border rounded w-full py-2 px-3" required>
                            <p id="error-nama_mk" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">SKS</label>
                            <input type="number" name="sks" id="sks" class="border rounded w-full py-2 px-3" required>
                            <p id="error-sks" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="border rounded w-full py-2 px-3"></textarea>
                            <p id="error-deskripsi" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        <a href="{{ route('admin.courses.index') }}" class="ml-2 text-gray-600">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('course-form');
            if (!form) return;

            form.addEventListener('submit', function(e) {
                // Reset error state
                document.querySelectorAll('.border-red-500').forEach(el => {
                    el.classList.remove('border-red-500');
                });
                document.querySelectorAll('[id^="error-"]').forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });

                // Ambil nilai
                const kode_mk = document.getElementById('kode_mk')?.value.trim() || '';
                const nama_mk = document.getElementById('nama_mk')?.value.trim() || '';
                const sks = document.getElementById('sks')?.value.trim() || '';

                let isValid = true;

                if (kode_mk === '') {
                    showError('kode_mk', 'Kode MK tidak boleh kosong.');
                    isValid = false;
                }
                if (nama_mk === '') {
                    showError('nama_mk', 'Nama MK tidak boleh kosong.');
                    isValid = false;
                }
                if (sks === '' || isNaN(sks) || parseInt(sks) <= 0) {
                    showError('sks', 'SKS harus angka positif.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                const errorEl = document.getElementById('error-' + fieldId);
                if (field) field.classList.add('border-red-500');
                if (errorEl) {
                    errorEl.textContent = message;
                    errorEl.classList.remove('hidden');
                }
            }
        });
    </script>
</x-app-layout>