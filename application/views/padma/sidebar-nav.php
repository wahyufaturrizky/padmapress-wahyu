<nav id="sidebar-nav"><!-- Add class="sticky-sidebar-js" for auto-height sidebar -->
    <ul id="vertical-sidebar-nav" class="sf-menu">
      <li class="normal-item-pro <?php if($nav=='home'){echo 'current-menu-item';} ?>">
        <a href="<?= base_url() .'welcome/index' ?> ">
                <span class="icon-Old-TV"></span>
          Home
        </a>
      </li>
      <li class="normal-item-pro <?php if($nav=='video'){echo 'current-menu-item';} ?>">
        <a href="<?= base_url() .'welcome/video' ?> ">
                <span class="icon-Movie"></span>
          Video
        </a>
      </li>
      <li class="normal-item-pro <?php if($nav=='audio'){echo 'current-menu-item';} ?>">
        <a href="<?= base_url() .'welcome/audio' ?> ">
                <span class="icon-Reel"></span>
          Audio
        </a>
      </li>
      <li class="normal-item-pro <?php if($nav=='katalog'){echo 'current-menu-item';} ?>">
        <a href="<?= base_url() .'welcome/katalog' ?> ">
                <span class="icon-Movie-Ticket"></span>
          Katalog
        </a>
      </li>
      <li class="normal-item-pro <?php if($nav=='tentang'){echo 'current-menu-item';} ?>">
        <a href="<?= base_url() .'welcome/tentang' ?> ">
        <span class="icon-User"></span>
          Tentang
        </a>
      </li>
    </ul>
        <div class="clearfix"></div>
</nav>