@if($errors->any())
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

    @foreach($errors->all() as $error)
        {!! $error !!}<br/>
    @endforeach
</div>
@elseif(session()->get('flash_success'))
@stack('before-scripts')
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    Toast.fire({
    icon: 'success',
    title: 'Berhasil Diperbaruhi !',
    })
</script>
@stack('after-scripts')
@endif
