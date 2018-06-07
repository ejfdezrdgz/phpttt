window.onload = function () {

    var timer = this.setInterval(ajaxreload(), 5000);

};

function ajaxreload() {
    let req = new XMLHttpRequest();
    let id = document.getElementById("mIdSpan").innerText;
    req.open("GET", `ajax.php?id=${id}`, true);
    req.addEventListener("load", function () {
        document.getElementById("playerB").innerHTML = req.responseText;
        if (req.responseText != "") {
            timer.clearInterval();
        };
    });
    req.send(null);
};