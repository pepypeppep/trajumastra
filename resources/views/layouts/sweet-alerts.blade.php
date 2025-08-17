<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!--sweet alert init js-->
<script src="{{ URL::asset('assets/js/pages/sweetalert.init.js') }}"></script>
{{-- Alert Action Notification --}}
<script>
    // Show error by type
    @foreach (['success', 'error', 'warning', 'info'] as $type)
        @if ($message = Session::get($type))
            @php
                $title = match ($type) {
                    'success' => 'Berhasil',
                    'error' => 'Gagal',
                    'warning' => 'Peringatan',
                    'info' => 'Informasi',
                    default => null,
                };
            @endphp
            Swal.fire({
                title: '{{ $title }}',
                text: '{{ $message }}',
                icon: '{{ $type }}',
                timer: 3000,
                confirmButtonText: 'OK'
            })
        @endif
    @endforeach

    // When has error more than 1
    @if ($errors->any())
        @foreach ($errors->all() as $message)
            Swal.fire({
                title: 'GAGAL',
                text: ' @json($message)',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        @endforeach
    @endif
</script>

{{-- Alert Action Confirmation --}}
<script>
    function confirmDelete(button) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#919191',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Cari form terdekat dan submit
                button.closest('form').submit();
            }
        });
    }
</script>
