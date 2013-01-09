/*
* Copyright Flowartz 2011
* Author: Ryan Priebe
* Version: 1.0.0
* Created on: September 27, 2011
* Last Modified: September 28, 2011
*/

/* Flowartz Javascript Core */

$(document).ready(function(){

    // Welcome page newsletter signup onclick functionality
    var originalvalue = $('#user_email').val();

    $('#user_email').focus(function(){
        if($(this).val() == originalvalue){
            $(this).val('');
        }
    });


    $('#user_email').blur(function(){
        if($(this).val() == ''){
            $(this).val(originalvalue);
        }
    });


    // Quick and dirty client side validation to spiff up the email form
    $('#email_list').find('input[type=submit]').click(function(){
        if($('#user_email').val() == originalvalue){
            $('#user_email').css('border-color', 'red');
            return false;
        }
    });



});


function processURL(url, container, videoTitle, noimageURL){
    var id;

    if (url.indexOf('youtube.com') > -1) {
        id = url.split('v=')[1].split('&')[0];
        return processYouTube(id);
    } else if (url.indexOf('youtu.be') > -1) {
        id = url.split('/')[1];
        return processYouTube(id);
    } else if (url.indexOf('vimeo.com') > -1) {
        if (url.match(/http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/)) {
            url = url.replace('http://', '');
            id = url.split('/')[1];
        } else if (url.match(/^vimeo.com\/channels\/[\d\w]+#[0-9]+/)) {
            id = url.split('#')[1];
        } else if (url.match(/vimeo.com\/groups\/[\d\w]+\/videos\/[0-9]+/)) {
            id = url.split('/')[4];
        } else {
            throw new Error('Unsupported Vimeo URL');
        }

        $.ajax({
            url: 'http://vimeo.com/api/v2/video/' + id + '.json',
            dataType: 'jsonp',
            success: function(data) {
                console.log(data);
                $('#'+container).html($("<img>", {
                    src: data[0].thumbnail_small,
                    title: videoTitle,
                    alt: videoTitle,
                    width: 70
                }));
            }
        });
    } else {
        $('#'+container).html($("<img>", {
            src: noimageURL,
            title: videoTitle,
            alt: videoTitle,
            width: 70
        }));
    }

    function processYouTube(id) {
        if (!id) {
            throw new Error('Unsupported YouTube URL');
        }

        //$('#video_div').html($("<img>", { src: 'http://i2.ytimg.com/vi/' + id + '/hqdefault.jpg' }));
        $('#'+container).html($("<img>", {
            src: 'http://img.youtube.com/vi/' + id + '/1.jpg',
            title: videoTitle,
            alt: videoTitle,
            width: 70
        }));
    }
}