<?php
//   if (!empty($_GET['q'])) {
//     switch ($_GET['q']) {
//       case 'info':
//         phpinfo(); 
//         exit;
//       break;
//     }
//   }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>%agic Ball</title>

        <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Karla';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            
            
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title" title="Magic Ball">Magic Ball</div>
     
                <div class="question utilisateur"><br />
                <form action="action.php" method="POST">
                    <label>Votre question est  :</label>
                    <input name="question" id="question" type="text" />
                    
                    <p><button type="submit">Valider</button></p>
                </form>
                </div>
               
            </div>

        </div>
    </body>
</html>