<html>
<body>
    <h1>Bonjour {{ $actionSignalement->signalement->civilite }} {{ $actionSignalement->signalement->prenom }} {{ $actionSignalement->signalement->nom }}</h1>
    <p>
        Nous vous remercions de bien vouloir répondre à la question ci-dessous par retour de courriel.
        <br>
        {{ $actionSignalement->question->libelle }} {{ $actionSignalement->question2 }}
        <br>
        La Direction de l’Offre Médico-Sociale
    </p>
</body>
</html>