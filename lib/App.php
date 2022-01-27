<?php

namespace Bktcli;
use GuzzleHttp\Client;

class App
{
    protected $printer;

    public function __construct()
    {
        $this->printer = new CliPrinter();
    }

    public function getPrinter()
    {
        return $this->printer;
    }

    public function runCommand($argv)
    {
       $name = "Not given";
	   $desc="";
        if (isset($argv[1])) {
            $name = $argv[1];
			$this->getPrinter()->display("Location $name");
            $client = new Client;
            $request = new \GuzzleHttp\Psr7\Request('GET', 'https://api.openweathermap.org/data/2.5/weather?q='.$name.'&appId=c0f764ce5e4c25576b8d6325fc223810');
            $promise = $client->sendAsync($request)->then(function ($response) {
            $jsondata = json_decode($response->getBody());
            $desc=ucwords($jsondata->weather[0]->description).",".$jsondata->main->temp. " degrees celcius" ;
			//echo $desc;
			$this->getPrinter()->display("$desc");
			$this->getPrinter()->newline();

                
            });
            $promise->wait();
        }
	   

    }
}
