rem
rem $Header: dbII.SQL_V 1.1 10/10/07 23:30
rem
Rem
Rem   dbII.sql
set feedback off

DROP TABLE albumy CASCADE CONSTRAINTS;
CREATE TABLE albumy
(id_albumu			NUMBER(11) NOT NULL,
   tytul			VARCHAR2(25) NOT NULL,
   id_wykonawcy 	NUMBER(11) NOT NULL,
   id_gatunku 		NUMBER(11) NOT NULL,
   rok 				NUMBER(4) NOT NULL,
   cena 			NUMBER(4,2) NOT NULL,
   img			VARCHAR2(25) NOT NULL,
		CONSTRAINT id_albumu_pk PRIMARY KEY (id_albumu));
		
INSERT INTO albumy VALUES
(1, 'Chronic2001', 4, 3, 1999, 17.99,'drdre.jpg');
INSERT INTO albumy VALUES
(2, 'The Singles Album', 2, 5, 1991, 17.99,'krawczyk.jpg');
INSERT INTO albumy VALUES
(3, 'Hypnotize', 1, 1, 2005, 40.99,'hypnotize.jpg');
INSERT INTO albumy VALUES
(4, 'Mezmerize', 1, 1, 2005, 40.99,'mezmerize.jpg');
INSERT INTO albumy VALUES
(5, 'One More Light', 3, 1, 2017, 49.99,'oml.jpg');
INSERT INTO albumy VALUES
(6, 'Małomiasteczkowy', 5, 2, 2018, 19.99,'podsiadlo.jpg');
INSERT INTO albumy VALUES
(8, 'Dzieci Duchy', 6, 4, 2019, 34.99,'szpaku.jpg');


DROP TABLE gatunek CASCADE CONSTRAINTS;
CREATE TABLE gatunek 
(id_gatunku NUMBER(11) 		NOT NULL,
	nazwaGatunku varchar(25) 		NOT NULL,
		CONSTRAINT id_gatunku_pk PRIMARY KEY (id_gatunku));


INSERT INTO gatunek VALUES
(1, 'rock');
INSERT INTO gatunek VALUES
(2, 'pop');
INSERT INTO gatunek VALUES
(3, 'hip-hop');
INSERT INTO gatunek VALUES
(4, 'rap');
INSERT INTO gatunek VALUES
(5, 'funk');

DROP TABLE klienci CASCADE CONSTRAINTS;
CREATE TABLE klienci
(id_klienta NUMBER(11) 				NOT NULL,
	nazwa_uzytkownika varchar(25)   NOT NULL,
	haslo varchar(25)				NOT NULL,
	imie varchar(25) 				NOT NULL,
    nazwisko varchar(25) 			NOT NULL,
    email varchar(25) 				NOT NULL,
    adres varchar(25)				NOT NULL,
		CONSTRAINT id_klienta_pk PRIMARY KEY (id_klienta));
		
INSERT INTO klienci VALUES
(1, 'tester','tester', 'janusz', 'kowalski', 'test@op.pl', 'Testowo');


DROP TABLE wykonawcy CASCADE CONSTRAINTS;
CREATE TABLE wykonawcy
(id_wykonawcy NUMBER(11) 		NOT NULL,
	nazwa varchar(45) 		NOT NULL,
		CONSTRAINT id_wykonawcy_pk PRIMARY KEY (id_wykonawcy));

INSERT INTO wykonawcy VALUES
(1, 'System Of A Down');
INSERT INTO wykonawcy VALUES
(2, 'Krzysztof Krawczyk');
INSERT INTO wykonawcy VALUES
(3, 'Linkin Park');
INSERT INTO wykonawcy VALUES
(4, 'Dr. Dre');
INSERT INTO wykonawcy VALUES
(5, 'Dawid Podsiadło');
INSERT INTO wykonawcy VALUES
(6, 'Szpaku');

DROP TABLE zamowienia CASCADE CONSTRAINTS;
CREATE TABLE zamowienia
(id_zamowienia NUMBER(11) 		NOT NULL,
	id_klienta NUMBER(11) 		NOT NULL,
    id_albumu NUMBER(11) 		NOT NULL,
	ilosc NUMBER(11)			NOT NULL,
	status varchar(25)  	NOT NULL,
		CONSTRAINT id_zamowienia_pk PRIMARY KEY (id_zamowienia));
		
INSERT INTO zamowienia VALUES
(1, 1, 2, 1, 'oczekiwanie');
INSERT INTO zamowienia VALUES
(2, 1, 5, 2, 'wyslano');


DROP TABLE zamowienia_albumy CASCADE CONSTRAINTS;
CREATE TABLE zamowienia_albumy
(id NUMBER(11) 			NOT NULL,
	id_albumu NUMBER(11) 	NOT NULL,
	id_zamowienia NUMBER(11) NOT NULL,
		CONSTRAINT id_pk PRIMARY KEY (id));
		
	
ALTER TABLE albumy
	ADD CONSTRAINT albumy_ibfk_1 
	FOREIGN KEY (id_wykonawcy) REFERENCES wykonawcy (id_wykonawcy);
ALTER TABLE albumy
	ADD CONSTRAINT albumy_ibfk_2 
	FOREIGN KEY (id_gatunku) REFERENCES gatunek (id_gatunku);
 
ALTER TABLE zamowienia
	ADD CONSTRAINT zamowienia_ibfk_2 
	FOREIGN KEY (id_klienta) REFERENCES klienci (id_klienta);
	
ALTER TABLE zamowienia_albumy
	ADD CONSTRAINT zamowienia_albumy_ibfk_1 
	FOREIGN KEY (id_zamowienia) REFERENCES zamowienia (id_zamowienia);
ALTER TABLE zamowienia_albumy
	ADD CONSTRAINT zamowienia_albumy_ibfk_2 
	FOREIGN KEY (id_albumu) REFERENCES albumy (id_albumu);

prompt Tables and sequences created and populated.
set feedback on



