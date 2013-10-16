/**
 * Created with IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 06/10/13
 * Time: 1:12 AM
 * To change this template use File | Settings | File Templates.
 */
$(function () {
    //Execute the slideShow
    slideShow();

    //display the datepickers
    $("#dpCheckin").datepicker();
    $("#dpCheckout").datepicker();

    $("#hotelSearch").submit(function(e){

        e.preventDefault();

        if ($("#txtLocation").val() != ""){
            //identify the city, country or hotel name

        }
        if ($("#txtCheckin").val() != ""){
            //check if is a date
            //check if the dat is not less than today

        }
        if ($("#txtCheckout").val() != ""){
            //check if is a date
            //check if the date is not less than today
            //check if the date is not less than date checkin

        }
        if ($("#txtRoomCount").val() != ""){
            //check if not less than 1

        }
        //pass the search details to generate search query
        var fetchUrl = SITE_URL + '/hotel/buildQuery/';


        $.post(fetchUrl, $("#hotelSearch").serialize() , function (data) {

            console.log(data);
            if (data.status == 'success'){
                window.location.href = data.url;
            }
            return false;
        }, 'json');
        return false;
    });

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
    $('#gallery .caption').animate({opacity: 0.0}, { queue: false, duration: 0 }).animate({height: '1px'}, { queue: true, duration: 300 });

    //Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
    $('#gallery .caption').animate({opacity: 0.7}, 100).animate({height: '100px'}, 500);

    //Display the content
    $('#gallery .content').html(caption);
}


var SEARCH = {

    'buildHotelList':function(hotelList){

        for (var i = 0; i < hotelList.length; i++) {
            var hotel = hotelList[i]['Hotel'];

            var item=$("#hotel").clone().attr("id","hotel_"+hotel['id']).attr("data-type",hotel['hotel_name']);

            for(var title in hotel){
                //console.log(typeof(hotel[title])+"---"+title);
                if(title == "hotel_image"){
                    item.find(".media-object").attt('src',hotel[title]);
                }
                if (title == "hotel_name"){
                    item.find(".media-heading").html(UTILS.ucWords(hotel[title]));
                }
                if (title == "hotel_stars"){
                    item.find(".star").attr("title",hotel[title]+"-star").addClass("star star"+hotel[title]).html("");
                }
                if (title == 'hotel_area'){
                    if( hotel['hotel_area'] != '' ){
                        item.find(".hotel_location").html("<i class='icon-map'></i> "+UTILS.ucWords(hotel[title]));
                    } else {
                        item.find(".hotel_location").html("");
                    }
                }
                if (title == 'hotel_phone' && hotel['hotel_phone'] != ''){
                    var html="";
                    html += "Phone: "+hotel['hotel_phone'];
                    if (hotel['hotel_fax'] != ''){
                        html += ", Fax: "+hotel['hotel_fax'];
                    }
                    item.find(".hotel_contact").html("<i class='icon-contact'></i> "+html);
                }
                if (title == 'hotel_details' && hotel['hotel_details'] != ''){
                    item.find(".hotel_details").html(UTILS.limitText(hotel['hotel_details'],250));
                }


            }
            $(".media-list").append(item);
            $(item).show();
        }


    }




};