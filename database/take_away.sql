pragma foreign_keys=ON;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS owners;
DROP TABLE IF EXISTS drivers;
DROP TABLE IF EXISTS favourite_restaurants;
DROP TABLE IF EXISTS favourite_dishes;
DROP TABLE IF EXISTS restaurants;
DROP TABLE IF EXISTS dishes;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS dishes_in_orders;


CREATE TABLE users (
    id_user INTEGER PRIMARY KEY,
    username VARCHAR UNIQUE,
    password VARCHAR NOT NULL,
    email VARCHAR NOT NULL UNIQUE,
    address VARCHAR,
    phone INTEGER,
    nif INTEGER,
    photo VARCHAR DEFAULT '../images/default/user.png'
);

-- Different types of users
CREATE TABLE customers (
    id_user INTEGER PRIMARY KEY REFERENCES users
);
CREATE TABLE owners (
    id_user INTEGER PRIMARY KEY REFERENCES users
);
CREATE TABLE drivers (
    id_user INTEGER PRIMARY KEY REFERENCES users,
    registration VARCHAR NOT NULL
);
--------------------------------------

CREATE TABLE favourite_restaurants (
    id_user INTEGER REFERENCES customers,
    id_restaurant INTEGER REFERENCES restaurants
);
CREATE TABLE favourite_dishes (
    id_user INTEGER REFERENCES customers,
    id_dish INTEGER REFERENCES dishes
);

CREATE TABLE restaurants (
    id_restaurant INTEGER PRIMARY KEY,
    id_owner INTEGER REFERENCES owners,
    name VARCHAR UNIQUE NOT NULL,
    address VARCHAR UNIQUE NOT NULL,
    info VARCHAR,
    photo VARCHAR DEFAULT '../images/default/restaurant.jpg',
    category VARCHAR NOT NULL,
    score INTEGER,
    CHECK (category IN ('Asiática','Churrasqueira', 'Fast food', 'Gourmet', 'Tradicional','Snacks', 'Pastelaria', 'Vegetariano'))
);

CREATE TABLE dishes (
    id_dish INTEGER PRIMARY KEY,
    id_restaurant INTEGER REFERENCES restaurants,
    name VARCHAR NOT NULL,
    price INTEGER NOT NULL,
    photo VARCHAR DEFAULT '../images/default/dish.png'
);

CREATE TABLE reviews (
    id INTEGER PRIMARY KEY,
    id_restaurant INTEGER REFERENCES restaurants,
    id_user INTEGER REFERENCES users,
    score INTEGER NOT NULL,
    texto VARCHAR,
    published TEXT NOT NULL,
    CHECK (score >=0 AND score<=5)
);

CREATE TABLE orders (
    id_order INTEGER PRIMARY KEY,
    id_user INTEGER REFERENCES customers,
    id_restaurant INTEGER REFERENCES restaurants,
    id_driver INTEGER REFERENCES drivers,
    total INTEGER NOT NULL,
    state VARCHAR NOT NULL,
    CHECK (state IN ('Received', 'Preparing', 'Ready', 'Delivered'))
);

CREATE TABLE dishes_in_orders (
    id INTEGER PRIMARY KEY,
    id_order INTEGER REFERENCES orders,
    id_dish INTEGER REFERENCES dishes,
    n_dish INTEGER NOT NULL
);



-- VALUES
-- password: 1234 -> 7110eda4d09e062aa5e4a390b0a572ac0d2c0220

-- 1
INSERT INTO users (username, password, email, phone) VALUES ('tiagotunes', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201805327@edu.fc.up.pt', 910239456);
INSERT INTO customers (id_user) VALUES (1);
INSERT INTO owners (id_user) VALUES (1);
-- 2
INSERT INTO users (username, password, email, address, phone) VALUES ('bernardopires', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201807827@edu.fc.up.pt', 'Rua Augusto Brazao Nº349', 910986456);
INSERT INTO customers (id_user) VALUES (2);
INSERT INTO owners (id_user) VALUES (2);
-- 3
INSERT INTO users (username, password, email, phone, nif) VALUES ('ruirodrigues', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201702327@edu.fc.up.pt', 960269426, 736079233);
INSERT INTO customers (id_user) VALUES (3);
INSERT INTO owners (id_user) VALUES (3);
-- 4
INSERT INTO users (username, password, email, address, phone, nif) VALUES ('vitorlemos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up20142397@edu.fc.up.pt', 'Rua Augusto Gil 234', 960265426, 567489333);
INSERT INTO customers (id_user) VALUES (4);
INSERT INTO owners (id_user) VALUES (4);
-- 5
INSERT INTO users (username, password, email, phone , nif) VALUES ('paulosa', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201704123@edu.fc.up.pt', 960269951, 467827354);
INSERT INTO customers (id_user) VALUES (5);
INSERT INTO owners (id_user) VALUES (5);
-- 6
INSERT INTO users (username, password, email, phone, nif) VALUES ('zeferrao', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201801234@edu.fc.up.pt', 923269426, 987538282);
INSERT INTO customers (id_user) VALUES (6);
INSERT INTO owners (id_user) VALUES (6);
-- 7
INSERT INTO users (username, password, email, nif) VALUES ('alexafonso', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201805455@edu.fc.up.pt', 123456789);
INSERT INTO customers (id_user) VALUES (7);
-- 8
INSERT INTO users (username, password, email, nif ) VALUES ('antoniosantos', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201907176@edu.fc.up.pt',234567134);
INSERT INTO customers (id_user) VALUES (8);
-- 9
INSERT INTO users (username, password, email, nif) VALUES ('Jose Paulo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201807175@edu.fc.up.pt',765890123);
INSERT INTO customers (id_user) VALUES (9);
INSERT INTO drivers (id_user, registration) VALUES (9, '12-AB-34');
--10
INSERT INTO users (username, password, email, nif) VALUES ('Pedro Pinto', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201804275@edu.fc.up.pt',765890345);
INSERT INTO customers (id_user) VALUES (10);
INSERT INTO drivers (id_user, registration) VALUES (10, '25-12-PH');
--11
INSERT INTO users (username, password, email, nif) VALUES ('Rui Dias', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up202007175@edu.fc.up.pt',672890123);
INSERT INTO customers (id_user) VALUES (11);
INSERT INTO drivers (id_user, registration) VALUES (11, '40-AA-04');
--12
INSERT INTO users (username, password, email, nif) VALUES ('Tó Esteves', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'up201986175@edu.fc.up.pt',765285123);
INSERT INTO customers (id_user) VALUES (12);
INSERT INTO drivers (id_user, registration) VALUES (12, '90-CT-12');


-- 1
INSERT INTO restaurants (id_owner, name, address, photo, category) VALUES (1,'McDonalds Boavista','Av. da Boavista 1745', '../images/restaurants/1.png','Fast food');
-- 2
INSERT INTO restaurants (id_owner, name, address, info, photo, category) VALUES (2,'h3','Estrada da Circunvalação 12700', 'Entrando directo no assunto da comida. Os nossos hambúrgueres têm 200g de pura carne. São grelhados (e não chapados ou prensados) no ponto escolhido, com sal marinho, puro por grelhadores diplomados e aprovados em 72 parâmetros na Escola de grelha h3. E por fim, servidos em pratos aquecidos, ou no pão, para comer de garfo e faca de metal.', '../images/restaurants/2.png', 'Fast food');
-- 3
INSERT INTO restaurants (id_owner, name, address, info, photo, category) VALUES (3,'Brasaria','Rua da Prelada 123', 'A marca Brasaria surge na cidade invicta como um novo conceito da churrascaria tradicional. A decoração intimista e a carta inovadora aliam-se à experiência e profissionalismo do grupo Central Churrasco.' , '../images/restaurants/3.png','Churrasqueira');
-- 4
INSERT INTO restaurants (id_owner, name, address, info, photo, category) VALUES (4,'Boa-Bao',' Rua da Picaria 61 65', 'Através da nossa comida asiática, cocktails & ambiente, convidamo-lo a aventurar-se connosco numa inesquecível viagem pela Ásia.' , '../images/restaurants/4.png', 'Asiática');
-- 5
INSERT INTO restaurants (id_owner, name, address, photo, category) VALUES (5,'bbGourmet','Rua de Cedofeita 377 379 ', '../images/restaurants/5.png', 'Gourmet');
-- 6
INSERT INTO restaurants (id_owner, name, address, photo, category) VALUES (6,'O Pote Velho','Rua de Domingos Machado 273', '../images/restaurants/6.jpeg', 'Tradicional');
-- 7
INSERT INTO restaurants (id_owner, name, address, photo, category) VALUES (2,'Nova Real','Rua da Prelada Nr 132','../images/restaurants/7.jpeg', 'Pastelaria');
-- 8
INSERT INTO restaurants (id_owner, name, address, info, photo, category) VALUES (4,'Honest Greens','Rua de Santa Catarina 184', 'Conceito de comida saudável com opções para todas as dietas, keto, plant-based e vegetariana, opções gluten free e sem açúcares refinados nem conservantes artificiais. Para garantir a máxima frescura e a sustentabilidade, a marca Honest Greens promove, ainda, uma agricultura sustentável, respeitando a Natureza e apostando na vertente orgânica, sempre que possível, mas mantendo os preços acessíveis.', '../images/restaurants/8.png', 'Vegetariano');
-- 9
INSERT INTO restaurants (id_owner, name, address, category) VALUES (4,'Stop-Bar','Rua do Tenente Valadim 553', 'Snacks');

--McDonalds
INSERT INTO dishes (id_restaurant, name, price) VALUES (1, 'BigMac', 6.50);                                         -- 1
INSERT INTO dishes (id_restaurant, name, price) VALUES (1, 'CBO', 7.90);
INSERT INTO dishes (id_restaurant, name, price) VALUES (1, 'BigTasty', 8.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (1, 'CheeseBurguer', 2.50);
--H3
INSERT INTO dishes (id_restaurant, name, price) VALUES (2, 'H3 GRELHADO', 8.70);                                    -- 5
INSERT INTO dishes (id_restaurant, name, price) VALUES (2, 'H3 CHAMPIGNON', 9.85);
INSERT INTO dishes (id_restaurant, name, price) VALUES (2, 'H3 MEDITERRÂNEO', 9.85);
INSERT INTO dishes (id_restaurant, name, price) VALUES (2, 'H3  TUGA', 9.55);
INSERT INTO dishes (id_restaurant, name, price) VALUES (2, 'H3 BENEDICT', 10.15);
--Brasaria
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Misto de Churrasco', 28.70);                            -- 10
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Secretos de Porco Grelhados', 12.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Panados de frango', 10.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Espetada de Vitela Madeirense', 15.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Bacalhau a Braga', 19.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Robalo Escalado', 14.50);                               -- 15
INSERT INTO dishes (id_restaurant, name, price) VALUES (3, 'Salmão Grelhado', 17.00);
--Boa-Bao
INSERT INTO dishes (id_restaurant, name, price) VALUES (4, 'Caril thai massaman de coco', 15.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (4, 'Caril verde thai', 17.85);
INSERT INTO dishes (id_restaurant, name, price) VALUES (4, 'Arroz frito', 3.5);
INSERT INTO dishes (id_restaurant, name, price) VALUES (4, 'Laab gai de frango', 12.50);                            -- 20
INSERT INTO dishes (id_restaurant, name, price) VALUES (4, 'Sopa picante de camarão', 15.50);
--bbGourmet
INSERT INTO dishes (id_restaurant, name, price) VALUES (5, 'Lulas com Legumes Orientais', 13.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (5, 'Tostada de Chevre, Bacon e Nozes', 8.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (5, 'Porco Corado com Batata e Espinafre', 10.5);
INSERT INTO dishes (id_restaurant, name, price) VALUES (5, 'Massa Picante de Camarão', 13.50);                      -- 25
INSERT INTO dishes (id_restaurant, name, price) VALUES (5, 'Robalo Grelhado com Risotto de Lima', 15.50);
--o pote velho
INSERT INTO dishes (id_restaurant, name, price) VALUES (6, 'Cozido a Portuguesa', 15.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (6, 'Bacalhau á bras', 12.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (6, 'Arroz de pato', 12.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (6, 'Moelas Guarnecidas', 9.50);                             -- 30
INSERT INTO dishes (id_restaurant, name, price) VALUES (6, 'Bitoque', 10.00);
--nova real
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Red Velvet', 15.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Pastel de Nata', 1.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Tarte de Laranja', 10.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Mil-folhas', 1.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Brownie', 3.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Bola de Berlim', 3.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (7, 'Pão de Ló', 20.00);
--honestgreens
INSERT INTO dishes (id_restaurant, name, price) VALUES (8, 'Honest Salmon ', 8.90);
INSERT INTO dishes (id_restaurant, name, price) VALUES (8, 'Tataki de Atum ', 10.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (8, 'Tempeh Stir Fry ', 7.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (8, 'Wild Mediterranean', 8.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (8, 'Latin Lover', 7.90);
--stop-bar
INSERT INTO dishes (id_restaurant, name, price) VALUES (9, 'Cachorro especial ', 5.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (9, 'Bifana ', 3.50);
INSERT INTO dishes (id_restaurant, name, price) VALUES (9, 'Pasteis de bacalhau', 2.00);
INSERT INTO dishes (id_restaurant, name, price) VALUES (9, 'Moelas ', 6.00 );

--Reviews
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (1,1,4,'Funcionários extremamente gentis! Restaurante limpo e uma velocidade incrível no preparo do pedido!','2022-05-1');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (1,2,5,'Mt bom, recomendo!', date('now'));
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (2,2,4,'Os Hambúrgueres são optimos, as combinações estão muito bem. Recomendo.','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (3,2,5,'Um restaurante com bom ambiente, o staff cinco estrelas, a comida é espetacular.','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (4,2,3,'Ótimos pratos, bom ambiente, atendimento atencioso.','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (5,1,4,'Muito bom mesmo,recomendo.','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (6,1,4,'Comida tradicional muito saborosa,preços bastante acessiveis e optimo atendimento.','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (7,1,5,'A melhor pastelaria da cidade do Porto.Recomendo','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (8,1,3,'Espaço muito agradavel, mas a comida não estava do meu agrado.','2022-05-19');
INSERT INTO reviews (id_restaurant,id_user,score,texto,published) VALUES (9,1,4,'Snacks rapidos e muito saborosos, atendimento rapido e impecável.Recomendo.','2022-05-19');

--FAVS
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(1,1);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(1,2);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(2,4);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(2,6);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(3,1);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(3,3);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(4,7);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(4,9);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(5,2);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(5,5);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(6,8);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(6,4);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(7,4);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(7,9);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(8,1);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(8,5);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(8,7);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(9,4);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(9,3);
INSERT INTO favourite_restaurants (id_user,id_restaurant) VALUES(9,9);

INSERT INTO favourite_dishes(id_user, id_dish) VALUES(1,2);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(1,3);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(1,15);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(2,2);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(3,10);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(3,7);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(4,5);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(4,6);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(4,7);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(5,1);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(7,20);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(7,18);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(9,1);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(6,13);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(6,19);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(5,11);
INSERT INTO favourite_dishes(id_user, id_dish) VALUES(8,17);

-- 1
INSERT INTO orders (id_user,id_restaurant,total,state) VALUES(1,1,6.5,'Received');
INSERT INTO dishes_in_orders (id_order, id_dish, n_dish) VALUES (1,1,1);

-- 2
INSERT INTO orders (id_user,id_restaurant,id_driver,total,state) VALUES(1,1,11,24.9,'Ready');
INSERT INTO dishes_in_orders (id_order, id_dish, n_dish) VALUES (2,1,1);
INSERT INTO dishes_in_orders (id_order, id_dish, n_dish) VALUES (2,2,1);
INSERT INTO dishes_in_orders (id_order, id_dish, n_dish) VALUES (2,3,1);
INSERT INTO dishes_in_orders (id_order, id_dish, n_dish) VALUES (2,4,1);

--3
INSERT INTO orders (id_user,id_restaurant,id_driver,total,state) VALUES(2,2,10,8.7,'Delivered');
INSERT INTO dishes_in_orders (id_order, id_dish, n_dish) VALUES (3,5,1);

--4
INSERT INTO orders (id_user,id_restaurant,id_driver,total,state) VALUES(3,3,12,44.2,'Ready');
INSERT INTO dishes_in_orders (id_order, id_dish,n_dish) VALUES (4,10,1);
INSERT INTO dishes_in_orders (id_order, id_dish,n_dish) VALUES (4,13,1);

--5
INSERT INTO orders (id_user,id_restaurant,total,state) VALUES(4,4,34.5,'Preparing');
INSERT INTO dishes_in_orders (id_order, id_dish,n_dish) VALUES (5,17,2);
INSERT INTO dishes_in_orders (id_order, id_dish,n_dish) VALUES (5,19,1);