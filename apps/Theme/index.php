<!DOCTYPE html>
<html lang="en" class="default <?php echo @$html_class; ?>" >
<head>
<?php echo $this->renderView('Theme/Views::common/head.php'); ?>
</head>
<body>

    <!-- PAGE -->
    <body>
        <tmpl type="system.messages" />
         <tmpl type="view" />
        <!--/FOOTER -->
    </div>
    <!--/PAGE -->
<?php echo $this->renderView('Theme/Views::common/footer.php'); ?>
</body>
</html>
