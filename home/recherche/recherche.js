$(document).ready(function () {
  $('#searchBar').keydown(function(event) {
      if (event.keyCode == 13) {
        this.form.submit();
        return false;
      }
    });
});

function changeVisibility(docID) {
  fields = document.getElementById(docID)
  if (fields.style.visibility == "visible") {
      fields.style.visibility= "hidden";

  } else if (document.getElementById('resultats').innerHTML != '') {
      fields.style.visibility = "visible";
  }
}
