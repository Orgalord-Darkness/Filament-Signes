<html>
<body>
    <h1>Bonjour {{ $action->signalement->civilite }} {{ $action->signalement->prenom }} {{ $action->signalement->nom }}</h1>
    <p>
        Nous vous remercions de bien vouloir répondre à la question ci-dessous par retour de courriel.
        <br>
        {{ $action->question->libelle }} {{ $action->question2 }}
        <br>
        La Direction de l’Offre Médico-Sociale
    </p>
</body>
</html>