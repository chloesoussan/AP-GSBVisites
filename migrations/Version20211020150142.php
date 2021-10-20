<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020150142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE famille (id VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, specialite_complementaire VARCHAR(255) DEFAULT NULL, departement INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id VARCHAR(255) NOT NULL, famille_id VARCHAR(255) NOT NULL, nom_commercial VARCHAR(255) NOT NULL, composition VARCHAR(255) NOT NULL, effets VARCHAR(255) NOT NULL, contre_indications VARCHAR(255) NOT NULL, INDEX IDX_9A9C723A97A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offrir (medicament_id VARCHAR(255) NOT NULL, rapport_id VARCHAR(255) NOT NULL, INDEX IDX_1D1E4ADEAB0D61F7 (medicament_id), INDEX IDX_1D1E4ADE1DFBCC46 (rapport_id), PRIMARY KEY(medicament_id, rapport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport (id VARCHAR(255) NOT NULL, medecin_id VARCHAR(255) NOT NULL, visiteur_id VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, motif VARCHAR(255) DEFAULT NULL, bilan VARCHAR(255) DEFAULT NULL, INDEX IDX_BE34A09C4F31A84 (medecin_id), INDEX IDX_BE34A09C7F72333D (visiteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, mdp VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, cp VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, date_embauche DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE offrir ADD CONSTRAINT FK_1D1E4ADEAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE offrir ADD CONSTRAINT FK_1D1E4ADE1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A97A77B84');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C4F31A84');
        $this->addSql('ALTER TABLE offrir DROP FOREIGN KEY FK_1D1E4ADEAB0D61F7');
        $this->addSql('ALTER TABLE offrir DROP FOREIGN KEY FK_1D1E4ADE1DFBCC46');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C7F72333D');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE offrir');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE visiteur');
    }
}
