<!-- | HELP show access -->
<h2>Berechtigungen</h2>
<p>
	Hier siehst du eine Liste mit allen Berechtigungen, die du
	besitzt.<br/>
	Die Berechtigungen sind nach ihren Modulen aufgeteilt.
</p>
<p>
	Falls du das Recht hast, die Berechtigungen aller Mitglieder
	einzusehen, wird dir hier eine Auswahlfeld für Benutzer und
	Gruppen angezeigt, über welches du auswählen kannst, für welchen
	Nutzer bzw. für welche Gruppe, du die Berechtigungen einsehen
	willst.
</p>
<p>
	Für jede Berechtigung werden die folgenden Sachen angezeigt.
</p>
<dl>
	<dt>Name</dt>
	<dd>Die Bezeichnung für die Berechtigung</dd>
	<dt>Zugriff?</dt>
	<dd>Besitzt du dieses Recht bzw. wurde dieses Recht explizit für
		dich gesetzt? Dies überschreibt die Gruppenrechte.</dd>
	<dt>Standard durch Gruppen</dt>
	<dd>
		Jeder Benutzer befindet sich in einer oder sogar
		mehreren Berechtigungsgruppen. Diese helfen dem
		Administrator der Seite, die Rechte für mehrere
		Nutzer gleichzeitig zu verwalten.<br/>
		Falls der Nutzer durch mindestens eine dieser Gruppen
		das entsprechende Recht erbt, wird dies hier mit "Ja"
		dargestellt.<br/>
		Falls nichts anderes für den Benutzer explizit
		festgelegt ist, dann wird diese Berechtigung genommen.
	</dd>
	<dt>Beschreibung</dt>
	<dd>Eine kurze Beschreibung für die Berechtigung.</dd>
</p>
<h2>Das Berechtigungssystem</h2>
<p>
	Für bestimmte Aktionen sind bei TSunic bestimmte Recht erforderlich.
	Fehlt dem Nutzer dieses Recht, kann er bestimmte Aktionen nicht
	ausführen.<br/>
	Die Berechtigungen werden in der Regel vom Administrator vergeben, können
	aber auch von anderen Nutzern vergeben werden, sofern sie vom
	Administrator dazu berechtigt wurden.<br/>
	Berechtigungen können sowohl einzelnen Benutzern, als auch
	ganzen Benutzergruppen (siehe Berechtigungsgruppen) gegeben bzw.
	verweigert werden.
</p>
<h3>Der Benutzer "root"</h3>
<p>
	Dem Benutzer "root" kommt eine Spezialrolle bei TSunic zu.
	Ähnlich wie bei UNIX-Betriebssystemen, ist root eine Art
	Super-Administrator, der immer alle Rechte hat. Diese
	Rechte können auch nicht eingeschränkt werden.<br/>
	Zudem kann dieser Nutzer nicht gelöscht werden. Bei der Installation
	von TSunic muss dem root-Nutzer ein Passwort gegeben werden.
	Bevor dies nicht geschehen ist, können sich keine weiteren
	Nutzer registrieren.
</p>
<h3>Der Benutzer "guest"</h3>
<p>
	Der Benutzer "guest" steht für alle unregistrierten Nutzer.
	Solange bis sich ein Nutzer eingeloggt hat, ist er als "guest"
	unterwegs.
</p>
<h3>Berechtigungsgruppen</h3>
<p>
	Damit nicht für jeden Nutzer einzeln Berechtigungen vergeben werden
	müssen, gibt es sog. Berechtigungsgruppen. Jeder Nutzer ist mindestens
	Mitglied der Berechtigungsgruppe "all", kann vom Administrator aber auch
	in weitere Gruppen aufgenommen werden.
</p>
<p>
	Berechtigungsgruppen sind hierarchisch aufgebaut, d.h., jede neue Berechtigungsgruppe
	ist unterhalb einer bereits bestehenden Gruppe (am Anfang ist dies "all").
	Eine Kindgruppe erbt alle Berechtigungen und Verbote seiner Elterngruppe.
	Ist eine Berechtigung für eine Gruppe explizit festgelegt, so gilt dieser gesetzte Wert.
	Genauso ist es bei Nutzern: Wenn einem Benutzer explizit ein Recht
	gegeben oder verweigert ist, gilt dies unabhängig davon, welche
	Rechte er durch seine Gruppenzugehörigkeiten besitzt.
</p>
<h4>Berechtigungsgruppe "all"</h4>
<p>
	Die Berechtigungsgruppe "all" ist eine spezielle Gruppe, in der
	jeder Nutzer Mitglied ist.<br/>
	Um systemweite Standardwerte für eine Berechtiung zu setzen,
	kann dieses einfach für diese Gruppe gesetzt werden.
</p>
