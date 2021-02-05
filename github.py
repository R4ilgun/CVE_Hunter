#coding = ctf-8

import urllib
import MySQLdb as cve_mysql
import requests,re,time

def getCVE():
	try:
		headers = {
			'Connection': 'close',
		}
		api = "https://api.github.com/search/repositories?q=CVE-2020&sort=updated"
		req = requests.get(api,headers=headers)
		json_data = req.json()
		cve_name = json_data['items'][1]['name']
		cve_url = json_data['items'][1]['html_url']
		cve_description = json_data['items'][1]['description']
		cve_owner = json_data['items'][1]['owner']['login']
		pushed_time = json_data['items'][1]['pushed_at']
		updated_time = json_data['items'][1]['updated_at']

		if(cve_description==None):
			cve_description = "null"

		return cve_name,cve_url,cve_description,cve_owner,pushed_time,updated_time

	except Exception as e:
		print (e,"github connect failed!")


def writeCVE():
	try:
		conn = cve_mysql.connect(host='127.0.0.1', port=3306, user='root', passwd='MIEri521', db='cve', charset='utf8')
	except Exception as e:
		print(e,"Mysql connect failed!")

	try:
		cve_info = getCVE()
                
                '''
		sql_check = "SELECT * from cve_github WHERE cve_name=%(cve_name)s"
		cve_check = {"cve_name":str(cve_info[0])}
		cursor = conn.cursor()
		'''

		cve_list = {"cve_name":str(cve_info[0]),"cve_url":str(cve_info[1]),"cve_description":str(cve_info[2]),"cve_owner":str(cve_info[3]),"pushed_time":str(cve_info[4]),"updated_time":str(cve_info[5])}
		sql = "INSERT INTO cve_github (cve_name,cve_url,cve_description,cve_owner,push_time,update_time) VALUES (%(cve_name)s,%(cve_url)s,%(cve_description)s,%(cve_owner)s,%(pushed_time)s,%(updated_time)s);"
		cursor = conn.cursor()
		cursor.execute(sql,cve_list)
		conn.commit()

		print 'Get:' + cve_info[0]

	except Exception as e:
		print(e,"Write CVE failed!")
	
	conn.close()

if __name__ == '__main__':
	writeCVE()
