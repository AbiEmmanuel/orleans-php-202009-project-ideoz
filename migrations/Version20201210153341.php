<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210153341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testimonye DROP FOREIGN KEY FK_9C54504D57ADEC91');
        $this->addSql('DROP INDEX UNIQ_9C54504D57ADEC91 ON testimonye');
        $this->addSql('ALTER TABLE testimonye DROP ecosysteme_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE testimonye ADD ecosysteme_id INT NOT NULL');
        $this->addSql('ALTER TABLE testimonye ADD CONSTRAINT FK_9C54504D57ADEC91 FOREIGN KEY (ecosysteme_id) REFERENCES testimonye (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9C54504D57ADEC91 ON testimonye (ecosysteme_id)');
    }
}
