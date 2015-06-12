<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bootstrap 101 Template</title>

        <link href="<?php echo base_url() ?>assets/themes/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
        <h1>Crud</h1>

        <?php $this->load->view($loadpage); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url() ?>assets/themes/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>