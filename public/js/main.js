(function (window, document) {

    "use strict";

    window.addEventListener('load', function () {
        var url = window.location.href.split("/");
        var location = url[url.length - 1];

        // js nur für die Startseite
        // uhr auf Startseite +++++++++++++++++++++++++++++++++++++++++++++++++
        if (location == '') {
            var clockContainter = document.getElementById('clock');
            var clock = setInterval(append, 1000);
            // damit die Uhrzeit direkt zu anfang und nicht erst nach einer Sekunde angezeigt wird
            clockContainter.textContent = timer();

            function append() {
                clockContainter.textContent = timer();
            }

            // datum
            var dateContainer = document.getElementById('date');
            dateContainer.textContent = date();
        } // ende Uhr ---------------------------------------------------------

        // Portfolio ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if (location == 'portfolio') {
            var portfolio = document.getElementById('inner-wrap');
            portfolio.addEventListener('mouseover', expand);
            portfolio.addEventListener('mouseout', shrink);
        }
        // ende Portfolio -----------------------------------------------------

        // var intGrow = setInterval(function grow() {
        //     if (i >= imgHeight) {
        //         clearInterval(intGrow);
        //         imgContainer.style.height = imgHeight;
        //         description.style.height = 'auto';
    
        //     } else {
        //         imgContainer.style.height = i + 'px';
        //         i += 6;
        //     }
        // }, 1);


        // Img-Slider auf Seite About +++++++++++++++++++++++++++++++++++++++++
        if (location == 'about') {
            var slide = setInterval(function change() {
                ajaxGet("../data/img.json", function (resp) {
                    var bildDaten = JSON.parse(resp);
                    changePic(bildDaten);
                });
            }, 2500);

            // Erzeugt Zufallszahl aus der Anzahl der Arrays/Bilder
            function randomPic(resp) {
                return Math.floor(Math.random() * resp.length);
            }

            // ändert die Attribute anhand der in randomPic ermittelten Arrays: Array[zufall]
            var pic = document.getElementById("bg");

            function changePic(resp) {
                var zufall = randomPic(resp);
                var quelle = "../img/portfolio/" + resp[zufall];
                pic.src = quelle;

                var altAtt = resp[zufall];
                pic.alt = altAtt;

                var titleAtt = altAtt;
                pic.title = titleAtt;
            }
        } // if (location == 'about')
        // ende Img-Slider ----------------------------------------------------
    });
    // ende window.addEventListener -------------------------------------------

}(window, document));
// ende Window-object +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// FUNKTIONEN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Datum erstellen ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function date() {
    var monthArray = [
        'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
    ];
    var weekdayArray = [
        'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'
    ]

    var dateYMD = new Date;
    var day = dateYMD.getDate();
    var weekdayNumber = dateYMD.getDay();
    var weekday = weekdayArray[weekdayNumber];
    var monthNumber = dateYMD.getMonth();
    var month = monthArray[monthNumber];
    var year = dateYMD.getFullYear();

    return weekday + ' der ' + day + '. ' + month + ', ' + year;
}
// ende Datum erstellen -------------------------------------------------------



// Uhrzeit anzeigen +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function timer() {
    var date = new Date();
    return digits(date.getHours()) + ':' + digits(date.getMinutes()) + ":" + digits(date.getSeconds());
}

function digits(str, count, sign) {
    str = String(str);
    if (sign === undefined) { // !sign
        sign = '0';
    }
    if (count === undefined) { // !count
        count = 2;
    }
    while (str.length < count) {
        str = sign + str;
    }
    return str;
}
// ende Uhrzeit anzeigen ------------------------------------------------------


// Portfolio expand +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function expand(e) {
    // aktuelle Containergröße und tatsächliche Bildgröße auslesen
    var imgContainer = e.target.parentElement.firstElementChild;
    var img = e.target.parentElement.firstElementChild.firstElementChild;
    imgContainerHeight = imgContainer.offsetHeight;
    imgHeight = img.offsetHeight;
    var i = imgContainerHeight;

    // Textfeldgröße ändern
    var description = e.target.previousElementSibling;

    // // zu Bookmark-Link springen
    // var link = e.target.getAttribute('id');
    // window.location = '#' + link;

    // Containergröße an Bildgröße anpassen
    var intGrow = setInterval(function grow() {
        if (i >= imgHeight) {
            clearInterval(intGrow);
            imgContainer.style.height = imgHeight;
            description.style.height = 'auto';

        } else {
            imgContainer.style.height = i + 'px';
            i += 6;
        }
    }, 1);
}
// ende Porfolio expand -------------------------------------------------------

// Portfolio shrink +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function shrink(e) {
    var imgContainer = e.target.parentElement.firstElementChild;
    imgContainerHeight = imgContainer.offsetHeight;
    var i = imgContainerHeight;

    // Textfeldgröße ändern
    var description = e.target.previousElementSibling;

    // Containergröße an Bildgröße anpassen
    var intDecrease = setInterval(function decrease() {
        if (i <= 160) {
            clearInterval(intDecrease);
            imgContainer.style.height = '160px';
            description.style.height = '0';

        } else {
            imgContainer.style.height = i + 'px';
            i -= 8;
        }
    }, 1);
}
// ende Porfolio shrink -------------------------------------------------------