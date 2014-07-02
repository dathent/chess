<!doctype html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>CHESS</title>
			<?php if(isset($_SESSION['alert'])){print $_SESSION['alert']; unset($_SESSION['alert']);}?>
            <link rel= 'stylesheet' href='<?php print URL.'css/style.css'; ?>'>
        </head>
        <body>
            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/header.inc'); ?>
            <main>
                <nav>
                </nav>
            </main>
            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/chess/html/footer.inc'); ?>
		</body>
	</html>