<?php
// Previousnextcustom extension, https://github.com/pftnhr/yellow-previousnextcustom

class YellowPreviousnextcustom {
    const VERSION = "0.9.1";
    public $yellow;         // access to API

    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->system->setDefault("previousnextcustomPagePrevious", "1");
        $this->yellow->system->setDefault("previousnextcustomPageNext", "1");
        $this->yellow->system->setDefault("previousnextcustomSubstrlength", "null");
        $this->yellow->system->setDefault("previousnextcustomSubstrtext", "...");
    }

    // Handle page content of shortcut
    public function onParseContentElement($page, $name, $text, $attributes, $type) {
        $output = null;
        if ($name=="previousnextcustom" && ($type=="block" || $type=="inline")) {
            $pages = $this->getRelatedPages($page);
            $page->setLastModified($pages->getModified());
            $pagePrevious = $pageNext = null;
            if ($this->yellow->system->get("previousnextcustomPagePrevious")) $pagePrevious = $pages->getPagePrevious($page);
            if ($this->yellow->system->get("previousnextcustomPageNext")) $pageNext = $pages->getPageNext($page);
            if ($pagePrevious!=null || $pageNext!=null) {
                $output = "<div class=\"previousnextcustom\" role=\"navigation\" aria-label=\"".$this->yellow->language->getTextHtml("previousnextcustomNavigation")."\">\n";
                //$output .= "<p>";
                if ($pagePrevious!=null) {
                    $prevText = preg_replace("/@title/i", $pagePrevious->get("title"), $this->yellow->language->getText("previousnextcustomPagePrevious"));
                    $text = substr($prevText, 0, $this->yellow->system->get("previousnextcustomSubstrlength"));
                    if (strlenu($prevText) > $this->yellow->system->get("previousnextcustomSubstrlength")) {
                        $text .= $this->yellow->system->get("previousnextcustomSubstrtext");
                    }
                    $output .= "<a role=\"button\" class=\"previous outline\" href=\"".$pagePrevious->getLocation(true)."\">".htmlspecialchars($text)."</a>";
                }
                if ($pageNext!=null) {
                    if ($pagePrevious) $output .= " ";
                    $nextText = preg_replace("/@title/i", $pageNext->get("title"), $this->yellow->language->getText("previousnextcustomPageNext"));
                    $text = substr($nextText, 0, $this->yellow->system->get("previousnextcustomSubstrlength"));
                    if (strlenu($nextText) > $this->yellow->system->get("previousnextcustomSubstrlength")) {
                        $text .= $this->yellow->system->get("previousnextcustomSubstrtext");
                    }
                    $output .= "<a role=\"button\" class=\"next outline\" href=\"".$pageNext->getLocation(true)."\">".htmlspecialchars($text)."</a>";
                }
                //$output .= "</p>\n";
                $output .="</div>\n";
            }
        }
        return $output;
    }

    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="previousnextcustom" || $name=="link") {
            $output = $this->onParseContentShortcut($page, "previousnextcustom", "", "block");
        }
        return $output;
    }

    // Return related pages
    public function getRelatedPages($page) {
        switch ($page->get("layout")) {
            case "blog":        if ($this->yellow->system->get("blogStartLocation")=="auto") {
                                    $pages = $page->getSiblings();
                                } else {
                                    $pages = $this->yellow->content->index();
                                }
                                if ($page->get("rssonly") == "false") {
                                    $pages->filter("rssonly", "false");
                                    $pages->filter("category", "blog", false);
                                    $pages->sort("published", true);
                                } elseif ($page->get("category") == "micro") {
                                    $pages->filter("rssonly", "false");
                                    $pages->filter("category", "blog", false);
                                    $pages->sort("published", true);
                                } elseif ($page->get("rssonly") == "true") {
                                    $pages->filter("layout", "blog");
                                    $pages->filter("category", "blog", false);
                                    $pages->sort("published", true);
                                }
                                break;
            case "blog-start":  $pages = $this->yellow->content->clean(); break;
            default:            $pages = $page->getSiblings();
        }
        return $pages;
    }
}
