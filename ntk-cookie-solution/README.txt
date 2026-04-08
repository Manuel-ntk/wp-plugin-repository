=== NTK Cookie Solution ===
Contributors: Manuel NTK
Tags: cookies, gdpr, consent, privacy, google maps
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Un plugin per la gestione del consenso ai cookie con blocco di script di terze parti come Google Maps.

== Descrizione ==

NTK Cookie Solution è un plugin WordPress per la gestione del consenso ai cookie che aiuta il tuo sito a essere conforme alle normative GDPR.

Caratteristiche principali:

* Banner dei cookie responsivo con design professionale
* Pulsante "Accetta" per il consenso dell'utente
* Blocco automatico degli script di terze parti (Google Maps, Analytics, ecc.)
* Memorizzazione del consenso per 365 giorni
* Design responsive ottimizzato per mobile
* Personalizzabile e pronto per ulteriori sviluppi

== Installazione ==

**METODO 1: Installazione tramite ZIP**

1. Scarica il repository come file ZIP
2. Estrai il contenuto dello ZIP
3. Carica l'intera cartella `ntk-cookie-solution` nella directory `/wp-content/plugins/` del tuo sito WordPress
4. Attiva il plugin attraverso il menu 'Plugin' in WordPress
5. Il banner dei cookie apparirà automaticamente sul frontend del tuo sito

**METODO 2: Installazione manuale via FTP**

1. Scarica i file del plugin
2. Carica l'intera cartella `ntk-cookie-solution` nella directory `/wp-content/plugins/` tramite FTP
3. Attiva il plugin dal pannello di amministrazione WordPress

**METODO 3: Installazione diretta (per sviluppatori)**

1. Naviga nella directory dei plugin: `cd wp-content/plugins/`
2. Clona il repository: `git clone https://github.com/Manuel-ntk/wp-plugin-repository.git`
3. Copia la cartella: `cp -r wp-plugin-repository/ntk-cookie-solution ./`
4. Attiva il plugin dal pannello WordPress

**IMPORTANTE:** Il plugin deve essere installato come cartella completa `ntk-cookie-solution/` con tutti i file al suo interno, non come singolo file PHP.

== Utilizzo ==

Dopo l'attivazione, il banner dei cookie apparirà automaticamente in fondo a tutte le pagine del tuo sito.

**Bloccare script di terze parti (Google Maps, Analytics, ecc.):**

Per bloccare uno script fino al consenso dell'utente, usa questo formato:

```html
<script type="text/plain" data-cookie-consent="required" src="https://maps.googleapis.com/maps/api/js?key=TUA_CHIAVE_API"></script>
```

Lo script verrà caricato automaticamente solo dopo che l'utente ha accettato i cookie.

**Esempio con Google Maps:**

```html
<!-- Script Google Maps bloccato -->
<script type="text/plain" data-cookie-consent="required" 
        src="https://maps.googleapis.com/maps/api/js?key=TUA_CHIAVE_API"></script>

<!-- Codice di inizializzazione bloccato -->
<script type="text/plain" data-cookie-consent="required">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
    }
</script>
```

== Domande frequenti ==

= Il plugin non funziona dopo l'installazione =

Assicurati di aver installato l'intera cartella `ntk-cookie-solution/` e non solo il file PHP singolo. La struttura corretta è:
```
wp-content/
  plugins/
    ntk-cookie-solution/
      ntk-cookie-solution.php
      README.txt
```

= Come posso personalizzare il messaggio del banner? =

Puoi modificare il testo nella funzione `ntk_cookie_solution_display_banner()` nel file principale del plugin.

= Come posso cambiare i colori del banner? =

Puoi modificare i CSS nella funzione `ntk_cookie_solution_enqueue_styles()` nel file principale del plugin.

= Il banner appare sempre, anche dopo aver accettato =

Verifica che i cookie siano abilitati nel tuo browser. Il plugin memorizza il consenso in un cookie chiamato `ntk_cookie_consent`.

= Come posso testare di nuovo il banner dopo averlo accettato? =

Cancella i cookie del sito o usa la modalità di navigazione in incognito del tuo browser.

== Screenshots ==

1. Banner dei cookie visualizzato in fondo alla pagina
2. Banner dopo l'accettazione (nascosto) con script caricati

== Changelog ==

= 1.0.0 =
* Versione iniziale
* Banner dei cookie con consenso
* Blocco script di terze parti
* Design responsive

== Upgrade Notice ==

= 1.0.0 =
Prima versione del plugin.

== Sviluppo futuro ==

Questa è la versione base del plugin. Funzionalità pianificate per le prossime versioni:

* Pannello di amministrazione per personalizzare il banner
* Supporto per diverse tipologie di cookie (tecnici, analytics, marketing)
* Integrazione con Google Analytics
* Gestione avanzata delle preferenze cookie
* Supporto multilingua
* Cookie policy page generator

== Supporto ==

Per supporto o segnalazione bug, visita: https://github.com/Manuel-ntk/wp-plugin-repository
