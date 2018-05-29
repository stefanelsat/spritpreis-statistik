from selenium import webdriver
from selenium.webdriver.firefox.options import Options
import re, sys

pos = "pos_lon=13.104237&pos_lat=47.678994&pos_name=5400+Hallein%2C+Austria"

if len(sys.argv) > 1:
    sprit = str(sys.argv[1])
else:
    sprit = "DIE"

print sprit
options = Options()
options.add_argument("--headless")
browser = webdriver.Firefox(firefox_options=options)
browser.get('http://mobile.spritpreisrechner.at/')

obj = "{'options':{'fuelType':'"+str(sprit)+"','ansichtsType':'Karte','gasAnzeige':'kg','stromLeistung':'Alle','stromTechnik':'Technik A','showSplash':false,'showClosed':true}}"
script = """localStorage.clear();
            localStorage.setItem('jStorage',JSON.stringify("""+obj+"))"
browser.execute_script(script)
browser.get('http://mobile.spritpreisrechner.at/location.html?'+pos+'&submit=submit-value')
list_button = browser.find_element_by_xpath('/html/body/div[1]/div[2]/div/div[1]/fieldset/div/div[2]/label/span/span')
list_button.click()

for i in range(1,6):
    cheapest_title = browser.find_element_by_css_selector('ul#tankstellen_list_content > li:nth-child('+str(i)+') .ui-li-heading').get_attribute('innerHTML').encode('utf-8')
    cheapest_price = browser.find_element_by_css_selector('ul#tankstellen_list_content > li:nth-child('+str(i)+') .ui-li-price').get_attribute('innerHTML').encode('utf-8')
    cheapest_location = browser.find_element_by_css_selector('ul#tankstellen_list_content > li:nth-child('+str(i)+') .ui-li-desc').get_attribute('innerHTML').encode('utf-8')

    # parsed values
    cheapest_title = re.sub(r'[\d\W\s,&]', '', str(cheapest_title)).replace('nbsp', '')
    cheapest_location = re.sub(r'[<,>]', '', str(cheapest_location)).replace('br', ',')

    print cheapest_title
    print cheapest_price
    print cheapest_location
    print

browser.quit()
