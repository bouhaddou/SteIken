<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115174436 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_complete VARCHAR(255) NOT NULL, type_client VARCHAR(255) NOT NULL, revesion_prix DOUBLE PRECISION NOT NULL, penalite DOUBLE PRECISION NOT NULL, retenue_grantie DOUBLE PRECISION NOT NULL, retenue_finition DOUBLE PRECISION NOT NULL, adresse LONGTEXT DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, montant_travaux DOUBLE PRECISION NOT NULL, montant_total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decomptes (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, montant_decompte DOUBLE PRECISION NOT NULL, INDEX IDX_B492EDA619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE decomptes ADD CONSTRAINT FK_B492EDA619EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE decomptes DROP FOREIGN KEY FK_B492EDA619EB6921');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE decomptes');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
    }
}
