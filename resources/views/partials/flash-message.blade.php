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

    @if ($message = session('error'))
    notyf.error('{{$success}}');
    @endif

</script>
