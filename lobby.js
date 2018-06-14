window.onload = function () {

    var timer = window.setInterval(lobbyreload, 5000);

    function lobbyreload() {
        let req = new XMLHttpRequest();
        req.open("GET", "ajax.php?lr", true);
        req.addEventListener("load", function () {
            data = JSON.parse(req.response);
            document.getElementById("wtable").innerHTML = data.wtable;
            document.getElementById("werror").innerHTML = data.werror;
            document.getElementById("mtable").innerHTML = data.mtable;
            document.getElementById("merror").innerHTML = data.merror;
        });
        req.send(null);
    }

}