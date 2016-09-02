<dialog id="dialog">
    <!--Dialog Bereich. Wird angezeigt bei Klick auf "+neuer plan" in der Navigationsleiste-->
    <h2>Neuen Plan erstellen</h2>
    <form id="form_neuer_plan_dialog" action="form_eval_neuer_plan_dialog.php" method="get"> <!--Formular zum Erstellen eines neuen Planes -->
        <label for="titel">Titel</label>                                                     <!--Label für Titel-->
        <br />
        <input type="text" id="titel" name="titel" />                                        <!--Input Titel(optional)-->
        <br />
        <label for="datum">Datum</label>                                                     <!--Label für Datum -->
        <br />
        <input type="date" id="datum" name="datum" required="required" />                    <!--Input Datum -->
        <br />
        <?php include "freischalten_markieren_freunde.html" ?>                               <!-- Bereich: Freischalten für Freunde/Markieren von Freunden-->
        <br>
        <button type="submit" id="Erstelle">Erstelle</button>                                <!--Button schickt Formular ab und schließt modalen Dialog -->
        <button type="button" id="Zurueck">Zurueck</button>                                  <!--Button schließt modalen Dialog-->
    </form>
</dialog>
