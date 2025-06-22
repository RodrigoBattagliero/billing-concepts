<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250621185933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE category (id SERIAL NOT NULL, category VARCHAR(50) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE iva_application (id SERIAL NOT NULL, code INT NOT NULL, iva_application VARCHAR(50) NOT NULL, aliquot DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product_service (id SERIAL NOT NULL, category_id INT DEFAULT NULL, unit_measurement_id INT DEFAULT NULL, iva_application_id INT DEFAULT NULL, type VARCHAR(1) NOT NULL, code VARCHAR(20) NOT NULL, product_service VARCHAR(255) NOT NULL, gross_price DOUBLE PRECISION DEFAULT 0, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_3044816277153098 ON product_service (code)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3044816212469DE2 ON product_service (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_30448162E24AEC2B ON product_service (unit_measurement_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_3044816219D32E38 ON product_service (iva_application_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE unit_measurement (id SERIAL NOT NULL, code VARCHAR(5) NOT NULL, unit_of_measurement VARCHAR(50) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_service ADD CONSTRAINT FK_3044816212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_service ADD CONSTRAINT FK_30448162E24AEC2B FOREIGN KEY (unit_measurement_id) REFERENCES unit_measurement (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_service ADD CONSTRAINT FK_3044816219D32E38 FOREIGN KEY (iva_application_id) REFERENCES iva_application (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_service DROP CONSTRAINT FK_3044816212469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_service DROP CONSTRAINT FK_30448162E24AEC2B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE product_service DROP CONSTRAINT FK_3044816219D32E38
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE iva_application
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product_service
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE unit_measurement
        SQL);
    }
}
