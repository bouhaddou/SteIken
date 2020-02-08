<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207221600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clients_par (id INT AUTO_INCREMENT NOT NULL, nom_complet VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients_ventes (id INT AUTO_INCREMENT NOT NULL, clients_id INT DEFAULT NULL, mode_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, libelle VARCHAR(255) DEFAULT NULL, credit DOUBLE PRECISION NOT NULL, observation LONGTEXT DEFAULT NULL, debit DOUBLE PRECISION NOT NULL, banque VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_613B9C7DAB014612 (clients_id), INDEX IDX_613B9C7D77E5854A (mode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients_ventes ADD CONSTRAINT FK_613B9C7DAB014612 FOREIGN KEY (clients_id) REFERENCES clients_par (id)');
        $this->addSql('ALTER TABLE clients_ventes ADD CONSTRAINT FK_613B9C7D77E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('ALTER TABLE achat_reg CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT NULL, CHANGE debit debit DOUBLE PRECISION DEFAULT NULL, CHANGE credit credit DOUBLE PRECISION DEFAULT NULL, CHANGE banque banque VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients_ventes DROP FOREIGN KEY FK_613B9C7DAB014612');
        $this->addSql('DROP TABLE clients_par');
        $this->addSql('DROP TABLE clients_ventes');
        $this->addSql('ALTER TABLE achat_reg CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE debit debit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE credit credit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE banque banque VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
