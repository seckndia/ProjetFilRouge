<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802145344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX tel ON user');
        $this->addSql('DROP INDEX cni ON user');
        $this->addSql('ALTER TABLE user ADD numcompt_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C716680B FOREIGN KEY (numcompt_id) REFERENCES compt (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C716680B ON user (numcompt_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C716680B');
        $this->addSql('DROP INDEX IDX_8D93D649C716680B ON user');
        $this->addSql('ALTER TABLE user DROP numcompt_id');
        $this->addSql('CREATE UNIQUE INDEX tel ON user (tel)');
        $this->addSql('CREATE UNIQUE INDEX cni ON user (cni)');
    }
}
