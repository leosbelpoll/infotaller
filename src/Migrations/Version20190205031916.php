<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190205031916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fcoches (id INT AUTO_INCREMENT NOT NULL, vehiculo_id INT DEFAULT NULL, idioma VARCHAR(255) NOT NULL, pocision_motor VARCHAR(255) DEFAULT NULL, distribucion VARCHAR(255) DEFAULT NULL, numero_cilindros VARCHAR(255) DEFAULT NULL, valvula_cilindro VARCHAR(255) DEFAULT NULL, cilindrada VARCHAR(255) DEFAULT NULL, potencia_maxima VARCHAR(255) DEFAULT NULL, par_motor_maxima VARCHAR(255) DEFAULT NULL, diametro_carrera VARCHAR(255) DEFAULT NULL, alimentacion VARCHAR(255) DEFAULT NULL, caja_cambio VARCHAR(255) DEFAULT NULL, desarrollos VARCHAR(255) DEFAULT NULL, marcha_atras VARCHAR(255) DEFAULT NULL, grupo_final VARCHAR(255) DEFAULT NULL, traccion VARCHAR(255) DEFAULT NULL, suspension_delantera VARCHAR(255) DEFAULT NULL, suspension_trasera VARCHAR(255) DEFAULT NULL, frenos_delanteros VARCHAR(255) DEFAULT NULL, frenos_traseros VARCHAR(255) DEFAULT NULL, neumaticos VARCHAR(255) DEFAULT NULL, llantas VARCHAR(255) DEFAULT NULL, tipo_direccion VARCHAR(255) DEFAULT NULL, radio_giro VARCHAR(255) DEFAULT NULL, vueltas_volante_tope VARCHAR(255) DEFAULT NULL, largo VARCHAR(255) DEFAULT NULL, ancho VARCHAR(255) DEFAULT NULL, alto VARCHAR(255) DEFAULT NULL, distancia_ejes VARCHAR(255) DEFAULT NULL, via_delantera VARCHAR(255) DEFAULT NULL, via_trasera VARCHAR(255) DEFAULT NULL, peso VARCHAR(255) DEFAULT NULL, capacidad_maletero VARCHAR(255) DEFAULT NULL, deposito_combustible VARCHAR(255) DEFAULT NULL, velocidad_maxima VARCHAR(255) DEFAULT NULL, aceleracion VARCHAR(255) DEFAULT NULL, consumo_urbano VARCHAR(255) DEFAULT NULL, consumo_extraurbano VARCHAR(255) DEFAULT NULL, consumo_medio VARCHAR(255) DEFAULT NULL, emisiones VARCHAR(255) DEFAULT NULL, combustible VARCHAR(255) DEFAULT NULL, INDEX IDX_5ED946D825F7D575 (vehiculo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clase (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehiculo (id INT AUTO_INCREMENT NOT NULL, marca_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', grupo_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', clase_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', tipo_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', usuario_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', modelo VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, fecha_inicio VARCHAR(255) NOT NULL, fecha_fin VARCHAR(255) DEFAULT NULL, creacion DATE NOT NULL, estado VARCHAR(255) NOT NULL, canti VARCHAR(255) DEFAULT NULL, pagado VARCHAR(255) DEFAULT NULL, INDEX IDX_C9FA16039F720353 (clase_id), INDEX IDX_C9FA160381EF0041 (marca_id), INDEX IDX_C9FA1603A9276E6C (tipo_id), INDEX IDX_C9FA16039C833003 (grupo_id), INDEX IDX_C9FA1603DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, vehiculo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, titulo VARCHAR(255) DEFAULT NULL, idioma VARCHAR(255) NOT NULL, tipo VARCHAR(255) NOT NULL, INDEX IDX_8C9F361025F7D575 (vehiculo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ficha (id INT AUTO_INCREMENT NOT NULL, vehiculo_id INT DEFAULT NULL, longitud_total VARCHAR(255) DEFAULT NULL, idioma VARCHAR(255) NOT NULL, distacia_ejes VARCHAR(255) DEFAULT NULL, altura_asiento VARCHAR(255) DEFAULT NULL, capacidad_combustible VARCHAR(255) DEFAULT NULL, cilindrada VARCHAR(255) DEFAULT NULL, diametro_cilindro VARCHAR(255) DEFAULT NULL, carrera_cilindro VARCHAR(255) DEFAULT NULL, relacion_compresion VARCHAR(255) DEFAULT NULL, potencia VARCHAR(255) DEFAULT NULL, rpm VARCHAR(255) DEFAULT NULL, alimentacion VARCHAR(255) DEFAULT NULL, encendido VARCHAR(255) DEFAULT NULL, arranque VARCHAR(255) DEFAULT NULL, embrague VARCHAR(255) DEFAULT NULL, chasis VARCHAR(255) DEFAULT NULL, suspension_delantera VARCHAR(255) DEFAULT NULL, recorrido_suspension VARCHAR(255) DEFAULT NULL, suspension_trasera VARCHAR(255) DEFAULT NULL, freno_delantero VARCHAR(255) DEFAULT NULL, freno_trasero VARCHAR(255) DEFAULT NULL, neumatico_delantero VARCHAR(255) DEFAULT NULL, neumatico_trasero VARCHAR(255) DEFAULT NULL, INDEX IDX_4B7E086125F7D575 (vehiculo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marca (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fcoches ADD CONSTRAINT FK_5ED946D825F7D575 FOREIGN KEY (vehiculo_id) REFERENCES vehiculo (id)');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA160381EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA16039C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id)');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA16039F720353 FOREIGN KEY (clase_id) REFERENCES clase (id)');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA1603A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo (id)');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA1603DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361025F7D575 FOREIGN KEY (vehiculo_id) REFERENCES vehiculo (id)');
        $this->addSql('ALTER TABLE ficha ADD CONSTRAINT FK_4B7E086125F7D575 FOREIGN KEY (vehiculo_id) REFERENCES vehiculo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehiculo DROP FOREIGN KEY FK_C9FA16039C833003');
        $this->addSql('ALTER TABLE vehiculo DROP FOREIGN KEY FK_C9FA16039F720353');
        $this->addSql('ALTER TABLE vehiculo DROP FOREIGN KEY FK_C9FA1603A9276E6C');
        $this->addSql('ALTER TABLE fcoches DROP FOREIGN KEY FK_5ED946D825F7D575');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F361025F7D575');
        $this->addSql('ALTER TABLE ficha DROP FOREIGN KEY FK_4B7E086125F7D575');
        $this->addSql('ALTER TABLE vehiculo DROP FOREIGN KEY FK_C9FA160381EF0041');
        $this->addSql('DROP TABLE fcoches');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE clase');
        $this->addSql('DROP TABLE tipo');
        $this->addSql('DROP TABLE vehiculo');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE ficha');
        $this->addSql('DROP TABLE marca');
    }
}
