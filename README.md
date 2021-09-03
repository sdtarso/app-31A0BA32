# Desafio Técnico Full-stack Appmax

## About

This is a simples API without authentication, with test purpose only

## Tables

Essentially, there are 2 tables, the product table itself and the log table, which store each modification made to each product, both tables have soft-delete columns

### Table structures

#### Product

| Column | Type | Not Nullable | Auto Increment | Key | Default | Extra | Expression | Commentary |
|---|---|---|---|---|---|---|---|---|
| product_id | bigint unsigned | true | true | PRI | [NULL] | auto_increment |  |  |
| pro_name | varchar(255) | true | false | [NULL] | [NULL] |  |  |  |
| pro_sku | varchar(255) | true | false | UNI | [NULL] |  |  |  |
| pro_quantity | int | true | false | [NULL] | [NULL] |  |  |  |
| created_at | timestamp | false | false | [NULL] | [NULL] |  |  |  |
| updated_at | timestamp | false | false | [NULL] | [NULL] |  |  |  |
| deleted_at | timestamp | false | false | [NULL] | [NULL] |  |  |  |

#### Product Log

| Column | Type | Not Nullable | Auto Increment | Key | Default | Extra | Expression | Commentary |
|---|---|---|---|---|---|---|---|---|
| product_id | bigint unsigned | true | true | PRI | [NULL] | auto_increment |  |  |
| pro_name | varchar(255) | true | false | [NULL] | [NULL] |  |  |  |
| pro_sku | varchar(255) | true | false | UNI | [NULL] |  |  |  |
| pro_quantity | int | true | false | [NULL] | [NULL] |  |  |  |
| created_at | timestamp | false | false | [NULL] | [NULL] |  |  |  |
| updated_at | timestamp | false | false | [NULL] | [NULL] |  |  |  |
| deleted_at | timestamp | false | false | [NULL] | [NULL] |  |  |  |

## Endpoint availables

Check [this link](https://documenter.getpostman.com/view/2482189/U16eunbX) for full API documentation

## Project requirements

This project was developed within this enviroment

1. ubuntu20.04.1+deb
1. PHP 7.3.30
1. mysql  Ver 8.0.26
1. laravel/framework 8.54
