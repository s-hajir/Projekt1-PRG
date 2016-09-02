<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ProjektA</title>
    <link rel="stylesheet" href="jquery-ui.css" />
    <link rel="stylesheet" href="jquery-ui.theme.css" />
    <link rel="stylesheet" href="style.css"/>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="Chart.min.js"></script>
</head>
<body>
    <header>
        <?php include "navigationsleiste.php";?>
    </header>
    <main>
        <?php include "neuer_plan_dialog.php";?>

        <section id="uebersicht">                                                       <!--Container für Tabelle und Tabellen-Navigation-->
            <header>                                                                    <!--Übersicht Kopfbereich-->
                <h1>Übersicht der Pläne</h1>                                            <!--Überschrift-->
            </header>
            <section class="month_nav">                                                 <!--Container für Tabellen-Navigation: Es geht monatsweise 'vor' und 'zurück'-->
                <ul>                                                                    <!--Liste der Navigations-Elemente-->
                    <li class="prev">&#10094;</li>                                      <!--'Zurück'-Element navigiert 1 Monat zurück -> Anzeige für Monat wird dynamisch verändert-> neue Tabellenzellen werden geladen und dargestellt-->
                    <li class="next">&#10095;</li>                                      <!--'Vor'-Element navigiert 1 Monat vor-->
                    <li class="month_year">August<br />2016</li>                        <!--Montag und Jahr-->
                </ul>
            </section>
            <table>                                                                     <!--Bereich für die Tabelle. Tabelle enthält Zeilen, die wiederum Zellen enthalten-->
                <tbody>                                                                 <!--Tabellenkörper-->
                    <tr>                                                                <!--Bereich für Tabellenzeile. Tabellenzeilen werden später dynamisch erzeugt & mit Zellen befüllt-->
                        <td>                                                            <!--Bereich für Tabellenzelle. Zellen werden später dynamisch erzeugt & mit DB-Daten befüllt. eine Zelle entspricht einem Tagesplan im Monat-->
                            <form action="tagesplan.php" method="get">                  <!--Formular umhüllt Zellendaten, ruft beim absenden tagesplan.php auf-->
                                <h3>Titel des Planes</h3>                               <!--Titel-->
                                <time>22.08.16</time>                                   <!--Datum des Planes-->
                                <br />
                                <label>                                                 <!--Gibt Anzahl der im Plan enthaltenen Tasks an-->
                                    Plan enthält
                                    <strong>7 </strong>Tasks
                                </label>
                                <input type="submit" value="zum plan" />                <!--Formular Submit-->
                                <input type="hidden" name="plan_id" value="13" />       <!--Beinhaltet die Id dieses Planes.Feld ist unsichtbar. Id wird an tagesplan.php gesendet-->
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section><br />
        <section id="diagramm">                                         <!--Container für Diagramm-->
                <canvas id="nutzer_statistik" height="250"></canvas>    <!--Fläche, auf der das Diagramm gezeichnet wird--> 
        </section>
    </main><br />
    <footer>&copy; Copyright 2016 Hajir</footer>
    <script>
//***********************************JS Code auslagern*****************************************
//Diagramm(nutzer_statistik) Achtung: das ist nur ein Dummy-Diagramm. Der tatsächliche Diagramm wird noch entwickelt.
        var ctx = document.getElementById("nutzer_statistik").getContext("2d");
        Chart.defaults.global.maintainAspectRatio = false;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 6, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
<script>
//gebe autocomplete input-Felder & bild-Containern eine unique ID
            var tagsArray = document.getElementsByClassName("tags");
            for (var i = 0; i < tagsArray.length; i++) {
                tagsArray[i].setAttribute("id","tags"+i);
            }
            var img_conteinerArray = document.getElementsByClassName("img_container");
            for (var i = 0; i < img_conteinerArray.length; i++) {
                img_conteinerArray[i].setAttribute("id", "img_container" + i);
            }
    </script>
 <script>
 //Dialog(neuer Plan) öffnen/schliessen
         var startbutton = document.getElementById("Neuer-Plan"),
         dialog = document.getElementById("dialog"),
         erstellebutton = document.getElementById("Erstelle"),
         zurueckbutton = document.getElementById("Zurueck");
         startbutton.addEventListener('click', zeigeFenster);
         erstellebutton .addEventListener('click', schliesseFenster2);
         zurueckbutton .addEventListener('click', schliesseFenster);
         function zeigeFenster() {
          dialog.showModal();
         }
         function schliesseFenster() {
             dialog.close();
             document.getElementById("form_neuer_plan_dialog").reset();
             var img_container = document.getElementById("img_container0")
             while (img_container.firstChild) {
             img_container.removeChild(img_container.firstChild);
          }
          }
         function schliesseFenster2() {
                                                                      //Verbesserung: AJAX -> Server macht DB Eintrag -> JSON String zurück "Erfolgreich"/"Fehlgeschlagen"
             dialog.close();
         }
//Autocomplete
        function showHint(e,objref) {
            var xhttp;
            var str = objref.value;
            if (str.length == 0) {
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var serverResponse = xhttp.responseText;
                        //server schickt JSON-String zurück
      					console.log("Server raw JSON:"+serverResponse);
      					console.log("Typeof response: "+typeof serverResponse);
                        //liefert Array von JS-Objekten. jedes Objekt entspricht einer Zeile in der DB-Tabelle
      					var jsObjArray = JSON.parse(serverResponse);  
                        //iteriere über jedes Objekt im Array -> fülle Wert vom name-Attribut in nameArray UND Wert vom imgUrl-Attribut in imgUrlArray
      					console.log(jsObjArray);
      					var nameArray = new Array();
      					var imgUrlProfilArray = new Array();
      					var username ="";
      					console.log("Die name/imgArrays: ");
      					for (var i = 0; i < jsObjArray.length; i++) {
      					    username = jsObjArray[i].username;
      					    nameArray[i] = jsObjArray[i].name.concat("("+username+")");
      					    imgUrlProfilArray[i] = jsObjArray[i].imgUrlProfil;
      					    console.log(nameArray[i] + " und " + imgUrlProfilArray[i]);
      					}
      					console.log("JS Objekt: ");
      					console.log(jsObjArray);
      					$( function() {
      						function split( val ) {
      						  return val.split( /,\s*/ );
      						}
      						function extractLast( term ) {
      						  return split( term ).pop();
      						}
      						$( ".tags" )
      						  // don't navigate away from the field on tab when selecting an item
      						  .on("keydown", function (event) {
      							if ( event.keyCode ===$.ui.keyCode.TAB &&
      								$( this ).autocomplete( "instance" ).menu.active ) {
      							  event.preventDefault();
      							}
      						  })
      						  .autocomplete({
      							minLength: 0,
      							source: function( request, response ) {
      							  response( $.ui.autocomplete.filter(
      								nameArray, extractLast(request.term)));
      							},
      							focus: function() {
      							  return false;
      							},
      							select: function( event, ui ) {
      							  var terms = split( this.value );
      							  terms.pop();
      							  terms.push( ui.item.value );
      							  terms.push( "" );
      							  this.value = terms.join(", ");
      							  var imgName = ui.item.value.replace(/\s/g, "_").concat("_profil.jpg");  
      							  var src = "";
      							  for (var i = 0; i < imgUrlProfilArray.length; i++) {
      							      var imgUrl = imgUrlProfilArray[i];
      							      if (imgUrl.includes(imgName)) {                                   
      							          src = imgUrl;
      							      }
      							  }
      							  var child = document.createElement('img');
      							  child.setAttribute('class','profilImg');
      							  child.setAttribute('src', '' + src + '');
      							  child.setAttribute('height', '70px');
      							  child.setAttribute('width', '80px');
      							  e.target.nextElementSibling.appendChild(child);
      							  return false;
      							}
      						  });
      					  } );
                }
            };
  			//String splitten -> String Array -> letztes Element zum Server schicken
  			var str2 = str;
  			var strArray;
  			if(str.includes(",")){                    
  				strArray = str.split(" ");              //split beim " "-Leerzeichen, dann Array bilden. Leerzeichen werden entfernt Bsp: "Peru, Belgien, Ungarn" ->["Peru,", "Belgien,", "Ungarn"]
  				str2 = strArray[strArray.length - 1];   //letztes Element des Arrays
  			}
  			console.log("Dein Input: "+str2);
  			xhttp.open("GET", "form_eval_freischalten_markieren_freunde.php?keyword=" + str2, true);
        xhttp.send();
          }
</script>
</body>
</html>