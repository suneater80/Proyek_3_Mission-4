<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-bold mb-6">Daftar Mata Kuliah</h2>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tabel 1: Course yang SUDAH Diambil -->
                    <h3 class="text-xl font-semibold mb-4">Mata Kuliah yang Sudah Diambil</h3>
                    @if($enrolledCourses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                            @foreach($enrolledCourses as $course)
                                <div class="border rounded-lg p-4 bg-green-50">
                                    <h4 class="font-bold text-green-800">{{ $course->nama_mk }}</h4>
                                    <p class="text-sm">Kode: {{ $course->kode_mk }} | SKS: {{ $course->sks }}</p>
                                    <p class="text-xs text-green-600">Status: Sudah Diambil</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mb-6 text-gray-500">Belum ada mata kuliah yang diambil.</p>
                    @endif

                    <!-- Tabel 2: Course yang BELUM Diambil -->
                    <h3 class="text-xl font-semibold mb-4">Mata Kuliah yang Tersedia</h3>
                    <!-- Form Multi-Select Course -->
                    <form id="enroll-multi-form" class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-bold mb-4">Pilih Mata Kuliah untuk Diambil</h4>
                        <div id="course-checkboxes" class="space-y-2 mb-4">
                            <!-- Checkbox akan di-generate oleh JavaScript -->
                        </div>
                        <p class="font-medium">Total SKS: <span id="total-sks" class="text-blue-600">0</span></p>
                        <button type="submit" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                            Ambil Mata Kuliah Terpilih
                        </button>
                        <div id="form-error" class="mt-2 text-red-600 font-medium hidden">
                            Pilih minimal 1 mata kuliah!
                        </div>
                    </form>
                    @if($availableCourses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($availableCourses as $course)
                                <div class="border rounded-lg p-4 bg-blue-50">
                                    <h4 class="font-bold text-blue-800">{{ $course->nama_mk }}</h4>
                                    <p class="text-sm">Kode: {{ $course->kode_mk }} | SKS: {{ $course->sks }}</p>
                                    <p class="text-xs text-blue-600 mb-3">{{ Str::limit($course->deskripsi, 100) }}</p>
                                    <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                            Ambil Mata Kuliah
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada mata kuliah tersedia untuk diambil.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Scope, Array, Object — Data dummy course
        const availableCourses = @json($availableCourses); // Ambil data dari Laravel

        // 2. DOM Selector — Akses elemen
        const checkboxesContainer = document.getElementById('course-checkboxes');
        const totalSKS = document.getElementById('total-sks');
        const formError = document.getElementById('form-error');
        const enrollForm = document.getElementById('enroll-multi-form');

        // 3. DOM Manipulation — Buat checkbox
        function renderCheckboxes() {
            checkboxesContainer.innerHTML = ''; // Kosongkan dulu

            availableCourses.forEach(course => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="course_ids[]" value="${course.id}" data-sks="${course.sks}" class="course-checkbox">
                        <span>${course.nama_mk} (${course.sks} SKS)</span>
                    </label>
                `;
                checkboxesContainer.appendChild(div);
            });

            // 4. Event Handling — Pasang event listener ke semua checkbox
            document.querySelectorAll('.course-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalSKS);
            });
        }

        // 5. Hitung total SKS otomatis
        function updateTotalSKS() {
            let total = 0;
            document.querySelectorAll('.course-checkbox:checked').forEach(checkbox => {
                total += parseInt(checkbox.getAttribute('data-sks'));
            });
            totalSKS.textContent = total;
        }

        // 6. Event Handling — Validasi form & submit
        enrollForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const checked = document.querySelectorAll('.course-checkbox:checked');
            if (checked.length === 0) {
                // Tampilkan error + border merah
                formError.classList.remove('hidden');
                checkboxesContainer.classList.add('border', 'border-red-500', 'rounded');
                return;
            }

            // Sembunyikan error
            formError.classList.add('hidden');
            checkboxesContainer.classList.remove('border', 'border-red-500');

            // Ambil ID course yang dipilih
            const selectedIds = Array.from(checked).map(cb => cb.value);

            // Simulasi: Tampilkan alert (nanti pakai fetch ke server)
            alert(`Berhasil mengambil course ID: ${selectedIds.join(', ')}\nTotal SKS: ${totalSKS.textContent}`);

            // TODO: Kirim data ke server via fetch (Mission 5)
            // Simulasi reload halaman
            setTimeout(() => {
                location.reload();
            }, 1000);
        });

        // Render checkbox saat halaman dimuat
        renderCheckboxes();
    </script>
</x-app-layout>