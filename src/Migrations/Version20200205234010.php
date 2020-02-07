<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205234010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE regelement DROP FOREIGN KEY FK_1C0D1DDC469FA10');
        $this->addSql('CREATE TABLE achat_reg (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, mode_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, libelle VARCHAR(255) DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, observation LONGTEXT DEFAULT NULL, credit DOUBLE PRECISION DEFAULT NULL, banque VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_8B9176B0670C757F (fournisseur_id), INDEX IDX_8B9176B077E5854A (mode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_roles (user_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_54FCD59FA76ED395 (user_id), INDEX IDX_54FCD59F38C751C4 (roles_id), PRIMARY KEY(user_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode (id INT AUTO_INCREMENT NOT NULL, mode_reg VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat_reg ADD CONSTRAINT FK_8B9176B0670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE achat_reg ADD CONSTRAINT FK_8B9176B077E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59F38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE achats');
        $this->addSql('DROP TABLE mode_regelement');
        $this->addSql('DROP TABLE regelement');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59F38C751C4');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FA76ED395');
        $this->addSql('ALTER TABLE achat_reg DROP FOREIGN KEY FK_8B9176B077E5854A');
        $this->addSql('CREATE TABLE achats (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT NOT NULL, designation_id INT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, montant DOUBLE PRECISION NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_9920924EFAC7D83F (designation_id), INDEX IDX_9920924E670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mode_regelement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE regelement (id INT AUTO_INCREMENT NOT NULL, fournissuer_id INT NOT NULL, mode_regelement_id INT NOT NULL, libelle VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, montant_regelement DOUBLE PRECISION NOT NULL, date VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_1C0D1DDC469FA10 (mode_regelement_id), INDEX IDX_1C0D1DD43AE066 (fournissuer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE achats ADD CONSTRAINT FK_9920924E670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE achats ADD CONSTRAINT FK_9920924EFAC7D83F FOREIGN KEY (designation_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE regelement ADD CONSTRAINT FK_1C0D1DD43AE066 FOREIGN KEY (fournissuer_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE regelement ADD CONSTRAINT FK_1C0D1DDC469FA10 FOREIGN KEY (mode_regelement_id) REFERENCES mode_regelement (id)');
        $this->addSql('DROP TABLE achat_reg');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_roles');
        $this->addSql('DROP TABLE mode');
    }
}
