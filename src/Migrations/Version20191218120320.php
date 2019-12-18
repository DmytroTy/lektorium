<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218120320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE staff (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(100) NOT NULL, email VARCHAR(30) NOT NULL, phone VARCHAR(15) NOT NULL, created_at DATE NOT NULL, skills VARCHAR(100) NOT NULL, comments VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE staff_department (staff_id INT NOT NULL, department_id INT NOT NULL, INDEX IDX_2B4FF15BD4D57CD (staff_id), INDEX IDX_2B4FF15BAE80F5DF (department_id), PRIMARY KEY(staff_id, department_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EE979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, team_lead_id INT DEFAULT NULL, company_id INT DEFAULT NULL, title VARCHAR(30) NOT NULL, description VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CD1DE18AFF2C34BA (team_lead_id), INDEX IDX_CD1DE18A979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_people (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, type VARCHAR(15) NOT NULL, responsibility VARCHAR(100) NOT NULL, INDEX IDX_3FB2816C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE staff_department ADD CONSTRAINT FK_2B4FF15BD4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE staff_department ADD CONSTRAINT FK_2B4FF15BAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AFF2C34BA FOREIGN KEY (team_lead_id) REFERENCES staff (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE project_people ADD CONSTRAINT FK_3FB2816C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE staff_department DROP FOREIGN KEY FK_2B4FF15BD4D57CD');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AFF2C34BA');
        $this->addSql('ALTER TABLE project_people DROP FOREIGN KEY FK_3FB2816C166D1F9C');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE979B1AD6');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A979B1AD6');
        $this->addSql('ALTER TABLE staff_department DROP FOREIGN KEY FK_2B4FF15BAE80F5DF');
        $this->addSql('DROP TABLE staff');
        $this->addSql('DROP TABLE staff_department');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE project_people');
    }
}
