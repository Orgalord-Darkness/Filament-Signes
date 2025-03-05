@php 
    use Carbon\Carbon ; 
    $date_evenement = Carbon::parse($signalement->date_evenement); 
    $date = $date_evenement->addWeeks(5);  
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>Nouveau Signalement créé</title>
</head>
<body>
    <p>
        Bonjour {{ $signalement->civilite }} {{ $signalement->prenom }} {{$signalement->nom}}
        </br>
        Nous accusons réception de votre signalement et nous vous en remercions.
        </br>
        Nous nous assurons d'instruire ce signalement dans les meilleures délais. Sans demandes particulières de notre part, 
        votre signalement sera clôturé automatiquement par nos services à partir du {{ $date->format('d/m/Y') }}.
        Vous pouvez à tout moment apporter des éléments complémentaires dans le champ Commentaire de l'onglet Suivi du formulaire.
        <br>
        La Direction de l'Offre Médico-Sociale 
    </p>
</body>
</html>