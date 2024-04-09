<p align="right"><a href="README-de.md">Deutsch</a> &nbsp; <a href="README.md">English</a></p>

# Previousnext Custom 0.9.1

Links zur vorherigen/nächsten Seite als Buttons anzeigen.

## Wie man eine Erweiterung installiert

[ZIP-Datei herunterladen](https://github.com/pftnhr/yellow-previousnextcustom/archive/refs/heads/main.zip) und in dein `system/extensions`-Verzeichnis kopieren. [Weitere Informationen zu Erweiterungen](https://github.com/annaesvensson/yellow-update/tree/main/README-de.md).

## Wie man Links anzeigt

Diese Erweiterung fügt Links zur vorherigen/nächsten Seite ein, mit denen Benutzer zwischen den Seiten navigieren können. Links werden auf Blogseiten angezeigt. Um Links auf anderen Seiten anzuzeigen, benutze eine `[previousnextcustom]`-Abkürzung.

## Beispiele

Inhaltsdatei mit Links:

    ---
    Title: Beispielseite
    ---
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
    labore et dolore magna pizza. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt 
    in culpa qui officia deserunt mollit anim id est laborum.

    [previousnextcustom]

Layoutdatei mit Links:

    <?php $this->yellow->layout("header") ?>
    <div class="content">
    <div class="main" role="main">
    <h1><?php echo $this->yellow->page->getHtml("titleContent") ?></h1>
    <?php echo $this->yellow->page->getContentHtml() ?>
    <?php echo $this->yellow->page->getExtraHtml("previousnextcustom") ?>
    </div>
    </div>
    <?php $this->yellow->layout("footer") ?>

## Einstellungen

Die folgenden Einstellungen können in der Datei `system/extensions/yellow-system.ini` vorgenommen werden:

`PreviousnextcustomPagePrevious` = Link zur vorherigen Seite zeigen, 1 oder 0  
`PreviousnextcustomPageNext` = Link zur nächsten Seite zeigen, 1 oder 0  
`PreviousnextcustomSubstrlength` = Maximale Länge des Button_textes. Standard ist `20`   
`PreviousnextcustomSubstrtext` = Zeichenkette, die nach dem abgeschnittenen Button-Text ausgegeben werden soll. Standard ist `...`   

### SCSS

``` scss
.previousnextcustom,
.pagination {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding-top: var(--font-size);
    
    &:has(a.next:only-child) {
        justify-content: flex-end;
    }
    
    &:has(a.previous:only-child) {
        justify-content: flex-start;
    }
}

.previousnextcustom,
.pagination {
    &::after {
        clear: both;
    }
}

.previousnextcustom {	
    .previous:before {
        content: "← ";
    }
    
    .next:after {
        content: " →";
    }
}
```

## Danksagung

Entwickelt von [Anna Svensson](https://github.com/annasvensson/)

## Anpasser

Robert Pfotenhauer. [Get help](https://datenstrom.se/yellow/help/).
