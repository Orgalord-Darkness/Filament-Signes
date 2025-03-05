<!DOCTYPE html>
<html>
    <body>
        <h1>Ceci est un test d'envoie de mail automatique. Ne pas répondre.</h1>
        <h1>Bonjour {{$signalement->civilite}} {{$signalement->prenom}} {{$signalement->nom}}</h1>
        <p>
            Nous vous remercions de bien vouloir nous faire connaitre les suites données à 
            l’évènement cité dans votre signalement.
            Vous pouvez apporter des éléments complémentaires dans le champ 
            Commentaire de l’onglet Suivi du formulaire.
            Tous les documents nécessaires sont à transmettre par retour de courriel. 
            Les services de la Direction de l’Offre Médico-Sociale restent à votre entière 
            disposition pour vous accompagner si nécessaire.
            <br>
            La Direction de l’Offre Médico-Sociale
        </p>
    </body>
</html>