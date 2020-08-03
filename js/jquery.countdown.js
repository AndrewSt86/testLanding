
function startTimer() {
    var my_timer = document.getElementById("my_timer");
    //var time = my_timer.innerHTML;
    //var arr = time.split(":");
    var h = $(".hour").html();
    var m = $(".min").html();
    var s = $(".sec").html();
    if (s == 0) {
        if (m == 0) {
            if (h == 0) {
                //alert("           ");

                $('.timer__item-title').hide();
                $('.timer__finish').show();
                return;
            }
            h--;
            m = 59;
            if (h < 10)
                h = "0" + h;
        }
        m--;
        if (m < 10)
            m = "0" + m;
        s = 59;
    }
    else
        s--;
    if (s < 10)
        s = "0" + s;
    $(".hour").html(h);
    $(".min").html(m);
    $(".sec").html(s);
    setTimeout(startTimer, 1000);
}
startTimer();
