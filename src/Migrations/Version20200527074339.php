<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527074339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE secteurs_structures DROP FOREIGN KEY secteurs_structures_secteur_fk');
        $this->addSql('ALTER TABLE secteurs_structures DROP FOREIGN KEY secteurs_structures_structure_fk');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_uri LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_8ECAEAD4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE command_line (product_id INT NOT NULL, command_id INT NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_70BE1A7B4584665A (product_id), INDEX IDX_70BE1A7B33E1689A (command_id), PRIMARY KEY(product_id, command_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_uri LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7B33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE secteurs_structures');
        $this->addSql('DROP TABLE structure');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B33E1689A');
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7B4584665A');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A76ED395');
        $this->addSql('CREATE TABLE secteur (ID INT AUTO_INCREMENT NOT NULL, LIBELLE VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, UNIQUE INDEX LIBELLE (LIBELLE), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE secteurs_structures (ID INT AUTO_INCREMENT NOT NULL, ID_STRUCTURE INT DEFAULT NULL, ID_SECTEUR INT DEFAULT NULL, INDEX ID_STRUCTURE (ID_STRUCTURE), INDEX ID_SECTEUR (ID_SECTEUR), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE structure (ID INT AUTO_INCREMENT NOT NULL, NOM VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, RUE VARCHAR(200) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, CP VARCHAR(5) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, VILLE VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, ESTASSO TINYINT(1) NOT NULL, NB_DONATEURS INT DEFAULT NULL, NB_ACTIONNAIRES INT DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE secteurs_structures ADD CONSTRAINT secteurs_structures_secteur_fk FOREIGN KEY (ID_SECTEUR) REFERENCES secteur (ID)');
        $this->addSql('ALTER TABLE secteurs_structures ADD CONSTRAINT secteurs_structures_structure_fk FOREIGN KEY (ID_STRUCTURE) REFERENCES structure (ID)');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE command_line');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
