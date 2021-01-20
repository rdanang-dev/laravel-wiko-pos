<script>
    import Swal from 'sweetalert2'
    @if ($message = Session::get('success'))
        swal.fire({
            icon: "success",
            title: "Berhasil",
            text : {{ $message }}"
        });
    @endif
</script>
