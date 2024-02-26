jQuery(document).ready(function ($) {
    jQuery.ready.then(function ($) {

        //Initialize date pickers
        $("#check-in-date").datepicker({dateFormat: "dd-mm-yy" });
        $("#check-out-date").datepicker({dateFormat: "dd-mm-yy" });

        var priceMinValue = $("#amount-min").val().split(" ")[0];
        var priceMaxValue = $("#amount-max").val().split(" ")[0];

        //Initialize Range Slider using jqueryui library  eg ->https://jqueryui.com/slider/#range
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [priceMinValue, priceMaxValue],
            slide: function (event, ui) {
                $("#amount-min").val(ui.values[0] + " €");
                $("#amount-max").val(ui.values[1] + " €");
            },
        });
        // $("#amount-min").val(ui.values[0] + " €");
        // $("#amount-max").val(ui.values[1] + " €");
        // priceMinValue.val($("#slider-range").slider("values", 0));
        // priceMaxValue.val($("#slider-range").slider("values", 1));
    });

    //Search Submit Button
    $(document).on('submit', 'form.searchFormList', function(e){
        e.preventDefault();
        //Get form data
        const formData = $(this).serialize();
        //Ajax Requests
        $.ajax(
            'http://hotel.collegelink.localhost/public/ajax/search_results.php',
            {
                type: 'Get',
                dataType: 'html',
                data: formData,
        }).done(function (result) {
            //Clear results container
            $('#search-results-container').html('');

            //Append results to container
            $('#search-results-container').html(result);

            //Push url state to history
            history.pushState({}, '', window.location.origin + window.location.pathname + '?' + formData);
        });
    });
});

