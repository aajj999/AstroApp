CREATE TABLE obiekt_astronomiczny(
   nazwa VARCHAR2(30) PRIMARY KEY,
   jasnosc NUMBER(3, 2) NOT NULL,
   rektascensja NUMBER(3, 4) NOT NULL CHECK (rektascensja >= 0 AND rektascensja < 360),
   deklinacja NUMBER(2, 4) NOT NULL CHECK (deklinacja >= -90 AND deklinacja <= 90),
   opis LONG DEFAULT 'Na razie brak opisu'
   );

CREATE TABLE miejsce(
   dlugosc_geograficzna NUMBER(3, 5) NOT NULL CHECK (dlugosc_geograficzna >= -180 AND dlugosc_geograficzna <= 180),
   szerokosc_geograficzna NUMBER(2, 5) NOT NULL CHECK (szerokosc_geograficzna >= -90 AND szerokosc_geograficzna <= 90),
   janosc NUMBER(2, 2) NOT NULL
   );