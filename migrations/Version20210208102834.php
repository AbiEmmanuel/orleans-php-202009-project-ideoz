<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208102834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO legal_notice (content) VALUES ('Mentions légales à rédiger')");
        $this->addSql("INSERT INTO offer (name, description, abstract, catch_phrase, example, number) VALUES ('Formation et transmission', 'Description à rédiger', 'Présentation à rédiger', 'Phrase d''accroche à rédiger', null, 1)");
        $this->addSql("INSERT INTO offer (name, description, abstract, catch_phrase, example, number) VALUES ('Conseil', 'Description à rédiger', 'Présentation à rédiger', 'Phrase d''accroche à rédiger', null, 2)");
        $this->addSql("INSERT INTO offer (name, description, abstract, catch_phrase, example, number) VALUES ('Accompagnement engagé', 'Description à rédiger', 'Présentation à rédiger', 'Phrase d''accroche à rédiger', null, 3)");
        $this->addSql("INSERT INTO company (phone_number, email, name) VALUES ('0661992159', 'zideo2020@gmail.com', 'Simon Abraham')");
        $this->addSql("INSERT INTO status (name) VALUES ('Client')");
        $this->addSql("INSERT INTO status (name) VALUES ('Partenaire')");
        $this->addSql("INSERT INTO status (name) VALUES ('Adhérent')");
        $this->addSql("INSERT INTO status (name) VALUES ('Autre')");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
