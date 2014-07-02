<header>
    <?php
        $main_menu = new Mainmenu();
        include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/main_menu.inc');
        if(isset($_SESSION['user'])){
		?> 
		<div class="login">
		<a href='<?php print URL."login/?logout"; ?>' class="buttom_mainMenu">Logout</a>
		<?php
            if($_SESSION['role'] == 'admin'){?>
    <a href="<?php print URL."admin/"; ?>" class="buttom_mainMenu">Admin</a> <?php } else{ ?>
    
	<a href='<?php print URL."user/?my_account"; ?>' class="buttom_mainMenu">My account</a> <?php } ?>
	</div>
    <div class="name_user">Helo  <?php print $_SESSION['user']['real_name'];?> </div>
        <?php } else {?>
    <div class="login">
		<a href='<?php print URL."login/?login"; ?>' class="buttom_mainMenu">Login</a>
		<a href='<?php print URL."login/?register"; ?>' class="buttom_mainMenu">Register</a>
	</div>

        <?php } ?>

</header>