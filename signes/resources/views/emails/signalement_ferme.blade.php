<!DOCTYPE html>
<html>
<head>
    <title> Signalement fermé</title>
</head>
<body>
    <p>
        Bonjour {{ $signalement->civilite }} {{ $signalement->prenom }} {{ $signalement->nom }}
        </br>
        Nous accusons réception de votre signalement et nous vous en remercions.
        </br>
        Nous vous remercions de bien vouloir nous faire connaitre les suites données à 
        l’évènement cité dans votre signalement.
        Vous pouvez apporter des éléments complémentaires dans le champ 
        Commentaire de l’onglet Suivi du formulaire.
        Tous les documents nécessaires sont à transmettre par retour de courriel. 
        Les services de la Direction de l’Offre Médico-Sociale restent à votre entière 
        disposition pour vous accompagner si nécessaire.
        <br>
        La Direction de l'Offre Médico-Sociale 
    </p>
</body>
</html>