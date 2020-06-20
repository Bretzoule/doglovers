  // Merci Stack OverFlow https://stackoverflow.com/questions/6320113/how-to-prevent-form-resubmission-when-page-is-refreshed-f5-ctrlr 
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  function deleteMsg(msgId,convID) {
    if (confirm('Voulez-vous vraiment supprimer ce message ?')) {
      if (msgId.length == 0) {
        return;
      }
      var xmlhttp = new XMLHttpRequest(); // création de la requete
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { // si la page est prete
          alert("Message supprimé");
          window.history.replaceState(null, null, window.location.href);
        }
      }
      xmlhttp.open("GET", "./supprimerMessage.php?msgID=" + msgId + "&convID=" + convID, true); // on ouvre la requete
      xmlhttp.send();
    }
  }

  function deleteMsg(msgId,convID) {
    if (confirm('Voulez-vous vraiment signaler ce message ?')) {
      raison = prompt("Merci de rentrer la raison de votre signalement :");
      if (raison.length == 0) {
        return;
      }
      var xmlhttp = new XMLHttpRequest(); // création de la requete
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { // si la page est prete
          alert("Message supprimé");
          window.history.replaceState(null, null, window.location.href);
        }
      }
      xmlhttp.open("GET", "./reportMessage.php?msgID=" + msgId + "&convID=" + convID+"&raison="+raison, true); // on ouvre la requete
      xmlhttp.send();
    }
  }