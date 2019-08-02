<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802120345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX numcompt ON compt');
        $this->addSql('DROP INDEX cni ON user');
        $this->addSql('DROP INDEX ninea ON partenaire');
        $this->addSql('DROP INDEX nom ON partenaire');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX numcompt ON compt (numcompt)');
        $this->addSql('CREATE UNIQUE INDEX ninea ON partenaire (ninea)');
        $this->addSql('CREATE UNIQUE INDEX nom ON partenaire (nom)');
        $this->addSql('CREATE UNIQUE INDEX cni ON user (cni)');
    }
}
