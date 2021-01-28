<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210127181507 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A79C4DC9');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A79C4DC9 FOREIGN KEY (privileges_id) REFERENCES privileges (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A79C4DC9');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A79C4DC9 FOREIGN KEY (privileges_id) REFERENCES privileges (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
