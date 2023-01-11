
function reload()
{
    const xhr = new XMLHttpRequest();
    xhr.open('POST','captcha.php',true);

    xhr.onload = function(){

        img = document.getElementById("capt");
        img.src="captcha.php";
    }
    xhr.send();
}



$(document).ready(function(){

var htm='<p><img src="captcha.php" id="capt">&nbsp;<img width="30" height="30" type="image" src="reload.png" onClick="reload();"  ></p><p><input type="text" name="g-recaptcha-response"  > ';

$('#custom_captcha').html(htm);//set the captcha data in element having id > custom_captcha . you can change as your div/Element id

});