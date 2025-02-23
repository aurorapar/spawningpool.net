
$(document).ready(function () {
    $(".header_link").click(function (event) {
        let input = event.target.text;
        if (input.length !== 0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    $('.main_body').html(this.responseText);
                };
            };
            xmlhttp.open("GET", "requests/update_body.php?body_requested=" + input, true);
            xmlhttp.send();
        }
    });
});