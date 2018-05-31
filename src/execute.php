<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>    <script src="./index.js"></script>
  </head>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$latlng = filter_input(INPUT_POST, 'pos', FILTER_SANITIZE_STRING); 
$treibstoff = filter_input(INPUT_POST, 'sprit', FILTER_SANITIZE_STRING);
if (isset($latlng) && isset($treibstoff)) $pythoncmd = "python  ./fetch_page.py ". $treibstoff . " ". $latlng . " 2>&1";
else $pythoncmd = 'python  ./fetch_page.py DIE 2>&1';

$output = shell_exec($pythoncmd);
$json = json_decode($output);

$prices = array($json->prices);
?>
<div class="alerts"></div>
<div class="loading"></div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Preis</th>
      <th scope="col">Tankstelle</th>
      <th scope="col">Ort</th>
      <th scope="col">Zeit</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($prices[0] as &$price) {
          echo <<<EOT
            <tr>
              <th scope="row">$price->price</th>
              <td>$price->title</td>
              <td>$price->location</td>
              <td>$price->time</td>
            </tr>
EOT;
        }
    ?>
  </tbody>
</table>
<form action=" " method="POST">
  <div class="container">Suchergebnisse für Hallein Nähe ...</div>
  <div class="container">
    <input type="radio" name="options" id="option1" autocomplete="off" checked> Hallein
    <input onclick="locate()" type="radio" name="options" id="option2" autocomplete="off"> meiner Position<br>
    <input type="text" class="form-control" name="sprit" placeholder="DIE oder SUP?"><br>
    <input id="pos-field" type="hidden" name="pos">
    <input type="submit" value="Senden" class="btn btn-primary">
  </div>
</form>
