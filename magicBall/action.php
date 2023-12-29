 <!-- htmlspecialchars() s'assure que tous les caractères spéciaux HTML 
                sont proprement encodés afin d'éviter des injections de balises HTML 
                et de Javascript dans vos pages. !-->
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
            <p>La question posée : </p>
            </div>
            <div class= "title">
            <?php echo htmlspecialchars($_POST['question']); ?>?
            </div>
            <div class="content">
            <p>La reponse est  : </p>
            </div>
            <div class= "title">
                <?php
                $magic=[
                    "C’est certain",
                    "C’est complètement ça",
                    "Sans aucun doute",
                    "Oui, vraiment",
                    "Tu peux compter dessus",
                    "Augure favorable", 
                    "Très probablement",
                    "Ça m’a l’air de bien se présenter", 
                    "Oui",
                    "Les signes indiquent que oui", 
                    "La réponse est flou, essaye encore",
                    "Redemande plus tard",
                    "Il ne vaut mieux pas que je réponde tout de suite",
                    "Impossible à prévoir pour l’instant",
                    "Concentre toi et redemande",
                    "Ne compte pas dessus",
                    "Ma réponse est non",
                    "Mes sources disent non",
                    "Ça ne se présente pas bien",
                    "Très peu probable"];
                $i=0;
                $count=count ($magic);
                    echo $magic[rand($i, $count)]."<br>";
                ?>
            </div>
        </div>
    </body>
</html>