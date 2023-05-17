    $(document).ready(function() {

        var count = 0;
        $('input[type=file]').change(function(e) {
            $('#image-table').html('');
            var files = e.target.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var filename = file.name;
                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = `
                        <tr id="row-${count}" data-rowid="">
                            <td>
                                <img src="${e.target.result}" width="100">
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="title-${count}">Title:</label>
                                    <input type="text" class="form-control checkName" name="titles[]" id="titles-${count}" >
                                    <span class="text-danger" id="titles_${count}_error"></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="description-${count}">Description:</label>
                                    <input type="text" class="form-control checkDescription" name="descriptions[]" id="descriptions-${count}" >
                                    <span class="text-danger" id="descriptions_${count}_error"></span>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="coin-${count}">Coin:</label>
                                    <input type="number" class="form-control checkCoin" name="coins[]" id="coins-${count}" >
                                    <span class="text-danger" id="coins_${count}_error"></span>
                                </div>
                            </td>
                        </tr>
                    `;
                    $('#image-table').append(html);
                    count++;
                };
                reader.readAsDataURL(file);
            }

        });

        // $('#myForm').submit(function(e) {
        $('#myForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('data-route'),
                type:'POST',
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // handle success
                    Swal.fire(
                        'Good job!',
                        'You Have Uploaded the Images!',
                        'success'
                    )
                    $('#myForm')[0].reset();
                    $('#image-table').html('');

                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var id = key.replace(/\./g, "_");
                        var newvar = id.replace(/\_/g, "-");
                        // console.log(id)
                        console.log(newvar)
                        $("#" + id + "_error").text(value[0]);
                        $("#" + newvar).addClass("is-invalid");
                    });
                }
            });
        });
});
