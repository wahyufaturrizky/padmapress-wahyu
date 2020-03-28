<nav id="mobile-navigation-pro">
			
    <ul id="mobile-menu-pro">
    <li <?php if($nav=='home'){echo 'class="current-menu-item"';} ?>>
      <a href="<?php echo base_url().'welcome/index' ?> ">
            <span class="icon-Old-TV"></span>
        Home
      </a>
    <li>
    <li <?php if($nav=='video'){echo 'class="current-menu-item"';} ?>>
        <a href="<?php echo base_url().'welcome/video' ?> ">
              <span class="icon-Movie"></span>
          Video
        </a>
      </li>
    <li <?php if($nav=='audio'){echo 'class="current-menu-item"';} ?>>
      <a href="<?php echo base_url().'welcome/audio' ?> ">
            <span class="icon-Reel"></span>
        Audio
      </a>
    </li>
    <li <?php if($nav=='katalog'){echo 'class="current-menu-item"';} ?>>
      <a href="<?php echo base_url().'welcome/katalog' ?> ">
            <span class="icon-Movie-Ticket"></span>
        Katalog
      </a>
    </li>
    <li <?php if($nav=='tentang'){echo 'class="current-menu-item"';} ?>>
      <a href="<?php echo base_url().'welcome/tentang' ?> ">
      <span class="icon-User"></span>
         Tentang
      </a>
    </li>
    </ul>
    <div class="clearfix"></div>
    
    <div id="search-mobile-nav-pro">
      <form action="<?= base_url() ?>Welcome/search" method="GET">
      <input type="text" name="s" placeholder="Search" aria-label="Search">
      </form>
    </div>
    
</nav>