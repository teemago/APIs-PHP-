<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../single.css">
    <title>Pessoas</title>
</head>

<body>
    <?php
    $x = $_GET['value'];
    $ch = curl_init("$x");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch));

    echo ('
        <div class="header">
            <div>
                <div class="title"> 
                    ' . $result->name . '
                </div>
                    ' . $result->gender . '
            </div>
            <a href="../">
            <div class="logo">
            </div>
            </a>
            <a href=../pessoas?page=1>
            <div>
             <
            </div>
            </a>
        </div>
        <div class="main">
            <div class="particao">
                <div class="subtitle">
                    Informações
                </div>
                <hr>    
                <div class="opcoes">
                    <span>Aniversario: ' . $result->birth_year . ' </span>
                    <span>Altura: ' . $result->height . ' cm</span>
                    <span>Peso: ' . $result->mass . ' kg</span>
                    <span>Cor de pele: ' . $result->skin_color . '</span>
                    <span>Cabelo: ' . $result->hair_color . ' </span>
                    <span>Olhos: ' . $result->eye_color . '</span>
                </div>
                <hr> ');

    echo '<span> Planeta Natal: ';
    $ch = curl_init($result->homeworld);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $planet = json_decode(curl_exec($ch));
    echo '<a href="../planetas/planetas.php?value=' . $planet->url . '">' . $planet->name . '</a></span>';

    echo '<span> Espécie: ';
    if ($result->species != []) {
        $ch = curl_init($result->species[0]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $specie = json_decode(curl_exec($ch));
        echo '<a href="../especies/species.php?value=' . $specie->url . '">' . $specie->name . '</a></span>';
    } else {
        echo "<a href='../especies/species.php?value=https://swapi.dev/api/species/1/'> Human </a></span>";
    }
    echo "<hr>";
    echo '<span> Naves: </span>';
    if ($result->starships != []) {
        foreach ($result->starships as $starship) {
            $ch = curl_init($starship);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $starship = json_decode(curl_exec($ch));
            echo '<a href="../naves/naves.php?value=' . $starship->url . '">' . $starship->name . '</a><br>';
        }
        ;
    } else {
        echo "N/A </span>";
    }
    echo "<hr>";
    echo '<span> Veiculos: </span>';
    if ($result->vehicles != []) {
        foreach ($result->vehicles as $vehicle) {
            $ch = curl_init($vehicle);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $vehicle = json_decode(curl_exec($ch));
            echo '<a href="../veiculos/veiculos.php?value=' . $vehicle->url . '">' . $vehicle->name . '</a><br>';
        }
        ;
    } else {
        echo "N/A </span>";
    }


    echo '<hr><span> Filmes: </span>';
    foreach ($result->films as $film) {
        $ch = curl_init($film);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $film = json_decode(curl_exec($ch));
        echo '<a href="../filmes/filmes.php?value=' . $film->url . '">' . $film->title . '</a><br>';
    }
    ;

    echo ('</div>
            <div class="image">
                <img src="../images/' . $result->name . '.png">
            </div>

        </div>
        '
    );
    ?>
</body>

</html>