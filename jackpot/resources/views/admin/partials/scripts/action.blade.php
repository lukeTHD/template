<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#kt_do_action").click(async function () {
            var action = $("#kt_form_action").val();
            var ids = $("#ajax_data .kt-checkbox input[type=checkbox]:checked").map(function (_, el) {
                var val = $(el).val();
                if (val !== 'on') return val;
            }).get();
            if (action) {
                if (ids.length === 0) {
                    Swal.fire(
                        '{{ __('label.error') }} !',
                        '{{ __('label.no_record') }} !',
                        'error'
                    );
                }
                if (action === 'delete') {
                    var response = await axios({
                        method: 'delete',
                        url: 'http://localhost/jackpot/public/api/users',
                        data: {
                            ids: ids
                        }
                    });

                    if(response.data.status) {
                        Swal.fire(
                            '{{ __('label.success') }} !',
                            '{{ __('label.delete_success') }} !',
                            'success'
                        ).then(function () {
                            window.location.reload();
                        });
                    }
                }
            } else {
                Swal.fire(
                    '{{ __('label.error') }} !',
                    '{{ __('label.no_action') }} !',
                    'error'
                );
            }
        });
    });
</script>
