# Mi rincon - Proyecto blog de poesía
Esta web esta pensada como un espacio para alguien que quisiera compartir sus textos.
En su mayoría está programado con PHP aunque también utilizo HTML, CSS y JS. También utilicé CKeditor para darle un estilo de editor de texto a los textareas.

## Explicación de mi lógica
- El objeto principal es 'Entrada' y la gran mayoría de métodos desprenden de él.
- En el archivo 'manejo_obj' se encuentran los métodos que dan funcionabilida a la web.

## Rutas
- El index de la aplicación muestra un carrousel con los últimos posteos que contengan imágenes y un breve abstract sobre la persona propietaria de la página.

### Si no estas loggeado, en el header encontrarás:
- La ruta ./escritos, ahí vas a tener la totalidad de los textos que estén activos. Está programado para mostrar 6 entradas por página.
- La ruta ./sobre mi, tiene un breve texto para contar quien administra la web.
- La ruta ./contacto, habilita un formulario que permite a quienes visiten el sitio enviar un mensaje que llega como mail a la persona que administra la web.
- La ruta ./Buscador, corresponde a un buscador que filtra la palabra buscada entre el título o el cuerpo de las notas activas.
- La ruta ./ingresar, es un login para que poniendo usuario y contraseña tengas acceso a funciones de administrador.

### Si estas loggeado, en el header encontrarás:
- La ruta ./escritos, además de lo antes mencionado también vas a tener disponible las opciones de 'editar' la entrada o 'borrarla'.
- La ruta ./nueva entrada, da acceso a un formulario donde podes subir nuevo contenido a la web.
- La ruta ./archivo, muestra las entradas que por algún motivo no están visibles para el público general y te da la posibilidad de editarlo o volver a hacerlo público.
- La ruta ./cerrar_sesion, permite hacer logout.

## Variables de entorno
Para que el proyecto funcione correctamente es necesario descargar PHPMailer y CKEDITOR, son las dos librerías externas que estoy utilizando. En el caso de PHPMailar ademas de descargar la librería es necesario configurar las variables de entorno para determinar los datos requeridos para poder recibir mail efectivamente.
También sería necesario asignar usuario/contraseña al inicio de sesión. De esto último dejo un ejemplo en [env.example](https://github.com/Jxxlian/MiRincon/blob/main/.env) 

 ## Test App
 [InfinityFreeApp Test](http://mirincon.infinityfreeapp.com/index.php)




