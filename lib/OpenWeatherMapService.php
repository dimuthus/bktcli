<?php
namespace Bktcli;
use GuzzleHttp\Client;
use Bktcli\App;
use Bktcli\Config;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;

class OpenWeatherMapService implements WeatherInformationInterface{
    public function getWeatherForLocation($city)
    {
        
        $key =Config::getApiKey();
        $url = 'https://api.openweathermap.org/data/2.5/weather?units=metric&appid=' . $key . '&q=' . $city;
        try {
            $client = new Client();
            $response = $client->request('GET', $url);
        } catch (\Exception $e) {
            error_log('something went wrong' . $e->getMessage());
            throw $e;
        }
        $myres= $response->getBody()->getContents();
        $response = json_decode($myres);

        return [
            'weather' => $response->weather[0]->description,
            'temp' => $response->main->temp,
        ];
    }
}