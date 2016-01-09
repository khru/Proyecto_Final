# Proyecto_Final
Este es el proyecto final de MINI
//Propongo este archivo como un diario en el que se vayan realizando anotaciones sobre cambios relevantes en el proyecto.
//Por ejemplo, si alguien crea una nueva funcion que se puede reutilizar en archivos que van a realizar otras personas,
//o también cualquier idea o situación del proyecto que creais necesario compartir.
//Para que no tengamos que estar bajando hasta el final, se escribirán las anotaciones de abajo a arriba, de forma que
//se siga un orden cronológico, y la anotación más reciente sea también la primera.
//Arriba del todo se situará la fecha, y se escribirá una nueva cuando se escriba en una fecha posterior, podeis ver el ejemplo.

                                         --------------------------------
                                        |           ANOTACIONES          |
                                         ¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯
Sábado, 9 de enero

>> Luis: Para la reutilización de vistas, propongo el nuevo método renderSinCabeceras, que es llamado múltiples veces desde
>> el controlador, de esa forma puede llamarse a una misma vista con diferentes datos y presentar ambas vistas-resultado.

>> Luis: He creado un acercamiento al tema de la separación entre la aplicación que ve el cliente y la que ven los usuarios.
>> Básicamente, si queremos que se usen las plantillas (header y footer) del cliente tendremos que llamar al método
>> ClientRender en vez de al método Render, que queda únicamente para el Backend.

>> Luis: Os he incluido un ejemplo básico de como utilizar esta función renderMulti, desde el
>> controlador "proyectos"

>> Luis: Añadida una nueva función "renderMulti" en la clase View que permite renderizar una vista
>> a partir de varios archivos. Recibe un array con los archivos que deben de estar ordenados en
>> orden de aparición. Podemos usarlo para no tener que implementar las mismas vistas en los
>> menus de backend, intentaré implementarlas lo antes posible para que se pueda hacer uso de ellas. 

>> Luis: Arreglado el controlador acceso para que funcione con las nuevas validaciones, lo he hecho yo pero al que le
>> toque lo puede cambiar a su gusto sin problemas.

>> Luis: Las validaciones ya están subidas, podeis encontrarlas en la carpeta libs.
>> No están probadas porque me es imposible probar 600 lineas de código, así que según vayais usándolas,
>> si veis que aparece algún error lo corregís (y obviamente lo subis a github).

>> Luis: Esta anotación siempre es más reciente que la de abajo. 

>> Luis: Esta anotación de prueba es para que se vea el intervalo de fechas, y todas las anotaciones queden ordenadas
>> cronológicamente.

Viernes, 8 de enero

>> Luis: Los repositorios de la máquina mini actuales no incluyen las librerías de validación ya que está previsto
>> un cambio en ellas, lo haré lo antes posible y las subiré para que todos podamos utilizarlas.

>> Luis: He subido los repositorios de la máquina mini que personalicé y que se usará para el proyecto,
>> tened en cuenta que la clase vista es ahora estática, y que el acceso a los datos se hará usando el
>> array "data" que aparece como parámetro en el método render.

>> Emmanuel: He modificado la validación de fecha para que el separador sea por defecto el de MySQL "-".
