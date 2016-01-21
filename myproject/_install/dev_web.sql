/*------------------------------------*\
        ESTRUCTURA DE LA BD
\*------------------------------------*/
/**
 * Última revisión: Eduardo López Pardo 21-12-2015
 * -----------------------------------------
 * Contenido
 * ------------------------------------------
 * PROVINCIA...........Contiene todas las provincias, se utilizará solo en caso de que la persona sea de España
 * PERSONA.............Las personas son los padres de los clientes y de los usuarios
 * CAT_USU.............Categoría de los usuarios y precio de dicha categoría
 * USUARIO.............Hace referencia a los usuarios de la aplicación (los cuales administran la aplicación)
 * CLIENTE.............Clientes de la aplicación, personas interesadas en los servicios de la aplicación
 * CAT_SERV............Categoría de los servicios, que ofrecemos (Para poder agruparlos)
 * SERVICIO............Servicios que oferta nuestra aplicación
 * ESTADO..............Estado del proyecto
 * PROMO...............Promociones para los proyectos
 * PROYECTO............Conjunto de servicios.
 * USU_PROY............Que usuario tiene que proyecto
 * PROY_SERV...........Que servicios contiene un proyecto, en caso de existir.
 * ENTREVISTA..........Entrevista que se le hacen a los clientes, para saber que necesitan y como lo necesitan
 * CLIENT_FAV_WEB......Páginas web que le gustan a los usuarios
 * PRESUPUESTO.........Presupuesto que se le da a un cliente en base a un proyecto(que aún no existe, pero se crea)
 * TIPO_RED............Tipo de redes sociales que tenemos y/o podemos gestionar
 * RED_SOCIAL..........Que red social y de que cliente es + URL...
 * --------------------------------------------------
 * Número total de tablas: 17
 */

/* Borramos la base de datos si existe */
drop database if exists devweb;
/* Creacion de la base de datos */
create database devweb character set utf8 collate utf8_general_ci;
/* Uso de la base de datos */
use devweb;
/**
 * En caso de que el cliente esté en España
 */
/* Tabla listado de provincias */
create table provincia (
    id int(11) primary key not null,
    nombre nvarchar(50) comment 'Nombre de la provincia, no se admiten null'
);

/* Insercion de datos en la tabla provincia */
insert into provincia(id, nombre) values (0,'DESCONOCIDO');
insert into provincia(id, nombre) values (1, 'Álava');
insert into provincia(id, nombre) values (2, 'Albacete');
insert into provincia(id, nombre) values (3, 'Alacant');
insert into provincia(id, nombre) values (4, 'Almería');
insert into provincia(id, nombre) values (5, 'Ávila');
insert into provincia(id, nombre) values (6, 'Badajoz');
insert into provincia(id, nombre) values (7, 'Balears');
insert into provincia(id, nombre) values (8, 'Barcelona');
insert into provincia(id, nombre) values (9, 'Burgos');
insert into provincia(id, nombre) values (10, 'Cáceres');
insert into provincia(id, nombre) values (11, 'Cádiz');
insert into provincia(id, nombre) values (12, 'Castellon de la Plana');
insert into provincia(id, nombre) values (13, 'Ciudad Real');
insert into provincia(id, nombre) values (14, 'Cordoba');
insert into provincia(id, nombre) values (15, 'A Coruña');
insert into provincia(id, nombre) values (16, 'Cuenca');
insert into provincia(id, nombre) values (17, 'Girona');
insert into provincia(id, nombre) values (18, 'Granada');
insert into provincia(id, nombre) values (19, 'Guadalajara');
insert into provincia(id, nombre) values (20, 'Gipuzkoa');
insert into provincia(id, nombre) values (21, 'Huelva');
insert into provincia(id, nombre) values (22, 'Huesca');
insert into provincia(id, nombre) values (23, 'Jaén');
insert into provincia(id, nombre) values (24, 'Leon');
insert into provincia(id, nombre) values (25, 'Lleida');
insert into provincia(id, nombre) values (26, 'La Rioja');
insert into provincia(id, nombre) values (27, 'Lugo');
insert into provincia(id, nombre) values (28, 'Madrid');
insert into provincia(id, nombre) values (29, 'Málaga');
insert into provincia(id, nombre) values (30, 'Murcia');
insert into provincia(id, nombre) values (31, 'Navarra');
insert into provincia(id, nombre) values (32, 'Ourense');
insert into provincia(id, nombre) values (33, 'Asturies');
insert into provincia(id, nombre) values (34, 'Palencia');
insert into provincia(id, nombre) values (35, 'Las Palmas');
insert into provincia(id, nombre) values (36, 'Pontevedra');
insert into provincia(id, nombre) values (37, 'Salamanca');
insert into provincia(id, nombre) values (38, 'S.C.Tenerife');
insert into provincia(id, nombre) values (39, 'Cantabria');
insert into provincia(id, nombre) values (40, 'Segovia');
insert into provincia(id, nombre) values (41, 'Sevilla');
insert into provincia(id, nombre) values (42, 'Soria');
insert into provincia(id, nombre) values (43, 'Tarragona');
insert into provincia(id, nombre) values (44, 'Teruel');
insert into provincia(id, nombre) values (45, 'Toledo');
insert into provincia(id, nombre) values (46, 'Valencia');
insert into provincia(id, nombre) values (47, 'Valladolid');
insert into provincia(id, nombre) values (48, 'Bizkaia');
insert into provincia(id, nombre) values (49, 'Zamora');
insert into provincia(id, nombre) values (50, 'Zaragoza');
insert into provincia(id, nombre) values (51, 'Ceuta');
insert into provincia(id, nombre) values (52, 'Melilla');

/* Comprobacion de la tabla provincia */
select * from provincia;

/**
 * Los Usuarios y los clientes heredan de las personas
 */
/* Tabla para todas las personas */
create table persona(
    id          int(11) not null auto_increment comment 'identificador de la persona',
    nombre      varchar(50) not null comment 'nombre de la persona',
    apellidos   varchar(50) not null comment 'apellido/s de la persona',
    email       varchar(50) not null comment 'email de la persona',
    direccion   varchar(255) comment 'Direccion de la persona',
    provincia   int(11) comment 'FK a la provincia',
    nif         varchar(15) comment 'dni de la persona',
    habilitado  boolean not null default 1 comment 'controla si está habilitado',
    telefono    varchar(14) comment 'telefono de la persona, solo numeros espanyoles, puede ser null',
    fecha_alta  date not null comment 'fecha de registro',
    newsletter  boolean default 0 comment 'campo para saber si la persona desea recibir correos electronicos con noticias',
    unique(email),
    unique(nif),
    foreign key(provincia) references provincia(id),
    primary key (id)
);

/* Insercion de datos en la tabla persona */
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Luis", "Cavero Martínez", "luiscavero92@gmail.com", "calle esperanza Nº6", 1, "11027317M","659483002", "2000-11-10");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Daniel", "Martínez Almela", "daniel@gmail.com", "calle esperanza Nº6", 1, "51027317M","659483052", "2000-11-10");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Eduardo", "Lopez Pardo", "duardo@gmail.com", "calle esperanza Nº6", 1, "21027317M","659487002", "2000-11-10");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Emmanuel", "Valverde Ramos", "emmanuel@gmail.com", "calle esperanza Nº6", 1, "71027317M","659183602", "2000-11-10");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("David", "Valiente Martinez", "david@gmail.com", "calle esperanza Nº6", 1, "187546849M","659004685", "2000-11-10");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Jose", "Rodrigez Campos", "jose@gmail.com", "calle de serrano", 28, "78957841S","666475821", "2002-10-25");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta, habilitado) values ("Sara", "Albadalejo Navarro", "sara@gmail.com", "calle Real", 15, "45685219L","669742234", "2001-02-03",0);
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Ana", "Martinez Lopez", "ana@gmail.com", "calle Real", 15, "47812546E","678942136", "2010-06-24");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Cristina", "Martinez Martinez", "cristina@gmail.com", "calle San Pio", 30, "47872231M","621457832", "2008-10-10");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Antonio", "Pedreño Gonzalez", "antonio@gmail.com", "calle el pintor", 22, "87412356D","699588472", "2006-02-04");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta, newsletter) values ("Pedro", "Torraño Plana", "pedro@gmail.com", "calle Mistica", 11, "79846513G","639124578", "2009-01-11", 1);
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Fernando", "Martinez Soriano", "fernando@gmail.com", "calle Sicilia", 47, "78941254I","600457821", "2007-12-14");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta, newsletter) values ("Jesus", "Garrido Vazquez", "jesus@gmail.com", "calle del arco", 50, "94821354P","632412487", "2000-11-30", 1);
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Patricia", "Gomez Sanchez", "patricia@gmail.com", "calle del rio", 17, "12378954J","682179435", "2001-05-25");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("chema", "Gutierrez Blanco", "chema@gmail.com", "calle del puente", 48, "8527985M","666541226", "2006-06-06");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Ivan", "Gracia Martinez", "ivan@gmail.com", "calle huerta", 13, "79847255O","621456875", "2004-08-19");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta, habilitado) values ("Manuel", "Silvente Fernandez", "manuel@gmail.com", "calle del caudillo", 5, "72458711N","621473389", "2001-08-14", 0);
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Alberto", "Martinez Pedreño", "alberto@gmail.com", "calle plaza de españa", 29, "15975328Y","602789451", "2012-01-26");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Noelia", "Pancorbo Ruiz", "noelia@gmail.com", "calle del casco viejo", 4, "46706895F","671005891", "2003-08-18");
insert into persona (nombre, apellidos, email, direccion, provincia, nif, telefono, fecha_alta) values ("Sofia", "Martinez Rodrigez", "sofia@gmail.com", "calle de la independencia", 22, "47815620A","689236914", "2005-06-17");

/* Comprobacion de la tabla persona */
select * from persona;

/* Tabla para las categorias del usuario */
create table cat_usu(
    id int(11) not null auto_increment comment 'identificador',
    nombre varchar(50) not null comment 'nombre de la categoria del usuario',
    precio_hora decimal(6,2) not null comment 'precio por cada hora de trabajo',
    habilitado  boolean not null default 1 comment 'controla si está habilitada la categoria del usuario',
    unique(nombre),
    primary key(id)
);

/* Insercion de datos en la tabla cat_usu */
insert into cat_usu(nombre, precio_hora) values("Back - End", 20);
insert into cat_usu(nombre, precio_hora) values("Front - End", 14);
insert into cat_usu(nombre, precio_hora) values("Diseñador Gráfico", 14);
insert into cat_usu(nombre, precio_hora) values("Fotografo", 14);

/* Comprobacion de la tabla cat_usu */
select * from cat_usu;

/* Tabla para las personas que son usuarios */
create table usuario(
    id          int(11) not null comment 'identificador del usuario',
    nick        varchar(20) not null comment 'nombre de usuario elegido por la persona',
    pass        varchar(35) not null comment 'contrasenya elegida por el usuario',
    categoria   int(11) not null comment 'identificador de la categoria del usuario',
    carpeta     varchar(255) not null comment 'ruta donde se aloja la carpeta personal del usuario',
    img         varchar(255) comment 'ruta donde se aloja la imagen del usuario, puede ser null',
    unique(nick),
    foreign key(id) references persona(id) on update cascade on delete restrict,
    foreign key(categoria) references cat_usu(id) on update cascade on delete restrict,
    primary key(id)
);

/* Insercion de datos en la tabla usuario */
/* Usuario de prueba, contraseña Admin123 */
/* Usuario dan22, contraseña Moto123 */
/* Usuario quorum, contraseña Halo123*/
/* Usuario khru, contraseña Program1 */
/* Usuario painya, contraseña Pikachu */
/* Usuario shiva, contraseña Kingdom1  */
/* Usuario ryusen, contraseña  Dragon17 */
/* Usuario djayu, contraseña Captain7 */
/* Usuario random, contraseña  Random0 */
/* Usuario ranmita, contraseña Lobo00 */

insert into usuario(id, nick, pass, categoria, carpeta, img) values(1, "luilliangelux", "e64b78fc3bc91bcbc7dc232ba8ec59e0", 1, "luilliangelux", "luilliangelux/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(2, "dan22", "51a8a58a3088b51cd6bb066c827ee350", 2, "dan22", "dan22/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(3, "quorum", "9956fd0be981185585a7adb49fabce31", 1, "quorum", "quorum/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(4, "khru", "fbe9f959391eedd88aebd5e4729c36b3", 1, "khru", "khru/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(5, "painya", "4b576e26f68e1a0a5792019088bd0442", 2, "painya", "painya/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(9, "shiva", "4714b3acb7f29549a3e52349372547f8", 3, "shiva", "shiva/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(10, "ryusen", "4f94075173838a42ae4ef7524d73f433", 2, "ryusen", "ryusen/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(15, "djayu", "d202ecb6f02c69a21870f034a3c62da1", 4, "djayu", "djayu/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(18, "random", "4fd523215fa68cf01e4e7a73e885c4bb", 3, "random", "random/img/perfil.png");
insert into usuario(id, nick, pass, categoria, carpeta, img) values(20, "ranmita", "9a99722c82cc3fccc828572abd2d8593", 1, "ranmita", "ranmita/img/perfil.png");


/* Comprobacion de la tabla usuario */
select * from usuario;

/* Tabla para las personas que son clientes */
create table cliente(
    id int(11) not null comment 'identificador del cliente',
    nombre_corporativo varchar(255) not null comment 'Nombre de la empresa',
    foreign key(id) references persona(id) on update cascade on delete restrict,
    unique(nombre_corporativo),
    primary key(id)
);

/* Insercion de datos para los clientes */
insert into cliente(id, nombre_corporativo) values (6, "Perros S.L");
insert into cliente(id, nombre_corporativo) values (7, "Gatos S.L");
insert into cliente(id, nombre_corporativo) values (8, "Hermanos Condor S.L");
insert into cliente(id, nombre_corporativo) values (9, "Mecanicos Neumatico S.L");
insert into cliente(id, nombre_corporativo) values (12, "ferreteria Tornillo S.L");
insert into cliente(id, nombre_corporativo) values (13, "Autoescuela Volante");
insert into cliente(id, nombre_corporativo) values (14, "Pizzerias Italianos S.L");
insert into cliente(id, nombre_corporativo) values (16, "Librerias Dante S.L");
insert into cliente(id, nombre_corporativo) values (15, "Peluquerias Cabello S.L");
insert into cliente(id, nombre_corporativo) values (19, "Funeraria Muerto S.L");


/* Comprobacion de la tabla cliente */
select * from cliente;

/* Tabla para las categorias de los servicios */
create table cat_serv(
    id int(11) not null auto_increment comment 'identificador de la categoria a la que pertenece el servicio',
    descripcion varchar(255) not null comment 'descripcion de la categoria del servicio',
    habilitado  boolean not null default 1 comment 'controla si está habilitada la categoría',
    primary key(id)
);

/* Insercion de datos en la tabla cat_serv */
insert into cat_serv(descripcion) values ("Basado en plantilla");
insert into cat_serv(descripcion) values ("Basado a mano");

/* Comprobacion de la tabla cat_serv */
select * from cat_serv;

/* Tabla para los servicios que se ofertan */
create table servicio(
    id          int(11) not null auto_increment comment 'identificador del servicio que se realiza',
    nombre      varchar(50) not null comment 'nombre del servicio a realizar',
    categoria   int(11) not null comment 'tipo de categoria del servicio ej: pag web facil, profesional...',
    tiempo_estimado int(10) comment 'tiempo estimado en horas para realizar ese servicio, puede ser null',
    precio      decimal(10,2) not null comment 'precio del servicio',
    descripcion varchar(255) not null comment 'descripcion del servicio',
    habilitado  boolean not null default 1 comment 'controla si está habilitado el servicio',
    foreign key(categoria) references cat_serv(id) on update cascade on delete restrict,
    primary key(id)
);

/* Insercion de datos en la tabla servicio */
insert into servicio(nombre, categoria, tiempo_estimado, descripcion, precio) values ("mantenimiento", 1, 23, "Mantenimiento de una pagina web",2000);
insert into servicio(nombre, categoria, tiempo_estimado, descripcion, precio) values ("creacion", 2, 30, "Creacion de una pagina web",2500);


/* Comprobacion de la tabla servicio */
select * from servicio;

/* Tabla para las promociones */
create table promo(
    id           int(11) not null auto_increment comment 'identificador de la promocion',
    codigo       varchar(15) not null comment 'codigo de la promocion',
    descripcion  varchar(255) not null comment 'descripcion de la promocion que se trata',
    unidades     int(5) comment 'unidades totales disponibles de esa promocion',
    porcentaje   decimal(6,2) not null comment 'porcentaje de descuento que se aplica',
    fecha_inicio date not null comment 'fecha en la que se inicia la promocion',
    fecha_fin    date comment 'fecha en la que finaliza la promocion',
    habilitado   boolean not null default 1 comment 'controla si está habilitada la promocion',
    unique(codigo),
    primary key(id)
);

/* Insercion de datos en la tabla promo */
insert into promo(codigo, descripcion, unidades, porcentaje, fecha_inicio) values ('A42VDFGPO841', 'Se reduce en un 10% el precio del mantenimiento durante 2 meses', 6, 10, '2015-06-06');
insert into promo(codigo, descripcion, unidades, porcentaje, fecha_inicio) values ('A317RTDP75S2', 'Se reduce en un 20% el precio de creacion de una segunda pagina web', 10, 20, '2015-06-06');
insert into promo(codigo, descripcion, unidades, porcentaje, fecha_inicio) values ('A21TY8745S66', 'Se reduce en un 15% el precio del mantenimiento contratado por 3 años', 30, 15, '2015-09-09');
insert into promo(codigo, descripcion, porcentaje, fecha_inicio, habilitado) values ('A877RAC47FF2', 'Se reduce en un 15% el precio del mantenimiento durante 3 meses', 15, '2015-03-06', 0);
insert into promo(codigo, descripcion, porcentaje, fecha_inicio, fecha_fin) values ('78954GDSS87A', 'Se reduce en un 30% la contratacion de creacion+mantenimiento', 30, '2015-06-06', '2018-06-06');


/* Comprobacion de la tabla promo */
select * from promo;

/* Tabla para el estado de los proyectos */
create table estado(
    id int(11) not null auto_increment comment 'identificador del estado',
    descripcion varchar(255) comment 'descripcion del estado del proyecto',
    habilitado  boolean not null default 1 comment 'controla si está habilitada la categoría',
    unique(descripcion),
    primary key(id)
);

/* Insercion de datos en la tabla estado */
insert into estado(descripcion) values ("no confirmado");
insert into estado(descripcion) values ("confirmado");
insert into estado(descripcion) values ("en proceso");
insert into estado(descripcion) values ("finalizado");
insert into estado(descripcion) values ("mantenimiento");
insert into estado(descripcion) values ("desconocido");

/* Comprobacion de la tabla estado */
select * from estado;

/* Tabla para los proyectos que se realicen */
create table proyecto(
    id             int(11) not null auto_increment comment 'identificador del trabajo que se ha realizado o esta por realizar',
    cliente        int(11) not null comment 'identificador del cliente que pide el proyecto',
    promocion      int(11) comment 'identificador de la promocion si la tiene',
    fecha_inicio   date not null comment 'fecha en la que se inicia el trabajo/proyecto',
    fecha_fin      date comment 'fecha en la que se ha finalizado el proyecto',
    fecha_prevista date not null comment 'fecha prevista de finalizacion del proyecto',
    estado         int(11) default 2 not null comment 'controla el estado del proyecto',
    habilitado     boolean not null default 1 comment 'controla si está habilitado el proyecto',
    foreign key(cliente) references cliente(id) on update cascade on delete restrict,
    foreign key(estado) references estado(id) on update cascade on delete restrict,
    foreign key(promocion) references promo(id) on update cascade on delete restrict,
    primary key(id)
);

/* Insercion de datos en la tabla proyecto */
insert into proyecto(cliente, promocion, fecha_inicio, fecha_fin, fecha_prevista , estado) values (6, 4, "2000-12-10", "2001-01-12", "2001-02-01", 1);
insert into proyecto(cliente, promocion, fecha_inicio, fecha_fin, fecha_prevista , estado, habilitado) values (7, 3, "2003-12-10", "2004-01-12", "2001-02-01", 1, 0);
insert into proyecto(cliente, fecha_inicio, fecha_prevista , estado) values (8, "2015-12-10", "2016-02-19", 3);
insert into proyecto(cliente, fecha_inicio, fecha_fin, fecha_prevista , estado) values (12, "2001-12-22", "2002-01-12", "2002-02-10", 2);
insert into proyecto(cliente, promocion, fecha_inicio, fecha_fin, fecha_prevista , estado) values (12, 2, "2000-12-10", "2001-04-22", "2001-04-24", 4);
insert into proyecto(cliente, fecha_inicio, fecha_fin, fecha_prevista , estado) values (13, "2002-8-03", "2002-10-10", "2001-09-27", 5);
insert into proyecto(cliente, fecha_inicio, fecha_fin, fecha_prevista , estado, habilitado) values (14, "2007-01-04", "2007-03-01", "2007-03-05", 1, 0);
insert into proyecto(cliente, fecha_inicio, fecha_fin, fecha_prevista , estado) values (16, "2005-12-11", "2005-01-12", "2005-02-01", 2);
insert into proyecto(cliente, fecha_inicio, fecha_fin, fecha_prevista , estado) values (19, "2009-09-09", "2009-10-09", "2009-10-19", 4);
insert into proyecto(cliente, fecha_inicio, fecha_prevista , estado) values (19, "2016-01-10", "2016-03-22", 3);



/* Comprobacion de la tabla proyecto */
select * from proyecto;


/* Tabla para los usuarios que han trabajado en diferentes proyectos */
create table usu_proy(
    usuario     int(11) not null comment 'identificador del usuario que realiza el proyecto',
    proyecto    int(11) not null comment 'identificador del proyecto en el que trabaja el usuario',
    foreign key(usuario) references usuario(id) on update cascade on delete restrict,
    foreign key(proyecto) references proyecto(id) on update cascade on delete restrict,
    primary key(usuario, proyecto) comment 'un usuario solo puede participar una vez en un proyecto'
);

/* Insercion de datos en la tabla usu_proy */
insert into usu_proy(usuario, proyecto) values (1, 1);
insert into usu_proy(usuario, proyecto) values (2, 2);
insert into usu_proy(usuario, proyecto) values (3, 3);
insert into usu_proy(usuario, proyecto) values (4, 4);
insert into usu_proy(usuario, proyecto) values (5, 5);
insert into usu_proy(usuario, proyecto) values (10, 6);
insert into usu_proy(usuario, proyecto) values (10, 7);
insert into usu_proy(usuario, proyecto) values (4, 8);
insert into usu_proy(usuario, proyecto) values (2, 9);
insert into usu_proy(usuario, proyecto) values (5, 10);


/* Comprobacion de la tabla usu_proy */
select * from usu_proy;

/* Tabla para los servicios que contiene cada proyecto */
create table proy_serv(
    proyecto    int(11) not null comment 'identificador del proyecto',
    servicio    int(11) not null comment 'identificador del proyecto',
    foreign key(proyecto) references proyecto(id) on update cascade on delete restrict,
    foreign key(servicio) references servicio(id) on update cascade on delete restrict,
    primary key(proyecto, servicio)
);

/* Insercion de datos en la tabla proy_serv */
insert into proy_serv(proyecto, servicio) values (1, 1);
insert into proy_serv(proyecto, servicio) values (1, 2);
insert into proy_serv(proyecto, servicio) values (2, 1);
insert into proy_serv(proyecto, servicio) values (3, 2);
insert into proy_serv(proyecto, servicio) values (4, 1);
insert into proy_serv(proyecto, servicio) values (5, 1);
insert into proy_serv(proyecto, servicio) values (6, 1);
insert into proy_serv(proyecto, servicio) values (7, 1);
insert into proy_serv(proyecto, servicio) values (7, 2);
insert into proy_serv(proyecto, servicio) values (8, 1);
insert into proy_serv(proyecto, servicio) values (9, 1);
insert into proy_serv(proyecto, servicio) values (10, 2);


/* Comprobacion de la tabla proy_serv */
select * from proy_serv;

/* Tabla para las entrevistas que se realizan a clientes */
create table entrevista(
    id         int(11) not null auto_increment comment 'identificador de la entrevista',
    usuario    int(11) not null comment 'identificador del usuario que ha realizado la entrevista',
    cliente    int(11) not null comment 'identificador del cliente al que se ha entrevistado',
    conclusion text not null comment 'conclusiones que se han sacado despues de la entrevista',
    proyecto   int(11) not null comment 'proyecto asociado',
    fecha      date not null comment 'fecha en la que se ha realizado la entrevista',
    habilitado  boolean not null default 1 comment 'controla si está habilitada la entrevista o cancelada',
    foreign key(proyecto) references proyecto(id) on update cascade on delete restrict,
    foreign key(usuario) references usuario(id) on update cascade on delete restrict,
    foreign key(cliente) references cliente(id) on update cascade on delete restrict,
    primary key(id)
);

/* Insercion de datos en la tabla entrevista */
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (1, 6, 'Proyecto aun por confirmar', 1, '2015-06-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (1, 7, 'Proyecto no habilitado, el cliente aun no tiene claro que quiere', 2, '2015-06-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (2, 8, 'Proyecto en proceso, todo va segun quiere el cliente', 3, '2015-07-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (2, 13, 'Proyecto confirmado', 4, '2015-07-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (3, 12, 'Proyecto finalizado, Todo conforme', 5, '2015-08-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (3, 13, 'Proyecto en mantenimiento', 6, '2015-08-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (4, 14, 'Proyecto aun por confirmar, cliente indeciso', 7, '2015-09-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (4, 16, 'Proyecto confirmado', 8, '2015-09-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha) values (3, 19, 'Proyecto finalizado, sin quejas del cliente', 9, '2015-10-09');
insert into entrevista(usuario, cliente, conclusion, proyecto, fecha, habilitado) values (5, 19, 'entrevista cancelada', 10, '2015-10-09',0);


/* Comprobacion de la tabla entrevista */
select * from entrevista;

/* Tabla para las webs que cada cliente tiene de referencia */
create table client_fav_web(
    id      int(11) not null auto_increment comment 'identificador de la url',
    cliente int(11) not null comment 'identificador del cliente en la que se ha dado esa url',
    url     varchar(255) not null comment 'direccion url de las paginas webs que le gustan al cliente',
    habilitado  boolean not null default 1 comment 'controla si está habilitada la web favorita del cliente',
    foreign key(cliente) references cliente(id) on update cascade on delete restrict,
    primary key(id)
);

/* Insercion de datos en la tabla client_fav_web */
insert into client_fav_web(cliente, url) values (6, "javadesdecero.esy.es");
insert into client_fav_web(cliente, url) values (6, "youtube.com");
insert into client_fav_web(cliente, url) values (7, "laopinion.es");
insert into client_fav_web(cliente, url) values (8, "wikipedia.org");
insert into client_fav_web(cliente, url) values (8, "youtube.com");
insert into client_fav_web(cliente, url) values (8, "facebook.com");
insert into client_fav_web(cliente, url) values (12, "php.net");
insert into client_fav_web(cliente, url) values (12, "hostinger.es");
insert into client_fav_web(cliente, url) values (13, "w3schools.com");
insert into client_fav_web(cliente, url) values (13, "www.youtube.com");
insert into client_fav_web(cliente, url) values (14, "phpya.com.ar");
insert into client_fav_web(cliente, url) values (16, "hostinger.com");
insert into client_fav_web(cliente, url) values (16, "cssya.com.ar");
insert into client_fav_web(cliente, url) values (15, "php.net");
insert into client_fav_web(cliente, url) values (15, "wikipedia.org");
insert into client_fav_web(cliente, url) values (19, "youtube.com");


/* Comprobacion de la tabla client_fav_web */
select * from client_fav_web;

/* Tabla para los presupuestos pedidos por un cliente o futuro cliente */
create table presupuesto(
    id                int(11) not null auto_increment comment 'identificador del presupuesto',
    usuario           int(11) not null comment 'identificador del usuario que lo ha presupuestado',
    proyecto          int(11) comment 'identificador del proyecto',
    precio_estimado   decimal(10,2) not null comment 'precio estimado en euros del presupuesto',
    fecha_presupuesto date not null comment 'fecha en la que se ha realizado el presupuesto',
    habilitado        boolean not null default 1 comment 'controla si está habilitado el proyecto',
    foreign key(usuario) references usuario(id) on update cascade on delete restrict,
    foreign key(proyecto) references proyecto(id) on update cascade on delete restrict,
    primary key(id)
);

/* Insercion de datos en la tabla presupuesto */
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (1, 1, 4500, "2000-12-12");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (2, 2, 2000, "2003-01-11");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (3, 3, 2500, "2015-12-12");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (4, 4, 2000, "2001-02-14");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (5, 5, 2000, "2000-03-01");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (10, 6, 2000, "2002-05-27");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (10, 7, 4500, "2007-03-07");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (1, 8, 2000, "2005-01-12");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (18, 9, 2000, "2009-02-12");
insert into presupuesto(usuario, proyecto, precio_estimado, fecha_presupuesto) values (20, 10, 2500, "2016-01-01");

/* Comprobacion de la tabla presupuesto */
select * from presupuesto;

/* Tabla para los tipos de red social que almacenaremos */
create table tipo_red(
 id     int(11) not null auto_increment comment 'identificador del tipo de red social',
 nombre varchar(50) not null comment 'nombre de la red social',
 habilitado  boolean not null default 1 comment 'controla si está habilitado el tipo de red',
 unique(nombre),
 primary key(id)
);

/* Insercion de datos en la tabla tipo_red */
insert into tipo_red (nombre) values ('github');
insert into tipo_red (nombre) values ('facebook');
insert into tipo_red (nombre) values ('twitter');
insert into tipo_red (nombre) values ('linkedin');
insert into tipo_red (nombre) values ('pinterest');
insert into tipo_red (nombre) values ('instagram');

/* Comprobacion de la tabla tipo_red */
select * from tipo_red;

/* Tabla para las redes sociales pertenecientes a personas */
create table red_social(
 id         int(11) not null auto_increment comment 'identificador de la red social',
 tipo_red   int(11) not null comment 'identificador del tipo red (facebook, twitter...)',
 url        varchar(255) not null comment 'direccion url de dicha red social',
 persona    int(11) not null comment 'identificador de la persona propietaria de la red social',
 habilitado  boolean not null default 1 comment 'controla si está habilitada la red social del cliente',
 unique(tipo_red, persona) comment 'no puede haber un cliente con dos facebook por ejemplo',
 foreign key(tipo_red) references tipo_red(id) on update cascade on delete restrict,
 foreign key(persona) references persona(id) on update cascade on delete restrict,
 primary key(id)
);

/* Insercion de datos en la tabla red_social */
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/luilliangelux", 1);
insert into red_social(tipo_red, url, persona) values (6, "www.instagram.com/luilliangelux", 1);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/dan22", 2);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/quorum", 3);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/khru", 4);
insert into red_social(tipo_red, url, persona) values (1, "www.github.com/khru", 4);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/painya", 5);
insert into red_social(tipo_red, url, persona) values (3, "www.twitter.com/painya", 5);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/jose", 6);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/sara", 7);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/ana", 8);
insert into red_social(tipo_red, url, persona) values (4, "www.linkedin.com/ana", 8);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/shiva", 9);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/ryusen", 10);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/pedro", 11);
insert into red_social(tipo_red, url, persona) values (6, "www.instagram.com/pedro", 11);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/fernando", 12);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/jesus", 13);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/patricia", 14);
insert into red_social(tipo_red, url, persona) values (5, "www.pinterest.com/patricia", 14);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/djayu", 15);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/ivan", 16);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/manuel", 17);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/random", 18);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/noelia", 19);
insert into red_social(tipo_red, url, persona) values (3, "www.twitter.com/noelia", 19);
insert into red_social(tipo_red, url, persona) values (6, "www.instagram.com/noelia", 19);
insert into red_social(tipo_red, url, persona) values (2, "www.facebook.com/ranmita", 20);

/* Comprobacion de la tabla red_social */
select * from red_social;

/*Tabla para los artículo*/
create table articulo(
    id int(5) not null auto_increment,
    titulo varchar(100) not null,
    cuerpo text not null,
    url varchar(100) not null,
    fecha_publicacion datetime not null,
    unique(titulo),
    unique(url),
    primary key(id)
);
/*Inserción de los datos en la tabla artículo*/
insert into articulo(titulo, cuerpo, url, fecha_publicacion) values ("¡Precios por los suelos!", "¡Nueva promoción! Se reduce en un 10% el precio del mantenimiento durante 2 meses", "precios-por-los-suelos", "2012-10-10 13:20:25");
insert into articulo(titulo, cuerpo, url, fecha_publicacion) values ("¡Precios de escándalo!", "¡Nueva promoción! Se reduce en un 30% la contratacion de creacion+mantenimiento", "precios-de-esc-ndalo", "2011-11-05 10:20:25");
insert into articulo(titulo, cuerpo, url, fecha_publicacion) values ("¡Nueva plantilla: Dark Essence!", "¡Nueva plantilla! ¡Pide ahora la nueva plantilla y con descuento!", "nueva-plantilla--dark-essence", "2012-10-10 13:20:25");
insert into articulo(titulo, cuerpo, url, fecha_publicacion) values ("¡Precios Increibles!", "¡Nueva promoción! Se reduce en un 15% el precio del mantenimiento contratado por 3 años", "precios-increibles", "2010-10-10 13:10:25");



 /**
  *  _
  * | |                    _
  * | |                   |_|  _______
  * | |          _     _   _  |  _____|
  * | |         | |   | | | | | |_____
  * | |         | |   | | | | |_____  |
  * | |________ | |___| | | |  _____| |
  * |__________||_______| |_| |_______|
  *
  *    _____
  *   /  _  \    _   _                      _
  *  /  / \  \  | | | |                   _| |_
  * |  |   |  | | | | |                  |_   _|
  * |  |___|  | | | | |___    ____   _____ | |  _____
  * |   ___   | | | |  __ \  / __ \ |  __/ | | |  _  |
  * |  |   |  | | | | |__| ||  ___/ | |    | | | |_| |
  * |__|   |__| |_| |_____/  \____/ |_|    |_| |_____|
  *
  *  __________
  * |  ________|       _
  * | |               | |
  * | |____           | |  _     _
  * |  ____|       ___| | | |   | |
  * | |           / __  | | |   | |
  * | |________  | |__| | | |___| |
  * |__________|  \_____| |_______|
  *
  *  _______
  * |  ____ \                     __
  * | |    \ \                   |__|
  * | |     \ |   ___    __    _  __
  * | |     | |  / _ \  | \\  | ||  |
  * | |     / | | |_| | | |\\ | ||  |
  * | |____/ /  |  _  | | | \\| ||  |
  * |_______/   |_| |_| |_|  \\_||__|
  *
  *  _______
  * |  ____ \                      __        _
  * | |    \ \                    |__|      | |
  * | |     \ |   ___    _     _   __       | |
  * | |     | |  / _ \  | |   | | |  |   ___| |
  * | |     / | | |_| | | \   / | |  |  / __  |
  * | |____/ /  |  _  |  \ \_/ /  |  | | |__| |
  * |_______/   |_| |_|   \___/   |__|  \_____|
  *
  *  _       _
  * | \     / |
  * |  \   /  |
  * |   \_/   |   ___    __    _  _     _
  * | |\   /| |  / _ \  | \\  | || |   | |
  * | | \_/ | | | |_| | | |\\ | || |   | |
  * | |     | | |  _  | | | \\| || |___| |
  * |_|     |_| |_| |_| |_|  \\_||_______|
  *
  */
