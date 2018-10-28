# Digitales Plakat für Gruppenarbeiten

## Plakat erstellen

### Textfelder hinzufügen und Gruppen zuweisen

In der Datei ´config.json´ liegt die Konfiguration für alle Gruppen und deren untergeordneten Textfelder. Der Aufbau der Datei ist folgendermaßen:

```json
{
    "groups": {
        "1": {
            "inputs": {
                "schlagzeile": {
                    "type": "text",
                    "initial-value": "Schlagzeile",
                    "maxlength": 100
                },
                "preis": {
                    "type": "emoji",
                    "initial-value": "em---1",
                    "emojis": [
                        "em---1",
                        "em--1"
                    ]
                },
                "bild": {
                    "type": "image",
                    "initial-value": "https://via.placeholder.com/350x350/ccc",
                    "images": [
                        "./img/activeboard.jpg",
                        "https://www.magnettafel.net/media/catalog/product/cache/10/image/9df78eab33525d08d6e5fb8d27136e95/m/o/mobile-kreidetafel-6.jpg"
                    ]
                }
            }
        }
    }
}
```

Unter `groups` findet sich die Auflistung aller Gruppen. Innerhalb der Gruppen können unter `inputs` einzelne Flder erfasst werden. Ein Feld kann dabei von folgenden Typen sein:
1. text
2. emoji
3. image

Für alle Felder existiert das Attribut `initial-value`, in welchem der Standardwert des Felds festgelegt wird. Dieser wird beim Aufruf der Seite gesetzt, sofern noch kein Wert für das Feld erfasst wurde.

#### Typ "text"
Dem Typ "text" ist das Attribut `maxlength` angehängt, in welchem die maximale Anzahl von Zeichen angegeben wird, die in das Textfeld eingegeben werden können.

#### Typ "emoji"
Dem Typ "emoji" ist ein weiteres Attribut `emojis` angehängt, in welchem mittels einer Liste alle für das Feld zur Verfügung stehenden Emojis aufgelistet werden. Eine Übersicht über alle Emojis kann unter https://afeld.github.io/emoji-css/ eingesehen werden.

#### Typ "image"
Dem Typ "image" ist ein weiteres Attribut `images` angehängt, in welchem mittels einer Liste alle für das Feld zur Verfügung stehenden Bilder aufgelistet werden. Dafür können sowohl Bilder aus dem Ordner `img` als auch aus dem Internet verwendet werden. Das Bild wird immer in dem für das Feld vorgegebenen Seitenverhältnis, allerdings nicht verzerrt. Stattdessen wird ein zentrierter Ausschnitt des Bildes verwendet, sollte das Seitenverhältnis abweichen.

### Textfelder positionieren
Um die Textfelder auf der Webseite zu positionieren, muss unter `css/positioning.css` ein Eintrag mit einer `#` gefolgt dem Namen des Textfeldes, wie er in der `config.json` gewählt wurde, erstellt werden. Für das beispielhafte Textfeld Schlagzeile würde also folgender CSS Eintrag entstehen:

```css
#schlagzeile {
    top: 5px;
    left: 430px;
    width: 620px;
    height: 80px;
    font-family: Georgia1;
    font-size: 40px;
    color: red;
}
```

Die Befehle innerhalb der geschwungenen Klammer verändern das ausgewählte Textfeld. Eine Übersicht über die grundlegenden Befehle findet sich unter https://www.html-seminar.de/css-definitionen-uebersicht.htm.

### Schriftarten hinzufügen
Wenn besondere Schriftarten verwendet werden sollen, müssen diese bspw. als `.ttf` Datei in dem Ordner `/fonts` abgelegt werden. In der Datei `css/fonts.css` kann die Schriftart dann für Textfelder verfügbar gemacht werden. Ein beispielhafter Eintrag für eine Abwandlung von `Georgia` sähe folgendermaßen aus:

```css
@font-face {
    font-family: 'Georgia1';
    src: url(../fonts/georgia.ttf) format('truetype');
}
```

Der in einfachen Anführungszeichen gewählte Name hinter `font-family:` ist dabei ausschlaggebend für die weitere Verwendung der Schriftart für die Textfelder. Der Wert für `src:` muss dem Dateinamen der gewünschten Schriftart entsprechen.

### Hintergrundbild ändern
Um das Hintergrundbild zu verändern, muss die Datei `img/background.png` verändert werden.

## Ansicht auswählen

### Masteransicht
In der Masteransicht können alle Felder verschoben werden. Dafür muss hinter die URL der Eintrag `?role=master` gesetzt werden. Wird die Position eines Feldes verändert, aktualisiert sich die Position für alle Gruppen, die das Feld nicht bearbeiten können, in jedem Fall aber für die Präsentationsansicht.

### Gruppe auswählen
Um eine Gruppe auszuwählen, muss hinter die URL der Eintrag `?group=1` gesetzt werden, `1` steht in diesem Falle beispielhaft für die in der `config.json` benannte Gruppe. Mit diesem Aufruf sind alle der Gruppe untergeordneten Textfelder bearbeitbar, alle weiteren Textfelder aktualisieren sich regelmäßig.

### Präsentationsansicht
Soll keines der Textfelder bearbeitet werden sondern ausschließlich eine Darstellung des digitalen Plakats erfolgen, so kann die Seite ohne weitere Parameter aufgerufen werden.
