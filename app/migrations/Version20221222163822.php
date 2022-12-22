<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222163822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, rating DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie ADD review_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F3E2E969B FOREIGN KEY (review_id) REFERENCES review (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F3E2E969B ON movie (review_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F3E2E969B');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP INDEX IDX_1D5EF26F3E2E969B ON movie');
        $this->addSql('ALTER TABLE movie DROP review_id');
    }
}
