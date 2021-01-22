<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121103419 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecosystem ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ecosystem ADD CONSTRAINT FK_ABE8FB39A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ABE8FB39A76ED395 ON ecosystem (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649146249B8');
        $this->addSql('DROP INDEX UNIQ_8D93D649146249B8 ON user');
        $this->addSql('ALTER TABLE user DROP ecosystem_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecosystem DROP FOREIGN KEY FK_ABE8FB39A76ED395');
        $this->addSql('DROP INDEX UNIQ_ABE8FB39A76ED395 ON ecosystem');
        $this->addSql('ALTER TABLE ecosystem DROP user_id');
        $this->addSql('ALTER TABLE user ADD ecosystem_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649146249B8 FOREIGN KEY (ecosystem_id) REFERENCES ecosystem (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649146249B8 ON user (ecosystem_id)');
    }
}
