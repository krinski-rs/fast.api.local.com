INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (1, 'SRW224G4', TRUE, NOW(), NULL, 'Linksys');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (2, 'SRW2024', TRUE, NOW(), NULL, 'Linksys');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (3, 'Summit-250e', TRUE, NOW(), NULL, 'Extreme');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (4, 'SummitX350-24t', TRUE, NOW(), NULL, 'Extreme');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (5, '3224F2', TRUE, NOW(), NULL, 'Datacom');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (6, 'Catalyst-2950', TRUE, NOW(), NULL, 'Cisco');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (7, 'Catalyst-2970', TRUE, NOW(), NULL, 'Cisco');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (8, 'SF-300', TRUE, NOW(), NULL, 'Cisco');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (9, 'SummitX450a-48t', TRUE, NOW(), NULL, 'Extreme');
INSERT INTO redes.switch_model(id, name, active, created_at, removed_at, brand) VALUES (10, 'SummitX350-48t', TRUE, NOW(), NULL, 'Extreme');

SELECT CONCAT('INSERT INTO redes.switch_model(
	id, name, active, created_at, removed_at, brand)
	VALUES (1, \'', modelo, '\', TRUE, NOW(), NULL, \'', marca, '\');') FROM gcdb.switch_templates;
