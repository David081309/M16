import mysql.connector

DB_HOST = "localhost"
DB_USER = "root"
DB_PASSWORD = ""
DB_NAME = "Modulo16"


def inicializar_bd():
    cnx = mysql.connector.connect(host=DB_HOST, user=DB_USER, password=DB_PASSWORD)
    cur = cnx.cursor()
    cur.execute(f"CREATE DATABASE IF NOT EXISTS {DB_NAME}")
    cnx.commit()
    cnx.database = DB_NAME

    cur.execute("""
        CREATE TABLE IF NOT EXISTS utilizadores (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50),
                password VARCHAR(255),
                email VARCHAR(255),
                role ENUM('cliente','operador')
        )
    """)
    cur.execute("""
        CREATE TABLE IF NOT EXISTS pontos_recolha (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100),
                rua VARCHAR(255),
                email_ponto VARCHAR(100)
        )
    """)
    cur.execute("""
        CREATE TABLE IF NOT EXISTS tipos_eletronicos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(50)
                descrição VARCHAR(255)
        )
    """)

    

    cnx.commit()
    cur.close()
    cnx.close()
inicializar_bd()


