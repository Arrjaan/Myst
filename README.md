PROJECT MYST
=============

Projectomschrijving
-------
Een webapplicatie waarmee je een eigen website kan maken. Het zal een Content Managing System worden waar niet alleen hele simpele websites gemaakt kunnen worden, maar ook ingewikkelde websites door middel van add-ons. Daarnaast zal een sterke nadruk liggen op technieken als jQuery en AJAX voor een betere gebruikerservaring.

~~ Specifieke eisen ~~
- De gebruiker hoeft geen kennis te hebben van HTML of PHP om van de applicatie gebruik te kunnen maken.
- De gebruiker moet zelf pagina's kunnen toevoegen en verwijderen.
- De applicatie moet een standaard layout hebben, maar het moet ook mogelijk zijn zelf makkelijk een lay-out te kunnen toevoegen.
- De applicatie moet makkelijk kunnen worden aangevuld door add-ons die geschreven zijn in Javascript of PHP.
- Voor de installatie van de applicatie hoeft de gebruiker alleen maar te beschikken over MySQL en FTP-gegevens.
- De gebruiker moet makkelijk foto's, video's en films kunnen toevoegen aan zijn website.
- De pagina moet zo min mogelijk keren herladen worden.
- Alle onderdelen die niet noodzakelijk zijn voor het functioneren van de webapplicatie moeten worden ondergebracht in add-ons.


Woordenlijst
-------
Applicatie - Het hele systeem zoals wij die ontwikkelen. Alles bij elkaar dus.
Site - De website zoals gebruikers en de beheerder die te zien krijgen.
Gebruikers - Bezoekers van de website.
Beheerder - De persoon die de applicatie op zijn server geïnstalleerd heeft.
Add-on - Een uitbreidingspakket of extensie dat kan worden toegevoegd aan de applicatie. De beheerder kan zelf kiezen welke add-ons hij wel en niet installeert.

Git Handeleiding
=============

Voor je gaat werken
-------
- Start Git
- In console:
 cd Myst
 git pull origin master
 
Bestanden uploaden
-------
- In console:
 git stage "bestand1.php" "bestand2.php"
 git commit -m "Aanpassing die je hebt gedaan"
 git push origin master
 
Bestand toevoegen/verwijderen
-------
- In console:
 git add/rm "bestand.php"
 git commit -m "Bestand toegevoegd/verwijderd"
 git push origin master

Bestand terughalen
-------
- In console:
 git pull origin master
 git log --oneline
 > zoek de code van de commit die terug geplaatst moet worden (HEAD voor de laatste)
 > druk op "q"
 git revert "code"
 > waarschijnlijk krijg je een melding nu, druk twee keer op "q"
 git status
 > kijk goed welk(e) bestand(en) je terug wil zetten!
 git checkout -- "bestanden die niet terug gezet moeten worden"
 git checkout -- HEAD "bestanden die niet verwijderd moeten worden"
 > als je alleen de/het bedoelde bestand(en) over hebt mag je verder":
 git commit -m "reden"
 git push origin master