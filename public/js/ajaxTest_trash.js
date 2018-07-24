(function (window, document) {

    "use strict";

    window.addEventListener("load", function () {
        if (document.getElementById("portfolio-wrapper") != undefined) {
            var expandLink = document.getElementById("portfolio-wrapper");
            // var myForm = document.createElement("form");
            // myForm.action = "../app/models/GetAjaxContent.php"; // the href of the link
            // myForm.method = "POST";

            // expandLink.appendChild(myForm);

            expandLink.addEventListener("click", function (e) {
                // while (myForm.firstChild) {
                //     myForm.removeChild(myForm.firstChild);
                // }

                // var inputHidden = document.createElement('input');
                // inputHidden.setAttribute('type', 'hidden');
                // inputHidden.setAttribute('name', 'inputHidden');

                // var fileName = getFileNameFromPath(e);
                // inputHidden.setAttribute('value', fileName);
                // myForm.appendChild(inputHidden);

                // myForm.submit();
                getData(e);
            });
        } // ende if portfolio-wrapper != undefined

    }); // ende window.addEventListener ---------------------------------------

}(window, document));
        
function getData(e) {
    ajaxGetDb("GetAjaxContent.php", function (resp) {
        console.log(resp);
    });
} // ende function getData()