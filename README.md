<p align="right"><a href="README-de.md">Deutsch</a> &nbsp; <a href="README.md">English</a> &nbsp; <a href="README-sv.md">Svenska</a></p>

# Previousnext Custom 0.9.1

Show links to previous/next page as buttons.

<p align="center"><img src="SCREENSHOT.png" alt="Screenshot"></p>

## How to install an extension

[Download ZIP file](https://github.com/pftnhr/yellow-previousnextcustom/archive/refs/heads/main.zip) and copy it into your `system/extensions` folder. [Learn more about extensions](https://github.com/annaesvensson/yellow-update).

## How to show links

This extension adds links to previous/next page, which allows users to navigate between pages. Links are shown on blog pages. To show links on other pages use a `[previousnextcustom]` shortcut.

## Examples

Content file with links:

    ---
    Title: Example page
    ---
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut 
    labore et dolore magna pizza. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
    esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt 
    in culpa qui officia deserunt mollit anim id est laborum.

    [previousnextcustom]

Layout file with links:

    <?php $this->yellow->layout("header") ?>
    <div class="content">
    <div class="main" role="main">
    <h1><?php echo $this->yellow->page->getHtml("titleContent") ?></h1>
    <?php echo $this->yellow->page->getContentHtml() ?>
    <?php echo $this->yellow->page->getExtraHtml("previousnextcustom") ?>
    </div>
    </div>
    <?php $this->yellow->layout("footer") ?>

## Settings

The following settings can be configured in file `system/extensions/yellow-system.ini`:

`PreviousnextcustomPagePrevious` = show link to previous page, 1 or 0  
`PreviousnextcustomPageNext` = show link to next page, 1 or 0  
`PreviousnextcustomSubstrlength` = max length of the button text. default's to 20  
`PreviousnextcustomSubstrtext` = character string to be output after the truncated button text. default's to `...`  

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

## Acknowledgement

Developed by [Anna Svensson](https://github.com/annasvensson/)

## Customiser

Robert Pfotenhauer. [Get help](https://datenstrom.se/yellow/help/).
