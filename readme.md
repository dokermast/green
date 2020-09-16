*********************************************************** CRUD test
This application has two Entyties (Field & Product)  /for Agricultures/

Every Fields may has several products

Every Product may grows on the several fields

This is the "ManyToMany" relation

****** INSTALLATION

git clone https://github.com/dokermast/green.git

cd (dir)

composer install

create DB

export green.sql from DB_DUMP

create & configure .env (db config, key, mailer ...)

run application

your may log in using default credentials  ( user@user.com  : User1234 )  or register yourself
