/**
 * Created with IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 08/09/13
 * Time: 2:48 PM
 * To change this template use File | Settings | File Templates.
 */

$(function(){

    //submit login form
    //$(document).on('submit','#loginForm',ADMIN.doLogin);

    $(document).on('click','#changeImage',UTILS.changeImage);

    //on click of toggle_status button/link
    $(document).on('click','.toggle-status',ADMIN.toggleStatus);

    //on click of delete link
    $(document).on('click','a.delete-link',ADMIN.deleteAction);

});