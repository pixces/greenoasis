/**
 * Created with IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 06/10/13
 * Time: 1:09 AM
 * To change this template use File | Settings | File Templates.
 */
$(function() {

    //submit login form
    //$(document).on('submit','#loginForm',ADMIN.doLogin);

    $(document).on('click', '#changeImage', UTILS.changeImage);

    //on click of toggle_status button/link
    $(document).on('click', '.toggle-status', ADMIN.toggleStatus);

    //on click of toggle_status button/link
    $(document).on('click', '.toggle-featured', ADMIN.toggleFeatured);

    //on click of delete link
    $(document).on('click', 'a.delete-link', ADMIN.deleteAction);

    $(document).on('click', 'ul.dropdown-menu > li > a', ADMIN.toggleBookingStatus);
    $(document).on('click', '.btn-funds', ADMIN.allocateFunds);
    $(document).on('click', '#fundUpdateBtn', ADMIN.updateFunds);
    $(document).on('submit', '#uploadform', ADMIN.uploadDocument);

    $('.modal').on('hide.bs.modal', function() {
        $('.modal').removeData();
    })



    //actions to get sef title
    $("#page_title").on('blur', ADMIN.createSEF);
    $("#package_title").on('blur', ADMIN.createSEF);

    //remove image from form
    $('a.form-change-image').on('click', function() {
        //change the padding
        $(this).css("padding-bottom", "0px");

        //hide this box
        $(this).hide('slow', function() {
            $('div.form-image-upload').show('slow');
        })
    });
});


var ADMIN = {
    'doLogin': function() {

        var error = '';
        var username = $("#username").val();
        var password = $("#password").val();
    },
    'getSeasons': function() {

        var $obj = $(".seasonList");
        var action = $obj.attr('data-action');
        var hotelId = $obj.attr('data-value');

        var htmlText = $obj.html();
        var fetchUrl = SITE_URL + '/admin/get_season_list/' + hotelId;

        $(".seasonList").load(fetchUrl);

    },
    /* general method to change status
     * Can be used on all places like
     * @page, @products, @category, @users
     */
    'toggleStatus': function() {
        var obj = $(this);
        var id = $(obj).attr('id');
        var action = $(obj).attr('data-action');
        var type = $(obj).attr('data-type');
        var oldStatus = $(obj).attr('data-value');

        var fetchUrl = SITE_URL + '/admin/' + type + "_" + action;

        $.post(fetchUrl, {'id': id, 'action': action, 'data': oldStatus}, function(data) {
            if (data.result == 'Success') {
                var newStatus = data.response;

                if (newStatus == 'active' || newStatus == 'approved') {
                    $(obj).removeClass().addClass('toggle-status btn btn-small btn-success');
                } else {
                    $(obj).removeClass().addClass('toggle-status btn btn-small btn-warning');
                }
                //remove all existing data and plot the new values
                $(obj).attr('data-value', newStatus);
                $(obj).text(UTILS.ucWords(newStatus));

            } else {
                alert("Sorry, cannot change user status");
                return false;
            }
        }, 'json');

        return false;
    },
    /* general method to change featured
     * Can be used on all places like
     * @page, @products, @category, @users
     */
    'toggleFeatured': function() {

        var obj = $(this);
        var id = $(obj).attr('id');
        var action = $(obj).attr('data-action');
        var type = $(obj).attr('data-type');
        var oldState = $(obj).attr('data-value');

        var fetchUrl = SITE_URL + '/admin/' + type + "_" + action;

        $.post(fetchUrl, {'id': id, 'action': action, 'data': oldState}, function(data) {
            if (data.result == 'Success') {
                var newState = data.response;

                $(obj).toggleClass('btn-inverse');

                if (newState === 1) {
                    $(obj).html('<i class="icon-thumbs-up icon-white"></i>');
                } else {
                    $(obj).html('<i class="icon-thumbs-down"></i>');
                }
                //remove all existing data and plot the new values
                $(obj).attr('data-value', newState);

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
    'deleteAction': function() {

        var obj = $(this);
        var id = $(obj).attr('id');
        var action = $(obj).attr('data-action');
        var type = $(obj).attr('data-type');
        var title = $(obj).attr('data-title');

        var fetchUrl = SITE_URL + '/admin/' + type + "_" + action;
        var rowId = type + "-" + id;
        var t = confirm("Sure!, you want to Delete " + type + ": " + title + "?");
        if (t == true) {
            $("#" + rowId).css({"background": '#FFEAEA'});

            $.post(fetchUrl, {id: id, 'title': title},
            function(data) {

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
    },
    /** create SEF function */
    'createSEF': function() {
        var str = $(this).val();
        var fetchUrl = SITE_URL + '/admin/createSEF/';

        $.post(fetchUrl, {'str': str},
        function(data) {
            $('.formTitleSlug').val(data);
            //$('#title_slug').val(data);
        });
        return false;
    },
    'toggleBookingStatus': function() {
        var reservation_id = $(this).attr("data-booking-id");
        var booking_action = $(this).attr("data-booking-action");
        var action = '';
        var booking_price = 0;
        var params = '';
        if (booking_action === "approve") {
            booking_price = $(this).attr("data-booking-price");
            action = 'approve';
            params = "action=" + action + "&reservation_id=" + reservation_id + '&price=' + booking_price;

        } else {
            booking_price = 0;
            action = 'reject';
            params = "action=" + action + "&reservation_id=" + reservation_id + '&price=' + booking_price;
        }

        $.ajax({
            type: "POST",
            data: params,
            url: SITE_URL + '/admin/toogleBookingStatus/',
            cache: false,
            dataType: 'json',
            success: function(data) {
                alert(data.message);
                location.reload();
            }
        });

        return;
    },
    'allocateFunds': function() {
        var agent_id = $(this).attr('id');
        var agent_name = $(this).data('name');
        var CONTENT = "<div class='fund-div'>" +
                        "<label>Enter Amount:</label>" +
                        "<input type='hidden' name='agentid' id='agent_id' value='" + agent_id + "'/>" +
                        "<input type='text' name='fundAmt' id='fundAmt' value=''/><br/><br/>" +
                        "<input class='btn btn-primary' type='button' id='fundUpdateBtn' name='Add' value='Add Funds' />" +
                       "</div>";
        $("#divAgentModel #myModalLabel").html("Add Funds to " + agent_name);
        $("#divAgentModel .modal-body").html(CONTENT);
    },

    'updateFunds': function() {

        if ($(".error").length > 0) {
            $('.error').empty();
        }
        if ($("#fundAmt").val() === '') {
            $(".fund-div").prepend("<div class='error' style='color:red'><span>*</span>Please Enter Amount.</div>");
            return false;
        } else if ($("#fundAmt").val() <= 0) {
            $(".fund-div").prepend("<div class='error' style='color:red'><span>*</span>Amount Must Be Greater Than Zero(0)..</div>");
            return false;
        } else {
            var agent_id = $('.fund-div').find('input[name="agentid"]').val();
            var fund_amount = $('.fund-div').find('input[name="fundAmt"]').val();
            $.ajax({
                type: "POST",
                data: {agentid: agent_id, fundamt: fund_amount},
                url: SITE_URL + '/admin/allocateFund/',
                cache: false,
                dataType: 'json',
                success: function(data) {
                    var agent_totAmt = $("#agent-" + agent_id + " .total .count").data('count');
                    if (data.result === "Success") {
                        agent_totAmt = parseFloat(fund_amount) + parseFloat(agent_totAmt);
                        $("#agent-" + agent_id).data('count', agent_totAmt);
                        $("#agent-" + agent_id + " .total .count").html(ADMIN.formatCurrency(agent_totAmt));
                        $('.fund-div').empty().html(data.message);
                    } else {
                        $('.fund-div').empty().html(data.message);
                    }
                }
            });
        }
    },
    'formatCurrency': function(num) {
        return "$" + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },
    'viewVisaDetails': function() {
        var application_id = $(this).data('application-id');
        $.ajax({
            type: "POST",
            data: {application_id: application_id},
            url: SITE_URL + '/admin/loadVisaApplication/',
            cache: false,
            dataType: 'html',
            success: function(data) {
                console.log(data);
            }
        });
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
}