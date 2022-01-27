<?php
namespace Bktcli;

use Illuminate\Console\Command;

class GetWeatherForecast extends Command {
    public function handle()
    {
        $app = new OpenWeatherMapService();
        echo "Provide the Location and it will get the weather for you! ";
        $handleInput = fopen ("php://stdin","r");
        $city = fgets($handleInput);
        $currentWeather=[];
        if(trim($city) != ''){
            try {
                $currentWeather = $app->getWeatherForLocation(trim($city));
            } catch (\Exception $e) {
                error_log($e->getMessage());
            }
             echo $this->printResult($currentWeather);
        }
        
    }

    public function printResult($result)
    {
        $weatherStr=$result['weather'] .", ".$result['temp']." degrees celcius \n";
        return $weatherStr;
    }
 
}
