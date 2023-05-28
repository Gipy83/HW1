create database hw1;
use hw1;


create table Avatar(
	id integer primary key auto_increment,
	img varchar(128),
    icon varchar(128)
);

create table User(
    id integer primary key auto_increment,
    username varchar(16), 
	email varchar(128),
    nome varchar(32),
    cognome varchar(32),
    password varchar(128),
    image integer,
    foreign key (image) references Avatar(id)
);

create table Image(
	id integer primary key auto_increment,
    src varchar(256)
);

create table catch(
	id integer,
    pokedex integer,
    pokemon varchar(32),
    type_pokemon1 varchar(32),
    type_pokemon2 varchar(32),
    move1 varchar(32),
    move2 varchar(32),
    move3 varchar(32),
    move4 varchar(32),
    type1 varchar(32),
    type2 varchar(32),
    type3 varchar(32),
    type4 varchar(32),
    img integer,
    primary key (id, pokedex),
    foreign key(img) references Image(id)
    );
    


create table Team(
	session integer,
    pokemon integer,
    primary key(session, pokemon),
    foreign key(session, pokemon) references Catch(id , pokedex)
);
