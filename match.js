window.onload = function () {

    var turn = null;
    var result = 0;
    var reltabletimer;
    var cells = document.getElementsByClassName("cell");
    var id = document.getElementById("mIdSpan").innerText;
    var namegettimer = window.setInterval(nameget, 1000);

    for (const cell of cells) {
        cell.onclick = function () {
            activecell(this.id);
        }
    }

    function nameget() {
        let req = new XMLHttpRequest();
        req.open("GET", `ajax.php?id=${id}`, true);
        req.addEventListener("load", function () {
            document.getElementById("playerB").innerHTML = req.responseText;
            if (req.responseText != "") {
                clearInterval(namegettimer);
                reltabletimer = window.setInterval(reloadtable, 1000);
            };
        });
        req.send(null);
    };

    function activecell(cellid) {
        if (turn == player && result == 0) {
            let req = new XMLHttpRequest();
            req.open("GET", `ajax.php?matchid=${id}&cellid=${cellid}`, true);
            req.addEventListener("load", function () {
                console.log(req.response);
            });
            req.send(null);
        } else {
            console.log("Not your turn");
        }
    };

    function reloadtable() {
        let req = new XMLHttpRequest();
        req.open("GET", `ajax.php?rid=${id}`, true);
        req.addEventListener("load", function () {
            data = JSON.parse(req.response);
            turn = data.turn;
            if (data.user == data.playerA) {
                player = 1;
            } else {
                player = 2;
            }
            drawtable(data);
            if (turn == 1) {
                document.getElementById("playerA").setAttribute("class", "player playerAOn");
                document.getElementById("playerB").setAttribute("class", "player playerBOff");
            } else {
                document.getElementById("playerA").setAttribute("class", "player playerAOff");
                document.getElementById("playerB").setAttribute("class", "player playerBOn");
            }
            result = wincheck(data.cells);
            if (result != 0) {
                clearInterval(reltabletimer);
                updatematchdb(result, id);
                if (result == -1) {
                    alert("Draw");
                } else {
                    alert(result + " has won");
                }
            }
            console.log(result);
        });
        req.send(null);
    };

    function drawtable(obj) {
        array = obj.cells;
        wincheck(array);
        let cells = document.getElementsByClassName("cell");
        for (const element in cells) {
            if (obj.playerA == array[element]) {
                cells[element].className = "cell fas fa-times";
            }
            if (obj.playerA != array[element] && array[element] != 0) {
                cells[element].className = "cell far fa-circle";
            }
        }
    };

    function updatematchdb(result, matchid) {
        let req = new XMLHttpRequest();
        let query = `ajax.php?result=${result}&matchid=${matchid}`;
        req.open("GET", query, true);
        req.addEventListener("load", function () {
            console.log(req.response);
        });
        req.send(null);
    };

    function wincheck(a) {
        function sc(a, b, c) { if (a == b && b == c) { return true; } };

        let r = 0;
        if (sc(a[0], a[1], a[2]) ||
            sc(a[0], a[3], a[6]) ||
            sc(a[0], a[4], a[8])) {
            return r = a[0];
        }
        if (sc(a[3], a[4], a[5]) ||
            sc(a[1], a[4], a[7]) ||
            sc(a[2], a[4], a[6])) {
            return r = a[4];
        }
        if (sc(a[6], a[7], a[8]) ||
            sc(a[2], a[5], a[8])) {
            return r = a[8];
        }
        for (const c of a) { if (c == 0) return r = 0; }
        return r = -1;
    };

};