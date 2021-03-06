<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011141454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE announces_categorie (announces_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_EC14745C86751F55 (announces_id), INDEX IDX_EC14745CBCF5E72D (categorie_id), PRIMARY KEY(announces_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announces_categorie ADD CONSTRAINT FK_EC14745C86751F55 FOREIGN KEY (announces_id) REFERENCES announces (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announces_categorie ADD CONSTRAINT FK_EC14745CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE announces DROP categories');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announces_categorie DROP FOREIGN KEY FK_EC14745CBCF5E72D');
        $this->addSql('DROP TABLE announces_categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('ALTER TABLE announces ADD categories VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
