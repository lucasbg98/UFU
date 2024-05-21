ALTER TABLE perfil
	add column origin varchar(100) NOT NULL;

UPDATE perfil
set origin = "web"
where id != 0;

INSERT INTO perfil(descricao, permissao, origin)
VALUES
	("Agrônomo", "0000000000", "app"),
	("Agricultor", "0000000000", "app"),
	("Estudante", "0000000000", "app"),
	("Pesquisador", "0000000000", "app"),
	("Representante Comercial", "0000000000", "app"),
	("Outro", "0000000000", "app");


CREATE TABLE app_user(
  id varchar(32) not null,
  nome varchar(255) not null,
  email varchar(255) not null unique,
  cidade varchar(255) not null,
  uf varchar(255) not null,
  criado_em datetime default CURRENT_TIMESTAMP,
  atualizado_em datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  perfil_id int not null,
  primary key (id),
  foreign key (perfil_id) references perfil(id)
);

DELIMITER //
CREATE TRIGGER app_user_before_insert
BEFORE INSERT ON app_user FOR EACH ROW
BEGIN
  SET NEW.id = MD5(CURRENT_TIMESTAMP);
END;
//
DELIMITER ;


create table log(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    request varchar(1000) NOT NULL,
    response varchar(1000) NOT NULL,
    user_id varchar(32) NOT NULL,
    criado_em datetime default CURRENT_TIMESTAMP
);
