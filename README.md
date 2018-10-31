# Digitale Plakatumgebung für Gruppenarbeiten

## Plakate erstellen

In der Datei ´config.json´ liegt die Konfiguration für alle Plakate und deren untergeordneten Felder und Gruppen. Der Aufbau der Datei ist folgendermaßen:

```json
{
    "uebersicht": {
        "fillables": {
            "schlagzeile": {
                ...
            },
            "stimmung": {
                ...
            }
        },
        "groups": {
            "1": [
                ...
            ],
            "2": [
                ...
            ]
        }
    },
    "detail": {
        "fillables": {
            ...
        },
        "groups": {
            ...
        }
    }
}
```

### Felder hinzufügen

Je Plakat befindet sich unter `fillables` die Auflistung aller Felder für dieses Plakat. Ein Feld kann dabei von folgenden Typen sein:
1. text
2. emoji
3. image
4. external

Für alle Felder existiert das Attribut `initial-value`, in welchem der Standardwert des Felds festgelegt wird. Dieser wird beim Aufruf der Seite gesetzt, sofern noch kein Wert für das Feld erfasst wurde. Die Namen der Felder müssen auch **übergreifend der Plakate eindeutig** sein.

#### Typ "text"
```json
...
"schlagzeile": {
    "type": "text",
    "initial-value": "Schlagzeile",
    "maxlength": 100
}
...
```
Dem Typ "text" ist das Attribut `maxlength` angehängt, in welchem die maximale Anzahl von Zeichen angegeben wird, die in das Textfeld eingegeben werden können.

#### Typ "emoji"
```json
...
"stimmung": {
    "type": "emoji",
    "initial-value": "em---1",
    "emojis": [
        "em---1",
        "em--1"
    ]
}
...
```
Dem Typ "emoji" ist ein weiteres Attribut `emojis` angehängt, in welchem mittels einer Liste alle für das Feld zur Verfügung stehenden Emojis aufgelistet werden. Eine Übersicht über alle Emojis kann unter https://afeld.github.io/emoji-css/ eingesehen werden.

#### Typ "image"
```json
...
"bild": {
    "type": "image",
    "initial-value": "https://via.placeholder.com/350x350/ccc",
    "images": [
        "./img/activeboard.jpg",
        "https://www.magnettafel.net/media/catalog/product/cache/10/image/9df78eab33525d08d6e5fb8d27136e95/m/o/mobile-kreidetafel-6.jpg"
    ]
}
...
```
Dem Typ "image" ist ein weiteres Attribut `images` angehängt, in welchem mittels einer Liste alle für das Feld zur Verfügung stehenden Bilder aufgelistet werden. Dafür können sowohl Bilder aus dem Ordner `img` als auch aus dem Internet verwendet werden. Das Bild wird immer in dem für das Feld vorgegebenen Seitenverhältnis, allerdings nicht verzerrt. Stattdessen wird ein zentrierter Ausschnitt des Bildes verwendet, sollte das Seitenverhältnis abweichen.

#### Typ "external" 
Der Typ "external" ist insofern besonders, als dass er keinen neuen Typen darstellt, sondern die Möglichkeit bietet, ein Feld aus einem anderen Plakat anzuzeigen. Das Plakat, aus dem importiert werden soll, wird in `source-poster` angegeben, das zu importierende Feld in `source-fillable`.
```json
...
"beschreibung": {
    "type": "external",
    "source-poster": "wurst",
    "source-fillable": "beschreibung"
}
...
```

### Felder Gruppen zuweisen
Unter `groups` können beliebig viele Gruppen erstellt werden, die die im Plakat existierenden Felder bearbeiten dürfen. Dazu muss gemäß der Vorlage eine Auflistung der Feldernamen erfolgen. Importierte Felder, die bereits in anderen Plakaten Gruppen zur Bearbeitung zugewiesen sind, dürfen **keinesfalls**
```json
...
"groups": {
    "1": [
        "schlagzeile",
        "preis"
    ],
    "2": [
        "bild"
    ]
}
...
```

### Schriftarten hinzufügen
Wenn besondere Schriftarten verwendet werden sollen, müssen diese bspw. als `.ttf` Datei in dem Ordner `/fonts` abgelegt werden. In der Datei `css/typography.css` kann die Schriftart dann für Textfelder verfügbar gemacht werden. Ein beispielhafter Eintrag für eine Abwandlung von `Georgia` sähe folgendermaßen aus:

```css
@font-face {
    font-family: 'Georgia1';
    src: url(../fonts/georgia.ttf) format('truetype');
}
```

Der in einfachen Anführungszeichen gewählte Name hinter `font-family:` ist dabei ausschlaggebend für die weitere Verwendung der Schriftart für die Textfelder. Der Wert für `src:` muss dem Dateinamen der gewünschten Schriftart entsprechen. Weitere Veränderungen wie Schriftgröße oder -farbe können vorgenommen werden, indem ein Eintrag mit einer `#` gefolgt dem Namen des Textfeldes, wie er in der `config.json` gewählt wurde, erstellt werden. Für das beispielhafte Textfeld Schlagzeile würde also folgender CSS Eintrag entstehen:

```css
#schlagzeile {
    font-family: Georgia1;
    font-size: 40px;
    color: red;
}
```

Die Befehle innerhalb der geschwungenen Klammer verändern das ausgewählte Textfeld. Eine Übersicht über die grundlegenden Befehle findet sich unter https://www.html-seminar.de/css-definitionen-uebersicht.htm.

### Hintergrundbild ändern
Um das Hintergrundbild zu verändern, muss die Datei `img/background.png` verändert werden.

## Ansicht auswählen
Bevor eine bestimmte Ansicht ausgewählt werden kann, muss in jedem Fall das anzuzeigende Plakat ausgewählt werden. Dafür muss hinter die URL der Eintrag `?poster=uebersicht` gesetzt werden - `uebersicht` steht in diesem Falle beispielhaft für das in der `config.json` benannte Plakat.

### Editor-Ansicht
In der Editor-Ansicht können alle Felder verschoben und vergrößert werden. Dafür muss hinter die URL der Eintrag `&role=editor` gesetzt werden. Die Editor-Ansicht ist nicht für den Unterricht gedacht, sondern dient der Erstellung von Plakaten.

### Master-Ansicht
In der Master-Ansicht können während des Unterrichts alle Felder verschoben werden. Dafür muss hinter die URL der Eintrag `&role=master` gesetzt werden. Wird die Position eines Feldes verändert, aktualisiert sich die Position für alle Gruppen, die das Feld nicht bearbeiten können, in jedem Fall aber für die Präsentationsansicht.

### Gruppen-Ansicht
Um eine Gruppe auszuwählen, muss hinter die URL der Eintrag `&group=1` gesetzt werden, `1` steht in diesem Falle beispielhaft für die in der `config.json` benannte Gruppe. Mit diesem Aufruf sind alle der Gruppe untergeordneten Textfelder bearbeitbar, alle weiteren Textfelder aktualisieren sich regelmäßig.

### Präsentations-Ansicht
Soll keines der Textfelder bearbeitet werden sondern ausschließlich eine Darstellung des digitalen Plakats erfolgen, so kann die Seite ohne weitere Parameter aufgerufen werden.
