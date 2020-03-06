<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200304093919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tablebislyon');
        $this->addSql('ALTER TABLE smsbureau ADD titresms VARCHAR(255) NOT NULL, CHANGE datesms datesms DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE adhesion CHANGE image_id image_id INT DEFAULT NULL, CHANGE statut statut VARCHAR(255) DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE lieu_naissance lieu_naissance VARCHAR(255) DEFAULT NULL, CHANGE nationnalite nationnalite VARCHAR(255) DEFAULT NULL, CHANGE nature_identite nature_identite VARCHAR(255) DEFAULT NULL, CHANGE number_identity number_identity VARCHAR(255) DEFAULT NULL, CHANGE voie voie VARCHAR(255) DEFAULT NULL, CHANGE novoie novoie VARCHAR(255) DEFAULT NULL, CHANGE nomvoie nomvoie VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE codepostale codepostale VARCHAR(5) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE profession profession VARCHAR(255) DEFAULT NULL, CHANGE birthday birthday DATE DEFAULT NULL, CHANGE dateadhesion dateadhesion DATETIME DEFAULT NULL, CHANGE dateecheancebis dateecheancebis DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE adhesion_id adhesion_id INT DEFAULT NULL, CHANGE date_signat date_signat DATETIME DEFAULT NULL, CHANGE signature signature VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE count CHANGE ref ref VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE p_un_ht p_un_ht NUMERIC(10, 0) DEFAULT NULL, CHANGE qte qte INT DEFAULT NULL, CHANGE remise remise NUMERIC(10, 0) DEFAULT NULL, CHANGE p_un_ht_rem p_un_ht_rem NUMERIC(10, 0) DEFAULT NULL, CHANGE prix_tot_ht prix_tot_ht NUMERIC(10, 0) DEFAULT NULL, CHANGE tva tva NUMERIC(10, 0) DEFAULT NULL, CHANGE date_bill date_bill DATETIME DEFAULT NULL, CHANGE total_ttc total_ttc NUMERIC(10, 0) DEFAULT NULL, CHANGE tot_cumul tot_cumul NUMERIC(10, 0) DEFAULT NULL, CHANGE date_cumul date_cumul DATETIME DEFAULT NULL, CHANGE date_echeance date_echeance DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE tablelyon CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE roles roles VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tablebislyon (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, roles VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, titre LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adhesion CHANGE image_id image_id INT DEFAULT NULL, CHANGE statut statut VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE first_name first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lieu_naissance lieu_naissance VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nationnalite nationnalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nature_identite nature_identite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE number_identity number_identity VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE voie voie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE novoie novoie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE nomvoie nomvoie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE pays pays VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE codepostale codepostale VARCHAR(5) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE profession profession VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE birthday birthday DATE DEFAULT \'NULL\', CHANGE dateadhesion dateadhesion DATETIME DEFAULT \'NULL\', CHANGE dateecheancebis dateecheancebis DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE count CHANGE ref ref VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE p_un_ht p_un_ht NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE qte qte INT DEFAULT NULL, CHANGE remise remise NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE p_un_ht_rem p_un_ht_rem NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE prix_tot_ht prix_tot_ht NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE tva tva NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE date_bill date_bill DATETIME DEFAULT \'NULL\', CHANGE total_ttc total_ttc NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE tot_cumul tot_cumul NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE date_cumul date_cumul DATETIME DEFAULT \'NULL\', CHANGE date_echeance date_echeance DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE smsbureau DROP titresms, CHANGE datesms datesms DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE tablelyon CHANGE firstname firstname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE lastname lastname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE adhesion_id adhesion_id INT DEFAULT NULL, CHANGE date_signat date_signat DATETIME DEFAULT \'NULL\', CHANGE signature signature VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
