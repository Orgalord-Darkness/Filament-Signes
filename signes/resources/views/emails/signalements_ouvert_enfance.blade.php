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
        </br>
        La Direction de l'Offre Médico-Sociale 
    </p>
</body>
</html>