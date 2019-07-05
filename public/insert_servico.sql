INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (1, 'IP CORPORATIVO', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (2, 'VIP Connection', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (3, 'Carrier Last Mile', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (4, 'Gerencia', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (5, 'Argos', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (6, 'Outros', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (7, 'EAPS Controller', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (8, 'Voice', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (9, 'PTT RS', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (10, 'PTT SP', FALSE, NOW(), NOW());
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (11, 'IP ISP STECH', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (12, 'VIP CONNECTION LAN2', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (13, 'VIP CONNECTION VPN3', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (14, 'ACESSO PTT', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (15, 'VOICE CORPORATE', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (16, 'VOICE ISP', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (17, 'ARGOS CFTV', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (18, 'ARGOS CONFERENCE', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (19, 'CARRIER LAST MILE TDM', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (20, 'CARRIER LAST MILE ETH', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (21, 'VIP CONNECTION TDM', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (22, 'COBRANÇA ÚNICA', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (23, 'SESSÃO BGP4', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (24, 'BLOCO IP ADICIONAL', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (25, 'IP ISP STECH + PTT RS', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (26, 'IP ISP STECH + PTT SP', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (27, 'IP ISP STECH + PTT RS e PTT SP', TRUE, NOW(), NULL);
INSERT INTO redes.service(id, name, active, created_at, removed_at) VALUES (28, 'IP HOME STECH', TRUE, NOW(), NULL);

SELECT CONCAT('INSERT INTO redes.service(
	id, name, active, created_at, removed_at)
	VALUES (1, \'', servico, '\', ', IF(ativo = 1, 'TRUE', 'FALSE'),', NOW(), ', IF(ativo = 1, 'NULL', 'NOW()'),');') FROM gcdb.servico order by idservico;
