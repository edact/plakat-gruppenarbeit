# Digitales Plakat für Gruppenarbeiten
## Textfelder hinzufügen und Gruppen zuweisen
In der Datei ´config.json´ liegt die Konfiguration für alle Gruppen und deren untergeordneten Textfelder. Der Aufbau der Datei ist folgendermaßen:
```
{
    "groups": {
        "1":{
            "inputs": {
                "schlagzeile": {
                    "type": "text",
                    "placeholder": "Schlagzeile",
                    "maxlength": 100
                },
                "preis": {
                    "type": "emoji",
                    "emojis": ["em---1", "em--1"]
                }
            }
        },
        "2":{
            "inputs": {
                "schlagzeile": {
                    "type": "text",
                    "placeholder": "Schlagzeile",
                    "maxlength": 100
                }
            }
        }
    }
}

```

Unter ´groups´ findet sich die Auflistung aller Gruppen. Innerhalb der Gruppen können unter `inputs` einzelne Textfelder erfasst werden. Ein Textfeld kann dabei von folgenden Typen sein:
1. text
2. emoji

### Typ "text"
Dem Typ "text" können die Attribute `placeholder` und `maxlength` hinzugefügt werden. Der Inhalt von `placeholder` wird in dem Textfeld angezeigt, wenn noch kein Text eingegeben wurde. So kann bspw. ein Schlagwort wie "Schlagzeile" einen Hinweis auf den Sinn des Textfeldes geben. Das Attribut `maxlength` bestimmt die maximale Anzahl von Zeichen, die in das Textfeld eingegeben werden können.

### Typ "emoji"
Dem Typ "emoji" ist ein weiteres Attribut `emojis` angehängt, in welchem mittels einer Liste alle für das Feld zur Verfügung stehenden Emojis aufgelistet werden. Eine Übersicht über alle Emojis kann unter https://afeld.github.io/emoji-css/ eingesehen werden.

## Textfelder positionieren
Um die Textfelder auf der Webseite zu positionieren, muss unter `css/positioning.css` ein Eintrag mit einer `#` gefolgt dem Namen des Textfeldes, wie er in der `config.json` gewählt wurde, erstellt werden. Für das beispielhafte Textfeld Schlagzeile würde also folgender CSS Eintrag entstehen:

```
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

## Schriftarten hinzufügen
Wenn besondere Schriftarten verwendet werden sollen, müssen diese bspw. als `.ttf` Datei in dem Ordner `/fonts` abgelegt werden. In der Datei `css/fonts.css` kann die Schriftart dann für Textfelder verfügbar gemacht werden. Ein beispielhafter Eintrag für eine Abwandlung von `Georgia` sähe folgendermaßen aus:

```
@font-face {
    font-family: 'Georgia1';
    src: url(../fonts/georgia.ttf) format('truetype');
}
```

Der in einfachen Anführungszeichen gewählte Name hinter `font-family:` ist dabei ausschlaggebend für die weitere Verwendung der Schriftart für die Textfelder. Der Wert für `src:` muss dem Dateinamen der gewünschten Schriftart entsprechen.

## Hintergrundbild ändern
Um das Hintergrundbild zu verändern, muss die Datei `img/background.png` verändert werden.

## Gruppe auswählen
Um eine Gruppe auszuwählen, muss hinter die URL der Eintrag `?group=1` gesetzt werden, `1` steht in diesem Falle beispielhaft für die in der `config.json` benannte Gruppe. Mit diesem Aufruf sind alle der Gruppe untergeordneten Textfelder bearbeitbar, alle weiteren Textfelder aktualisieren sich regelmäßig.

## Präsentationsansicht
Soll keines der Textfelder bearbeitet werden sondern ausschließlich eine Darstellung des digitalen Plakats erfolgen, so kann die Seite ohne weitere Parameter aufgerufen werden.
