<script>
    let id = "{{ \Request::route('id') }}";
    let url = "{{ route('api.tickets.update-status', [':id', ':status']) }}";

    $(document).on('click','.inbox-message',function(){
        if($(this).hasClass('toggle-on')){
            $(this).addClass('toggle-off');
            $(this).removeClass('toggle-on');
        }
        else{
            $(this).addClass('toggle-on');
            $(this).removeClass('toggle-off');
        }
    });

    $('#kt_summernote_1').summernote({
        height: 150
    });

    $('.dropdown-item').click(function(){
        let status = $(this).data('status');
        $.ajax({
            url: url.replace(':id', id).replace(':status', status),
            method: "GET",
            success: function(data){
                if(data == "success"){
                    $('.dropdown-item').each(function(){
                        if($(this).hasClass('disabled')){
                            $(this).removeClass('disabled');
                        }
                        else{
                            $(this).addClass('disabled');
                        }
                    });

                    Swal.fire({
                        timer: 1000,
                        onOpen: function() {
                            Swal.showLoading()
                        }
                    }).then(function(result) {
                        if (result.dismiss === "timer") {
                            if(status == 0){
                                $('.status').text('Open');
                                if($('.status').hasClass('label-danger')){
                                    $('.status').removeClass('label-danger');
                                    $('.status').addClass('label-success');
                                }
                            }
                            else if(status == 1){
                                $('.status').text('Close');
                                if($('.status').hasClass('label-success')){
                                    $('.status').removeClass('label-success');
                                    $('.status').addClass('label-danger');
                                }
                            }
                            console.log('Update successful')
                        }
                    })
                }
            }
        });
    })
    
    $('#send-message').click(function(){console.log($("#kt_summernote_1").summernote("code"));
        let content = $("#kt_summernote_1").summernote("code");
        if($('#kt_summernote_1').summernote('isEmpty')){
            $('.invalid-feedback').text('* Please enter your content.');
        }
        else if(content.replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim().length < 20 && $(content).find('img').length == 0){
            $('.invalid-feedback').text('* Content must has at least 20 characters.');
        }
        else{
            $('.invalid-feedback').text('');
            let message = {
                subject_id : id,
                user_id : "{{ $userId }}",
                content : content.replace(/&nbsp;/g, "").trim(),
            };
            $.ajax({
                url : "{{ route('api.tickets.insert-message') }}",
                method: "POST",
                data : message,
                headers : {
                    'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                },
                success : function(data){
                    Swal.fire({
                        timer: 1000,
                        onOpen: function() {
                            Swal.showLoading()
                        }
                    }).then(function(result) {
                        if (result.dismiss === "timer") {
                            $('#kt_summernote_1').summernote('code', '');
                            let message_preview = data.content.replace(/(<([^>]+)>)/ig, " ");
                            if($(data.content).find('img').length > 0){
                                message_preview = 'Attachments file';
                            }
                            $('#show-message').append(`<div class="cursor-pointer shadow-xs inbox-message toggle-on" data-inbox="message">
                                    <!--begin::Message Heading-->
                                    <div class="d-flex card-spacer-x py-6 flex-column flex-md-row flex-lg-column flex-xxl-row justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="symbol symbol-50 mr-4" data-toggle="expand">
                                                <span class="symbol-label" style="background-image: url({{ asset('media/users/100_11.jpg') }})"></span>
                                            </span>
                                            <div class="d-flex flex-column flex-grow-1 flex-wrap mr-2">
                                                <div class="d-flex align-items-center justify-content-between" data-toggle="expand">
                                                    <div>
                                                        <a href="#" class="font-size-lg font-weight-bolder text-dark-75 text-hover-primary mr-2">{{ $user['display_name'] }}</a>
                                                        <span class="label label-success label-dot mr-2"></span>{{ \Carbon\Carbon::parse(` + data.created_at + `)->diffForHumans() }}
                                                    </div>
                                                    <span>` + data.created_at + `</span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <div class="toggle-off-item">
                                                        <span>{{ $user['email'] }}</span>
                                                    </div>
                                                    <div class="text-muted font-weight-bold toggle-on-item text-truncate" style="max-width: 550px" data-toggle="expand">` + message_preview + `</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Message Heading-->
                                    <div class="card-spacer-x py-3 toggle-off-item">
                                        ` + data.content + `
                                    </div>
                                </div>`);
                            console.log('Insert successful')
                        }
                    });
                } 
            })
        }
    });

    $('.delete-ticket').click(function(){
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                let status = 2;
                $.ajax({
                    url: url.replace(':id', id).replace(':status', status),
                    method: "GET",
                    success: function(data){
                        if(data == 'success'){
                            Swal.fire(
                            "Deleted!",
                            "Ticket has been deleted.",
                            "success"
                            ).then(function(OK){
                                if (OK.value){
                                    window.location.href = "{{ route('tickets.index') }}";
                                }
                            });
                        }
                    },
                    error: function(){
                        Swal.fire(
                            "Cancelled",
                            "error"
                        )
                    }
                })
                
            }
        });
    })
</script>