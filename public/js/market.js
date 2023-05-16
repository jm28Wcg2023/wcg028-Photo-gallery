
    // $(document).ready(function() {
    //     // var offset = 0; // Initial offset value

    //     // loadCards(offset);
    //     loadCards();



    //   // Search functionality
    //   $('#search').on('keyup', function() {
    //     var query = $(this).val();
    //     $.ajax({
    //     //   url: '{{ route("cards") }}',
    //       url : $('#search').attr('data-action'),
    //       type: 'GET',
    //       dataType: 'json',
    //       data: {
    //         search: query,
    //         // sort: $('#sort').val()
    //       },
    //       success: function(data) {
    //         displayCards(data);
    //       },
    //       error: function(xhr, status, error) {
    //         console.log(xhr.responseText);
    //       }
    //     });
    //   });

    //   // Sort functionality
    //   $('#sort').on('change', function() {
    //     var query = $('#search').val();
    //     $.ajax({
    //     //   url: '{{ route("cards") }}',
    //     url : $('#sort').attr('data-action'),
    //       type: 'GET',
    //       dataType: 'json',
    //       data: {
    //         query: query,
    //         sort:$('#sort').val()
    //       },
    //       success: function(data) {
    //         displayCards(data);
    //       },
    //       error: function(xhr, status, error) {
    //         console.log(xhr.responseText);
    //       }
    //     });
    //   });

    // //   $(document).scroll(function() {
    // //     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
    // //       offset += 10; // Adjust the offset value as per your pagination logic
    // //       loadCards(offset);
    // //     }
    // //   });

    //   function loadCards() {
    //     $.ajax({
    //       url: $('#sort').attr('data-action'),
    //     //   url : $(this).attr('data-action'),
    //       type: 'GET',
    //       dataType: 'json',
    //     //   data :{
    //     //     offset: offset,
    //     //   },
    //       success: function(data) {
    //         displayCards(data);
    //       },
    //       error: function(xhr, status, error) {
    //         console.log(xhr.responseText);
    //       }
    //     });
    //   }

    //   function displayCards(data) {
    //     var cards = '';
    //     console.log(data)
    //     $.each(data, function(index, value) {
    //         cards += '<div class="col-md-6 col-lg-4">';
    //         cards += '<div class="card  my-3 card-block lazy">';
    //         cards += '<img src="/images/'+ value.image_path +'" class="card-img-top" alt="'+ value.name +'">';
    //         cards += '<div class="card-body">';
    //         cards += '<div class="row">';
    //         cards += '<div class="col d-flex justify-content-between">';
    //         cards += '<p class="card-title fs-5">'+ value.name +'</p>';
    //         cards += '<p class="badge rounded-pill bg-success fs-6 ownername"><i class="bi bi-person"></i> '+ value.user.name +'</p>';
    //         cards += '</div>';
    //         cards += '</div>';
    //         cards += '<p class="card-text">'+ value.description +'</p>';
    //         cards += '<p class="card-text badge rounded-pill bg-success fs-6">'+ value.coin +' <i class="bi bi-cash text-warning fs-6"></i></p>';
    //         cards += '<div class="d-flex justify-content-between">';
    //         // if(checkLogin){
    //         if(auth) {
    //             if(Role === '0'){

    //                 if (value.is_owned || value.user_id == "{{ Auth::user()->id }}") {

    //                     cards += '<a href="/image-market/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
    //                     // cards += '<a href="{{ route("download.image", "") }}/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
    //                 } else if (value.is_purchased) {
    //                     cards += '<a href="/image-market/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
    //                     // cards += '<a href="{{ route("download.image", "") }}/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
    //                 } else {
    //                      cards += '<a href="/image-purchase/' +value.id+'" id="buy" data-id="'+ value.id +'" class="btn btn-warning">Buy</a>';
    //                     // cards += '<a href="{{ route("purchase.image", "") }}/' +value.id+'" id="buy" data-id="'+ value.id +'" class="btn btn-warning">Buy</a>';
    //                 }
    //             }else{

    //                 cards += '<a href="/image-market/' + value.id + '" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
    //             }
    //         } else {
    //         // }else {
    //             cards += '<a href="/market" id="buy" class="btn btn-warning">Buy</a>';

    //             // cards += '<a href="{{ route("plzLogin") }}" class="btn btn-dark d-flex w-0 justify-content-end download" id="download"><i class="bi bi-arrow-down"></i></a>';
    //         }


    //         cards += '</div>';
    //         cards += '</div>';
    //         cards += '</div>';
    //         cards += '</div>';
    //     });
    //     // $('#card-list').html('');
    //     // $('#card-list').html(cards);
    //     $('#card-list').append(cards); // Append the new cards instead of replacing
    //     }
    // });

    var ENDPOINT = route;
    var page = 1;
    var search = '';
    var sort = '';

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
            page++;
            infiniteLoadMore(page, search, sort);
        }
    });

    function infiniteLoadMore(page, search, sort) {
        $.ajax({
            url: ENDPOINT + "?page=" + page + "&search=" + search + "&sort=" + sort,
            datatype: "html",
            type: "get",
            beforeSend: function () {
                $('.auto-load').show();
            }
        })
        .done(function (response) {
            if (response.html == '') {
                $('.auto-load').html("We don't have more data to display :(");
                return;
            }

            $('.auto-load').hide();
            $("#data-wrapper").append(response.html);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occurred');
        });
    }

    $('#searchInput').on('input', function() {
        var newSearch = $(this).val().trim();
        if (search !== newSearch) {
            search = newSearch;
            resetAndLoadData();
        }
    });

    $('#sortSelect').on('change', function() {
        var newSort = $(this).val();
        if (sort !== newSort) {
            sort = newSort;
            resetAndLoadData();
        }
    });

    function resetAndLoadData() {
        page = 1;
        $("#data-wrapper").empty();
        infiniteLoadMore(page, search, sort);
    }
