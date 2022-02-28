<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220227235509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD userid_id INT DEFAULT NULL, ADD hotelid_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495558E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495595A438C4 FOREIGN KEY (hotelid_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_42C8495558E0A285 ON reservation (userid_id)');
        $this->addSql('CREATE INDEX IDX_42C8495595A438C4 ON reservation (hotelid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495558E0A285');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495595A438C4');
        $this->addSql('DROP INDEX IDX_42C8495558E0A285 ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495595A438C4 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP userid_id, DROP hotelid_id');
    }
}
