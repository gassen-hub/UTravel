<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307151453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE endroit DROP FOREIGN KEY FK_7B44825A1A65C546');
        $this->addSql('DROP INDEX IDX_7B44825A1A65C546 ON endroit');
        $this->addSql('ALTER TABLE endroit ADD latitude VARCHAR(255) NOT NULL, ADD longitude VARCHAR(255) NOT NULL, DROP no_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE endroit ADD no_id INT DEFAULT NULL, DROP latitude, DROP longitude');
        $this->addSql('ALTER TABLE endroit ADD CONSTRAINT FK_7B44825A1A65C546 FOREIGN KEY (no_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_7B44825A1A65C546 ON endroit (no_id)');
    }
}
