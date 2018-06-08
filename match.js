window.onload = function () {

    var cells = document.getElementsByClassName("cell");
    var id = document.getElementById("mIdSpan").innerText;
    var namegettimer = this.setInterval(function () { nameget(); }, 1000);
    var reltabletimer = this.setInterval(function () { reloadtable(); }, 5000);

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
            };
        });
        req.send(null);
    };

    function activecell(cellid) {
        let req = new XMLHttpRequest();
        req.open("GET", `ajax.php?matchid=${id}&cellid=${cellid}`, true);
        req.addEventListener("load", function () {
            console.log(req.response);
        });
        req.send(null);
    };

    function reloadtable() {
        let req = new XMLHttpRequest();
        req.open("GET", `ajax.php?rid=${id}`, true);
        req.addEventListener("load", function () {
            console.log(req.response);
            drawtable(JSON.parse(req.response));
        });
        req.send(null);
    };

    function drawtable(array) {
        console.log(array);
        let cells = document.getElementsByClassName("cell");
        for (const cell in cells) {
            if (array[cell] == playerA) {
                cells[cell].setAttribute("class", "cellX");
            }
            if (array[cell] != playerA && array[cell] != 0) {
                cells[cell].setAttribute("class", "cell0");
            }
        }
    };
};