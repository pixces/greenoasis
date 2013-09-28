/**
 * Created with IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 08/09/13
 * Time: 1:29 AM
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
    }
};

var ADMIN = {

    'doLogin':function(){

        var error = '';
        var username = $("#username").val();
        var password = $("#password").val();
    },

    'getSeasons':function(){

        var $obj = $(".seasonList");
        var action = $obj.attr('data-action');
        var hotelId = $obj.attr('data-value');

        var htmlText = $obj.html();
        var fetchUrl = SITE_URL + '/admin/get_season_list/'+hotelId;

        $( ".seasonList" ).load( fetchUrl );

    },

    /* general method to change status
     * Can be used on all places like
     * @page, @products, @category, @users
     */
    'toggleStatus': function () {
        var obj = $(this);
        var id = $(obj).attr('id');
        var action = $(obj).attr('data-action');
        var type = $(obj).attr('data-type');
        var oldStatus = $(obj).attr('data-value');

        var fetchUrl = SITE_URL + '/admin/' + type + "_" + action;

        $.post(fetchUrl, {'id': id, 'action': action, 'data': oldStatus}, function (data) {
            if (data.result == 'Success') {
                var newStatus = data.response;

                if(newStatus == 'active'){
                    $(obj).removeClass().addClass('toggle-status btn btn-small btn-success');
                } else {
                    $(obj).removeClass().addClass('toggle-status btn btn-small btn-warning');
                }
                //remove all existing data and plot the new values
                $(obj).attr('data-value', newStatus);
                $(obj).text( UTILS.ucWords(newStatus) );

            } else {
                alert("Sorry, cannot change user status");
                return false;
            }
        }, 'json');

        return false;


    },

    /**
     * General method for deletion of all
     * the hotels / tariff / pages
     * @return {boolean}
     */
    'deleteAction': function () {

        var obj = $(this);
        var id = $(obj).attr('id');
        var action = $(obj).attr('data-action');
        var type = $(obj).attr('data-type');
        var title = $(obj).attr('data-title');

        var fetchUrl = SITE_URL + '/admin/'+ type + "_" + action;

        var rowId = type + "-" + id;

        var t = confirm("Sure!, you want to Delete " + type + ": " + title + "?");
        if (t == true) {
            $("#" + rowId).css({"background": '#FFEAEA'});

            $.post(fetchUrl, {id: id, 'title': title},
                function (data) {

                    var status = data.status;
                    var message = data.message;

                    if (status != 'error') {
                        //remove selected row from the dom
                        $("#" + rowId).animate({opacity: 1.0}, 500).fadeOut('slow');
                    } else {
                        $("#" + rowId).css({"background": 'none'});
                    }
                    UTILS.show_message(message, status);
                }, "json");
        } else {
            $("#" + rowId).css({"background": 'none'});
            return false;
        }
        return false;
    }
}

