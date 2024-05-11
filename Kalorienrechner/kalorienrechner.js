function berechneKalorien() {
  var geschlecht = document.getElementById('geschlecht').value;
  var gewicht = parseInt(document.getElementById('gewicht').value);
  var groesse = parseInt(document.getElementById('groesse').value);
  var alter = parseInt(document.getElementById('alter').value);
  var aktivitaet = document.getElementById('aktivität').value;
  var ziel = document.getElementById('ziel').value;
  var sport = document.getElementById('sport').value;
  
  var bmr;

  // Harris-Benedict-Prinzip
  if (geschlecht === 'männlich') {
    bmr = 66.47 + (13.7 * gewicht) + (5 * groesse) - (6.8 * alter);
  } else {
    bmr = 655.1 + (9.6 * gewicht) + (1.8 * groesse) - (4.7 * alter);
  };

  // Einfluss von Sport
  var sportFaktoren = {
    'kein': 1.0,
    'leicht': 1.08,
    'moderat': 1.18,
    'schwer': 1.3
  };

  // Einfluss von Aktivität
  var aktivitaetsFaktor = {
    'wenig': 1.1,
    'mittel': 1.3,
    'hoch': 1.5
  };

  var kalorien = bmr * aktivitaetsFaktor[aktivitaet] * sportFaktoren[sport];

  // Anpassung der Kalorien basierend auf dem Ziel
  if (ziel === 'abnehmen') {
    kalorien *= 0.8;
  } else if (ziel === 'zunehmen') {
    kalorien *= 1.2;
  };

  var url="speichere_kalorien.php" + "?kalorien=" + kalorien;

  var xhr = new XMLHttpRequest();
  xhr.open("GET", url , true);
  xhr.onreadystatechange = KalorienAnzeigen(kalorien);
  xhr.send(null);
}

function KalorienAnzeigen(kalorien){
    document.getElementById('result').textContent = 'Dein täglicher Kalorienbedarf beträgt: ' + kalorien.toFixed(2) + ' kcal.';
}