# Spritpreis Statistik ⛽
> This is a app to track the fuel prices in Austria at your town.
> Based on requests to http://spritpreisrechner.at

## Fetch URLs
---------

### a) Diesel
```bash
# Fetch fuel prices for Diesel at location Hallein:
http://mobile.spritpreisrechner.at/location.html?pos_lon=13.104237&pos_lat=47.678994&pos_name=5400+Hallein%2C+Austria&submit=submit-value

# localStorage:
jStorage:"{"options":{"fuelType":"DIE","ansichtsType":"Karte","gasAnzeige":"kg","stromLeistung":"Alle","stromTechnik":"Technik A","showSplash":false,"showClosed":true}}"
```
### b) Super95
```bash
# Fetch fuel prices for Super95 at location Hallein:
http://mobile.spritpreisrechner.at/location.html?pos_lon=13.104237&pos_lat=47.678994&pos_name=5400+Hallein%2C+Austria&submit=submit-value

# localStorage:
jStorage:"{"options":{"fuelType":"SUP","ansichtsType":"Karte","gasAnzeige":"kg","stromLeistung":"Alle","stromTechnik":"Technik A","showSplash":false,"showClosed":true}}"
```

## How to set objects to LocalStorage
----
```bash
# 1. clear Storage
localStorage.clear()

# 2. generate Object
var obj = {"options":{"fuelType":"DIE","ansichtsType":"Karte","gasAnzeige":"kg","stromLeistung":"Alle","stromTechnik":"Technik A","showSplash":false,"showClosed":true}}

# 3. set item to LocalStorage
 localStorage.setItem('jStorage',JSON.stringify(obj))
```