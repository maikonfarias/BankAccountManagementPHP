create database banco;

use banco;

create table clientes (
  id_cliente int primary key,
  nome varchar(60),
  logradouro varchar(60),
  numero varchar(8),
  cep char(8),
  data_nascimento date,
  cpf char(11),
  rg char(16)
);

create table ccorrente(
  id_cliente int,
  id_ccorrente int primary key,
  agencia int,
  numero int,
  saldo float,
  data_abertura datetime,
  foreign key (id_cliente) references clientes (id_cliente) on delete cascade
);

create table cpoupanca(
  id_cliente int,
  id_cpoupanca int primary key,
  agencia int,
  numero int,
  saldo float,
  data_aniversario date,
  data_abertura date,
  foreign key (id_cliente) references clientes (id_cliente) on delete cascade
);
