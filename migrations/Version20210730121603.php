<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730121603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bibliotheque (id INT AUTO_INCREMENT NOT NULL, num_mus_id INT DEFAULT NULL, isbn_id INT DEFAULT NULL, date_achat DATETIME NOT NULL, INDEX IDX_4690D34D6D319670 (num_mus_id), INDEX IDX_4690D34DAFFF1118 (isbn_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moment (id INT AUTO_INCREMENT NOT NULL, jour VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musee (id INT AUTO_INCREMENT NOT NULL, code_pays_id INT DEFAULT NULL, num_mus INT NOT NULL, nom_mus VARCHAR(255) NOT NULL, nblivres INT NOT NULL, INDEX IDX_8884C8739E4306D8 (code_pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ouvrage (id INT AUTO_INCREMENT NOT NULL, code_pays_id INT DEFAULT NULL, isbn VARCHAR(255) NOT NULL, nb_page INT NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_52A8CBD89E4306D8 (code_pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, code_pays VARCHAR(255) NOT NULL, nbhabitant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referencer (id INT AUTO_INCREMENT NOT NULL, nom_site_id INT DEFAULT NULL, isbn_id INT DEFAULT NULL, numero_page INT NOT NULL, INDEX IDX_E8191D0A3321D8E (nom_site_id), INDEX IDX_E8191D0AAFFF1118 (isbn_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, code_pays_id INT DEFAULT NULL, nom_site VARCHAR(255) NOT NULL, anneedecouv DATETIME NOT NULL, INDEX IDX_694309E49E4306D8 (code_pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiter (id INT AUTO_INCREMENT NOT NULL, num_mus_id INT DEFAULT NULL, jour_id INT DEFAULT NULL, nbvisiteurs INT NOT NULL, INDEX IDX_300A09156D319670 (num_mus_id), INDEX IDX_300A0915220C6AD0 (jour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bibliotheque ADD CONSTRAINT FK_4690D34D6D319670 FOREIGN KEY (num_mus_id) REFERENCES musee (id)');
        $this->addSql('ALTER TABLE bibliotheque ADD CONSTRAINT FK_4690D34DAFFF1118 FOREIGN KEY (isbn_id) REFERENCES ouvrage (id)');
        $this->addSql('ALTER TABLE musee ADD CONSTRAINT FK_8884C8739E4306D8 FOREIGN KEY (code_pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE ouvrage ADD CONSTRAINT FK_52A8CBD89E4306D8 FOREIGN KEY (code_pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE referencer ADD CONSTRAINT FK_E8191D0A3321D8E FOREIGN KEY (nom_site_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE referencer ADD CONSTRAINT FK_E8191D0AAFFF1118 FOREIGN KEY (isbn_id) REFERENCES ouvrage (id)');
        $this->addSql('ALTER TABLE site ADD CONSTRAINT FK_694309E49E4306D8 FOREIGN KEY (code_pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE visiter ADD CONSTRAINT FK_300A09156D319670 FOREIGN KEY (num_mus_id) REFERENCES musee (id)');
        $this->addSql('ALTER TABLE visiter ADD CONSTRAINT FK_300A0915220C6AD0 FOREIGN KEY (jour_id) REFERENCES moment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visiter DROP FOREIGN KEY FK_300A0915220C6AD0');
        $this->addSql('ALTER TABLE bibliotheque DROP FOREIGN KEY FK_4690D34D6D319670');
        $this->addSql('ALTER TABLE visiter DROP FOREIGN KEY FK_300A09156D319670');
        $this->addSql('ALTER TABLE bibliotheque DROP FOREIGN KEY FK_4690D34DAFFF1118');
        $this->addSql('ALTER TABLE referencer DROP FOREIGN KEY FK_E8191D0AAFFF1118');
        $this->addSql('ALTER TABLE musee DROP FOREIGN KEY FK_8884C8739E4306D8');
        $this->addSql('ALTER TABLE ouvrage DROP FOREIGN KEY FK_52A8CBD89E4306D8');
        $this->addSql('ALTER TABLE site DROP FOREIGN KEY FK_694309E49E4306D8');
        $this->addSql('ALTER TABLE referencer DROP FOREIGN KEY FK_E8191D0A3321D8E');
        $this->addSql('DROP TABLE bibliotheque');
        $this->addSql('DROP TABLE moment');
        $this->addSql('DROP TABLE musee');
        $this->addSql('DROP TABLE ouvrage');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE referencer');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE visiter');
    }
}
