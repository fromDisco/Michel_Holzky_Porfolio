"use strict";

/**
 * [Erzeugt eine zufällige Ganzzahl von min bis max (inklusive)]
 * @param {number} min [Ganzzahl Untergrenze für Zufallszahl]
 * @param {number} max [Ganzzahl Obergrenze für Zufallszahl]
 * @return {number} Ganzzahl [min max]  -   min >= wert <= max
 */
function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
/* 
{number} rand({number} min, {number}max) 
*/

/**
 * 
 */
function randomRGB() {
    return "rgb(" + rand(0, 255) + "," + rand(0, 255) + "," + rand(0, 255) + ")"
}

function capitalize(s) {
    return s.charAt(0).toUpperCase() + s.slice(1);
}


/**
 * [Findet den ersten Index des Suchwerts in einem Array]
 * @param {array} array     [haystack - Array in dem gesucht werden soll]
 * @param {mixed} search    [needle - Was in den Arrayindizes gesucht werden soll]
 * @param {number} pos      [offset - Optionaler Parameter mit dem die Startposition                                   angegeben wird. Normalerweise beginnt die Suche auf 
                            Position 0 / Index 0]
 * @return {number}
 */
function myIndexOf(array, search, pos) {
    if (pos === undefined) {
        pos = 0;
    }
    for (var i = pos; i < array.length; i++) {
        if (array[i] === search) {
            return i;
        }
    }
    return -1;
}
/* 
{number} myIndexOf( {array} array,  {mixed} search, [{number} pos]) 
*/

function addHandler(el, ev, fn) {
    el.addEventListener(ev, fn);
}


function isChecked(a) {
    if (a.length !== undefined) {
        for (var i = 0; i < a.length; i++) {
            if (a[i].checked) {
                return true;
            }
        }
        return false;
    } else {
        return a.checked;
    }
}

function ajaxGet(file, fn) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", file, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            fn(xhr.responseText);
        }
    };
    xhr.send();
}


function ajaxGetXML(file, fn) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", file, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            fn(xhr.responseXML);
        }
    };
    xhr.send();
}


function ajaxGetDb(file, fn) {
    // var searchIndex = "searchIndex=" + searchName;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", file, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        console.log(xhr);
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr);
            fn(xhr.responseXML);
        } 
    }
    xhr.send();
}


function getFileNameFromPath(e) {
    // +++++++++++++++++++++++++++++++++++++++++++++++
    var filePath = e.target.nextElementSibling.src;
    var lastSlash = filePath.lastIndexOf('/') + 1;
    var fileName = filePath.slice(lastSlash);
    return fileName;
}




function createElement(tag, txt) {
    tag = document.createElement(tag);
    if (txt) {
        txt = document.createTextNode(txt);
        tag.appendChild(txt);
    }
    return tag;
}

function removeContent(el) {
    while (el.firstChild) {
        el.removeChild(el.firstChild);
    }
}