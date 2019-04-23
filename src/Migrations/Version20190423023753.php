<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423023753 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE auto (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, mark VARCHAR(10) NOT NULL, number VARCHAR(10) NOT NULL, state INT DEFAULT NULL COMMENT \'статус (есть в наличии или кто-то взял)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, addr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, auto_id INT DEFAULT NULL, department_from INT DEFAULT NULL, user_id INT DEFAULT NULL, department_to INT DEFAULT NULL, took DATETIME NOT NULL, gave DATETIME DEFAULT NULL, INDEX department_to_id (department_to), INDEX department_id (department_from), INDEX avto_id (auto_id), INDEX user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, patronymic VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B1D55B925 FOREIGN KEY (auto_id) REFERENCES auto (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B1B00C625 FOREIGN KEY (department_from) REFERENCES department (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BC63E404B FOREIGN KEY (department_to) REFERENCES department (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B1D55B925');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B1B00C625');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BC63E404B');
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BA76ED395');
        $this->addSql('DROP TABLE auto');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE user');
    }
}
