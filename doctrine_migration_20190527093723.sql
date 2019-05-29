-- Doctrine Migration File Generated on 2019-05-27 09:37:23

-- Version 20190527091633
ALTER TABLE property ADD filename VARCHAR(225) NOT NULL, CHANGE slug slug VARCHAR(255) NOT NULL;
INSERT INTO migration_versions (version, executed_at) VALUES ('20190527091633', CURRENT_TIMESTAMP);
