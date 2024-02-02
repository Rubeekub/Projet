<h2>Contact</h2>
<fieldset>
    <ul>
        <li><span>TrouveTout</span><br>
        Siège social<br>
        1 chemin du Tanit<br>
        06600 Antibes<br>
        Telephone:<br> <a href="tel:+330609870857" title="12 34 56 78 90">12 34 56 78 90</a><br>
        <a href="sms:+331234567890" title="12 34 56 78 90">12 34 56 78 90</a></li>
        <li>Facebook : <a href="https://www.facebook.com/legreta/" title="https://www.facebook.com/legreta/"> Legreta </a></li>
    </ul>
</fieldset>
<br>
    <fieldset>
        <form method="post" action="">
        Pour nous contacter par mail:
        <br>
        <input type="text"  name="FirstName" placeholder="Prénom (requis)" required="">
        <br>  
        <input type="email"  name="Email" placeholder="Email (requis)" required="">
        <br>
        <textarea type="text" name="Commentaire_utilisateur"  title="Commentaire" placeholder="Commentaire (Requis)" rows="3" required=""></textarea>
        <br>
        <input type="submit" value="Envoyer ma demande">
        </form>     
    </fieldset>

   
   <!-- Envoyer les informations par mail. -->

        </ul>
        
    <?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $to = 'johndoe@email.com';
        $subject="informations pour votre Bday";
        $from = 'johndoe@email.com';
        //$from = '$_POST["Email"]'; mais on veut savoir que le mail a ete envoyé avec le site
        


        $headers = array(
            'MIME-Version' => '1.0',
            'Content-type'=> 'text/html; charset=iso-8859-1',
            'From' => 'johndoe@email.com',
            'Cc' => 'mail@test.fr',
            'Reply-To' => '$_POST["Email"]',
            'X-Mailer' => 'PHP/' . phpversion()
            );

            $message="<html><body>";
            $message .= "<h1> la demande </h1>";
            $message .= "FirstName";
            $message .= "Commentaire_utilisateur";
            $message .= "Email";
            $message .= "</body></html>";

            if(mail($to, $subject, $message, $headers)){ echo 'Votre message a été envoyé avec succès.';
                } else{ echo 'Impossible d\'envoyer des courriels. Veuillez réessayer.';
                }
            }
                    ?>