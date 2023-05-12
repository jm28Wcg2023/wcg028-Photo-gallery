$(document).ready(function() {
    // var  action = $('form').attr('data-id');
    function isvalidateBonus(){
        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length != 0;
        }, "Spaces are not allowed.");

        $("#myForm").validate({
                rules: {
                    bonus_name: {
                        required :true,
                        noSpace: true,
                    },
                    coins:{
                        required :true,
                        number: true,
                        noSpace: true,
                    }
                },
                messages: {
                    bonus_name: {
                        required: "Please enter a name.",
                        noSpace: "Spaces are not allowed in the name field."
                    },
                    coins: {
                        required: "Please select a coin.",
                        number: "Please enter a valid number",
                        noSpace: "Spaces are not allowed in the coin field."
                    }
                }
            });
        }
    $('form').submit(function(e) {
        e.preventDefault();
        isvalidateBonus();

        if ($('#myForm').valid()) { //start
        $.ajax({
            url:$('form').attr('action'),
            method:"POST",
            data:$('#myForm').serialize(),
            type:'json',
            success:function(data)
            {
                console.log('data', data);
                // $(".alert-success").css("display", "block");
                // $(".alert-success").append("<p>Bonus Updated Successfully.</p>");
                swal({
                    type: 'success',
                    html: 'code, ' + data.value
                });

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
        // $('#myForm')[0].submit();
    }//end

    });
 });
