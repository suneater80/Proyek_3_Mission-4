<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Kelola Mata Kuliah</h2>

                    <a href="{{ route('admin.courses.create') }}" style="display: inline-block; background-color: #4F46E5; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; margin-bottom: 24px;">
                        + Tambah Mata Kuliah
                    </a>

                    @if(session('success'))
                        <div style="background-color: #dcfce7; border: 1px solid #bbf7d0; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 24px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table style="width: 100%; border-collapse: collapse; margin-top: 24px;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="padding: 12px; text-align: left; border: 1px solid #e5e7eb;">Kode MK</th>
                                <th style="padding: 12px; text-align: left; border: 1px solid #e5e7eb;">Nama MK</th>
                                <th style="padding: 12px; text-align: left; border: 1px solid #e5e7eb;">SKS</th>
                                <th style="padding: 12px; text-align: left; border: 1px solid #e5e7eb;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr style="background-color: #ffffff; border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">{{ $course->kode_mk }}</td>
                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">{{ $course->nama_mk }}</td>
                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">{{ $course->sks }}</td>
                                    <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                        <a href="#" style="color: #2563eb; text-decoration: underline; margin-right: 16px;">Edit</a>

                                        <!-- Form Hapus dengan Konfirmasi JavaScript -->
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display: inline;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" 
                                                data-nama="{{ $course->nama_mk }}" 
                                                data-sks="{{ $course->sks }}"
                                                style="color: #dc2626; text-decoration: underline; background: none; border: none; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const form = this.closest('.delete-form');
                const nama = this.getAttribute('data-nama');
                const sks = this.getAttribute('data-sks');

                const message = `Anda yakin ingin menghapus mata kuliah "${nama}" (${sks} SKS)?\nTindakan ini tidak dapat dibatalkan.`;

                if (confirm(message)) {
                    form.submit();
                }
            });
        });
    </script>
</x-app-layout>