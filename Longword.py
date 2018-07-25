import requests

from bs4 import BeautifulSoup

import pymysql.cursors

connection = pymysql.connect(host='localhost',user='root',password='autoset',db='dasom',charset='utf8mb4',cursorclass=pymysql.cursors.DictCursor)
sql="INSERT INTO `word`(`length`, `name`) VALUES (%s,%s)"

if __name__=="__main__":
    url = "https://namu.wiki/w/끄투/긴%20단어/한국어"
    html = requests.get(url)
    bs4 = BeautifulSoup(html.text,'lxml')
    table = bs4.find_all('div',class_='wiki-table-wrap table-center')[2].find('table',class_='wiki-table')
    trs = table.find_all("tr")
    with connection.cursor() as cursor:
        for tr in trs:
            try:
                name=tr.find_all('td')[1].find('p').get_text().strip()
                length = len(name)

                # if '♥' in name:
                #     index = name.find('♥')
                #     name = name [:index]
                #     if '[' or ']' in name:
                #         index = name.find('[')
                #         name = name [:index]
                print(name,length)
                # cursor.execute(sql,(length,name))
            except:
                pass
        connection.commit()
