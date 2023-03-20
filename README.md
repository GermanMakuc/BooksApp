# BooksApp

Aplicación construída en PHP orientada a objetos por capas (MVC) y MySQL, haciendo uso de API pública Google Books

## Puntos que debe tener

- Buscar un objeto desde la API que se consume.
- Visualizar el objeto y algunos de sus datos en el componente web.
- Guardar el objeto en una base de datos. (Puede ser una base web, como Always
Data o similar). El objeto guardado debe verse en una sección del componente web
llamada “Objetos guardados” o de nombre parecido.
- Modificar el objeto, por ejemplo, agregarle un comentario, etiqueta o un “me gusta”.
(Sugerencias)
- Borrar el objeto de la base propia donde se guardó y que además desaparezca de la
sección de “Objetos guardados” visible en el componente web.

# Buscar un objeto desde la API que se consume. (Cumplido)

Se hacen multiples llamadas a la API tanto nivel de front-end como de back-end:
En primera instancia hace una llamada vía ajax, para que cargue libros con referencia a Harry Potter al cargar la página
> [js/Functions.js Línea 17](https://github.com/GermanMakuc/BooksApp/blob/main/js/functions.js#L17)

Al realizar la acción de busqueda agrega el parámetro de búsqueda a la API para recoger los datos pertinentes y limpiar si hubo busquedas anteriores

> [js/functions.js Línea 209](https://github.com/GermanMakuc/BooksApp/blob/main/js/functions.js#L209)

A nivel de Back-end al seleccionar un libro, recibimos el id, posterior se consulta por medio del id y mostramos sus datos

> [book.php](https://github.com/GermanMakuc/BooksApp/blob/main/book.php)

# Visualizar el objeto y algunos de sus datos en el componente web (Cumplido)

Se repite lo del paso anterior pero predomina este punto
A nivel de Back-end al seleccionar un libro, recibimos el id, posterior se consulta por medio del id y mostramos sus datos
> [book.php](https://github.com/GermanMakuc/BooksApp/blob/main/book.php)

# Guardar el objeto en una base de datos (Cumplido)

Todas las clases, funciones (Agregar, editar, borrar) y conexión a la base de datos están ubicadas en:

Directorio: BooksApp/classes/

Incluye el string de conexion a la base de datos el cuál usaremos para las llamadas
> BooksApp/classes/connection.php

```sh
$this->connection = new PDO("mysql:host=localhost;dbname=appbooks",'root', '');
$this->connection = new PDO("mysql:host=sql309.epizy.com;dbname=epiz_33831145_booksapp",'epiz_33831145', 'o74eNk6IU8g');
```

El primer string fue usado para trabajar en la máquina local y el segundo string es dónde está siendo usado en la demo de ejemplo, por medio de una base de datos alojada de un servicio de MySql llamado: https://www.infinityfree.net/

### El proceso de inserción se compone de 3 partes

Parte a nivel de Front el cual va a estar a la escucha del botón "Agregar"

> [js/Functions.js Línea 139](https://github.com/GermanMakuc/BooksApp/blob/main/js/functions.js#L139)

Para posterior comunicarse por via Ajax con una API interna

> [BooksApp/api/favorites.php](https://github.com/GermanMakuc/BooksApp/blob/main/api/favorites.php)

Dependiendo de la lógica va a insertar u borrar haciendo usos de las clases ya definidas

> [BooksApp/classes/favorites.php](https://github.com/GermanMakuc/BooksApp/blob/main/classes/favorites.php)

La consulta de los datos insertados se encuentran en:

> [BooksApp/saved.php](https://github.com/GermanMakuc/BooksApp/blob/main/saved.php)

# Modificar el objeto (Cumplido)

Funciona de la misma forma que el punto anterior, pero con otro elemento
Parte a nivel de Front el cual va a estar a la escucha del botón "Agregar Comentario"

> [js/Functions.js Línea 74](https://github.com/GermanMakuc/BooksApp/blob/main/js/functions.js#L74)

Para posterior comunicarse por via Ajax con una API interna

> [BooksApp/api/comments.php](https://github.com/GermanMakuc/BooksApp/blob/main/api/comments.php)

Dependiendo de la lógica va a insertar u modificar haciendo usos de las clases ya definidas

> [BooksApp/classes/comments.php](https://github.com/GermanMakuc/BooksApp/blob/main/classes/comments.php)

La consulta de los datos insertados se encuentran en:

> [BooksApp/mycomments.php](https://github.com/GermanMakuc/BooksApp/blob/main/mycomments.php)

# Borrar el objeto de la base propia donde se guardó (Cumplido)

Forma parte del punto de inserción la misma APi interna encargada de insertar también decide sí borrar

API interna de Guardados

> [BooksApp/api/favorites.php](https://github.com/GermanMakuc/BooksApp/blob/main/api/favorites.php)

```sh
    $favorite = new Favorites();
    $results = $favorite->countByID($id);
    if($results == 0)
    {
        $favorite->id_google_book = $id;
        $favorite->image = $image;
        $favorite->title = $title;
        $favorite->description = $description;
        $favorite->version = $version;
        $favorite->add();

        $data = array("state" => true);
    }
    else
    {
        $data = array("state" => false);
        $favorite->delete($id);
    }
```

Lo que hace es contar sí existen elementos con ese id, sí no existen significa que desea agregar sino lo desea borrar

La consulta de los datos insertados se encuentran en:

> [BooksApp/saved.php](https://github.com/GermanMakuc/BooksApp/blob/main/saved.php)
