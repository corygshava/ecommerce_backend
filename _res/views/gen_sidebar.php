<?php
    // sidebar items blueprint
    class navitem{
        public $link;           // where to send ajax
        public $caption;        // what will be shown
        public $href;           // anchor link to navigate to
        public $icon;           // what fa5 icon to use

        public function __construct($hrf,$lnk='',$cap='',$ico='home',$pfix='#'){
            $cap = $cap == '' ? $hrf : $cap;
            $lnk = $lnk == '' ? $hrf : $lnk;

            $this->link = $lnk;
            $this->caption = $cap;
            $this->href = $pfix.$hrf;
            $this->icon = $ico;
        }
    }

    // the sidebar items
    $nav_items = array(
        new navitem('dashboard','','','tachometer-alt'),
        new navitem('test API','','','microchip'),
        new navitem('account','','user')
    );

    foreach ($nav_items as $navl) {
        $caption = $navl->caption;
        $href = $navl->href;
        $icon = $navl->icon;
        $link = $navl->link;

        echo <<<HTML
            <a href="$href" data-mylink="$link" data-role="sidebar-btn"><i class="fas fa-$icon"></i> $caption</a>
        HTML;
    }

    /*
    echo <<<HTML
        <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <div><hr></div>
        <a href="#"><i class="fas fa-shopping-bag"></i> Orders</a>
        <a href="#"><i class="fas fa-box"></i> Products</a>
        <a href="#"><i class="fas fa-users"></i> Customers</a>
        <a href="#"><i class="fas fa-chart-line"></i> Analytics</a>
        <a href="#"><i class="fas fa-percent"></i> Promotions</a>
        <a href="#"><i class="fas fa-star"></i> Reviews</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
        <a href="#"><i class="fas fa-palette"></i> Appearance</a>
        <a href="#"><i class="fas fa-credit-card"></i> Payments</a>
        <a href="#"><i class="fas fa-shipping-fast"></i> Shipping</a>
        <a href="#"><i class="fas fa-headset"></i> Support</a>
    HTML;
    */
?>