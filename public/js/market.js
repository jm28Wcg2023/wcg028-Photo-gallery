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
