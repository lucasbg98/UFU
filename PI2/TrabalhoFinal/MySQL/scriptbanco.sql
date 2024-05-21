use trabfinal;

drop database trabfinal;

insert into perfil values ("Administrador");
insert into perfil values ("Gerente");
insert into perfil values ("Usuario");

insert into categoria values("Notebook");
insert into categoria values("Desktop");
insert into categoria values("Smartphone");
insert into categoria values("Teclado");
insert into categoria values("Mouse");
insert into categoria values("Monitor");

insert into usuarios values ("111.111.111-11","Danilo Pereira",md5("123"),"Administrador");
insert into usuarios values ("222.222.222-22","Lucas Bragança",md5("12"),"Administrador");
insert into usuarios values ("333.333.333-33","Joaquim",md5("12"),"usuario");
insert into usuarios values ("444.444.444-44","Frederico ",md5("123"),"usuario");

insert into produto (nome, preco, qtd, descricao, img, categoria_fk) VALUES ("MacBook Air","4190.00","55","O MacBook Air é um notebook Macintosh fino da Apple apresentando um disco rígido de memória sólida. O MacBook Air tem um monitor widescreen com iluminação de fundo LED de 13.3, com resolução de tela 2560 x 1600 . O MacBook Air pesa 1.25 kg, tem 1,56 cm no ponto mais espesso e 0,41 cm no mais fino.","1.jpg","Notebook");
insert into produto (nome, preco, qtd, descricao, img, categoria_fk) VALUES ("Xiaomi CC9","1650.00","452","O mouse DeathAdder, da Razer, foi desenvolvido e pensado para gamers, mas suas características servem muito bem para quem é designer, desenhista, artista etc., por sua impressionante acuidade e sensibilidade.","2.jpg","Smartphone");  
insert into produto (nome, preco, qtd, descricao, img, categoria_fk) VALUES ("iPhone 11","4249.99","183","O Apple iPhone 11 é um dos smartphones iOS mais avançados e completos que existem em circulação. Tem um grande display de 6.1 polegadas com uma resolução de 1792x828 pixel.As funcionalidades oferecidas pelo Apple iPhone 11 são muitas e inovadoras.","3.jpg","Smartphone");  
insert into produto (nome, preco, qtd, descricao, img, categoria_fk) VALUES ("Monitor LG Ultrawide 25 Polegadas","599.99","45","Desfrute de jogos de alta especificidade no grande ecrã 21:9 UltraWide Full HD (2560x1080) com uma impressionante qualidade de imagem que irão satisfazer o seu desejo de uma experiência de jogo ainda mais real e perfeita.","4.jpg","Monitor");  
insert into produto (nome, preco, qtd, descricao, img, categoria_fk) VALUES ("Mouse Razer Deathadder","320.00","152","O mouse DeathAdder, da Razer, foi desenvolvido e pensado para gamers, mas suas características servem muito bem para quem é designer, desenhista, artista etc., por sua impressionante acuidade e sensibilidade.","5.jpg","Mouse");  
insert into produto (nome, preco, qtd, descricao, img,	 categoria_fk) VALUES ("Teclado Razer BlackWindow","585.00","87","O Razer Blackwidow faz parte da nova linha de produtos Razer Chroma. Com a opção de ajuste entre 16.8 milhões de cores que podem ser sincronizadas em vários modos programados, o Razer Chroma faz com que o seu teclado acompanhe o seu estilo.","6.jpg","Teclado"); 
	
select * from perfil;
select * from usuarios;
select * from produto;	
select * from categoria;


delete from usuarios where cpf="111.111.111-11";
delete from usuarios where cpf="222.222.222-22";
delete from usuarios where cpf="333.333.333-33";

delete from produto where id=2;


UPDATE produto SET img="7.jpg" WHERE id=7;

