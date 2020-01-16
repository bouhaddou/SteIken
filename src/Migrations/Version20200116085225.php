<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200116085225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avenant (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_avenant DOUBLE PRECISION NOT NULL, INDEX IDX_2FE5CE519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_complete VARCHAR(255) NOT NULL, type_client VARCHAR(255) NOT NULL, revesion_prix DOUBLE PRECISION NOT NULL, penalite DOUBLE PRECISION NOT NULL, retenue_grantie DOUBLE PRECISION NOT NULL, retenue_finition DOUBLE PRECISION NOT NULL, adresse LONGTEXT DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, montant_travaux DOUBLE PRECISION NOT NULL, prorata DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decomptes (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_decompte DOUBLE PRECISION NOT NULL, INDEX IDX_B492EDA619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition_details (id INT AUTO_INCREMENT NOT NULL, finitions_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_A7D3D5C6A1D355A9 (finitions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avenant ADD CONSTRAINT FK_2FE5CE519EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE decomptes ADD CONSTRAINT FK_B492EDA619EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE finition_details ADD CONSTRAINT FK_A7D3D5C6A1D355A9 FOREIGN KEY (finitions_id) REFERENCES finition (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avenant DROP FOREIGN KEY FK_2FE5CE519EB6921');
        $this->addSql('ALTER TABLE decomptes DROP FOREIGN KEY FK_B492EDA619EB6921');
        $this->addSql('ALTER TABLE finition_details DROP FOREIGN KEY FK_A7D3D5C6A1D355A9');
        $this->addSql('DROP TABLE avenant');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE decomptes');
        $this->addSql('DROP TABLE finition');
        $this->addSql('DROP TABLE finition_details');
    }
}
