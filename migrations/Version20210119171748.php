<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210119171748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD ecosystem_id INT DEFAULT NULL, DROP is_verified');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649146249B8 FOREIGN KEY (ecosystem_id) REFERENCES ecosystem (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649146249B8 ON user (ecosystem_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649146249B8');
        $this->addSql('DROP INDEX UNIQ_8D93D649146249B8 ON user');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, DROP ecosystem_id');
    }
}
