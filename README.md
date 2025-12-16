# NTK Cookie Solution - WordPress Plugin

Plugin WordPress per la gestione del consenso ai cookie con blocco di script di terze parti.

## 🚀 Installazione

### Metodo 1: Download e Upload (Raccomandato)

1. **Scarica** il repository come ZIP (pulsante "Code" → "Download ZIP")
2. **Estrai** il file ZIP sul tuo computer
3. **Carica** l'intera cartella `ntk-cookie-solution` in `wp-content/plugins/` del tuo sito WordPress (via FTP o File Manager)
4. **Attiva** il plugin dal menu Plugin in WordPress

### Metodo 2: Git Clone (Per sviluppatori)

```bash
cd wp-content/plugins/
git clone https://github.com/Manuel-ntk/wp-plugin-repository.git temp
cp -r temp/ntk-cookie-solution ./
rm -rf temp
```

Poi attiva il plugin dal pannello WordPress.

## ⚠️ IMPORTANTE

Il plugin **DEVE** essere installato come cartella completa `ntk-cookie-solution/` con la seguente struttura:

```
wp-content/
  plugins/
    ntk-cookie-solution/
      ntk-cookie-solution.php  ← File principale
      README.txt
      index.php
```

**NON** installare solo il file `ntk-cookie-solution.php` singolo - non funzionerà!

## 📋 Caratteristiche

✅ Banner cookie responsivo  
✅ Consenso utente con pulsante "Accetta"  
✅ Blocco automatico script terze parti (Google Maps, Analytics, ecc.)  
✅ Memorizzazione consenso per 365 giorni  
✅ Design mobile-friendly  
✅ Conforme GDPR  

## 🔧 Utilizzo

### Bloccare script di terze parti

Per bloccare uno script fino al consenso:

```html
<script type="text/plain" data-cookie-consent="required" 
        src="https://maps.googleapis.com/maps/api/js?key=TUA_CHIAVE"></script>
```

Lo script verrà caricato automaticamente dopo l'accettazione dei cookie.

## 📖 Documentazione completa

Vedi [README.txt](ntk-cookie-solution/README.txt) per la documentazione completa.

## 🐛 Risoluzione problemi

**Il plugin non appare in WordPress?**
- Verifica di aver caricato l'intera cartella `ntk-cookie-solution/`
- Controlla che il percorso sia `wp-content/plugins/ntk-cookie-solution/`
- Ricarica la pagina dei Plugin in WordPress

**Il banner non appare?**
- Verifica che il plugin sia attivato
- Controlla che il tema utilizzi `wp_head()` e `wp_footer()`
- Cancella la cache del browser e del sito

## 📄 Licenza

GPL v2 or later

## 👨‍💻 Autore

Manuel NTK
