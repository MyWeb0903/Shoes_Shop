<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013003235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT cart_username_fkey');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT orders_username_fkey');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT product_category_id_fkey');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT product_shop_id_fkey');
        $this->addSql('ALTER TABLE order_detail DROP CONSTRAINT order_detail_order_id_fkey');
        $this->addSql('CREATE SEQUENCE cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contain_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE feadback_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE supplier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contain (id INT NOT NULL, cart_id INT NOT NULL, product_id INT NOT NULL, qty_product INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4BEFF7C81AD5CDBF ON contain (cart_id)');
        $this->addSql('CREATE INDEX IDX_4BEFF7C84584665A ON contain (product_id)');
        $this->addSql('CREATE TABLE feadback (id INT NOT NULL, user_id INT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, message VARCHAR(255) NOT NULL, product_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_49B8064EA76ED395 ON feadback (user_id)');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, user_id INT NOT NULL, order_date DATE NOT NULL, delivery_date DATE NOT NULL, payment DOUBLE PRECISION NOT NULL, address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, client VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON "order" (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(10) NOT NULL, gender VARCHAR(6) NOT NULL, birthday DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649444F97DD ON "user" (phone)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C81AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C84584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feadback ADD CONSTRAINT FK_49B8064EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE cart_detail');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP INDEX IDX_BA388B7F85E0677');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE cart ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart DROP username');
        $this->addSql('ALTER TABLE cart RENAME COLUMN cart_id TO id');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B7A76ED395 ON cart (user_id)');
        $this->addSql('ALTER TABLE cart ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX IDX_ED896F468D9F6D38');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE order_detail ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail ADD order_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail ADD qty_pro INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail DROP orderdetail_id');
        $this->addSql('ALTER TABLE order_detail DROP order_id');
        $this->addSql('ALTER TABLE order_detail DROP qty_product');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F46FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ED896F46FCDAEAAA ON order_detail (order_id_id)');
        $this->addSql('ALTER TABLE order_detail ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT product_supplier_id_fkey');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD2ADD6D8C');
        $this->addSql('DROP INDEX IDX_D34A04AD4D16C4DD');
        $this->addSql('ALTER TABLE product ADD supplier_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE product ADD detail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product DROP category_id');
        $this->addSql('ALTER TABLE product DROP supplier_id');
        $this->addSql('ALTER TABLE product DROP shop_id');
        $this->addSql('ALTER TABLE product DROP original_price');
        $this->addSql('ALTER TABLE product DROP sale_price');
        $this->addSql('ALTER TABLE product DROP pro_image');
        $this->addSql('ALTER TABLE product DROP status');
        $this->addSql('ALTER TABLE product ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA65F9C7D FOREIGN KEY (supplier_id_id) REFERENCES supplier (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADA65F9C7D ON product (supplier_id_id)');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE supplier DROP address');
        $this->addSql('ALTER TABLE supplier DROP phone');
        $this->addSql('ALTER TABLE supplier ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE supplier ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE supplier ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE supplier ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE supplier RENAME COLUMN supplier_id TO id');
        $this->addSql('ALTER TABLE supplier ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA heroku_ext');
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_detail DROP CONSTRAINT FK_ED896F46FCDAEAAA');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE feadback DROP CONSTRAINT FK_49B8064EA76ED395');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398A76ED395');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contain_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE feadback_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE order_detail_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE supplier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE TABLE cart_detail (cartdetail_id INT NOT NULL, cart_id INT NOT NULL, product_id INT NOT NULL, qty_pro INT NOT NULL, PRIMARY KEY(cartdetail_id))');
        $this->addSql('CREATE INDEX IDX_20821DCC1AD5CDBF ON cart_detail (cart_id)');
        $this->addSql('CREATE INDEX IDX_20821DCC4584665A ON cart_detail (product_id)');
        $this->addSql('CREATE TABLE account (username TEXT NOT NULL, password CHAR(200) NOT NULL, email CHAR(200) NOT NULL, phone CHAR(10) NOT NULL, address CHAR(200) NOT NULL, gender CHAR(20) DEFAULT NULL, type CHAR(20) DEFAULT NULL, PRIMARY KEY(username))');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name CHAR(200) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE shop (shop_id INT NOT NULL, name CHAR(200) NOT NULL, address CHAR(200) NOT NULL, email CHAR(200) NOT NULL, phone CHAR(10) NOT NULL, PRIMARY KEY(shop_id))');
        $this->addSql('CREATE TABLE orders (order_id INT NOT NULL, username CHAR(200) NOT NULL, orderdate DATE NOT NULL, deliverydate DATE DEFAULT NULL, payment BIGINT NOT NULL, PRIMARY KEY(order_id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEEF85E0677 ON orders (username)');
        $this->addSql('ALTER TABLE cart_detail ADD CONSTRAINT cart_detail_cart_id_fkey FOREIGN KEY (cart_id) REFERENCES cart (cart_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cart_detail ADD CONSTRAINT cart_detail_product_id_fkey FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT orders_username_fkey FOREIGN KEY (username) REFERENCES account (username) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE contain');
        $this->addSql('DROP TABLE feadback');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX UNIQ_BA388B7A76ED395');
        $this->addSql('DROP INDEX cart_pkey');
        $this->addSql('ALTER TABLE cart ADD cart_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD username CHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE cart DROP id');
        $this->addSql('ALTER TABLE cart DROP user_id');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT cart_username_fkey FOREIGN KEY (username) REFERENCES account (username) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BA388B7F85E0677 ON cart (username)');
        $this->addSql('ALTER TABLE cart ADD PRIMARY KEY (cart_id)');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADA65F9C7D');
        $this->addSql('DROP INDEX IDX_D34A04ADA65F9C7D');
        $this->addSql('ALTER TABLE product ADD supplier_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD original_price BIGINT NOT NULL');
        $this->addSql('ALTER TABLE product ADD sale_price BIGINT NOT NULL');
        $this->addSql('ALTER TABLE product ADD pro_image CHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD status CHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP image');
        $this->addSql('ALTER TABLE product DROP price');
        $this->addSql('ALTER TABLE product DROP detail');
        $this->addSql('ALTER TABLE product ALTER name TYPE CHAR(200)');
        $this->addSql('ALTER TABLE product ALTER name TYPE CHAR(200)');
        $this->addSql('ALTER TABLE product RENAME COLUMN supplier_id_id TO category_id');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT product_category_id_fkey FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT product_supplier_id_fkey FOREIGN KEY (supplier_id) REFERENCES supplier (supplier_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT product_shop_id_fkey FOREIGN KEY (shop_id) REFERENCES shop (shop_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD2ADD6D8C ON product (supplier_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD4D16C4DD ON product (shop_id)');
        $this->addSql('DROP INDEX supplier_pkey');
        $this->addSql('ALTER TABLE supplier ADD address CHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE supplier ADD phone CHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE supplier ALTER name TYPE CHAR(200)');
        $this->addSql('ALTER TABLE supplier ALTER name TYPE CHAR(200)');
        $this->addSql('ALTER TABLE supplier ALTER email TYPE CHAR(200)');
        $this->addSql('ALTER TABLE supplier ALTER email TYPE CHAR(200)');
        $this->addSql('ALTER TABLE supplier RENAME COLUMN id TO supplier_id');
        $this->addSql('ALTER TABLE supplier ADD PRIMARY KEY (supplier_id)');
        $this->addSql('DROP INDEX IDX_ED896F46FCDAEAAA');
        $this->addSql('DROP INDEX order_detail_pkey');
        $this->addSql('ALTER TABLE order_detail ADD orderdetail_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail ADD order_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail ADD qty_product INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail DROP id');
        $this->addSql('ALTER TABLE order_detail DROP order_id_id');
        $this->addSql('ALTER TABLE order_detail DROP qty_pro');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT order_detail_order_id_fkey FOREIGN KEY (order_id) REFERENCES orders (order_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ED896F468D9F6D38 ON order_detail (order_id)');
        $this->addSql('ALTER TABLE order_detail ADD PRIMARY KEY (orderdetail_id)');
    }
}
