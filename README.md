# SnowFall - TFG
Este es el TFG que he realizado para finalizar mis estudios en el ámbito de la informática.

En simples conceptos, es un proyecto que combina dos servidores Debian para simular un proceso automático de hosting web.

El proyecto consta de dos servidores:
- CentralServer.
  - El encargado de redirigir conexiones.
- DataServer.
  - El encargado de alojar los datos.
 
Cada servidor tiene una tarea asignada.
- CentralServer:
  - Aloja el servicio DNS (Bind9) y hace redirige las conexiones al DataServer si es necesario.
  - Aloja la zona directa e inversa del DNS de SnowFall.
  - Aloja el script de automatización de Bind9 y recibe el nombre de la nueva zona.
- DataServer:
  - Aloja el servicio Apache2 (Web), servicio FTP (Very Secure FTP Daemon), bases de datos y páginas web.
  - Aloja la configuración de las páginas web principales de SnowFall y la de los usuarios.
  - Aloja el script de automatización de Apache2, comunicación con CentralServer y creación de usuarios locales a partir de una base de datos.
- Común:
  - Ambos servidores comparten una configuración en crontab que ejecuta los scripts cada minuto.
  - Ambos servidores se encuentran en la misma red interna con el fin de verse.
  - CentralServer tiene acceso a Internet pero DataServer no.
  - Las direcciones de red usadas para los servidores son 192.168.21.X, siendo X 254 para CentralServer y 253 para DataServer.

### Elementos que me hubiese gustado añadir
- Comprobaciones de datos insertados en formularios.
- Gestor de sitios mediante WebGUI.
- Acceso a FTP 100% automatizado.
- Script de comprobación de contenido dañino en sitios subidos.
- Estabilidad y confiabilidad del 100% de la automatización de servicios.
- Más configuraciones, más complejas de los servicios.
- Implementación de un servicio de correo con Postfix.
 
### Notas
- La persistencia de la automatización, es delicada, usar con precaución dado que puede fallar si no se sabe lo que se toca.
- Cuidado al usar las funciones administrativas de la WebGUI, no tienen confirmación y se dispone de acciones destructivas.
- La tabla "orders" dispone de un trigger que se lanza si el campo "bugPrio" de una nueva inserción se encuentra en 1.

### Información de interés
##### ¿Se modificará y/o terminará lo deseado?
No, al menos no lo tengo pensado ni a corto ni a largo alcance, no tengo suficiente tiempo y creo que sería mejor empezar desde cero antes que tocar de nuevo cada palo de este proyecto.

##### ¿Por qué empezar de cero?
Ha sido una de las primeras veces que comienzo y termino un proyecto "grande" y he cometido varios errores que habrían facilitado la elaboración del proyecto y habrían agilizado el proceso.

##### ¿Habrá algún proyecto del estilo en el futuro?
Sí, sin duda. Habrá algo parecido, algo del estilo "SnowFall X" o "NeoSFall", se verá con el tiempo y será adjuntado a este mismo proyecto.

###### ToniCoding - 17/06/2023 - SnowFallTFG
