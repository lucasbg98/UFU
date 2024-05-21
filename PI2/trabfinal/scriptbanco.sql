use trabfinal;

drop database trabfinal;

insert into usuarios values ("11692036637","Danilo",123);
insert into usuarios values ("11111111111","Fulano",456);
insert into usuarios values ("22222222222","Ciclano",789);
insert into usuarios values ("33333333333","Beltrano",123);
insert into usuarios values ("44444444444","Maria",123);

select * from usuarios;


delete from usuarios where cpf="321345";

