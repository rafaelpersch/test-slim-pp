CREATE TABLE usuarios (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(256) NOT NULL DEFAULT '',
    email varchar(256) NOT NULL DEFAULT '',
    senha varchar(1024) NOT NULL DEFAULT '',
    PRIMARY KEY (id)
);

-- SELECT * FROM usuarios;
-- INSERT INTO usuarios (nome, email, senha) VALUES ('Admin', 'admin@admin.com', 'senha');
-- DELETE FROM usuarios WHERE id = 4;

CREATE TABLE tarefas (
    id int NOT NULL AUTO_INCREMENT,
    descricao varchar(256) NOT NULL DEFAULT '',
    observacao varchar(4096) NOT NULL DEFAULT '',
    PRIMARY KEY (id)
);

-- SELECT * FROM tarefas;
-- INSERT INTO tarefas (descricao) VALUES ('teste');
-- DELETE FROM tarefas WHERE id = 4;

