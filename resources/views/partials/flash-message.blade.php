<script>
    var notyf = new Notyf({
        position: {
            x: 'center',
            y: 'bottom',
        },
        duration: 4000,
        dismissible: true,
    });

    @if ($message = session('success'))
    notyf.success('{{ $message }}');
    @endif

    @if ($message = session('errors'))
    notyf.error('เกิดข้อผิดพลาด');
    @endif

    @if ($message = session('error'))
    notyf.error('{{ $message }}');
    @endif

</script>
