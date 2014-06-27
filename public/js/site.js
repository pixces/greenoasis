/**
 * Created with IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 06/10/13
 * Time: 1:12 AM
 * To change this template use File | Settings | File Templates.
 */
$(function() {
    //Execute the slideShow
    slideShow();

    //display the datepickers
    $("#dpCheckin").datepicker();
    $("#dpCheckout").datepicker();

    //display datepicker for arrivaldate */
    $("#dpArrival").datepicker();

    $("#hotelSearch").submit(function(e) {

        e.preventDefault();

        if ($("#txtLocation").val() != "") {
            //identify the city, country or hotel name

        }
        if ($("#txtCheckin").val() != "") {
            //check if is a date
            //check if the dat is not less than today

        }
        if ($("#txtCheckout").val() != "") {
            //check if is a date
            //check if the date is not less than today
            //check if the date is not less than date checkin

        }
        if ($("#txtRoomCount").val() != "") {
            //check if not less than 1

        }
        //pass the search details to generate search query
        var fetchUrl = SITE_URL + '/hotel/buildQuery/';


        $.post(fetchUrl, $("#hotelSearch").serialize(), function(data) {

            console.log(data);
            if (data.status == 'success') {
                window.location.href = data.url;
            }
            return false;
        }, 'json');
        return false;
    });

    $("#quickContact").submit(function(e) {
        e.preventDefault();

        //all validation is already taken care of
        //so now just do a form submit
        var fetchUrl = SITE_URL + '/pages/saveContact/';

        $.post(fetchUrl, $("#quickContact").serialize(), function(data) {
            console.log(data);
            if (data.status == 'success') {
                alert(data.message);
                $("#quickContact")[0].reset();
            } else {
                alert("Please Correct:\n" + data.message);
            }
            return false;
        }, 'json');
        return false;
    });

    $(document).on('click', '.btn-book-hotel', SEARCH.preBooking);

    //add more applicants based on selected numbers
    $("form.visa-form").on('change', '#visa_count', VISA.addApplicants);
     $(document).on('submit', '#uploadform', VISA.uploadDocument);

    $('.modal').on('hide.bs.modal', function () {
   $('.modal').removeData();
});


    //call the function to recalculate booking values on select of qty
    //from the qty box on the room pricing page


});

function slideShow() {

    //Set the opacity of all images to 0
    $('#gallery a').css({opacity: 0.0});

    //Get the first image and display it (set it to full opacity)
    $('#gallery a:first').css({opacity: 1.0});

    //Set the caption background to semi-transparent
    $('#gallery .caption').css({opacity: 0.7});

    //Resize the width of the caption according to the image width
    $('#gallery .caption').css({width: $('#gallery a').find('img').css('width')});

    //Get the caption of the first image from REL attribute and display it
    $('#gallery .content').html($('#gallery a:first').find('img').attr('rel'))
            .animate({opacity: 0.7}, 400);

    //Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
    setInterval('gallery()', 6000);

}

function gallery() {

    //if no IMGs have the show class, grab the first image
    var current = ($('#gallery a.show') ? $('#gallery a.show') : $('#gallery a:first'));

    //Get next image, if it reached the end of the slideshow, rotate it back to the first image
    var next = ((current.next().length) ? ((current.next().hasClass('caption')) ? $('#gallery a:first') : current.next()) : $('#gallery a:first'));

    //Get next image caption
    var caption = next.find('img').attr('rel');

    //Set the fade in effect for the next image, show class has higher z-index
    next.css({opacity: 0.0})
            .addClass('show')
            .animate({opacity: 1.0}, 1000);

    //Hide the current image
    current.animate({opacity: 0.0}, 1000)
            .removeClass('show');

    //Set the opacity to 0 and height to 1px
    $('#gallery .caption').animate({opacity: 0.0}, {queue: false, duration: 0}).animate({height: '1px'}, {queue: true, duration: 300});

    //Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
    $('#gallery .caption').animate({opacity: 0.7}, 100).animate({height: '100px'}, 500);

    //Display the content
    $('#gallery .content').html(caption);
}

var SEARCH = {
    'buildHotelList': function(hotelList) {

        for (var i = 0; i < hotelList.length; i++) {

            var hotel = hotelList[i]['Hotel'];
            var tariffList = hotelList[i]['Tariff'];

            var item = $("#hotel").clone().attr("id", "hotel_" + hotel['id']).attr("data-type", hotel['hotel_name']);

            for (var title in hotel) {
                //console.log(typeof(hotel[title])+"---"+title);
                if (title == "hotel_logo") {
                    if (hotel['hotel_logo'] != '') {
                        var imgSrc = SITE_URL + "/public/upload/logo_" + hotel['hotel_logo'];
                        item.find(".media-object").attr('src', imgSrc);
                    } else {
                        item.find(".media-object").removeClass("img-polaroid");
                    }
                }
                if (title == "hotel_name") {
                    item.find(".media-heading").html(UTILS.ucWords(hotel[title]));
                }
                if (title == "hotel_stars") {
                    item.find(".star").attr("title", hotel[title] + "-star").addClass("star star" + hotel[title]).html("");
                }
                if (title == 'hotel_area') {
                    if (hotel['hotel_area'] != '') {
                        item.find(".hotel_location").html("<i class='icon-map'></i> " + UTILS.ucWords(hotel[title]));
                    } else {
                        item.find(".hotel_location").html("");
                    }
                }
                if (title == 'hotel_phone' && hotel['hotel_phone'] != '') {
                    var html = "";
                    html += "Phone: " + hotel['hotel_phone'];
                    if (hotel['hotel_fax'] != '') {
                        html += ", Fax: " + hotel['hotel_fax'];
                    }
                    item.find(".hotel_contact").html("<i class='icon-contact'></i> " + html);
                }
                if (title == 'hotel_details' && hotel['hotel_details'] != '') {
                    item.find(".hotel_details").html(UTILS.limitText(hotel['hotel_details'], 250));
                }
            }

            //append the media to media list and make it visible
            $(".media-list").append(item);
            $(item).show();

            //console.log(tariffList.length);
            //console.log(tariffList);

            for (var j = 0; j < tariffList.length; j++) {
                var tariff = tariffList[j];

                var itm = $("#tariff").clone().attr("id", "tariff_" + tariff['id']);

                //add tariff id to the button
                itm.find(".btn-book-hotel").attr("id", tariff['id']);

                //add hotel id
                itm.find(".btn-book-hotel").attr("data-hotel", hotel['id']);

                for (var label in tariff) {
                    if (label == 'room_type') {
                        itm.find(".room_type").html(UTILS.ucWords(tariff[label]));
                    }
                    if (label == 'meal_plan') {
                        itm.find(".meal_plan").html(tariff[label]);
                    }
                }
                item.find(".tariff-list").append(itm);
                $(itm).show();
            }
        }
    },
    //this will check for the valid agent signature
    //if present will redirect to the booking page
    //else it should throw a modal for Agent Login
    'preBooking': function() {

        //alert(window.location);
        //validate agent login
        var agentSession;
        var hrefUrl;
        agentLoginSession = SEARCH.checkForsession();

        if (agentLoginSession == "FAILED") {
            hrefUrl = SITE_URL + "/agent/login/";

        } else {
            var obj = $(this);
            var id = $(obj).attr('id');
            var hotelId = $(obj).attr('data-hotel');
            var searchSession = $(obj).attr('data-search-session');
            hrefUrl = SITE_URL + "/hotel/booking/?tariff=" + id + "&hotel=" + hotelId + "&search_sid=" + searchSession;
        }

        //check for valid agent credentials

        //redirect to the booking form
        window.location.href = hrefUrl;
    },
    'booking': function(e) {
        e.preventDefault;

        //validate if the tnc checkbox is selected
        if (!$('#tnc_input').is(':checked')) {
            alert("You must agree to booking terms and conditions");
            return false;
        }

        var fetchUrl = SITE_URL + '/hotel/saveBooking/';

        $.post(fetchUrl, $("#frmBooking").serialize(), function(data) {
            console.log(data);
            if (data.status == 'success') {
                //redirect to the confirmation page
                var queryStr = data.message;
                var redirect = SITE_URL + "/hotel/confirmation/?" + queryStr;

                //redirect
                window.location.href = redirect;

                return false;
            } else {
                alert("Some error occurred.");
                console.log(data.message);
            }
            return false;
        }, 'json');
        return false;
    },
    'checkForsession': function() {

        var ajaxSessionResponse;
        var reloadUrl=window.location;
        $.ajax({
            type: "POST",
            async: false,
            data:"reloadUrl="+reloadUrl,
            url: SITE_URL + '/agent/checkAgentSession/',
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.status == "failed") {
                    alert(data.message);
                    ajaxSessionResponse = "FAILED";
                }
                else {
                    ajaxSessionResponse = "SUCCESS";
                }
            }
        });
        return ajaxSessionResponse;
    }


};

var VISA = {
    'addApplicants': function() {
        var maxCount = 5;
        var applicantCount = $("#visa_count").val();

        //start with resetting everything
        $(".appl-item").remove();

        if (applicantCount > 0) {

            if (applicantCount > maxCount) {
                alert("More than " + maxCount + " applicants not allowed. Please check Admin");
                return false;
            }

            for (var i = 0; i < applicantCount; i++) {

                var item = $("#visaAppl_0").clone().attr("id", "visaAppl_" + i).attr("class", "appl-item");

                //change the field names accordingly
                item.find(":input").each(function() {

                    if ($(this).attr('id')) {

                        var nodeId = $(this).attr('id');
                        var splitId = nodeId.split("_");
                        var nodeName = splitId[0] + "[" + i + "]" + "[" + splitId[1] + "]";
                        nodeId = splitId[0] + "_" + splitId[1] + "_" + i;

                        $(this).attr('name', nodeName);
                        $(this).attr('id', nodeId);
                    }
                });
                $(".visa-pax-list").append(item);
            }
            $(".appl-item").show();
            $(".visa-pax-list").fadeIn();
        } else {
            $(".visa-pax-list").fadeOut();
        }

    },
            'uploadDocument': function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: SITE_URL + '/admin/uploadVisaByAdmin/',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function() {
                $("#loader").show();
            },
            success: function(data) {
                if (data.result == "Success") {
                    $(".uploadvisa-form").slideUp("slow", function() {
                        $("#uploadError").empty();
                        $("#uploadStatus").html(data.message);
                        $("."+data.applicationid+"-text-status").removeClass("text-warning").addClass("text-success").html("Approved");
                        $(".download-visa-"+data.applicationid).html(data.download_link);
                        
//window.parent.location.reload(false);
                       // opener.location.href = opener.location.href;
                        
                    });

                } else {
                    $("#uploadError").html(data.message);
                }

                $("#loader").hide();

            }
        });
    }

};

var PACKAGE = {
    'init': function() {
        PACKAGE.optionsSelect();
    },
    'optionsSelect': function() {

        //check the values based on the selected radio button
        var RateRadio = $('input[name="pk[rate]"]:checked');
        var TimeRadio = $('input[name="pk[time]"]:checked');

        //update these to the appropriate items
        var rateSelected = RateRadio.val();
        var timeSelected = TimeRadio.val();

        var rates = rateSelected.split("|");

        //console.log(rates);

        $("#pkSelectedTimeId").text(timeSelected);
        $("#pkPriceAdult").text(rates[0]);
        if (typeof rates[1] !== "undefined" && rates[1] != '') {
            $("#pkPriceChild").text(rates[1]);
        } else {
            $("#pkPriceChild").text(0);
        }
        $("#pkUnit").text(rates[2]);


        //run calculate here
        PACKAGE.calculate();
    },
    'calculate': function() {

        var adultPax = $("#pkPxAdult").val();
        var childPax = $("#pkPxChild").val();
        var adultPrice = $("#pkPriceAdult").text();
        var childPrice = $("#pkPriceChild").text();
        var paxUnit = $("pkUnit").text();




        var totalPrice = (adultPax * adultPrice) + (childPax * childPrice);

        //console.log('Adult: '+adultPax + ' child: '+childPax + ' Adult Price:' + adultPrice + ' child price: ' + childPrice + ' Total: '+totalPrice);

        //update the total price
        $("#pkTotalPrice").text(totalPrice);
    }

};

var BOOKING = {
    'init': function() {
        BOOKING.calculateTariff();
    },
    'calculateTariff': function() {
        var subtotal = 0;
        $(".tariff-plan").each(function() {
            //calculate the row total
            var Obj = $(this);
            var plan = Obj.attr("data-plan");
            var unit_price = Obj.children(".clmn-unit-price").text();
            var nights = Obj.children(".clmn-nights").text();
            var qty = $("#select_" + plan).val();
            var total = 0;

            if (qty > 0) {
                total = parseInt(unit_price) * parseInt(nights) * parseInt(qty);
            }

            subtotal += total;
            //update total to the price value
            $(".price-" + plan).html(total);
        });

        //update subtotal
        $(".subtotal-price").html(subtotal);

        //get grand total
        $(".grandTotal-price").html(subtotal);
    }
};