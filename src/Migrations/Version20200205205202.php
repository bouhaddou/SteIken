<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205205202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat_reg CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT NULL, CHANGE debit debit DOUBLE PRECISION DEFAULT NULL, CHANGE credit credit DOUBLE PRECISION DEFAULT NULL, CHANGE banque banque VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD user_roles_id INT DEFAULT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D84AB5C4 FOREIGN KEY (user_roles_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D84AB5C4 ON user (user_roles_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D84AB5C4');
        $this->addSql('DROP TABLE roles');
        $this->addSql('ALTER TABLE achat_reg CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL, CHANGE mode_id mode_id INT DEFAULT NULL, CHANGE libelle libelle VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE debit debit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE credit credit DOUBLE PRECISION DEFAULT \'NULL\', CHANGE banque banque VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_8D93D649D84AB5C4 ON user');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, DROP user_roles_id, DROP first_name, DROP last_name, CHANGE email email VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
