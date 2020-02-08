<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200208085300 extends AbstractMigration
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
        $this->addSql('CREATE TABLE clients_ventes (id INT AUTO_INCREMENT NOT NULL, clients_id INT DEFAULT NULL, mode_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, libelle VARCHAR(255) DEFAULT NULL, credit DOUBLE PRECISION DEFAULT NULL, observation LONGTEXT DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, banque VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_613B9C7DAB014612 (clients_id), INDEX IDX_613B9C7D77E5854A (mode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_roles (user_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_54FCD59FA76ED395 (user_id), INDEX IDX_54FCD59F38C751C4 (roles_id), PRIMARY KEY(user_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clients_ventes ADD CONSTRAINT FK_613B9C7DAB014612 FOREIGN KEY (clients_id) REFERENCES clients_par (id)');
        $this->addSql('ALTER TABLE clients_ventes ADD CONSTRAINT FK_613B9C7D77E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59F38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat_reg ADD date DATETIME NOT NULL, CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT NULL, CHANGE debit debit DOUBLE PRECISION DEFAULT NULL, CHANGE credit credit DOUBLE PRECISION DEFAULT NULL, CHANGE banque banque VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE avenant ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE clients ADD date DATETIME NOT NULL, CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE decomptes ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs ADD date DATETIME NOT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clients_ventes DROP FOREIGN KEY FK_613B9C7DAB014612');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59F38C751C4');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FA76ED395');
        $this->addSql('DROP TABLE clients_par');
        $this->addSql('DROP TABLE clients_ventes');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_roles');
        $this->addSql('ALTER TABLE achat_reg DROP date, CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE debit debit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE credit credit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE banque banque VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE avenant DROP date');
        $this->addSql('ALTER TABLE clients DROP date, CHANGE telephone telephone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE decomptes DROP date');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs DROP date, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
