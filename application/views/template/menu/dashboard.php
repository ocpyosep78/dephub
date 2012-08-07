<div id="mainmenu">
    <div id="yw0" class="navbar">
	<div class="navbar-inner">
	<div class="container">
	    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	    </a>
	    <div class="nav-collapse">
		<ul class="nav">
		    <a class="brand" href="#"><img src="assets/img/dephub-icon.png" /></a>
		    <li class="<?php if($this->uri->segment(1)==''){echo 'active';};?>"><a href="<?php echo site_url();?>">Halaman Utama</a></li>
		    <li class="<?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='elearning'){echo 'active';};?>"><a href="site/dashboard/elearning">E-Learning</a></li>
		    <li class="<?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='email'){echo 'active';};?>"><a href="site/dashboard/email">E-Mail</a></li>
		    <li class="<?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='diklat'){echo 'active';};?>"><a href="site/dashboard/diklat">Manajemen Diklat</a></li>
		    <li class="<?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='library'){echo 'active';};?>"><a href="site/dashboard/library">Library</a></li>
		    <li class="dropdown <?php if($this->uri->segment(2)=='about'){echo 'active';};?>"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Tentang Kita<b class="caret"></b></a>
			<ul class="dropdown-menu">
			    <li class="<?php if($this->uri->segment(1)=='about' && $this->uri->segment(2)==''){echo 'active';};?>"><a href="about">Pusbang SDM</a></li>
			    <li class="<?php if($this->uri->segment(1)=='about' && $this->uri->segment(2)=='visi_misi'){echo 'active';};?>"><a href="about/visi_misi">Visi & Misi</a></li>
			    <li class="<?php if($this->uri->segment(1)=='about' && $this->uri->segment(2)=='struktur'){echo 'active';};?>"><a href="about/struktur">Struktur Organisasi</a></li>
			    <li class="<?php if($this->uri->segment(1)=='about' && $this->uri->segment(2)=='kontak'){echo 'active';};?>"><a href="about/kontak">Kontak</a></li>
			</ul>
		    </li>
		</ul>
	    </div>
	</div>
	</div>
    </div>
</div>
<!-- mainmenu -->