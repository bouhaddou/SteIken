<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200208003545 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE achat_reg CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT NULL, CHANGE debit debit DOUBLE PRECISION DEFAULT NULL, CHANGE credit credit DOUBLE PRECISION DEFAULT NULL, CHANGE banque banque VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients_par CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients_ventes DROP FOREIGN KEY FK_613B9C7D4353524D');
        $this->addSql('DROP INDEX IDX_613B9C7D4353524D ON clients_ventes');
        $this->addSql('ALTER TABLE clients_ventes DROP clients_par_id, CHANGE clients_id clients_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT NULL, CHANGE credit credit DOUBLE PRECISION DEFAULT NULL, CHANGE banque banque VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE achat_reg CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE debit debit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE credit credit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE banque banque VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clients_par CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE adresse adresse VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE telephone telephone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clients_ventes ADD clients_par_id INT NOT NULL, CHANGE clients_id clients_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE credit credit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE banque banque VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clients_ventes ADD CONSTRAINT FK_613B9C7D4353524D FOREIGN KEY (clients_par_id) REFERENCES clients_par (id)');
        $this->addSql('CREATE INDEX IDX_613B9C7D4353524D ON clients_ventes (clients_par_id)');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
