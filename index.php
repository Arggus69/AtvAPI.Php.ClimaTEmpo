<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previsão do Tempo</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
    // Efetua a busca na api
    $url = 'http://apiadvisor.climatempo.com.br/api/v1/forecast/locale/5092/days/15?token=992a9d95e82478ef3669b700ea8bfeac';

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $weather_data = json_decode($response, true);
    $day = $weather_data["data"][0];

    $imgDawn = $day['text_icon']['icon']['dawn'];
    $imgMorning = $day['text_icon']['icon']['morning'];
    $imgAfternoon = $day['text_icon']['icon']['afternoon'];
    $imgNight = $day['text_icon']['icon']['night'];
    $direcaoVento = $day['wind']['direction'];
    $anguloVento = $day['wind']['direction_degrees'];
    
?>
<style>
    .direcao-vento svg {
        transform: rotate(<?=$anguloVento?>deg);
        margin-right: 5px;
    }
</style>
<body>
    <div class="container-all">
        <!-- Titulo -->
        <div class="title-container">
            <h3>Previsão do Clima em Bombinhas - SC</h3>
        </div>
        
        <div class="container">
            <div class="box">
                <div class="header">
                <!-- Descrição da Previsão do Dia -->
                    <div class="description">
                        <?=$day['text_icon']['text']['pt']?>
                    </div>
                </div>  
                <!-- Data -->
                <div class="table-data">
                    <div>
                        <strong>Data:</strong> 
                        <?=$day['date_br']?>
                    </div>
                </div>
                <!-- Imagens da Previsão -->
                <div class="table-img">
                    <div>
                        <img src="/imagens/<?=$imgDawn?>.png" alt="dawn">
                        <div>
                            Madrugada
                        </div>
                    </div>
                    <div>
                        <img src="/imagens/<?=$imgMorning?>.png" alt="morn" >
                        <div>
                            Manhã
                        </div>
                    </div>
                    <div>
                        <img src="/imagens/<?=$imgAfternoon?>.png" alt="noon" >
                        <div>
                            Tarde
                        </div>
                    </div>
                    <div>
                        <img src="/imagens/<?=$imgNight?>.png" alt="night" >
                        <div>
                            Noite
                        </div>
                    </div>
                </div>

                <div class="vertical-table">
                    <div>
                        <!-- Temperatura -->
                        <strong>Temperatura (°C)</strong>
                    </div>
                    <div>
                        <div class="arrow-down">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                            </svg>
                            <?=$day['temperature']['min']?>°C -
                        </div>
                        <div class="arrow-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                            </svg>
                            <?=$day['temperature']['max']?>°C
                        </div>
                    </div>
                        <!-- Chuva -->
                        <div>
                            <strong>Chuva (%):</strong>
                        </div>
                        <div class="table-rain">
                            <div class="rain-icon"></div>
                            <div>
                                <?=$day['rain']['precipitation']?> mm - 
                                <?=$day['rain']['probability']?>%
                            </div>
                        </div>
                    <div>
                        <!-- Vento -->
                        <strong>Vento (km/h):</strong>
                    </div>
                    <div class="direcao-vento">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                        </svg> 
                        <?=$day['wind']['direction']?> -
                        <?=$day['wind']['velocity_avg']?> km/h 
                    </div>
                    <!-- Umidade -->
                    <div>
                        <strong>Umidade (%):</strong>
                    </div>
                    <div>
                        <div class="arrow-down">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                            </svg>
                            <?=$day['humidity']['min']?>% -
                        </div>
                        
                        <div class="arrow-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                            </svg>
                            <?=$day['humidity']['max']?>%
                        </div>
                    </div>
                    <!-- Nascer e Por do Sol -->
                    <div>
                        <strong>Nascer e Pôr do Sol:</strong>
                    </div>
                    <div class="sunrise">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-sunrise" viewBox="0 0 16 16">
                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l1.5 1.5a.5.5 0 0 1-.708.708L8.5 2.707V4.5a.5.5 0 0 1-1 0V2.707l-.646.647a.5.5 0 1 1-.708-.708zM2.343 4.343a.5.5 0 0 1 .707 0l1.414 1.414a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707m11.314 0a.5.5 0 0 1 0 .707l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0M8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7m3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                    </svg>
                        <?=$day['sun']['sunrise']?>
                    </div>
                    <div class="sunset">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-sunset" viewBox="0 0 16 16">
                            <path d="M7.646 4.854a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V1.5a.5.5 0 0 0-1 0v1.793l-.646-.647a.5.5 0 1 0-.708.708zm-5.303-.51a.5.5 0 0 1 .707 0l1.414 1.413a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .706l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7m3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10m13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                        </svg>
                        <?=$day['sun']['sunset']?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
