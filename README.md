# Aplikacja do odnajdowania obiektów astronomicznych na niebie


Aplikacja przeznaczona jest dla każdego, kto chce się dowiedzieć jakie obiekty (gwiazdy, mgławice, galaktyki, itp.) może
dostrzec na nocnym niebie w miejscu, w którym się znajduje. Biorąc pod uwagę lokalizację użytkownika i aktualny czas, wyświetlana
jest lista obiektów, które będą dla niego widoczne. Wszystkie opatrzone są współrzędnymi azymutu i wysokości, które umożliwiają
łatwe zlokalizowanie obiektu na niebie.

Użytkownik korzystający z aplikacji wybiera jedną z opcji terenu obserwacji (duże miasto, wieś, las, itp.) dzięki czemu
obiekty, które znajdą się na jego liście będą odpowiednio jasne, aby były dostrzegalne w jego warunkach. Dodatkowo istnieje 
opcja wybrania obserwacji powyżej podanej wysokości nad horyzontem, jeżeli niżej niebo jest zasłonięte np przez drzewa oraz 
obserwacji tylko w jednym kierunku.

Obiekty wybierane są z bazy kilkuset obiektów, dla których zapisana będzie rektascensja oraz deklinacja, czyli 
współrzędne w układzie równikowym równonocnym, który nie zmienia się z czasem oraz jasność. Dane te pobrane zostaną przeze
mnie z internetu. Dodatkowo do przeliczenia tych współrzędnych na współrzędne w układzie horyzontalnym wykorzystam wartości
równania czasu, które również umieszczę najpierw w bazie.
Oszacowana będzie jasność nieba w warunkach wybranych przez użytkownika i na tej podstawie dla obserwacji w mieście wybrane
zostaną jedynie najjaśniejsze obiekty, podczas gdy dla obserwacji z dala od cywilizacji wyświetlana lista będzie dużo dłuższa.

Po obliczeniu zakresu jasności oraz współrzędnych, odpowiednie obiekty będą wypisane wraz ze współrzędnymi, dzięki którym
użytkownik bez wiedzy astronomicznej będzie mógł odnaleźć je na niebie. Lista będzie posortowana na podstawie jasności od obiektów
najjaśniejszych. Obok listy zamieszczona będzie instrukcja jak interpretować podane współrzędne.
