<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316102056 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie CHANGE main_joueur2 main_joueur2 LONGTEXT DEFAULT NULL, CHANGE pioche pioche LONGTEXT DEFAULT NULL, CHANGE main_joueur1 main_joueur1 LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partie CHANGE main_joueur1 main_joueur1 VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE main_joueur2 main_joueur2 VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE pioche pioche VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
