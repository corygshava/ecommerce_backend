    <link rel="stylesheet" href="_assets/css/fa-all.css">
    <link rel="stylesheet" href="_assets/css/fonts.css">
    <link rel="stylesheet" href="_assets/css/w3.css">
    <!-- <link rel="stylesheet" href="_assets/css/theme.css"> -->
    <link rel="stylesheet" href="_assets/css/tmp_styles.css">
    <link rel="stylesheet" href="_assets/css/coryG_base.css">
    <link rel="stylesheet" href="_assets/css/coryG_UIOps.css">

    <script src="_assets/js/SuperScript.js"></script>
    <script src="_assets/js/toappend.js"></script>
    <script src="_assets/js/customalerter.js"></script>
    <script src="_assets/js/coryG_UIOps.js"></script>
    <script src="_assets/js/app.js"></script>
    <script src="_assets/js/animate.js"></script>

<?php
    $wantedtheme = isset($wantedtheme) ? $wantedtheme : "light";

    if($wantedtheme == "dark"){
        echo <<<HTML
            <style>
                /* @media (prefers-color-scheme: dark) { */
                    /* actually dark */
                    :root {
                        --clr-theme-dark: var(--darkcolor);
                        --clr-bg: #121212;
                        --clr-bgglass: #1e1e1eaa;
                        --clr-darkglass: #000000aa;
                        --clr-whiteglass: #2a2a2aaa;
                        --clr-panelbg: #1e1e1e;
                        --clr-alttext: #111;
                        --clr-text: #f5f5f5;
                        --clr-text-muted: #aaa;
                        --clr-mode: #000;
                        --clr-altmode: #fff;
                        --clr-lighter-dark: #181818;
                        --borderdesktop: #333;
                        --themeglow: 0 0 16px var(--themecolor);
                        --themeshadow: 0 0 16px rgba(0,0,0,0.9);
                        --lightshadow: 0 0 16px rgba(255,255,255,0.1);
                        --overlaybg: rgba(0,0,0,0.9);

                        --primary: #f5f5f5;
                        --gold: #d4af37;
                        --gold-light: #f4e5a1;
                        --dark: #0a0a0a;
                        --light: #1a1a1a;
                        --gray: #aaa;
                        --light-gray: #333;
                        --white: #121212;
                        --shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
                        --shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.8);
                    }
                /* } */
            </style>
        HTML;
    } else {
        echo <<<HTML
            <style>
                /* @media (prefers-color-scheme: light) { */
                    /* actually light */
                    :root {
                        --clr-theme-dark: var(--darkcolor);
                        --clr-bg: #efefef;
                        /* --clr-bg: red; */
                        --clr-bgglass: #efefefaa;
                        --clr-darkglass: #000000aa;
                        --clr-whiteglass: #efefefaa;
                        --clr-panelbg: #efefef;
                        --clr-text: #222;
                        --clr-alttext: #fefefe;
                        --clr-text-muted: #999;
                        --clr-mode: #fff;
                        --clr-altmode: #000;
                        --borderdesktop: transparent;
                        --themeglow: 0 0 16px var(--themecolor);
                        --themeshadow: 0 0 16px rgba(0,0,0,0.7);
                        --lightshadow: 0 0 16px rgba(0,0,0,0.2);
                        --overlaybg: rgba(0,0,0,0.8);

                        --primary: #1a1a1a;
                        --gold: #d4af37;
                        --gold-light: #f4e5a1;
                        --dark: #0a0a0a;
                        --light: #fafafa;
                        --gray: #666;
                        --light-gray: #f1f1f1;
                        --white: #ffffff;
                        --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        --shadow-hover: 0 4px 20px rgba(0, 0, 0, 0.15);
                    }
                /* } */
            </style>
        HTML;
    }
?>