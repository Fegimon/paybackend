﻿function loadTxt() {
    document.getElementById("tab0").innerHTML = "FLICKR";
    document.getElementById("tab1").innerHTML = "MINE FILER";
    document.getElementById("tab2").innerHTML = "FORMAT";
    document.getElementById("lblTag").innerHTML = "SØGEORD:";
    document.getElementById("lblFlickrUserName").innerHTML = "Flickr brugernavn:";
    document.getElementById("lnkLoadMore").innerHTML = "Indlæs flere";
    document.getElementById("lblImgSrc").innerHTML = "BILLEDKILDE:";
    document.getElementById("lblWidthHeight").innerHTML = "BREDDE x HØJDE:";

    var optAlign = document.getElementsByName("optAlign");
    optAlign[0].text = ""
    optAlign[1].text = "Venstre"
    optAlign[2].text = "Højre"

    document.getElementById("lblTitle").innerHTML = "TITEL:";
    document.getElementById("lblAlign").innerHTML = "JUSTER:";
    document.getElementById("lblSpacing").innerHTML = "L-AFSTAND:";
    document.getElementById("lblSpacingH").innerHTML = "V-AFSATND:";
    document.getElementById("lblSize1").innerHTML = "LILLE FIRKANT";
    document.getElementById("lblSize2").innerHTML = "MINIATURE";
    document.getElementById("lblSize3").innerHTML = "LILLLE";
    document.getElementById("lblSize5").innerHTML = "MELLEM";
    document.getElementById("lblSize6").innerHTML = "STOR";

    document.getElementById("lblOpenLarger").innerHTML = "ÅBEN STØRRE UDGAVE I EN LIGHTBOX, ELLER";
    document.getElementById("lblLinkToUrl").innerHTML = "INDSÆT LINK:";
    document.getElementById("lblNewWindow").innerHTML = "ÅBEN I NYT VINDUE";
    document.getElementById("btnCancel").value = "annuller";
    document.getElementById("btnSearch").value = " Søg "; 
}
function writeTitle() {
    document.write("<title>" + "Billede" + "</title>")
}
function getTxt(s) {
    switch (s) {
        case "insert": return "indsæt";
        case "change": return "gem ændringer";
    }
}