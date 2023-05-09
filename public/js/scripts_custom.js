/*!
* Start Bootstrap - Grayscale v7.0.6 (https://startbootstrap.com/theme/grayscale)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
*/
//
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});

//jquery class file
// $(".tblSample").DataTable();
//check only title.
// function mySearchFunction() {
    //     var input, filter, cards, cardContainer, h3, title, i;
    //     input = document.getElementById("myFilter");
    //     filter = input.value.toUpperCase();
    //     cardContainer = document.getElementById("myItems");
    //     cards = cardContainer.getElementsByClassName("card");
    //     for (i = 0; i < cards.length; i++) {
        //         title = cards[i].querySelector(".card-block h3.card-title");
        //         if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            //             cards[i].parentElement.style.display = "flex"
            //         } else {
                //             cards[i].parentElement.style.display = "none"
                //         }
                //     }
                // }

//Image Search by its Title in market-view
let buttonUp = () => {
    const input = document.querySelector("#myFilter");
    const cards = document.getElementsByClassName("card");
    let filter = input.value.toUpperCase();
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector(".card-body");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].parentElement.style.display = "flex"
        } else {
            cards[i].parentElement.style.display = "none"
        }
    }
}

let buttonUpOwner = () => {
    const input = document.querySelector("#myOwner");
    const cards = document.getElementsByClassName("card");
    let filter = input.value.toUpperCase();
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector(".ownername");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].parentElement.style.display = "flex"
        } else {
            cards[i].parentElement.style.display = "none"
        }
    }
}

$('select[name="dropdown"]').change(function(){

    if ($(this).val() == "ASC"){
        $('.cardSort .card').sort(function(a,b) {
            return $(a).find(".card-title").text() > $(b).find(".card-title").text() ? 1 : -1;
        }).appendTo(".cardSort");
    }
    if ($(this).val() == "DEC"){
        $('.cardSort .card').sort(function(a,b) {
            return $(a).find(".card-title").text() < $(b).find(".card-title").text() ? 1 : -1;
        }).appendTo(".cardSort");
    }
});

//Copy to Clipboard Link function
function myFunction() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    swal("Copied", "Here's Referral Link Copied", "success", {
        button: "Done",
        });
}

