<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220401163502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite CHANGE nom_activite nom_activite VARCHAR(255) DEFAULT NULL, CHANGE type_activite type_activite VARCHAR(255) DEFAULT NULL, CHANGE nb_pers nb_pers VARCHAR(255) DEFAULT NULL, CHANGE date_debut date_debut VARCHAR(255) DEFAULT NULL, CHANGE date_fin date_fin VARCHAR(255) DEFAULT NULL, CHANGE fiche_descriptive fiche_descriptive VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite CHANGE nom_activite nom_activite VARCHAR(255) NOT NULL, CHANGE type_activite type_activite VARCHAR(255) NOT NULL, CHANGE nb_pers nb_pers VARCHAR(255) NOT NULL, CHANGE date_debut date_debut VARCHAR(255) NOT NULL, CHANGE date_fin date_fin VARCHAR(255) NOT NULL, CHANGE fiche_descriptive fiche_descriptive VARCHAR(255) NOT NULL');
    }
}
