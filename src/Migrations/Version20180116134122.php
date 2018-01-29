<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180116134122 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, ordering_title VARCHAR(255) NOT NULL, summary LONGTEXT DEFAULT NULL, type SMALLINT NOT NULL, release_year SMALLINT DEFAULT NULL, duration SMALLINT DEFAULT NULL, bonus_summary LONGTEXT DEFAULT NULL, note SMALLINT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, is_serie TINYINT(1) NOT NULL, is_boxed TINYINT(1) NOT NULL, is_lent TINYINT(1) NOT NULL, lent_to VARCHAR(50) DEFAULT NULL, lent_since DATE DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias_categories (media_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B3EB52FAEA9FDD75 (media_id), INDEX IDX_B3EB52FA12469DE2 (category_id), PRIMARY KEY(media_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias_languages (media_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_6BEE21E0EA9FDD75 (media_id), INDEX IDX_6BEE21E082F1BAF4 (language_id), PRIMARY KEY(media_id, language_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medias_subtitles (media_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_6C06BB1FEA9FDD75 (media_id), INDEX IDX_6C06BB1F82F1BAF4 (language_id), PRIMARY KEY(media_id, language_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_store (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, store_id INT NOT NULL, role SMALLINT NOT NULL, INDEX IDX_1D95A32FA76ED395 (user_id), INDEX IDX_1D95A32FB092A811 (store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, identity VARCHAR(255) NOT NULL, is_director TINYINT(1) NOT NULL, is_actor TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(2) NOT NULL, label VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medias_categories ADD CONSTRAINT FK_B3EB52FAEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE medias_categories ADD CONSTRAINT FK_B3EB52FA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE medias_languages ADD CONSTRAINT FK_6BEE21E0EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE medias_languages ADD CONSTRAINT FK_6BEE21E082F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE medias_subtitles ADD CONSTRAINT FK_6C06BB1FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE medias_subtitles ADD CONSTRAINT FK_6C06BB1F82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE user_store ADD CONSTRAINT FK_1D95A32FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_store ADD CONSTRAINT FK_1D95A32FB092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medias_categories DROP FOREIGN KEY FK_B3EB52FAEA9FDD75');
        $this->addSql('ALTER TABLE medias_languages DROP FOREIGN KEY FK_6BEE21E0EA9FDD75');
        $this->addSql('ALTER TABLE medias_subtitles DROP FOREIGN KEY FK_6C06BB1FEA9FDD75');
        $this->addSql('ALTER TABLE user_store DROP FOREIGN KEY FK_1D95A32FB092A811');
        $this->addSql('ALTER TABLE medias_languages DROP FOREIGN KEY FK_6BEE21E082F1BAF4');
        $this->addSql('ALTER TABLE medias_subtitles DROP FOREIGN KEY FK_6C06BB1F82F1BAF4');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE medias_categories');
        $this->addSql('DROP TABLE medias_languages');
        $this->addSql('DROP TABLE medias_subtitles');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE user_store');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE language');
    }
}
