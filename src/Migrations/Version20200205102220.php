<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200205102220 extends AbstractMigration
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
        $this->addSql('DROP TABLE achats');
        $this->addSql('DROP TABLE mode_regelement');
        $this->addSql('DROP TABLE regelement');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achats (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, date VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, montant DOUBLE PRECISION NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_9920924E670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mode_regelement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE regelement (id INT AUTO_INCREMENT NOT NULL, fournissuer_id INT NOT NULL, mode_regelement_id INT NOT NULL, libelle VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, montant_regelement DOUBLE PRECISION NOT NULL, date VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_1C0D1DD43AE066 (fournissuer_id), INDEX IDX_1C0D1DDC469FA10 (mode_regelement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE achats ADD CONSTRAINT FK_9920924E670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE regelement ADD CONSTRAINT FK_1C0D1DD43AE066 FOREIGN KEY (fournissuer_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE regelement ADD CONSTRAINT FK_1C0D1DDC469FA10 FOREIGN KEY (mode_regelement_id) REFERENCES mode_regelement (id)');
        $this->addSql('ALTER TABLE clients CHANGE telephone telephone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE contact CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE finition_details CHANGE finitions_id finitions_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fournisseurs CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
