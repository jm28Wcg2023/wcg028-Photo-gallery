{/* <script> */}
        $(document).ready(function() {
            function isValidate(){
                $("#editForm").validate({
                    rules: {
                        name: {
                            required :true,
                            // noSpace: true,
                        },
                        description: {
                            required :true,
                            // noSpace: true,
                        },
                        coin:{
                            required :true,
                            number: true,

                            // noSpace: true,
                        },

                    },
                    messages: {
                        name: {
                            required: "Please enter a name.",
                        },
                        description: {
                            required: "Please enter a description.",
                        },
                        coin: {
                            required: "Please select a coin.",
                            number: "Please enter a valid number",
                        },
                    }
                });
            }

            $('form').submit(function(e) {
                e.preventDefault();

                // if(isValidate()){ // client side validation start

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        // url:"{{route('UserUpdateImage',$imageData->id)}}",
                        url : $(this).attr('action'),
                        method:"POST",
                        data:new FormData(this),
                        type:'json',
                        contentType: false,
                        cache : false,
                        processData: false,
                        success:function(data)
                        {
                            Swal.fire({
                                icon: 'success',
                                title: 'Good job!',
                                text: 'Image Data Updated Successfully!',
                                timer: 4000
                            })
                            // console.log(data)
                            // window.location = '{{ route('userimagelist') }}'
                        },
                        error:function(xhr, status, error){
                            var errors = xhr.responseJSON.errors;
                            console.log(errors)
                            $.each(errors, function (key, value) {
                                $("#" + key + "_error").text(value[0]);
                                $("#" + key).addClass("is-invalid");
                            });

                        }
                    });
                // } // client side validation end
            });
        });
    {/* </script> */}
