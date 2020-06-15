function changeVisibility(docID) {
    fields = document.getElementById(docID) 
    if (fields.style.display == "block") {
        fields.style.display = "none";
        if (docID = "nbEnfants") {
        document.getElementById("nombreEnf").options[0].selected = 'selected';
        }
    } else {
        fields.style.display = "block";
    }
}


function updateCheckBoxOnload(docID,docIDShow) {
    fields = document.getElementById(docID);
    toShow = document.getElementById(docIDShow);
    if (fields.checked == true) {
        toShow.style.display = "block";
    }
}