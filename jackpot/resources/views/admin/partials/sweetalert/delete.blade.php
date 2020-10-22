<script type="text/javascript">
    jQuery(document).ready(function () {
        $('#ajax_data').on('click', '.kt_sweetalert_delete', function (e) {
            var id = $(this).data('id');
            swal.fire({
                title: '{{ __('label.delete_confirmation') }} ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('label.delete_sure') }} !',
                cancelButtonText: '{{ __('label.cancel') }}',
                reverseButtons: true
            }).then(async function (result) {
                if (result.value && id) {
                    try {
                        var response = await axios.delete(DELETE_URL.replace(':id', id));
                        if (response['data']['status']) {
                            swal.fire('{{ __('label.success') }} !', "{{ __('label.delete_success') }} !", "success").then(function () {
                                window.location.reload();
                            });
                        } else {
                            swal.fire('{{ __('label.error') }} !', "{{ __('label.has_error') }}", "error").then(function () {
                                window.location.reload();
                            });
                        }
                    } catch (e) {
                        swal.fire('{{ __('label.error') }} !', "{{ __('label.has_error') }}", "error").then(function () {
                            window.location.reload();
                        });
                    }

                }
            });
        });
    });
</script>
