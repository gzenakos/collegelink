jQuery(document).ready(function ($) {
    jQuery.ready.then(function ($) {
        initImageGallery($)
        // initGoogleMap($);

    });



    //Review Submit Button
    $(document).on('submit', 'form.bookingForm', function(e){
        e.preventDefault();
        const checkInDate = $('[name="check_in_date"]').val();
        const checkOutDate = $('[name="check_out_date"]').val();
        if (confirm("Are you sure you want to book this room from " + checkInDate + "to " + checkOutDate +"?")) {
            this.submit();
          }
    });
    //Favorite Submit Button
    $(document).on('submit', 'form.favoriteForm', function(e){

        e.preventDefault();
        //Get form data
        const formData = $(this).serialize();

        //Ajax Requests
        $.ajax(
            'http://hotel.collegelink.localhost/public/ajax/room_favorite.php',
            {
                type: 'POST',
                dataType: 'json',
                data: formData,
        }).done(function (result) {
            $('input[name=is_favorite]').val(result.is_favorite ? 1 : 0 );

            if (result.status) {
                $('#fav').hasClass('selected') ? null : $('#fav').addClass('selected') ;
            } else {
                console.log(result);

                $('#fav').hasClass('selected') ? $('#fav').removeClass('selected') : null;

            }
        });
    });

    //Review Submit Button
    $(document).on('submit', 'form.reviewForm', function(e){

        e.preventDefault();
        //Get form data
        const formData = $(this).serialize();
        $('form.reviewForm :input').prop('disabled', true);
        //Ajax Requests
        $.ajax(
            'http://hotel.collegelink.localhost/public/ajax/room_review.php',
            {
                type: 'POST',
                dataType: 'html',
                data: formData,
            }
        ).done( function (result) {
                //Append results to container
                $('#room-reviews-container').append(result);
                //Reset review form
                $('form.reviewForm').trigger('reset');
            }
        ).fail()
        .always( function () {
            $('form.reviewForm :input').prop('disabled', false);
        });
    });

});

function initImageGallery($) {
    $('.image-popup-vertical-fit').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}

	});

	$('.image-popup-fit-width').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		image: {
			verticalFit: false
		}
	});

	$('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

}

// Initialize Google Map
async function initMap() {
    // Get latitude and longitude from data attributes
    var latitude = parseFloat(document.getElementById('map').getAttribute('data-lat'));
    var longitude = parseFloat(document.getElementById('map').getAttribute('data-long'));

    // Request `needed libraries.
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    const map = new Map(document.getElementById("map"), {
        center: { lat: latitude, lng: longitude },
        zoom: 14,
        mapId: "f92366b90dd2c9c",
    });
    const marker = new AdvancedMarkerElement({
        map,
        position: { lat: latitude, lng: longitude },
    });
}
initMap();