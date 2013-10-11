/**
 * Created with IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 06/10/13
 * Time: 1:08 AM
 * To change this template use File | Settings | File Templates.
 */
var SITE_URL = $('base').attr('href'),
    SELF_HREF = window.location.href,
    Loader = '<img class="loading" id="post_loader" src="' + SITE_URL + '/public/images/ajax_loader_02.gif"/>',
    postLoader = '<img class="loading" id="post_loader" src="' + SITE_URL + '/public/images/ajax_loader_05.gif"/>',
    isPostLoading = false,
    needLoadMore = false,
    loadOffset;

var UTILS = {
    numb:/^([0-9]*)$/,
    address:/^([a-zA-Z][a-zA-Z0\@\_\-\#\.\s]*)$/,
    email:/^[a-z0-9\-\_\+]+(\.[a-z0-9\-\_\+]+)*\@(([a-z0-9\-\_\+]+(\.[a-z0-9\-\_\+]+)*)(\.[a-z]{2,3})|([0-9]+\.){3}[0-9]+)$/i,
    alpha:/^[a-zA-Z\s]*$/,
    name:/^([a-zA-Z][a-zA-Z0\''\_\-\.\s]*)$/,
    zip:/^([0-9]{5,6})$/,
    phone:/^([0-9]{8,12})$/,
    end:0,

    'isEmpty':function (data) {
        if (data != '') {
            return false;
        } else {
            return true;
        }
    },
    'isPhone':function (phone) {
        return !!UTILS.phone.exec(phone);
    },

    'isZipcode':function (code) {
        return !!UTILS.zip.exec(code);
    },

    'isEmail':function (email) {
        return !!UTILS.email.exec(email);
    },

    'isNumber':function (num) {
        return !!UTILS.numb.exec(num);
    },

    'isValidCheckbox':function (obj_id){

        var check = 0;
        var objId = obj_id;

        $("input[id="+ objId +"]").each(function(){

            if ( this.checked )
            {
                check++;
            }

        });

        if ( check == 0) { return false; } else { return true; }
    },


    'length':function (string) {
        return string.length;
    },

    'redirect_window':function (url) {
        window.location.href = url;
    },

    //valid type message / error
    'show_message':function (message, type) {
        if (type == 'success') {
            $(".alert").removeClass().addClass('alert alert-success');
        } else if (type == 'error') {
            $(".alert").removeClass().addClass('alert alert-error');
        }
        $(".alert span.message").html(message);
        $(".alert").show();

        //remove this messsage after some time
        UTILS.remove_message();
    },

    //adnimate and remove message/error box
    'remove_message':function () {
        $(".alert").animate({opacity:1.0}, 8000).fadeOut('slow');
    },

    //reset form
    'reset':function(formId) {
        $("#"+formId).each(function () {
            this.reset();
        });
    },

    //display image upload form during edit
    'showImageUpload':function(){
        $("#oldImage").val('');
        $('.image_display').hide('slow');
        $('.add_image').show('slow');
    },

    //display delete confirmation box
    'confirmDelete':function(type, string){
        var t = confirm("Sure!, you want to delete " + type +" "+ string + "?");
        return t;
    },

    'displayFieldError':function( idStr , str ){
        var $obj = $("#"+idStr);
        $obj.html(str).show();
    },

    //call to hide displayed image and show
    //upload image box in the form
    'changeImage':function(){
        $('.imageDisplay').hide('slow');
        $('.uploadImage').show('slow');
    },

    //ucwords
    'ucWords':function( str ){
        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        return str;
    },

    'limitText':function(text,limit){
        try{
            var textLimit = (limit) ? limit : 300,
                variation = (limit < 50) ? limit : 50,	// limit the text between the chars eg. 300+/-50
                plusVar = parseInt(textLimit,10) + parseInt(variation,10),
                minusVar = textLimit-variation;
            if(text.length > textLimit){
                indexToSplit = text.indexOf('. ',textLimit);
                if(indexToSplit > plusVar || indexToSplit < minusVar){ // If the indexToSplit greater/less than the variation, find for a space index
                    indexToSplit = text.indexOf(' ',textLimit);
                    if(indexToSplit > plusVar || indexToSplit < minusVar){
                        indexToSplit = textLimit; // If still we cannot find a stopper, stop at the textLimt given
                    }
                }
                return text.substring(0,indexToSplit)+' [..]';
            } else {
                return text;
            }
        } catch(e){
            return text;
        }
    }

}
