<script>
    var notyf = new Notyf({
        position: {
            x: 'center',
            y: 'bottom',
        },
        dismissible: true,
    });

    @if ($message = session('success'))
    notyf.success('{{$message}}');
    @endif

    @if ($message = session('errors'))
    notyf.error('เกิดข้อผิดพลาด');
    @endif

</script>
