/**
 * User: aabid048@gmail.com
 * Date: 2011-10-02
 * Time: 2:40 PM
 * File: Custom Javascript File
 */

$(function() {

    $('#cancel-button').live('click', function(){
        $('#close-form').trigger('click');
    });

});