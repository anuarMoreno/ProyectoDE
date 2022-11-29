import socket
import datetime
import mysql.connector
import os
from dotenv import load_dotenv

load_dotenv()

# Mysqldata

mydb = mysql.connector.connect(
  host=os.environ['RDS_HOST'],
  user=os.environ['RDS_USER'],
  password=os.environ['RDS_PASSWORD'],
  database=os.environ['RDS_DATABASE']
)


#NetData


localIP     = "0.0.0.0"

localPort   = 52000

bufferSize  = 1024




# Create a datagram socket

UDPServerSocket = socket.socket(family=socket.AF_INET, type=socket.SOCK_DGRAM)

 

# Bind to address and ip

UDPServerSocket.bind((localIP, localPort))

 

print("UDP server up and listening")

 

# Listen for incoming datagrams

            
while(True):

    bytesAddressPair = UDPServerSocket.recvfrom(bufferSize)

    message = bytesAddressPair[0]

    address = bytesAddressPair[1]

    clientMsg = format(message)
    clientIP  = "Client IP Address:{}".format(address)

    
    mensaje = clientMsg.split()
    carro = mensaje[1]
    Latitud = mensaje[3]
    Longitud = mensaje[6]
    Date = mensaje[7]
    Time = mensaje[8]
    envio = Date+" "+Time
    fechaenv = datetime.datetime.strptime(envio, '%Y/%m/%d %H:%M:%S')

    print(carro, Latitud, Longitud, envio)


    mycursor = mydb.cursor()

    sql = "INSERT INTO registro_posicion (envio, latitud, longitud) VALUES (%s, %s, %s)"
    sql2 = "INSERT INTO registro_posicion2 (envio, latitud, longitud) VALUES (%s, %s, %s)"
    val = (fechaenv, Latitud, Longitud)
    
    if carro=="1":
      mycursor.execute(sql, val)
      mydb.commit()
      print(mycursor.rowcount, "record inserted in table", carro)
    elif carro=="2":
      mycursor.execute(sql2, val)
      mydb.commit()
      print(mycursor.rowcount, "record inserted in table", carro)