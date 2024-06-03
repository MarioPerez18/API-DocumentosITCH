<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .contenedor {
            width: 100%;
        }

        .imagenes {
            display: flex;
            justify-content: center;
        }

        .nombres {
            padding-top: 20px;
        }

        .descripcion {
            padding-top: 15px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <div class="imagenes">
            
        </div>

        <div class="nombres">
            <h2>{{$Nombres}} {{$ApellidoPaterno}} {{$ApellidoMaterno}} </h2>
        </div>

        <div class="descripcion">
            <p>Estimado participante, por este medio te hacemos entrega de tu documento de participación,
                por haber sido {{ $TipoParticipante }} en el evento {{ $Evento }}.
            </p>
        </div>
    </div>
</body>

</html>
