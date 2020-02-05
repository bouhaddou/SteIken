<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205122839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achat_reg (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, mode_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, libelle VARCHAR(255) DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, observation LONGTEXT DEFAULT NULL, credit DOUBLE PRECISION DEFAULT NULL, banque VARCHAR(255) DEFAULT NULL, INDEX IDX_8B9176B0670C757F (fournisseur_id), INDEX IDX_8B9176B077E5854A (mode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avenant (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_avenant DOUBLE PRECISION NOT NULL, INDEX IDX_2FE5CE519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, observation LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_complete VARCHAR(255) NOT NULL, type_client VARCHAR(255) NOT NULL, revesion_prix DOUBLE PRECISION NOT NULL, penalite DOUBLE PRECISION NOT NULL, retenue_grantie DOUBLE PRECISION NOT NULL, retenue_finition DOUBLE PRECISION NOT NULL, adresse LONGTEXT DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, montant_travaux DOUBLE PRECISION NOT NULL, prorata DOUBLE PRECISION NOT NULL, objet LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decomptes (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_decompte DOUBLE PRECISION NOT NULL, INDEX IDX_B492EDA619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition_details (id INT AUTO_INCREMENT NOT NULL, finitions_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_A7D3D5C6A1D355A9 (finitions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseurs (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode (id INT AUTO_INCREMENT NOT NULL, mode_reg VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, INDEX IDX_BE2DDF8CC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, type_categorie VARCHAR(255) NOT NULL, observation VARCHAR(255) NOT NULL, INDEX IDX_59308930A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat_reg ADD CONSTRAINT FK_8B9176B0670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE achat_reg ADD CONSTRAINT FK_8B9176B077E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('ALTER TABLE avenant ADD CONSTRAINT FK_2FE5CE519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE decomptes ADD CONSTRAINT FK_B492EDA619EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE finition_details ADD CONSTRAINT FK_A7D3D5C6A1D355A9 FOREIGN KEY (finitions_id) REFERENCES finition (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CC54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
        $this->addSql('ALTER TABLE types ADD CONSTRAINT FK_59308930A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE types DROP FOREIGN KEY FK_59308930A21214B7');
        $this->addSql('ALTER TABLE avenant DROP FOREIGN KEY FK_2FE5CE519EB6921');
        $this->addSql('ALTER TABLE decomptes DROP FOREIGN KEY FK_B492EDA619EB6921');
        $this->addSql('ALTER TABLE finition_details DROP FOREIGN KEY FK_A7D3D5C6A1D355A9');
        $this->addSql('ALTER TABLE achat_reg DROP FOREIGN KEY FK_8B9176B0670C757F');
        $this->addSql('ALTER TABLE achat_reg DROP FOREIGN KEY FK_8B9176B077E5854A');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CC54C8C93');
        $this->addSql('DROP TABLE achat_reg');
        $this->addSql('DROP TABLE avenant');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE decomptes');
        $this->addSql('DROP TABLE finition');
        $this->addSql('DROP TABLE finition_details');
        $this->addSql('DROP TABLE fournisseurs');
        $this->addSql('DROP TABLE mode');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE types');
    }
}
