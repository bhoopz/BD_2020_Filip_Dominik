CREATE SEQUENCE  album_seq  
MINVALUE 1 MAXVALUE 99999 
INCREMENT BY 1 START WITH 10 
NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;

CREATE SEQUENCE  gatunek_seq  
MINVALUE 1 MAXVALUE 99999 
INCREMENT BY 1 START WITH 6 
NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;

CREATE SEQUENCE  klienci_seq  
MINVALUE 1 MAXVALUE 99999 
INCREMENT BY 1 START WITH 3 
NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;

CREATE SEQUENCE  wykonawcy_seq  
MINVALUE 1 MAXVALUE 99999 
INCREMENT BY 1 START WITH 12 
NOCACHE  NOORDER  NOCYCLE  NOKEEP  NOSCALE  GLOBAL ;

create or replace PROCEDURE dodajalbum (
  tytul IN VARCHAR2,
  id_wykonawcy IN NUMBER,
  id_gatunku IN NUMBER,
  rok IN NUMBER,
  cena IN NUMBER,
  img IN VARCHAR2)
  IS
  BEGIN
    INSERT INTO albumy VALUES (album_seq.nextval, tytul, id_wykonawcy, id_gatunku, rok, cena, img);
  END dodajalbum;
  
create or replace PROCEDURE dodajgatunek (
  nazwaGatunku IN VARCHAR2)
  IS
  BEGIN
    INSERT INTO gatunek VALUES (gatunek_seq.nextval, nazwaGatunku);
  END dodajgatunek;
  
create or replace PROCEDURE dodajwykonawce (
  nazwa IN VARCHAR2)
  IS
  BEGIN
    INSERT INTO wykonawcy VALUES (wykonawcy_seq.nextval, nazwa);
  END dodajwykonawce;
  
create or replace PROCEDURE loguj (username IN VARCHAR2, pasword IN VARCHAR2, id_OUT OUT SYS_REFCURSOR) AS
BEGIN
  OPEN id_OUT FOR
  SELECT id_klienta FROM klienci WHERE nazwa_uzytkownika = username AND haslo = pasword;
  end;
  
create or replace PROCEDURE rejestruj (
  nazwa_uzytkownika in varchar2,
  haslo in varchar2,
  imie in varchar2,
  nazwisko in varchar2,
  email in varchar2,
  adres in varchar2)
  IS
  BEGIN
    INSERT INTO klienci VALUES (
   klienci_seq.nextval, nazwa_uzytkownika, haslo, imie, nazwisko, email, adres);
  END rejestruj;
  
create or replace NONEDITIONABLE PROCEDURE usunalbum (
  id_albumu_in IN NUMBER)
  IS
  BEGIN
    DELETE FROM albumy WHERE id_albumu=id_albumu_in;
  END usunalbum;
  

CREATE OR REPLACE 
FUNCTION ile_albumow return number is 
wynik number;
cursor ile_albumow_kursor is 
select count(tytul) from albumy;
BEGIN open ile_albumow_kursor;
fetch ile_albumow_kursor into wynik;
close ile_albumow_kursor;
return wynik;
END;

CREATE OR REPLACE 
FUNCTION ile_zamowien return number is 
wynik number;
cursor ile_zamowien_kursor is 
select count(id_zamowienia) from zamowienia;
BEGIN open ile_zamowien_kursor;
fetch ile_zamowien_kursor into wynik;
close ile_zamowien_kursor;
return wynik;
END;
