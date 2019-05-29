-- Doctrine Migration File Generated on 2019-05-27 09:33:31

-- Version 20190524111220
CREATE TABLE property_optionn (property_id INT NOT NULL, optionn_id INT NOT NULL, INDEX IDX_EAFEDC26549213EC (property_id),
         INDEX IDX_EAFEDC2698A88AB3 (optionn_id),
         PRIMARY KEY( optionn_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
ALTER TABLE property_optionn ADD CONSTRAINT FK_EAFEDC26549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE;
ALTER TABLE property_optionn ADD CONSTRAINT FK_EAFEDC2698A88AB3 FOREIGN KEY (optionn_id) REFERENCES optionn (id) ON DELETE CASCADE;
DROP TABLE optionn_property;
INSERT INTO migration_versions (version, executed_at) VALUES ('20190524111220', CURRENT_TIMESTAMP);

-- Version 20190527091633
ALTER TABLE property ADD filename VARCHAR(225) NOT NULL, CHANGE slug slug VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20190527091633', CURRENT_TIMESTAMP);
