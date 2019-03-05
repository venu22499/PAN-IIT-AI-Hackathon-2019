import pandas
import re
import csv
df = pandas.read_csv('/home/ganesh/Desktop/naukri.csv')
cl = csv.reader(open('/home/ganesh/Desktop/dictionary2.csv'))
pay = {}
Y = {}
for row in cl :
	Y[row[1]] = row[0]
	pay[row[1]] = [0,0,0]

for i in range(21999) :
	v = df['payrate'][i]
	#print(v , v.find('-'))
	y = df['industry'][i]
	if type(v) == str and type(y) == str and v.find('-') != -1 and v[-3:] == "P.A" and ord(v[-5]) - ord('0') in range(10) and ord(v[0])-ord('0') in range(10) and y in pay:
		v = v.replace(' ' , '').replace(',' , '')
		low = int(v[0:v.find('-')])
		high = int(v[v.find('-')+1:v.find('P')])
		pay[y][0] += low
		pay[y][1] += high
		pay[y][2] += 1

for y in Y:
	pay[y][0] = int((pay[y][0]/pay[y][2] + pay[y][1]/pay[y][2])/2)
	#pay[y][1] = int(pay[y][1]/pay[y][2])
	pay[y] = pay[y][:1]

print(pay)		