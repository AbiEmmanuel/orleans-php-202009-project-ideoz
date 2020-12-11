<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201211113721 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testimony (id INT AUTO_INCREMENT NOT NULL, ecosystem_id INT NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_523C9487146249B8 (ecosystem_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE testimony ADD CONSTRAINT FK_523C9487146249B8 FOREIGN KEY (ecosystem_id) REFERENCES ecosystem (id)');
        $this->addSql('DROP TABLE testimonye');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testimonye (id INT AUTO_INCREMENT NOT NULL, ecosystem_id INT NOT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_9C54504D146249B8 (ecosystem_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE testimonye ADD CONSTRAINT FK_9C54504D146249B8 FOREIGN KEY (ecosystem_id) REFERENCES ecosystem (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE testimony');
    }
}
